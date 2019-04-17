<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\RepNo;

class ReceiptsController extends Controller
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
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        //dd(request('donordetails'));
        
        $repno_query=RepNo::where('fyactive','=','y')->get();
       // $repno=$sec."/".$repno_query."/".$repno_query->repno;
        //dd($recpdata[0]);

        $donordetails=request('donordetails');
        $donordetails=json_decode($donordetails);
        $paymodes= \App\PayMode::get();
        $prevrecps=\App\Receipts::where('donorid','=',$donordetails->id)->orderBy('id', 'desc')->get();
        $donpurposes=\App\DonationPurposeMaster::get();
        $unlinkedevents=\App\Events::where('donorid','=',$donordetails->id)->get();
        $i=0;
        
        $event=array();
        /*
        putenv("GOOGLE_APPLICATION_CREDENTIALS={$_SERVER['DOCUMENT_ROOT']}/".getenv('APP_NAME')."".getenv('GOOGLE_CREDENTIALS_LOCATION'));
        define('SCOPES', implode(' ', array(\Google_Service_Calendar::CALENDAR)));

        foreach ($unlinkedevents as $unlinkedevent) {
          try{
            $client = new \Google_Client();
            $client->useApplicationDefaultCredentials();
            $client->setScopes(SCOPES);
            $service = new \Google_Service_Calendar($client);
                
            $calendarId = 'srmab.org.in_i1qp0qje47do94eje9nn3rdqrg@group.calendar.google.com';
            if(count($service->events->get($calendarId, $unlinkedevent->event)->recurrence)<2&&$service->events->get($calendarId, $unlinkedevent->event)->status=="tentative"){
                $event[$i++] = $service->events->get($calendarId, $unlinkedevent->event);   
            }
            else if($service->events->get($calendarId, $unlinkedevent->event)->status=="tentative"){
                $noofexdate=substr_count($service->events->get($calendarId, $unlinkedevent->event)->recurrence[0],",");
                $noofexdate++;
                $noofinstance=explode("COUNT=",$service->events->get($calendarId, $unlinkedevent->event)->recurrence[1]);
                if($noofinstance[1]-$noofexdate>0){
                    $event[$i++] = $service->events->get($calendarId, $unlinkedevent->event); 

                }
            }
          }catch(\GuzzleHttp\Exception\ConnectException $e){
              $event=[];
              $dispevents=0;
          }
        }
        */
        $unlinkedevents=$event;
        return view('receipt',compact('donordetails', 'repno_query', 'paymodes','prevrecps','donpurposes','unlinkedevents'));

        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return view('recpconfirm',$repno);


        $this->validate(request(),

                ['amount'=>"required|integer"]);
       $repno=request('repsec')."/".request('repfy')."/".request('repno');

       $receipt= \App\Receipts::create([
            'repno'=>$repno,'section'=>request('repsec'),'fy'=>request('repfy'),
            'amount'=>request('amount'),'date'=>date("Y-m-d"),
            'paymode'=>request('paymode'),'cno'=>request('cno'),
            'cdate'=>request('cdate'),'bank'=>request('bank'),
            'donorid'=>request('donorid'),'remarks'=>request('remarks'),'user'=> Auth::user()->email
        ]);
        $purposes=request('purpose');
        $mailstatus=1;
        $repid=$receipt->id;
        if($purposes!=null)
        foreach($purposes as $purpose){
            \App\DonationPurpose::create([
                'repid'=>$repid,'purpose'=>$purpose
            ]);
        }
        RepNo::where('sec','=',request('repsec'))->where('fyactive','=','y')->increment('repno');
        $donor = \App\Donors::where('id','=',request('donorid'))->first();

        $receipt = $request->all();
        if($donor->email!=""){
          try{
              \Mail::send('eacknowledgement',compact('receipt','donor','repno'),function($message) use ($donor){
                  $message->from("mail@srmab.org.in","SRMAB");
                  $message->to($donor->email);
                  $message->subject("eAcknowledgement Receipt");
               });
         }
          catch(Exception $e){
              echo "<script>alert('here1');</script>";
              $mailstatus=0;

          }
          catch(\Swift_TransportException $e){
              echo "<script>alert('here2 ".$e->getMessage()."');</script>";
              $mailstatus=0;
          }
          if (\Mail::failures()) {
              echo "<script>alert('here3');</script>";
              $mailstatus=0;
          }
        }
        else{
          echo "<script>alert('here4');</script>";
          $mailstatus=0;

        }
		
		if($donor->mobile!=null){
          
           $url="http://bulk.mobiglitz.com/pushsms.php?username=SRMABB&api_password=68237bjula7diphcy&sender=SRMABB&to=".$donor->mobile."&priority=11&message=";
           $sms="Dear ";
           if(strcmp(request('type'),"Individual"))$sms=$sms."".$donor->salutation.". ";
           $sms=$sms."".$donor->name;
           $sms=$sms.", Thank you for you donation of Rs.".request('amount')." vide Recp No.".$repno;
           $sms=$sms.".Pl share our work with friends %26 family www.srmab.org.in / 080-26581076";

            $url=$url."".urlencode($sms);
            $curl = curl_init($url);
            $resp = curl_exec($curl);
            curl_close($curl);
        }
        if(request('link')!=""){
          putenv("GOOGLE_APPLICATION_CREDENTIALS={$_SERVER['DOCUMENT_ROOT']}/".getenv('APP_NAME')."".getenv('GOOGLE_CREDENTIALS_LOCATION'));
          define('SCOPES', implode(' ', array(\Google_Service_Calendar::CALENDAR)));
          try{
          $client = new \Google_Client();
          $client->useApplicationDefaultCredentials();
          $client->setScopes(SCOPES);            
          $service = new \Google_Service_Calendar($client);        
          $calendarId = 'srmab.org.in_i1qp0qje47do94eje9nn3rdqrg@group.calendar.google.com';
          $events=$service->events->instances($calendarId, request('link')); 
          $flag=0;
          $newevent;
          foreach ($events as $event) {
              if($event->status=="tentative"){
                  $newevent=$event;
                  $flag=1;
              }
              if($flag==1)break;
          }
          $exdate=$event->start->date;
          $events=$service->events->get($calendarId,request('link'));

          if(count($events->recurrence)<2){
              array_push($events->recurrence,"EXDATE;VALUE=DATE:".date('Ymd',strtotime($exdate)));
          }
          else{
              $events->recurrence[0]=$events->recurrence[0].",".date('Ymd',strtotime($exdate));
          }
          $UpdatedEvent=$service->events->update($calendarId, $events->getId(), $events);
              $client = new \Google_Client();
              $client->useApplicationDefaultCredentials();
              $client->setScopes(SCOPES);
              $service = new \Google_Service_Calendar($client);
              $event = new \Google_Service_Calendar_Event(array(
                'summary' => $newevent->summary,
                'description' => $repno."::".$newevent->description,
                'status'=>'confirmed',
                'start' => array(
                  'date' => $exdate,
                  'timeZone' => 'Asia/Calcutta',
                ),
                'end' => array(
                  'date' => $exdate,
                  'timeZone' => 'Asia/Calcutta',
                  ),
              ));
          $event = $service->events->insert($calendarId, $event);
        }catch(\GuzzleHttp\Exception\ConnectException $e){
                    $event=[];
        }
        }
        return view('recpconfirm',compact('repid','mailstatus')); 
    }
        
    public function reports(){

        $paymodes= \App\PayMode::get();
        $donpurposes=\App\DonationPurposeMaster::get();
        $showrep=0;
        return view('reports',compact('paymodes','donpurposes','showrep')); 

    }
    public function getreports(Request $request){

      $sections=request('sections');
      $purposes=request('purposes');
      $paymodes=request('paymodes');
      $report=\App\Receipts::join('donors','receipts.donorid','=','donors.id')->leftjoin('donation_purposes','receipts.id','=','donation_purposes.repid')->where('receipts.date','>=',$request->from)->where('receipts.date','<=',$request->to)->distinct('receipts.id');

      if($sections!=""){
        $report=$report->whereIn('receipts.section',$sections);
      }
      if($paymodes!=""){
        $report=$report->whereIn('receipts.paymode',$paymodes);
      }
      if($purposes!=""){
        $report=$report->whereIn('donation_purposes.purpose',$purposes);
      }
     $report=$report->get();
      $showrep=1;
      $paymodes= \App\PayMode::get();
      $donpurposes=\App\DonationPurposeMaster::get();
      return view('reports',compact('report','showrep','donpurposes','paymodes'));
    }  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(strpos($id, ':') !== false){

            $id=str_replace(':', '/', $id);
            $receipts=\App\Receipts::where('repno','=',$id)->first();
            $donordetails = \App\Donors::where('id','=',$receipts->donorid)->first();

            //dd($donordetails); 
            return view('viewrecp',compact('receipts','donordetails'));

        }
        else{
         $receipts= \App\Receipts::where('id','=',$id)->get();
         foreach ($receipts as $receipt) {
             # code.
                $receipt->amountinwords=ReceiptsController::no_to_words($receipt->amount);
                $receipt->amount=ReceiptsController::moneyFormat($receipt->amount);
                $donorid= $receipt->donorid;
         }
         $donors= \App\Donors::where('id','=',$donorid)->get();
         foreach ($donors as $donor) {
             # code.
            if($donor->email=="")$donor->email="NIL";
            if($donor->pan=="")$donor->pan="NIL";
            if($donor->mobile=="")$donor->mobile="NIL";

         }
         return view('print',compact('receipts','donors'));
        }

    }
    public function moneyFormat($num){
        $explrestunits = "" ;
        if(strlen($num)>3){
            $lastthree = substr($num, strlen($num)-3, strlen($num));
            $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
            $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
            $expunit = str_split($restunits, 2);
            for($i=0; $i<sizeof($expunit); $i++){
                // creates each of the 2's group and adds a comma to the end
                if($i==0)
                {
                    $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
                }else{
                    $explrestunits .= $expunit[$i].",";
                }
            }
            $thecash = $explrestunits.$lastthree;
        } else {
            $thecash = $num;
        }
        return $thecash; // writes the final format where $currency is the currency symbol.
    }
    public function no_to_words($no){   
     $words = array('0'=> '' ,'1'=> 'One' ,'2'=> 'Two' ,'3' => 'Three','4' => 'Four','5' => 'Five','6' => 'Six','7' => 'Seven','8' => 'Eight','9' => 'Nine','10' => 'Ten','11' => 'Eleven','12' => 'Twelve','13' => 'Thirteen','14' => 'Fouteen','15' => 'Fifteen','16' => 'Sixteen','17' => 'Seventeen','18' => 'Eighteen','19' => 'Nineteen','20' => 'Twenty','30' => 'Thirty','40' => 'Fourty','50' => 'Fifty','60' => 'Sixty','70' => 'Seventy','80' => 'Eighty','90' => 'Ninty','100' => 'Hundred','1000' => 'Thousand','100000' => 'Lakh','10000000' => 'Crore');
        if($no == 0)
            return ' ';
        else {
        $novalue='';
        $highno=$no;
        $remainno=0;
        $value=100;
        $value1=1000;       
                while($no>=100)    {
                    if(($value <= $no) &&($no  < $value1))    {
                    $novalue=$words["$value"];
                    $highno = (int)($no/$value);
                    $remainno = $no % $value;
                    break;
                    }
                    $value= $value1;
                    $value1 = $value * 100;
                }       
              if(array_key_exists("$highno",$words))
                  return $words["$highno"]." ".$novalue." ".ReceiptsController::no_to_words($remainno);
              else {
                 $unit=$highno%10;
                 $ten =(int)($highno/10)*10;            
                 return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".ReceiptsController::no_to_words($remainno);
               }
        }
    }  
    public function edit($id)
    {
        //
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
        //
        \App\Receipts::find($id)->update([
            'reason'=>request('reason'),
            'status'=>"Cancelled",
        ]);

        $receipts=\App\Receipts::where('id','=',$id)->first();
        $donordetails = \App\Donors::where('id','=',$receipts->donorid)->first();

            //dd($donordetails); 
        return view('viewrecp',compact('receipts','donordetails'));

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
