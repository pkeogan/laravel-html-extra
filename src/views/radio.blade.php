@php 

//OLD CODE?
//if attributes is null, because it was not passed, setup so we can atleast add the class
//if($attributes == null){$attributes = [];}

//check if an id was set, if not, then set it to the id var
if(empty($attributes['id'])){ $attributes['id'] = $id; } 

//Set $label Var, if required was passed, add a * to the end of the label name
if(isset($attributes['required'])){ $label = $name.' *'; }else{ $label = $name; } 

//if the value was passed, use it, if not null it
if(isset($attributes['value'])){ $value = $attributes['value']; }else{ $value = null; } 

//Turn off autocomplete if it is not set.
if(!isset($attributes['autocomplete'])){ $attributes['autocomplete'] = 'off';}

//add class form control
$attributes['class'] = 'form-control';


@endphp

<div id="{{ $id }}Group" class="form-group @if($errors->getBag('default')->has($id))has-error @endif @hideGroup()">
    <label for="{{ $id }}" class="control-label">{{ $label }}  @labelRequired() </label>
  <div class="input-group">
      <div class="btn-group" data-toggle="buttons">
        @foreach($data['options'] as $optionIndex=>$option)
          <label id="radio-{{$id}}-{{$optionIndex}}" class="btn @if(isset($option['color'])) {{ $option['color'] }} @else btn-default @endif">
            <input type="radio" name="{{ $id }}" value="{{ $option['value'] }}" id="{{ $id . '-' . $option['value'] }}" autocomplete="off" @if(isset($option['checked']) && $option['checked']) checked @endif> {{ $option['display'] }}
          </label>
        @endforeach
      </div>
  </div>
    <p class="help-block">@if(isset($helper_text)){{ $helper_text }}@endif</p>
</div>

@push('scriptsdocumentready')
{{-- <script> --}}
  
@foreach($data['options'] as $optionIndex=>$option)
$('#radio-{{$id}}-{{$optionIndex}}').on('click', function () {
   console.log( '#radio-{{$id}}-{{$optionIndex}} was clicked' );
   console.log($(this).find('input').val());
    @if(isset($option['hideGroups']) && is_array($option['hideGroups']))
      @foreach($option['hideGroups'] as $val2)
                 $("#{{ $val2 }}Group").removeClass('visible');
                $("#{{ $val2 }}Group").addClass('hidden');
                $("#{{ $val2 }}").prop('disabled', true);
                $("#{{ $val2 }}").prop('required', false);
                $("#{{ $val2 }}Group label:first span").remove();
      @endforeach
    @endif
    @if(isset($option['requiredGroups']) && is_array($option['requiredGroups']))
      @foreach($option['requiredGroups'] as $val2)
                $("#{{ $val2 }}Group").removeClass('hidden');
                $("#{{ $val2 }}Group").addClass('visible');
                $("#{{ $val2 }}").prop('disabled', false);
                $("#{{ $val2 }}").prop('required', true);
                $("#{{ $val2 }}Group label:first").append('<span class="form-input-required-label">(required)</span>');
        @endforeach
    @endif

});
  @endforeach
  
  

@endpush