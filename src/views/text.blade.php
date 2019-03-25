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

//If no placeholer is set, set it to Enter + $name
if(!isset($attributes['placeholder']))
{
    $attributes['placeholder'] = 'Enter ' . $name;
} 

//add class form control
$attributes['class'] = 'form-control';


@endphp
<div id="{{ $id }}Group" class="form-group @if($errors->getBag('default')->has($id))has-error @endif @hideGroup()">
    <label for="{{ $id }}" class="control-label">{{ $label }}  @labelRequired() </label>
    {{ Form::text($id, $value, $attributes) }}
    <p class="help-block">@if(isset($helper_text)){{ $helper_text }}@endif</p>
</div>


