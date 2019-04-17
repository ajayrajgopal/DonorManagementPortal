							@foreach($donors as $donor)
	                		    {{ csrf_field() }}

                                		<div class="row">
	                                        <div class="col-lg-4 col-md-4 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Donor Type</label>
	                                            <div class="col-lg-7 col-md-7">
	                                            <select class="form-control" name='type' id='type' onchange="sal()">
                                                    <option value="Individual">Individual</option>
                                                    <option value="Company">Company</option>
                                                </select>
	                                            </div>

	                                        </div>
	                                        <div class="col-lg-4 col-md-4 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Saluation</label>
	                                            <div class="col-lg-7 col-md-7">
	                                            <select class="form-control" name='salutation' id='salutation' required>
                                                    <option value="" selected>Select</option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Mrs">Mrs</option>
                                                    <option value="Ms">Ms</option>
                                                    <option value="Dr">Dr</option>
                                                    <option value="C" disabled> </option>
                                                </select>
	                                            </div>
	                                        </div>
	                                        <div class="col-lg-4 col-md-4 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Name</label>
	                                            <div class="col-lg-7 col-md-7">
	                                                <input type="text" name='name' id='name' class="form-control" value="{{$donor->name}}" required="required">
	                                            </div>

	                                        </div>
                                        </div>
                                        <div class="row">
	                                        <div class="col-lg-4 col-md-4 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Address</label>
	                                            <div class="col-lg-7 col-md-7">

      												<textarea class="form-control" rows="3" name="address" id="address">{{$donor->address}}</textarea>
	                                            </div>

	                                        </div>
	                                        <div class="col-lg-4 col-md-4 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Pincode</label>
	                                            <div class="col-lg-7 col-md-7">
	                                                <input type="text" class="form-control" name="pincode" id="pincode" value="{{$donor->pincode}}" onchange="pinupdate()" required>
	                                            </div>
	                                            <label class="col-lg-5 col-md-5 control-label">City</label>
	                                            <div class="col-lg-7 col-md-7">
	                                                <input type="text" class="form-control" value="{{$donor->city}}" name="city" id="city">
	                                            </div>
	                                        </div>
	                                        <div class="col-lg-4 col-md-4 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">State</label>
	                                            <div class="col-lg-7 col-md-7">
	                                                <input type="text" class="form-control" name="state" id="state" value="{{$donor->state}}">
	                                            </div>
	                                            <label class="col-lg-5 col-md-5 control-label">Country</label>
	                                            <div class="col-lg-7 col-md-7">
	                                                <input type="text" class="form-control" name="country" id="country" value="{{$donor->country}}">
	                                            </div>

	                                        </div>
                                        </div>
                                        <div class="row">
	                                        <div class="col-lg-4 col-md-4 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Email</label>
	                                            <div class="col-lg-7 col-md-7">
	                                                <input type="email" class="form-control" id="email" name="email" value="{{$donor->email}}">
	                                            </div>

	                                        </div>
	                                        <div class="col-lg-4 col-md-4 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Mobile</label>
	                                            <div class="col-lg-7 col-md-7">
	                                                <input type="text" class="form-control" id="mobile" name='mobile' value="{{$donor->mobile}}">
	                                            </div>

	                                        </div>
	                                        <div class="col-lg-4 col-md-4 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Landline</label>
	                                            <div class="col-lg-7 col-md-7">
	                                                <input type="text" class="form-control" id="landline" name='landline' value="{{$donor->landline}}">
	                                            </div>

	                                        </div>
                                        </div>
                                        <div class="row">
	                                        <div class="col-lg-4 col-md-4 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">DOB</label>
	                                            <div class="col-lg-7 col-md-7">
	                                                <input type="date" class="form-control" id="dob" name='dob' value="{{$donor->dob}}">
	                                            </div>
	                                            <label class="col-lg-5 col-md-5 control-label">PAN</label>
	                                            <div class="col-lg-7 col-md-7">
	                                                <input type="text" class="form-control" id="pan" name="pan" value="{{$donor->pan}}">
	                                            </div>

	                                        </div>
	                                        <div class="col-lg-4 col-md-4 form-group">
	                                            
	                                        	<label class="col-lg-5 col-md-5 control-label">Remarks</label>
	                                            <div class="col-lg-7 col-md-7">

      												<textarea class="form-control" rows="3" name="remarks" id="remarks" value="{{$donor->remarks}}"></textarea>
	                                            </div>
	                                        </div>
	                                        <div class="col-lg-4 col-md-4 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Updates via</label>
	                                            <div class="col-lg-7 col-md-7">
	                                            	<select class="form-control" name="updates" id="updates">
	                                                    <option>Email</option>
	                                                    <option>Post</option>
	                                                    <option>Both</option>
	                                                    <option>None</option>
                                                	</select>
	                                            </div>

	                                        </div>
                                        </div>

                                        

									    <script type="text/javascript">
									    	function pinupdate(){
												
												var url1='https://api.data.gov.in/resource/6176ee09-3d56-4a3b-8115-21841576b2f6?format=json&api-key=579b464db66ec23bdd0000018082395e663b45a245a03e62f6b490ff&filters[pincode]=';
												var query=document.getElementById("pincode").value;
												var url2='&fields=districtname,statename&limit=1';
												var Url=url1.concat(query);
												var Url= Url.concat(url2);
												if (window.XMLHttpRequest)
											    {// code for IE7+, Firefox, Chrome, Opera, Safari
											        xmlhttp=new XMLHttpRequest();
											    }
											    else
											    {// code for IE6, IE5
											        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
											    }
											    xmlhttp.onreadystatechange=function()
											    {
											        if (xmlhttp.readyState==4 && xmlhttp.status==200)
											        {
														
														var obj = JSON.parse(xmlhttp.responseText);
														document.getElementById("city").value = obj.records[0].districtname;
														document.getElementById("state").value = obj.records[0].statename;
														if(document.getElementById("city").value!='')document.getElementById("country").value='INDIA'; 
											        }
											    }
											    xmlhttp.open("GET", Url, false );
											    xmlhttp.send();  
											}
									    	var errors="{{count($errors)}}";
									    	if(errors>0){
									    		document.getElementById('name').value="{{ old('name') }}";
									    		document.getElementById('address').value="{{ old('address') }}";
									    		document.getElementById('city').value="{{ old('city') }}";
									    		document.getElementById('state').value="{{ old('state') }}";
									    		document.getElementById('country').value="{{ old('country') }}";
									    		document.getElementById('email').value="{{ old('email') }}";
									    		document.getElementById('mobile').value="{{ old('mobile') }}";
									    		document.getElementById('pan').value="{{ old('pan') }}";
									    		document.getElementById('landline').value="{{ old('landline') }}";
									    		document.getElementById('dob').value="{{ old('dob') }}";
									    		document.getElementById('remarks').value="{{ old('remarks') }}";
									    		document.getElementById('pincode').value="{{ old('pincode') }}";
									    	}
									    	function sal(){
									    		var typ=document.getElementById('type').value;
									    		var sal=document.getElementById("salutation");
												if(typ=='Company'){
													sal.options[0].disabled = true;
													sal.options[1].disabled = true;
													sal.options[2].disabled = true;
													sal.options[3].disabled = true;
													sal.options[4].disabled = true;
													sal.options[5].disabled = false;
													sal.selectedIndex = 5;
												}
												if(typ=='Individual'){
													sal.selectedIndex = 0;
													sal.options[0].disabled = false;
													sal.options[1].disabled = false;
													sal.options[2].disabled = false;
													sal.options[3].disabled = false;
													sal.options[4].disabled = false;
													sal.options[5].disabled = true;
												}
									    	}

                                    	</script>
                            @endforeach