{{ "To" }}<br>
@if($donor->type=="Individual")
{{ $donor->salutation."."}}
@endif
{{$donor->name }}<br>{{ $donor->address}} <br>{{ $donor->city."-".$donor->pincode}} <br>{{ $donor->state.", ".$donor->country}}<br><br>{{"Dear "}}

@if($donor->type=="Individual")
{{$donor->salutation.".".$donor->name.","}}
@else
{{"Sir/Madam,"}}
@endif
<br><br>{{"We thank you for your contribution and support towards our mission of providing education, vocational training & livelihood empowerment to persons with disability through our urban and rural programs."}}<br><br>{{"We are grateful for your donation of Rs.".request('amount')." by ".request('paymode')." vide our receipt number ".$repno." dated ".date('d-m-Y')."."}}<br><br>{{"We are sure you share our feeling of joy in participating in this journey from darkness to light, from suppression to expression.  We look forward to your continued contribution in sustaining the momentum of this journey."}}<br><br>{{ "Please visit our website at www.srmab.org.in to get a more detailed insight of our service initiatives."}}<br><br>{{"Kindly share our work and passion with your friends and family."}}<br><br>{{"Thanking you,"}}<br><br>{{"Yours in the service of the differently abled"}}<br><br>{{"T.V.Srinivasan"}}<br>{{"Founder President"}}<br><br>{{"Shree Ramana Maharishi Academy for the Blind (R)"}}<br>{{"CA1B, 3rd Cross, 3rd Phase, J P Nagar"}}<br>{{"Bangalore - 560 078, Karnataka, INDIA"}}<br>{{"Ph: +91-(0)80-2658-1076, 2658-8045"}}<br><br>{{"Web:www.srmab.org.in | E: mail@srmab.org.in"}}<br>{{"Facebook: https://www.facebook.com/SRMAB.1969"}}<br><br>{{"Donations to SRMAB are eligible for exemption from income tax under section 35AC / 80G of the Income Tax Act." }}