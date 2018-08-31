@pushonce('afterstyles:bootstrapDatePicker')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha256-yMjaV542P+q1RnH6XByCPDfUFhmOafWbeLPmqKh11zo=" crossorigin="anonymous" />
<style>
	.bootstrap-datetimepicker-widget table td.disabled{
		color:#ae3523;
	}
	.bootstrap-datetimepicker-widget .timepicker-hour, .bootstrap-datetimepicker-widget .timepicker-minute, .bootstrap-datetimepicker-widget .timepicker-second{
		background-color:#ccc !important;

	}
	..bootstrap-datetimepicker-widget table td{
		background-color:#ccc !important;
	}
</style>
@endpushonce

@pushonce('afterscripts:bootstrapDatePicker')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js" integrity="sha256-CutOzxCRucUsn6C6TcEYsauvvYilEniTXldPa6/wu0k=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
@endpushonce

@php 
    if(isset($attributes['value'])){ $value = $attributes['value']; }else{ $value = null; } //if the value was passed, use it, if not null it
    if($attributes == null){$attributes = [];} //if attributes is null, because it wasnts passed, setup so we can atleast add the class
    $attributes['class'] = 'form-control';
    $attributes['id'] = $id;
    $attributes['data-input'] = 'data-input';
     if(!isset($attributes['autocomplete'])){ $attributes['autocomplete'] = 'off';}

if(isset($data['timeOnly']))
{
$format = 'HH:mm';
$attributes['data-mask'] = "00:00";
} elseif(isset($data['dateOnly'])) {
$format = 'MM-DD-YYYY';
$attributes['data-mask'] = "00-00-0000";

} else {
$format = 'MM-DD-YYYY HH:mm';
$attributes['data-mask'] = "00-00-0000 00:00";
}

@endphp

<div class="form-group @if($errors->getBag('default')->has($id))has-error @endif">
	<label for="{{ $id.'-label' }}" class="control-label">{{ $name }}@if(in_array('required', $attributes)) *@endif</label>
	        <div class="input-group">
          
        {{ Form::text($id, $value, $attributes) }}
          <span class="input-group-btn">
      <button id="{{$id}}-open" type="button" class="btn btn-default" data-toggle="tooltip" title="Open Calender"><span class="fa fa-calendar"></span></button>
      <button id="{{$id}}-clear" type="button" class="btn btn-default" data-toggle="tooltip" title="Clear Input"><span class="fa fa-times"></button>
            </span>

        </div>
    <p class="help-block">@if(isset($helper_text)){{ $helper_text }}@endif</p>
</div> 


@push('scriptsdocumentready')    
{{-- <script> --}}

	$('#{{ $id }}').datetimepicker({
		format: "{{ $format }}",
		sideBySide: true,
		useCurrent:false,
		icons: {
                    time: "far fa-clock",
                    date: "far fa-calendar-alt",
                    up: "fas fa-arrow-alt-up fa-2x",
                    down: "fas fa-arrow-alt-down fa-2x"
                },
	});
	$( "#{{$id}}-open" ).click(function() {
		$('#{{ $id }}').data("DateTimePicker").show();

	});
	$( "#{{$id}}-clear" ).click(function() {
		$('#{{ $id }}').data("DateTimePicker").clear();
	});
{{-- </script> --}}
@endpush