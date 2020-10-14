{{--
  -- | ---------------------------------------------------------------------------------------------------
  -- |      __                               __   __  __________  _____       _______  ____________  ___    
  -- |     / /  ____ __________ __   _____  / /  / / / /_  __/  |/  / /      / ____| |/ /_  __/ __ \/   |
  -- |    / /  / __ `/ ___/ __ `| | / / _ \/ /  / /_/ / / / / /|_/ / /      / __/  |   / / / / /_/ / /| |
  -- |   / /__/ /_/ / /  / /_/ /| |/ /  __/ /  / __  / / / / /  / / /___   / /___ /   | / / / _, _/ ___ |
  -- |  /_____\__,_/_/   \__,_/ |___/\___/_/  /_/ /_/ /_/ /_/  /_/_____/  /_____//_/|_|/_/ /_/ |_/_/  |_|
  -- | ---------------------------------------------------------------------------------------------------
  -- | Laravel HTML Extra - By Peter Keogan - Link:https://github.com/pkeogan/laravel-html-extra
  -- | ---------------------------------------------------------------------------------------------------
  -- |                                
  -- |  flatpickr Component (Date Time Input)
  -- |  
  -- |  This component uses the flatpickr v4 javascript plugin.
  -- |  Link: https://chmln.github.io/flatpickr/
  -- |  Default settings are in laravel-html-extra
  -- |
  -- |  Usage: See Readme.md
  --}}

@pushonce('styles:flatpickr')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.0/flatpickr.min.css" integrity="sha256-TV6wP5ef/UY4bNFdA1h2i8ASc9HHcnl8ufwk94/HP4M=" crossorigin="anonymous" />@endpushonce
@pushonce('scripts:flatpickr')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.5.0/flatpickr.min.js" integrity="sha256-wBDnPvmVBO049qOV/XacwBYYE0wgsok0tEcD+nwC4Kk=" crossorigin="anonymous"></script>
@endpushonce


@php 
    if(!isset($attributes['placeholder'])){$attributes['placeholder'] = 'Enter '. $name;}    
    if($attributes == null){$attributes = [];} //if attributes is null, because it wasnts passed, setup so we can atleast add the class
    $attributes['class'] = 'form-control';
    $attributes['id'] = $id;
    $attributes['data-input'] = 'data-input';
     if(!isset($attributes['autocomplete'])){ $attributes['autocomplete'] = 'off';}
      $dateFormat = '';
	  $maskFormat = '';
      if(isset($data['noCalendar']) && ! $data['noCalendar']){
        $dateFormat .= 'm-d-Y';
        $maskFormat .= '00-00-0000';

      }
      if((isset($data['noCalendar']) && ! $data['noCalendar']) && (isset($data['enableTime']) && $data['enableTime'])){
        $dateFormat .= ' ';
        $maskFormat .= ' ';
      }
      if(isset($data['enableTime']) && $data['enableTime']){
        $dateFormat .= 'H:i';
        $maskFormat .= '00:00';

      }
      if(isset($data['enableSeconds']) && $data['enableSeconds']){
        $dateFormat .= ':S';
        $maskFormat .= ':00';

      }
		$data['time_24hr'] = true;
		if(!isset($data['allowInput'])){$data['allowInput'] = true ;}
		$data['dateFormat'] = $dateFormat;
		$attributes['data-mask'] = $maskFormat;
@endphp

@push('after-scripts')    
<script>
$(document).ready(function() {
  let calendar{{$id}} =  $("#{{$id}}").flatpickr(
	  {!! json_encode($data) !!}
  );
  $("#{{$id}}-open").click(function() {
    calendar{{$id}}.open();
  });
  $("#{{$id}}-close").click(function() {
    calendar{{$id}}.clear();
  });
});
</script>
@endpush



<div class="form-group @if($errors->getBag('default')->has($id))has-error @endif @hideGroup" id="{{ $id }}Group">
	<label for="{{ $id.'-label' }}" class="control-label">{{ $name }} @labelRequired </label>
	        <div class="input-group">
          
        {{ Form::text($id, $value, $attributes) }}
          <div class="input-group-append">
      <button id="{{$id}}-open" type="button" class="btn btn-outline-secondary" data-toggle="tooltip" title="Open Calender"><span class="fa fa-calendar"></span></button>
      <button id="{{$id}}-close" type="button" class="btn btn-outline-secondary" data-toggle="tooltip" title="Clear Input"><span class="fa fa-times"></button>
      </div>

        </div>
    <p class="help-block">@if(isset($helper_text)){{ $helper_text }}@endif</p>
</div> 



