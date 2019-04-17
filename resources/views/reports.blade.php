@extends('layouts.master')

@section('content')
<!-- Page-Title -->
@if(Session::get('reportsaccess')=='Y')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Search Results</h4>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-lg-12 ">
            <div class="card-box col-lg-12">
				<form class="form-horizontal" role="form" id='searchfrm' method="POST" action="getreports">
				{{ csrf_field() }}
				<div class="row">

	                <div class="col-lg-6 col-md-6 col-xs-12">
						    <div class="row">
		                        <div class="col-lg-12 col-md-12 form-group">
		                        	<label class="col-lg-3 col-md-3 control-label" >From</label>
		                                <div class="col-lg-9 col-md-9">
		                                    <input type="date" name="from" class="form-control" required>
		                                </div>

		                        </div>
	                        </div>  

			        </div>
			        <div class="col-lg-6 col-md-6 col-xs-12">
						    <div class="row">
		                        <div class="col-lg-12 col-md-12 form-group">
		                        	<label class="col-lg-3 col-md-3 control-label" >To</label>
		                                <div class="col-lg-8 col-md-8">
		                                    <input type="date" name="to" class="form-control" required>
		                                </div>

		                        </div>
	                        </div>  

			        </div>
			        <div class="col-lg-4 col-md-4 col-xs-12">
						    <div class="row">
		                        <div class="col-lg-12 col-md-12 form-group">
		                        	<label class="col-lg-3 col-md-3 control-label" >Section</label>
		                                <div class="col-lg-9 col-md-9">

	                                            <select class="select2 form-control select2-multiple" name='sections[]' multiple="multiple" multiple>
	                                            	<option value="80G/D">80G Donation</option>
	                                            	<option value="80G/C">80G Corpus</option>
	                                            	<option value="35AC">Section 35AC</option>
	                                            </select>
		                                </div>

		                        </div>
	                        </div>  

			        </div>
			        <div class="col-lg-4 col-md-4 col-xs-12">
						    <div class="row">
		                        <div class="col-lg-12 col-md-12 form-group">
		                        	<label class="col-lg-3 col-md-3 control-label" >Purpose</label>
		                                <div class="col-lg-9 col-md-9">

	                                            <select class="select2 form-control select2-multiple" name='purposes[]' multiple="multiple" multiple>
	                                            	@foreach($donpurposes as $purpose)
                                                 	  <option value="{{ $purpose->purpose }}">{{ $purpose->purpose }}</option>
                                                    @endforeach
                                                </select>
		                                </div>

		                        </div>
	                        </div>  

			        </div>
			        <div class="col-lg-4 col-md-4 col-xs-12">
						    <div class="row">
		                        <div class="col-lg-12 col-md-12 form-group">
		                        	<label class="col-lg-3 col-md-3 control-label" >Pay Mode</label>
		                                <div class="col-lg-9 col-md-9">

	                                            <select class="select2 form-control select2-multiple" name='paymodes[]' multiple="multiple" multiple>
	                                            	@foreach($paymodes as $paymode)
	                                                    <option value="{{ $paymode->paytype }}">{{ $paymode->paytype }}</option>

	                                                    @endforeach
                                                </select>
		                                </div>

		                        </div>
	                        </div>  

			        </div>
	                            <div class="col-lg-12 col-md-12 form-group center-block" align='center'>

                                    <button type="submit" class="btn btn-orange btn-sm w-sm waves-effect m-t-10 waves-light">NEXT</button>
                                     @if($showrep==1)
                                    <button type="button" class="btn btn-primary btn-sm w-sm waves-effect m-t-10 waves-light" onclick="exportTableToCSV('reports.csv')">DOWNLAD</button>
	                            	@endif
	                            </div>
						    
		        </div>
		        </div>
		        </form>   	

			</div>
		</div>
    </div>
    @if($showrep==1)
	<div class="row">

		<div class="col-lg-12">
						<div class="card-box col-lg-12">
			            
			          
			                <div class="col-lg-12" align="center">
			                <hr />
			                <div class="table-responsive">
							         	<table class="table table table-hover m-0">

		                                    <thead>
		                                        <tr>
		                                            <th>Name</th>
		                                            <th>PAN</th>
		                                            <th>Address</th>
		                                            <th>Email</th>
		                                            <th>Date</th>
		                                            <th>Receipt No</th>
		                                            <th>Payment Mode</th>
		                                            <th>Amount</th>
		                                            <th>Chq/Trn No</th>
		                                            <th>Chq/Trn Date</th>
		                                            <th>Bank</th>
		                                            <th>Status</th>
		                                            <th>User</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                    @foreach($report as $rep)
		                                        <tr>  
		                                            <td style="vertical-align: middle;">{{ $rep->name }}</td>
		                                            <td style="vertical-align: middle;">{{ $rep->pan }}</td>
		                                            <td style="vertical-align: middle;">{{ $rep->address }}</td>
		                                            <td style="vertical-align: middle;">{{ $rep->email }}</td>
		                                            <td style="vertical-align: middle;">{{ date('d-m-Y',strtotime($rep->date)) }}</td>
		                                            <td style="vertical-align: middle;">{{ $rep->repno }}</td>
		                                           	<td style="vertical-align: middle;">{{ $rep->paymode }}</td>
		                                           	<td style="vertical-align: middle;">{{ $rep->amount }}</td>
		                                           	<td style="vertical-align: middle;">{{ $rep->cno }}</td>
		                                           	<td style="vertical-align: middle;">{{ $rep->cdate }}</td>
		                                           	<td style="vertical-align: middle;">{{ $rep->bank }}</td>
		                                           	<td style="vertical-align: middle;">{{ $rep->status }}</td>
		                                           	<td style="vertical-align: middle;">{{ $rep->user }}</td>
		                                        </tr>
		                                    @endforeach

		                                    </tbody>
		                                </table>
		                            </div>
					        </div>
						</div>

		</div>
	</div>

	@endif

	<script type="text/javascript">
		function exportTableToCSV(filename) {
		    var csv = [];
		    var rows = document.querySelectorAll("table tr");
		    
		    for (var i = 0; i < rows.length; i++) {
		        var row = [], cols = rows[i].querySelectorAll("td, th");
		        
		        for (var j = 0; j < cols.length; j++) 
		            row.push("\""+cols[j].innerText+"\"");
		        
		        csv.push(row.join(","));        
		    }

		    // Download CSV file
		    downloadCSV(csv.join("\n"), filename);
		}
		function downloadCSV(csv, filename) {
		    var csvFile;
		    var downloadLink;

		    // CSV file
		    csvFile = new Blob([csv], {type: "text/csv"});

		    // Download link
		    downloadLink = document.createElement("a");

		    // File name
		    downloadLink.download = filename;

		    // Create a link to the file
		    downloadLink.href = window.URL.createObjectURL(csvFile);

		    // Hide download link
		    downloadLink.style.display = "none";

		    // Add the link to DOM
		    document.body.appendChild(downloadLink);

		    // Click download link
		    downloadLink.click();
		}
	</script>
@endif
@endsection('content')