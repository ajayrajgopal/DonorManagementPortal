@extends('layouts.master')

@section('content')
<!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Home</h4>
                        </div>
                    </div>
                </div>
@include('layouts.searchbox')
     <div class="row" style="display: none;">
     		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

	            <div class="card-box col-lg-12 col-md-12 col-xs-12">
	                <h4 class="header-title m-t-0">Calendar</h4>

	                <div class="col-lg-12 col-md-12 col-xs-12">
	                	@include('calendar')
			        </div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="card-box col-lg-12 col-md-12">
	                <h4 class="header-title m-t-0">Unpaid Events</h4>

	                <div class="col-lg-12 col-md-12">

                            <div class="table-responsive">
					         	<table class="table table table-hover m-0">
                                    <thead>
                                        <tr>
                                            <th>Donor Name</th>
                                            <th>Event Name</th>
                                            <th>Event Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($events as $event)
                                                @if($event->status=='tentative')
                                                <tr>
                                                    <td>
                                                        <h5 class="m-0">{{ $event->donorname }}</h5>
                                                        <p class="m-0 text-muted font-13"><small>{{ $event->mobile }}</small></p>
                                                    </td>
                                                    <td>{{ $event->summary }}</td>
                                                    <td>{{ date('d-m-Y',strtotime($event->start->date)) }}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
			        </div>
				</div>
			</div>
		</div>
    </div>

@endsection('content')