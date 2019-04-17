<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use App\Donors;
class DonorsController extends Controller
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
        $donors="[{\"type\": \"\", \"salutation\": \"\",\"name\": \"\",\"address\": \"\",\"pincode\": \"\",\"city\": \"\",\"state\": \"\",\"country\": \"\",\"email\": \"\",\"mobile\": \"\",\"landline\": \"\",\"pan\": \"\",\"dob\": \"\",\"updates\": \"\",\"remarks\": \"\"}]";
        $donors=json_decode($donors);
        return view('adddonor',compact('donors'));
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

                ['type'=>"required",
                'salutation'=>"required",'name'=>"required",'pincode'=>"required",
                'email'=>"nullable|email|unique:donors",'mobile'=>"nullable|numeric|digits:10|unique:donors",'landline'=>"nullable|integer",
                'dob'=>"nullable|date",'pan'=>"nullable|unique:donors"]
        );
       $donor= Donors::create([
            'type'=>request('type'),
            'salutation'=>request('salutation'),'name'=>request('name'),
            'address'=>request('address'),'pincode'=>request('pincode'),
            'city'=>request('city'),'state'=>request('state'),
            'country'=>request('country'),'email'=>request('email'),
            'mobile'=>request('mobile'),'landline'=>request('landline'),
            'dob'=>request('dob'),'pan'=>strtoupper(request('pan')),
            'remarks'=>request('remarks'),'updates'=>request('updates'),
            'user'=> Auth::user()->email,
        ]);
		if(request('mobile')!=null){
           $url="http://bulk.mobiglitz.com/pushsms.php?username=SRMABB&api_password=68237bjula7diphcy&sender=SRMABB&to=".request('mobile')."&priority=11&message=";
           $sms="Dear ";
           if(strcmp(request('type'),"Individual"))$sms=$sms."".request('salutation').". ";
           $sms=$sms."".request('name');
           $sms=$sms.", welcome to SRMAB. Your PAN:";
           $sms=$sms."".request('pan').", E:".request('email').".Pl share our work with friends %26 family www.srmab.org.in / 080-26581076";

            $url=$url."".urlencode($sms);
            $curl = curl_init($url);
            $resp = curl_exec($curl);
            curl_close($curl);
        }
        $donordetails=\App\Donors::where('id','=',$donor->id)->first();
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
            else if(strpos($id, ':') !== false){

                $id=strtoupper($id);
                $id2=str_replace(':', '/', $id);
                $receipts=\App\Receipts::where('repno','=',$id2)->count();
                if($receipts>0)return redirect("receipts/".$id);
                $field="id";

            }
	    	else {
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
        //
        $donors = Donors::where('id','=',$id)->get();

        return view('editdonor',compact('donors'));
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
        $this->validate(request(),

                ['type'=>"required",
                'salutation'=>"required",'name'=>"required",'pincode'=>"required",
                'email'=>"nullable|email|unique:donors,email,".$id,'mobile'=>"nullable|numeric|digits:10|unique:donors,mobile,".$id,'pan'=>'nullable|unique:donors,pan,'.$id,'landline'=>"nullable|integer",
                'dob'=>"nullable|date",]
        );
        Donors::find($id)->update([
            'type'=>request('type'),
            'salutation'=>request('salutation'),'name'=>request('name'),
            'address'=>request('address'),'pincode'=>request('pincode'),
            'city'=>request('city'),'state'=>request('state'),
            'country'=>request('country'),'email'=>request('email'),
            'mobile'=>request('mobile'),'landline'=>request('landline'),
            'dob'=>request('dob'),'pan'=>strtoupper(request('pan')),
            'remarks'=>request('remarks'),'updates'=>request('updates')
        ]);
        $donordetails=\App\Donors::where('id','=',$id)->first();
		
		if(request('mobile')!=null){
           
           $url="http://bulk.mobiglitz.com/pushsms.php?username=SRMABB&api_password=68237bjula7diphcy&sender=SRMABB&to=".request('mobile')."&priority=11&message=";
           $sms="Dear ";
           if(strcmp(request('type'),"Individual"))$sms=$sms."".request('salutation').". ";
           $sms=$sms."".request('name');
           $sms=$sms.", welcome to SRMAB. Your PAN:";
           $sms=$sms."".request('pan').", E:".request('email').".Pl share our work with friends %26 family www.srmab.org.in / 080-26581076";

            $url=$url."".urlencode($sms);
            $curl = curl_init($url);
            $resp = curl_exec($curl);
            curl_close($curl);
        }
        if(Input::get('exit')){
            return redirect('/index');   
        }
        else{
            return redirect('receipts/create?donordetails='.$donordetails);

        }
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
