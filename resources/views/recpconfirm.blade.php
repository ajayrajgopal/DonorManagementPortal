@extends('layouts.master')

@section('content')

                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title"></h4>
                        </div>
                    </div>
                </div>
<div class="col-lg-12 col-md-12 col-xs-12">
                <div class="card-box col-lg-12">
                    <div class="row">
                    <div class="row">
                        <div class="account-content">
                                    <div class="text-center m-b-20">
                                        <div class="m-b-20">
                            <div class="checkmark">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                         viewBox="0 0 161.2 161.2" enable-background="new 0 0 161.2 161.2" xml:space="preserve">
                                <path class="path" fill="none" stroke="#4bd396" stroke-miterlimit="10" d="M425.9,52.1L425.9,52.1c-2.2-2.6-6-2.6-8.3-0.1l-42.7,46.2l-14.3-16.4
                                                        c-2.3-2.7-6.2-2.7-8.6-0.1c-1.9,2.1-2,5.6-0.1,7.7l17.6,20.3c0.2,0.3,0.4,0.6,0.6,0.9c1.8,2,4.4,2.5,6.6,1.4c0.7-0.3,1.4-0.8,2-1.5
                                                        c0.3-0.3,0.5-0.6,0.7-0.9l46.3-50.1C427.7,57.5,427.7,54.2,425.9,52.1z"/>
                                <circle class="path" fill="none" stroke="#4bd396" stroke-width="4" stroke-miterlimit="10" cx="80.6" cy="80.6" r="62.1"/>
                                <polyline class="path" fill="none" stroke="#4bd396" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="113,52.8
                                                        74.1,108.4 48.2,86.4 "/>

                                <circle class="spin" fill="none" stroke="#4bd396" stroke-width="4" stroke-miterlimit="10" stroke-dasharray="12.2175,12.2175" cx="80.6" cy="80.6" r="73.9"/>

                                </svg>
                            </div>
                            <h4 class="page-title">Donation Receipt has been generated </h4>    
                                    @if($mailstatus==1)
                                        <h5 class="page-title">eAckowledgement has been sent</h5>
                                    @else
                                         <h5 class="page-title">eAckowledgement could not be sent</h5>
                                    @endif
                                    <button type="button" onclick="printrecp()" class="btn btn-default waves-effect">Print Receipt</button>
                                
                            </div>
                            </div>
                            </div>

                                
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
         <script type="text/javascript">
            function printrecp() {
                window.open("/receipts/{{$repid}}",'_blank','height=2000,width=700,top=0,left=100');
            } 
         </script>      
        
@endsection('content')
