@if(!is_null($leave->end_date))
    <h3><strong>Leave status</strong> : From {{date('d F Y', strtotime($leave->start_date))}} to {{date('d F Y', strtotime($leave->end_date))}}</h3>
@else
    <h3><strong>Leave status</strong> : For Single day on {{date('d F Y', strtotime($leave->start_date))}}</h3>
@endif
<h4>
    {!!$leave->discription!!}
</h4>
</br>
<strong>Sincerely,</strong><br>
<h4>{{ucwords(auth()->user()->first_name)}} {{ucwords(auth()->user()->last_name)}}</h4>