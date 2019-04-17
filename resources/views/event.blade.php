@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Event</h4>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-lg-12 ">
            <div class="card-box">
            	<div class="row">
                <div class="col-lg-6 col-sm-12 col-md-6">

	                <h4 class="header-title m-t-0">Calendar</h4>
	                <div class="col-lg-12">
	                @include('calendar')
						<br>
					</div>
		        </div>
		        <div class="col-lg-6 col-sm-12 col-md-6">

	                <h4 class="header-title m-t-0">Event Details</h4>
	                <div class="col-lg-12">
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
	                	<form class="form-horizontal" role="form" method="POST" action="\{{getenv('APP_NAME')}}\public\events">
	                			{{ csrf_field() }}
	                				<input type="hidden" name="donorid" value="{{ $id }}">
                                        
                                        <div class="row">
	                                        <div class="col-lg-12 col-md-12 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Event Category</label>
	                                            <div class="col-lg-6 col-md-6">
	                                                <select class="form-control" name='eventtype' id='eventtype' onchange="seteventtype()" required>
	                                                	<option value="">Select Event Category</option>
	                                                	@foreach($eventtypes as $eventcategory)
                                                    		<option value="{{ $eventcategory->name }}">{{ $eventcategory->name }}</option>
                                                    	@endforeach
                                                	</select>
	                                            </div>

	                                        </div>
                                        </div>
                                        <div class="row">
	                                        <div class="col-lg-12 col-md-12 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Event Type</label>
	                                            <div class="col-lg-6 col-md-6">
	                                                <select class="form-control" name='subeventtype' id='subeventtype'>

                                                    	<option value="">Select Event Type</option>
                                                	</select>
	                                            </div>

	                                        </div>
                                        </div>
                                		<div class="row">
	                                        <div class="col-lg-12 col-md-12 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label" >Event Name</label>
	                                            <div class="col-lg-6 col-md-6">
	                                                <input type="text" name="name" id="name" class="form-control" required>
	                                            </div>

	                                        </div>
                                        </div>
                                        <div class="row">
	                                        <div class="col-lg-12 col-md-12 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Event Date</label>
	                                            <div class="col-lg-6 col-md-6">
	                                                <input type="date" name="date" id="date" class="form-control" required>
	                                            </div>

	                                        </div>
                                        </div>
                                        <div class="row">
	                                        <div class="col-lg-12 col-md-12 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Recurrence</label>
	                                            <div class="col-lg-6 col-md-6">
	                                                <select class="form-control" name='recurrence' id='recurrence'>

                                                    <option value="">Set Frequency</option>
                                                    <option value="DAILY">Daily</option>
                                                    <option value="MONTHLY">Monthly</option>
                                                    <option value="YEARLY">Yearly</option>
                                                </select>
	                                            </div>

	                                        </div>
                                        </div>
                                        <div class="row">
	                                        <div class="col-lg-12 col-md-12 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">No of times</label>
	                                            <div class="col-lg-6 col-md-6">
	                                               	<input type="text" name="recurrenceno" id="recurrenceno" class="form-control">

	                                            </div>

	                                        </div>
                                        </div>
                                		<div class="row">
	                                        <div class="col-lg-12 col-md-12 form-group">
	                                            <label class="col-lg-5 col-md-5 control-label">Description</label>
	                                            <div class="col-lg-6 col-md-6">
	                                                <textarea class="form-control" name="description" id="description"></textarea>
	                                            </div>

	                                        </div>
                                        </div>

                                        <div class="row">
	                                        <div class="col-md-12 col-lg-12 form-group center-block" align='center'>
	                                        	<button type="submit" name="exit" value="exit" class="btn btn-sm w-sm waves-effect m-t-10 waves-light">SAVE AND EXIT</button>

	                                			<button type="submit" name="continue" value="continue" class="btn btn-orange btn-sm w-sm waves-effect m-t-10 waves-light">NEXT</button>
	                                        </div>
                                        </div>
                                        
                                    </form>
					</div>
				</div>
		        </div>
		        </div>
			</div>
		</div>
    </div>
    <script type="text/javascript">
    	function seteventtype(){
    		var eventcategoryelement= document.getElementById("eventtype");
    		var eventtypeelement = document.getElementById("subeventtype");
    		var eventnameelement = document.getElementById("name");
    		var eventdateelement = document.getElementById("date");
    		var recurrenceelement = document.getElementById("recurrence");
    		var recurrencenoelement = document.getElementById("recurrenceno");
    		var descriptionelement = document.getElementById("description");
			var option = document.createElement("option");
			var eventselected=eventcategoryelement.value;
			var eventtypes="{{ $eventtypes }}";
			var eventsubtypes="{{ $subeventtypes }}";
			var eventid;
			var len=eventtypeelement.options.length;
			for (var i = 0; i < len; i++) {
			  eventtypeelement.options[0] = null;
			}

			var option = document.createElement("option");
			option.value = "";
			option.text = "Select Event Type";
			eventtypeelement.add(option);
			eventtypeelement.options[0].selected='true';
			eventtypes=JSON.parse(eventtypes.replace(/&quot;/g,'"'));
			eventsubtypes=JSON.parse(eventsubtypes.replace(/&quot;/g,'"'));
			for(var i = 0; i < eventtypes.length; i++) {
			    var obj = eventtypes[i];
			    if(eventselected==obj.name){
			    	eventid=obj.id;
			    	if(eventtypes[i]['details']=='N'){
			    		eventtypeelement.disabled=true;
			    		eventnameelement.readOnly=true;
			    		eventdateelement.readOnly=true;
			    		recurrenceelement.disabled=true;
			    		recurrencenoelement.readOnly=true;
			    		descriptionelement.readOnly=true;
			    	}
			    	else{
			    		eventtypeelement.disabled=false;
			    		eventnameelement.readOnly=false;
			    		eventdateelement.readOnly=false;
			    		recurrenceelement.disabled=false;
			    		recurrencenoelement.readOnly=false;
			    		descriptionelement.readOnly=false;
			    	}
			    }
			}

			for(var i=0;i< eventsubtypes.length;i++){
				var obj=eventsubtypes[i];
				if(eventid==obj.eventid){
					var option = document.createElement("option");
					//option.text = obj.subevent;
					option.value = obj.subevent;
           			option.innerHTML = obj.subevent;
					eventtypeelement.appendChild(option);
				}
			}
    	}
    </script>
@endsection('content')