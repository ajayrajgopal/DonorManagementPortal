@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
    <br>
    </div>
</div>

<div class="row">
        <div class="col-lg-12 ">
            <div class="card-box">
            	<div class="row">
		        <div class="col-lg-12 col-sm-12 col-md-12">

	                <h4 class="page-title">Add/Edit Donor Details</h4>
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

	                	
	                	<form class="form-horizontal" role="form" id="adddonor" method="POST" action="/{{getenv('APP_NAME')}}/public/donors">
	                		@include('donorform')
	                		
		                	<div class="row">
		                        <div class="col-lg-12 col-md-12 form-group center-block" align='center'>

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
    	var typeelement = document.getElementById("type");
        var salelement = document.getElementById("salutation");
        var updateselement = document.getElementById("updates");

                                    		
                                    		if(errors>0){
                                    			var type = "{{old('type')}}";
                                    			var salutation = "{{old('salutation')}}";      
                                    			var update = "{{old('salutation')}}";
                                    		}

                                    		setSelectedValue(typeelement, type);
                                    		sal();
                                    		setSelectedValue(salelement, salutation);
                                    		setSelectedValue(updateselement, update);

                                    		function setSelectedValue(selectObj, valueToSet) {
											    for (var i = 0; i < selectObj.options.length; i++) {
											        if (selectObj.options[i].text== valueToSet) {
											            selectObj.options[i].selected = true;
											            return;
											        }
											    }
											}
    </script>
@endsection('content')