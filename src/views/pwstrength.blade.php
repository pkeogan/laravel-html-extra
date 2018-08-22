    
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
  -- |  jquery.pwstrength.bootstrap
  -- |  
  -- |  This component uses the DropZone javascript plugin.
  -- |  Link: https://github.com/ablanco/jquery.pwstrength.bootstrap
  -- |  Default settings are in laravel-html-extra
  -- |
  -- |  Usage: See Readme.md
  --}} 



@pushonce('scripts:pwstrength')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pwstrength-bootstrap/2.2.1/pwstrength-bootstrap.min.js" integrity="sha256-URY2fVWqG7dzwG1Y2nFh/l5cpiI91+jV+hE6vphr2xs=" crossorigin="anonymous"></script>
@endpushonce

@php 

//Set $label Var to $name, if 'required' was passed, add a * to the end of the label name
if(isset($attributes) && (in_array('required' ,$attributes) || in_array('Required' ,$attributes))){ $label = $name.' *'; }else{ $label = $name; } 
   
 //if the value was not passed,null it
if(!isset($value)){ $value = null; }

//Turn off autocomplete if it is not set.
if(!isset($attributes['autocomplete'])){ $attributes['autocomplete'] = 'off';}

//If placeholder was not passed, set it to Enter + $name
if(!isset($attributes['placeholder']))
{
	$attributes['placeholder'] = 'Enter ' . $name;
} 

//If array-input is set, add a [] to the end of the name attribue
if(isset($data['arrayInput']) && $data['arrayInput'])
{
	$attributes['name'] = $id . '[]';
} 

// add the class 'form-control'
$attributes['class'] = 'form-control';

@endphp

<div id="{{ $id }}_group" class="form-group @if($errors->getBag('default')->has($id))has-error @endif @if(isset($data['hidden']) && $data['hidden'])hidden @endif">
    {{ Form::label($id, $label, ['class' => 'control-label']) }}
    {{ Form::password($id, $attributes) }}
    <p class="help-block">@if(isset($helper_text)){{ $helper_text }}@endif</p>
</div>


 @push('scriptsdocumentready')
	$('#{{ $id }}').pwstrength({
	common: { minChar:6, usernameField: "email"},
	ui: {showStatus: true, showErrors: true, showVerdictsInsideProgressBar:true,}
});
@endpush

