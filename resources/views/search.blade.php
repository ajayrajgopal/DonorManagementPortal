@extends('layouts.master')

@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Search Results</h4>
        </div>
    </div>
</div>
@include('layouts.searchbox')
<div class="row">

	<div class="col-lg-12">
					<div class="card-box col-lg-12">
		            <div class="row">
                        <div class="container" style="width: 100%;">
                            <div class="btn-group pull-right" >

	                            <a href="/{{getenv('APP_NAME')}}/public/donors/create">
                                	<button class="btn btn-orange waves-effect w-md waves-light m-b-5">New Donor</button>
                                </a>
                            </div>
                            <h4 class="header-title m-t-0 inline-header" style="">Results</h4>
                        </div>
                </div>
		          
		                <div class="col-lg-12" align="center">
		                <hr />
		                @if(count($donors)>0)
	                            <div class="table-responsive">
						         	<table class="table table table-hover m-0">

	                                    <thead>
	                                        <tr>
	                                            <th>Name</th>
	                                            <th>PAN</th>
	                                            <th>Email</th>
	                                            <th>Mobile</th>
	                                            <th>City</th>
	                                            <th></th>
	                                            <th></th>
	                                            <th></th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                    @foreach($donors as $donor)
	                                        <tr>  
	                                            <td style="vertical-align: middle;">
	                                            	<h5 class="m-0">
		                                            	@if($donor->salutation!='C')

		                                                {{ $donor->salutation."." }}
		                                            	@endif
		                                                {{ $donor->name }}
	                                                </h5>
	                                            </td>
	                                            <td style="vertical-align: middle;">{{ $donor->pan }}</td>
	                                            <td style="vertical-align: middle;">{{ $donor->email }}</td>
	                                            <td style="vertical-align: middle;">{{ $donor->mobile }}</td>
	                                            <td style="vertical-align: middle;">{{ $donor->city }}</td>
	                                            <td style="vertical-align: middle;">
		                                            <form class="form-horizontal" style='display: table-cell; vertical-align:middle;' role="form" method="GET" action="/{{getenv('APP_NAME')}}/public/receipts/create">
		                                            	{{ csrf_field() }}
		                                          		<input type="hidden" name="donordetails" value="{{ $donor }}">
		                                           		<button type="submit" class="btn btn-default waves-effect">Create Receipt</button>
		                                           	</form>
	                                           	</td>
	                                           	<td style="vertical-align: middle;">
	                                           		<a href="/{{getenv('APP_NAME')}}/public/donors/{{ $donor->id }}/edit"><button type="button" class="btn btn-default waves-effect">EDIT</button>
	                                            </td>
	                                        </tr>
	                                    @endforeach

	                                    </tbody>
	                                </table>
	                            </div>
	                        @else
	                        	<h5 class="m-0">
	                        		No Donors or Receipts Found
	                            </h5>
	                        @endif
				        </div>
					</div>

	</div>
</div>
@endsection('content')