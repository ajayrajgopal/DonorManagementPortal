<html>
<link rel="icon" href="favicon.ico" sizes="16x16" type="image/png">
<link rel='stylesheet' type='text/css' href='print2.css' media='print' />
<div align="center" class="Header">
	<br><br><br><br><br><br><br><br><br><br><br>

  <table width="90%">
  	@foreach($receipts as $receipt)
		<tr>
		<td>
			<b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{ $receipt->repno }}</b>
		</td>
		<td>
			<div align="right">
			<b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{ date("jS M Y", strtotime($receipt->date)) }}</b>
			</div>
		</td>
		</tr>
	@endforeach
  </table>
  <div align='center'>
  <br><br>
  <table width=90%>
  <tr><td>
  <div align="left">
  @foreach($donors as $donor)
  <b>

  		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  	@if(strcmp($donor->type,"Individual")==0)
  		{{ $donor->salutation."." }}
  	@endif
  		{{$donor->name}}
  </b>
  <br>
  {{$donor->address.", ".$donor->city."-".$donor->pincode}}
  <br>
  {{"M: ".$donor->mobile." E: ".$donor->email." PAN: ".$donor->pan}}
  @endforeach

  <br><br>

  @foreach($receipts as $receipt)
  {{"By ".$receipt->paymode}}
  @if(strcmp($receipt->paymode,"Cheque")==0||strcmp($receipt->paymode,"E-Transfer")==0)
  	No. {{$receipt->cno}} Dated {{$receipt->cdate}} Bank: {{$receipt->bank}}
  	 @if(strcmp($receipt->paymode,"Cheque")==0)
  	 	(Subject to realization)
  	 @endif
  @endif
  <b>Rs.{{$receipt->amount}}/-&nbsp&nbsp(Rupees {{$receipt->amountinwords}} Only.</b>)
  <br><br><br><br>
  

  @endforeach
 </div>
  </td></tr>
  </table>
  </div>
 	</div>

	<script>
		window.print();
	</script>

</html>
