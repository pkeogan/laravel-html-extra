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


if(isset($attributes['required'])){ $label = $name.' *'; }else{ $label = $name; } //Set $label Var, if required was passed, add a * to the end of the label name
if(isset($attributes['value'])){ $value = $attributes['value']; }else{ $value = null; } //if the value was passed, use it, if not null it
if($attributes == null){$attributes = [];} //if attributes is null, because it wasnts passed, setup so we can atleast add the class
if(!isset($attributes['placeholder']))
{
    $attributes['placeholder'] = 'Enter ' . $name;
} 

$attributes = array_merge(['class' => 'form-control'], $attributes); // add the class 'form-control'

@endphp
<div id="{{ $id }}_group" class="form-group @if($errors->getBag('default')->has($id))has-error @endif">
    {{ Form::label($id, $label, ['class' => 'control-label']) }}
    {{ Form::text($id, $value, $attributes) }}
    <p class="help-block">@if(isset($helper_text)){{ $helper_text }}@endif</p>
</div>


