{{--
  -- | ------------------------------------------------------------------------------------------------------
  -- |      __                               __   __  __________  _____       _______  ____________  ___    
  -- |     / /  ____ __________ __   _____  / /  / / / /_  __/  |/  / /      / ____| |/ /_  __/ __ \/   |
  -- |    / /  / __ `/ ___/ __ `| | / / _ \/ /  / /_/ / / / / /|_/ / /      / __/  |   / / / / /_/ / /| |
  -- |   / /__/ /_/ / /  / /_/ /| |/ /  __/ /  / __  / / / / /  / / /___   / /___ /   | / / / _, _/ ___ |
  -- |  /_____\__,_/_/   \__,_/ |___/\___/_/  /_/ /_/ /_/ /_/  /_/_____/  /_____//_/|_|/_/ /_/ |_/_/  |_|
  -- | -------------------------------------------------------------------------------------------------------
  -- | Laravel HTML Extra - By Peter Keogan - Link:https://github.com/pkeogan/laravel-html-extra
  -- | ------------------------------------------------------------------------------------------------------
  -- |                                
  -- |  Basic Text Input
  -- |  
  -- |  This component uses the basic Laravel/Collective text inpouts javascript plugin.
  -- |  Link: https://laravelcollective.com/docs/5.4/html
  -- |  Default settings are in laravel-html-extra
  -- |
  -- |  Usage: See Readme.md
  --}}

@pushonce('scripts:mask')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" integrity="sha256-u7MY6EG5ass8JhTuxBek18r5YG6pllB9zLqE4vZyTn4=" crossorigin="anonymous"></script>
@endpushonce


@php 
//Set the data type
if(isset($data['type'])){$type= $data['type'];}

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

if(!isset($removeLabel)){
$showLabel = true;
} else {
$showLabel = ! $removeLabel;
}

if(isset($inputOnly) && $inputOnly){
$showFormGroup = false;
$showLabel = false;
} 
else
{
$showFormGroup = true;
}

@endphp

<div id="{{ $id }}_group" class="@if($showFormGroup) form-group @endif @if($errors->getBag('default')->has($id))has-error @endif @if(isset($data['hidden']) && $data['hidden'])hidden @endif">

	
	@if($showLabel)
		{{ Form::label($id, $label, ['class' => 'control-label']) }}
	@endif
@if($type == 'text')
    {{ Form::text($id, $value, $attributes) }}
@elseif($type == 'phone')
	@php $attributes['data-mask'] = '(000) 000-0000' @endphp
    {{ Form::text($id, $value, $attributes) }}
@elseif($type == 'password')
    {{ Form::password($id, $attributes) }}
@elseif($type == 'passwordConfirm')
    {{ Form::password($id, $attributes) }}
@elseif($type == 'email')
    {{ Form::email($id, $value, $attributes) }}
@elseif($type == 'textarea')
    {{ Form::textarea($id, $value, $attributes) }}
@elseif($type == 'hidden')
    {{ Form::hidden($id, $value, $attributes) }}
@endif  
	@if(isset($helper_text))
	    <p class="help-block">{{ $helper_text }}</p>
	@endif
	
</div>

@if($type == 'passwordConfirm')
 @push('scriptsdocumentready')
var password = document.getElementById("password")
  , confirm_password = document.getElementById("password_confirmation");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
@endpush
@endif








