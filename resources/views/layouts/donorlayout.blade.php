@extends('layouts.master')

@section('content')

@yield('pagetitle')
<div class="row">
	<div class="col-lg-4 col-md-4 col-xs-12">
		             <div class="text-center card-box col-lg-12">
                                        <div class="member-card">
                                            <div class="">
                                                <h4 class="m-b-5">Donor Details</h4>
                                            </div>

                                            

                                            <hr/>
                                            <div class="text-left">
                                                <p class=" font-13"><strong>Full Name :</strong> <span class="m-l-15">        @if($donordetails->salutation!='C')

                                                            {{ $donordetails->salutation."." }}
                                                        @endif
                                                        {{ $donordetails->name }}</span></p>

                                                <p class=" font-13"><strong>Mobile :</strong><span class="m-l-15">{{$donordetails->mobile}}</span></p>
                                                <p class=" font-13"><strong>Landline :</strong><span class="m-l-15">{{$donordetails->landline}}</span></p>

                                                <p class=" font-13"><strong>Email :</strong> <span class="m-l-15">{{$donordetails->email}}</span></p>

                                                <p class=" font-13"><strong>PAN :</strong> <span class="m-l-15">{{$donordetails->pan}}</span></p>

                                                <div class="row"> <div class="col-lg-3 col-md-3"><p class=" font-13"><strong>Address :</strong> </p></div> <div class="col-lg-6 col-md-6"><p class=" font-13">{{$donordetails->address}}</p></div> </div>
                                                <div class="row"> <div class="col-lg-3 col-md-3"><p class="font-13"><strong>Remarks :</strong> </p></div> <div class="col-lg-6 col-md-6"><p class=" font-13">{{$donordetails->remarks}}</p></div> </div>


                                            </div>
                                            <hr/>
                                            <a href="/{{getenv('APP_NAME')}}/public/donors/{{ $donordetails->id }}/edit">
                                            <button type="button" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light">Edit</button>
                                            </a>
                                        </div>
                                    </div>

				</div>
			
                		@yield('content2')
                    </div>
				</div>
			</div>
		</div>
@endsection('content')