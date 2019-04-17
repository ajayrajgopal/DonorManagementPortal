
@extends('layouts.master')


@section('content')

                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title"></h4>
                        </div>
                    </div>

<div class=" col-lg-2 col-md-2 col-xs-12"></div>
<div class=" col-lg-8 col-md-8 col-xs-12">
    <div class="card-box col-lg-12 " >
     @if(strcmp($receipts->status,"Cancelled")!=0)
        <div class="row col-lg-12" >
        @else
        <div class="row col-lg-12" style="background-image:url( '/donorportal/public/assets/cancelled.gif' )">
        @endif
            <div class="row col-lg-12" >
                <h4 class="page-title">Receipt Details</h4>
                <hr />
       
        <div class="row col-lg-12">
                    <div class="row col-lg-6 col-md-6 col-xs-12">
                     <p>   <strong>Receipt No:</strong> {{$receipts->repno}}</p>
                     </div>
                     <div class="row col-lg-6 col-md-6 col-xs-12">
                        <p><strong>Date:</strong> {{date('d-m-Y',strtotime($receipts->date))}}</p>
                     </div>

                     <div class="row col-lg-12 col-md-12 col-xs-12">
                       <p>Received with thanks from
                       <strong>
                       @if($donordetails->salutation!='C')
                            {{ $donordetails->salutation."." }}
                        @endif
                        {{ $donordetails->name }}
                        </strong></p>
                     </div>
                     <div class="row col-lg-12 col-md-12 col-xs-12">
                    {{ $donordetails->address.", ".$donordetails->city."-".$donordetails->pincode }}
                     </div>
                     <div class="row col-lg-12 col-md-12 col-xs-12" >
                     {{ "M:".$donordetails->mobile." E:".$donordetails->email." PAN:".$donordetails->pan }}
                     </div>

                     <div class="row col-lg-12 col-md-12 col-xs-12">
                     <p>By {{$receipts->paymode}} <strong>Rs.{{$receipts->amount}}</strong></p>
                     @if(strcmp($receipts->status,"Cancelled")!=0)
                     <form class="form-horizontal" role="form" method="POST" action="/{{getenv('APP_NAME')}}/public/receipts/{{ $receipts->id }}" onsubmit="return confirm('Are you sure you want to cancel receipt?');">

                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                     <div class="col-lg-8 col-md-8 col-xs-12 form-group" style="display: table-cell;
    vertical-align: middle;">
                                @if(Session::get('cancelrep')=='Y')
                    <label class="col-lg-3 col-md-3 col-xs-4 control-label" style=" text-align: right; ">Reason: </label>
                                                <div class="col-lg-9 col-md-9 col-xs-8">
                                                    <input type="text" class="form-control" name='reason'>
                                                   
                                                </div>
                                @endif

                                            </div>
                            <div class="row col-lg-8 col-md-8" align="center">
                                            <button type="button" class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light" onclick="printrecp()">Print</button>
                                    @if(Session::get('cancelrep')=='Y')

                                            <button type="submit" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light">Cancel Receipt</button>
                                    @endif
                            </div>

                     @endif
                    </div>
                     </form>
                </div>  
            </div>
            </div>                 
        </div>
    </div>
<div>
      </div>
         <script type="text/javascript">
            function printrecp() {
                window.open("/{{getenv('APP_NAME')}}/public/receipts/{{$receipts->id}}",'_blank','height=2000,width=700,top=0,left=100');
            } 
         </script>   
@endsection('content')