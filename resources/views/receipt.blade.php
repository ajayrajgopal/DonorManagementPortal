
@extends('layouts.donorlayout')

@section('pagetitle')
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Donation Receipt</h4>
                        </div>
                    </div>
                </div>
@endsection('pagetitle')

@section('content2')
<style type="text/css">
            .table-fixed table{
                overflow-x: auto;
            }
            .table-fixed tbody {
              max-height: 230px;
              overflow-y: auto;

              min-width: 100%;
            }
            .table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
              display: block;
            }
            .table-fixed tbody td, .table-fixed thead > tr> th {
              float: left;
              border-bottom-width: 0;
            }
            td{
                 word-wrap:break-word;
            }
        </style>
<div class="col-lg-8 col-md-8 col-xs-12">
            	<div class="card-box col-lg-12">
            		<div class="row col-lg-12">
            		<div class="row col-lg-12">
			                	 @if(count($errors))
				                <div class="form-group">
				                	<div class="alert alert-danger">
				                		<ul>
				                			@foreach($errors->all() as $error)
				                				<li>{{ $error }}</li>
				                			@endforeach
				                		</ul>
				                	</div>
				                </div>
				                @endif
			                                           
                                            
                                <form class="form-horizontal" role="form" method="POST" action="/receipts">

                                	<div class="row col-lg-12">
	                                    <div class="col-lg-6 col-md-6 form-group">
	                                    {{ csrf_field() }}
	                                            <label class="col-lg-5 col-md-5 control-label">Receipt No</label>
	                                            <div class="col-lg-6 col-md-6">
	                                            <input type="hidden" name="repsec" id="repsec">
	                                            <input type="hidden" name="repfy" id="repfy">
	                                            <input type="hidden" name="repno" id="repno">
	                                            <input type="hidden" name="donorid" id="donorid" value="{{ $donordetails->id }}">
                                					<h5 id="repnodisp"></h5>
	                                            </div>
	                                    </div>
	                                        <div class="col-lg-6 col-md-6 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Date</label>
	                                            <div class="col-lg-6 col-md-6">
	                                            	
                                					<h5>{{ date('j F Y') }}</h5>
	                                            </div>
	                                        </div>
	                            	</div>

                                        <div class="row col-lg-12">
	                                        <div class="col-lg-6 col-md-6 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Section</label>
												
	                                            <div class="col-lg-7 col-md-7">
													
	                                                <select class="btn btn-default waves-effect form-control" name="recptype" id='recptype' onchange="updaterecp()" required="required">
	                                           			<option value="">Receipt Type</option>
														@if(Session::get('srmabrep')=='Y')
	                                           			<option value="D">SRMAB Donation</option>
	                                           			<option value="C">SRMAB Corpus</option>
														@endif
														@if(Session::get('trdcrep')=='Y')
	                                           			<option value="T/C">TRDC Donation</option>
	                                           			<option value="T/C">TRDC Corpus</option>
														@endif
														@if(Session::get('otherrep')=='Y')
														<option value="O/D">Other Donation</option>
														<option value="O/C">Other Corpus</option>
														@endif
	                                           		</select>
													
	                                            </div>

	                                        </div>

	                                        <div class="col-lg-6 col-md-6 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Chq/Trn No</label>
	                                            <div class="col-lg-7 col-md-7">
	                                                <input type="text" class="form-control" id="cno" name='cno' disabled="disabled">
	                                            </div>
	                                        </div>
                                        </div>
                                		<div class="row col-lg-12">
	                                        <div class="col-lg-6 col-md-6 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Amount</label>
	                                            <div class="col-lg-7 col-md-7">
	                                                <input type="text" class="form-control" name='amount' required="required">
	                                            </div>

	                                        </div>
	                                        <div class="col-lg-6 col-md-6 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Chq/Trn Date</label>
	                                            <div class="col-lg-7 col-md-7">
	                                                <input type="date" class="form-control" id="cdate" name='cdate' disabled="disabled">
	                                            </div>
	                                        </div>
                                        </div>
                                        <div class="row col-lg-12">
	                                        <div class="col-lg-6 col-md-6 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Pay Mode</label>
	                                            <div class="col-lg-7 col-md-7">
		                                            <select class="select2 form-control" name="paymode" onchange="details(this.value)">
		                                            	@foreach($paymodes as $paymode)
	                                                    <option value="{{ $paymode->paytype }}">{{ $paymode->paytype }}</option>

	                                                    @endforeach
	                                                </select>
	                                            </div>

	                                        </div>

	                                        <div class="col-lg-6 col-md-6 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Bank</label>
	                                            <div class="col-lg-7 col-md-7">
	                                                <input type="text" class="form-control" id="bank" name='bank' disabled="disabled">
	                                            </div>
	                                        </div>
	                                        
                                        </div>
                                        <div class="row col-lg-12">
	                                        <div class="col-lg-6 col-md-6 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Remarks</label>
	                                            <div class="col-lg-7 col-md-7">
	                                                <input type="text" class="form-control" name='remarks'>
	                                            </div>

	                                        </div>
	                                        <div class="col-md-6 form-group">
	                                            <label class="col-md-5 control-label">Donation Purpose</label>
	                                            <div class="col-md-7">
	                                            <select class="select2 form-control select2-multiple" name='purpose[]' multiple="multiple" multiple required="required">
	                                            	@foreach($donpurposes as $purpose)
                                                 	  <option value="{{ $purpose->purpose }}">{{ $purpose->purpose }}</option>
                                                    @endforeach
                                                </select>
	                                            </div>

	                                        </div>
                                        </div>
                                        <hr class="col-lg-12" />
                                        <h4 class="header-title m-t-0 inline-header" style="">Donation History</h4>

                            			<div class="table-responsive col-lg-12">
                            			    
                                        <table class="table table table-hover table-fixed col-lg-12 col-md-12">
		                                    <thead >
		                                        <tr>
		                                            <th class="col-xs-4 col-lg-4 col-md-4">Receipt No</th>
		                                            <th class="col-xs-4 col-lg-4 col-md-4">Date</th>
		                                            <th class="col-xs-4 col-lg-4 col-md-4">Amount</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                    	@foreach($prevrecps as $recp)
													@if(strcmp($recp->status,"Cancelled")!=0)
														<tr >
															<td class="col-xs-4 col-lg-4 col-md-4">{{$recp->repno}}</td>
															<td class="col-xs-4 col-lg-4 col-md-4">{{ date('j F Y', strtotime($recp->date)) }}</td>
															<td class="col-xs-4 col-lg-4 col-md-4">{{$recp->amount}}</td>
														</tr>
													@endif
		                                        @endforeach
		                                    </tbody>
		                                </table>
		                                </div>
                                        <div class="row">
	                                        <div class="col-lg-12 col-md-12 form-group center-block" align='center'>

                                            	<button type="submit" class="btn btn-orange btn-sm w-sm waves-effect m-t-10 waves-light">SAVE</button>
	                                        </div>
                                        </div>
                                        
                                    </form>
                                </div>
               					
               					</div>
               				</div>
               			</div>
               		</div>
               </div>
              <script type="text/javascript">
              	var det="{{ $paymodes }}";
              	var repnos="{{ $repno_query }}";

              	repnos=JSON.parse(repnos.replace(/&quot;/g,'"'));
              	det=JSON.parse(det.replace(/&quot;/g,'"'));
              	var i=0;
              	function details(x){
              		for(i=0;i<det.length;i++){
              			if(det[i]['paytype']==x){
              				if(det[i]['details']=='Y'){	
								document.getElementById("cno").disabled=false;
								document.getElementById("cdate").disabled=false;
								document.getElementById("bank").disabled=false;
              				}
              				else{

								document.getElementById("cno").value = " ";
								document.getElementById("cdate").value = " ";
								document.getElementById("bank").value = " ";
								document.getElementById("cno").disabled=true;
								document.getElementById("cdate").disabled=true;
								document.getElementById("bank").disabled=true;
              				}
              			}
              		}
					
				}

				function updaterecp(){
					for (var i = 0; i <repnos.length; i++) {
					
						if(repnos[i]['sec']==document.getElementById('recptype').value){

							document.getElementById("repnodisp").innerHTML=repnos[i]['sec']+"/"+repnos[i]['fy']+"/"+repnos[i]['repno'];
							document.getElementById("repsec").value=repnos[i]['sec'];
							document.getElementById("repfy").value=repnos[i]['fy'];
							document.getElementById("repno").value=repnos[i]['repno'];
						}
					}
				}
              </script>

@endsection('content2')