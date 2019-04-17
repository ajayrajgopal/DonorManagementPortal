<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;

use App\Events;

class EventsController extends Controller
{
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        /*
            
                $events = [];

                $events[] = \Calendar::event(
                    'Event One', //event title
                    false, //full day event?
                    '2015-02-11T0800', //start time (you can also use Carbon instead of DateTime)
                    '2015-02-12T0800', //end time (you can also use Carbon instead of DateTime)
                    0 //optionally, you can specify an event ID
                );

                $events[] = \Calendar::event(
                    "Valentine's Day", //event title
                    true, //full day event?
                    new \DateTime('2015-02-14'), //start time (you can also use Carbon instead of DateTime)
                    new \DateTime('2015-02-14'), //end time (you can also use Carbon instead of DateTime)
                    'stringEventId' //optionally, you can specify an event ID
                );

                /*$eloquentEvent = EventModel::first(); //EventModel implements MaddHatter\LaravelFullcalendar\Event
                
                $eloquentEvent="";
                $calendar = \Calendar::addEvents($events);
            putenv("GOOGLE_APPLICATION_CREDENTIALS={$_SERVER['DOCUMENT_ROOT']}/".getenv('APP_NAME')."".getenv('GOOGLE_CREDENTIALS_LOCATION'));
            define('SCOPES', implode(' ', array(\Google_Service_Calendar::CALENDAR)));
            try{
                $client = new \Google_Client();
                $client->useApplicationDefaultCredentials();
                $client->setScopes(SCOPES);
                $service = new \Google_Service_Calendar($client);
                $calendarId = 'srmab.org.in_i1qp0qje47do94eje9nn3rdqrg@group.calendar.google.com';
                
                $optParams = array('timeMin' =>date('c', strtotime(date('Y-m-d'))),'singleEvents' => 'true', 'maxResults' => 10,'orderBy' => "startTime");
                
                $events = $service->events->listEvents($calendarId,$optParams);
                $events = $events->getItems();
                $dispevents=1;

                }catch(\GuzzleHttp\Exception\ConnectException $e){
                    $events=[];
                    $dispevents=0;
                }
                    $donorsevents= Events::join('donors','events.donorid','=','donors.id')->get();

                
                $unpaidevents=[[]];
                foreach($events as $event){
                    foreach ($donorsevents as $donorsevent) {
                        if($event->recurringEventId==$donorsevent->event){
                            $event['donorname']=$donorsevent->name;
                            $event['mobile']=$donorsevent->mobile;
                        }
                    }
                */
                    $events=[];
           return view('index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    	$id=request('id');
        $eventtypes=\App\EventTypes::get();
        $subeventtypes=\App\EventSubTypes::get();
    	return view('event',compact('id','eventtypes','subeventtypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),

                ['name'=>"required",'date'=>"required","eventtype"=>"required"]
        );
        putenv("GOOGLE_APPLICATION_CREDENTIALS={$_SERVER['DOCUMENT_ROOT']}/".getenv('APP_NAME')."".getenv('GOOGLE_CREDENTIALS_LOCATION'));
        if(request('recurrence')!=""){

            $recur='RRULE:FREQ='.request('recurrence').';COUNT=';
            if(request('recurrenceno')!="")$recur=$recur.''.request('recurrenceno');
            else $recur=$recur.'1';
        }
        else{
            $recur='RRULE:FREQ=DAILY;COUNT=1';

        }
        if(request('subeventtype')!="")$eventtitle=request('eventtype')."-".request('subeventtype');
        else $eventtitle=request('eventtype');
        if(request('description')!="")$eventdesp=request('name')."\n".request('description')."\n";
        else $eventdesp=request('name')."\n";
        define('SCOPES', implode(' ', array(\Google_Service_Calendar::CALENDAR)));
		try{	
            $client = new \Google_Client();
			$client->useApplicationDefaultCredentials();
			$client->setScopes(SCOPES);
			$service = new \Google_Service_Calendar($client);
			$event = new \Google_Service_Calendar_Event(array(
			  'summary' => $eventtitle,
			  'description' => $eventdesp,
              'status'=>'tentative',
			  'start' => array(
			    'date' => request('date'),
			    'timeZone' => 'Asia/Calcutta',
			  ),
              'end' => array(
                'date' => request('date'),
                'timeZone' => 'Asia/Calcutta',
                ),
			  'recurrence' => array(
                $recur
			  )
			));

    	$calendarId = 'srmab.org.in_i1qp0qje47do94eje9nn3rdqrg@group.calendar.google.com';
    	$event = $service->events->insert($calendarId, $event);
        }
        catch(\GuzzleHttp\Exception\ConnectException $e){
                    $events=[];
        }
        $newevent=Events::create(['event'=>$event->id,"donorid"=>request('donorid')]);
        $donordetails=\App\Donors::where('id','=',request('donorid'))->first();
        if(Input::get('exit')){
            return redirect('/index');   
        }
        else{
            return redirect('receipts/create?donordetails='.$donordetails);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    	$field;
    	if($id[0]=='&'){
    		$id=substr($id, 1);
        	$donors = Donors::where('id','=',$id)->get();
    	}
    	else{
    		if(is_numeric($id)){
    			$field='mobile';
	    	}
	    	else if (strpos($id, '@') !== false) {
	    		$field='email';
			}
			else if (!preg_match('/[^A-Za-z]/', $id)) {
				$field='name';
			}
	    	else{
	    		$field='pan';
	    	}
        	
	        $donors = Donors::where($field,'LIKE','%'.$id."%")->get();
    	}
    	
        return view('search',compact('donors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \IlluminSte\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect('donors/&'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
class EventModel extends Model implements \MaddHatter\LaravelFullcalendar\Event
{

    protected $dates = ['start', 'end'];

    /**
     * Get the event's id number
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return (bool)$this->all_day;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }
}