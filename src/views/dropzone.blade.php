    
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
  -- |  Dropzone Component
  -- |  
  -- |  This component uses the DropZone javascript plugin.
  -- |  Link: https://www.dropzonejs.com/#installation
  -- |  Default settings are in laravel-html-extra
  -- |
  -- |  Usage: See Readme.md
  --}} 


@pushonce('afterstyles:dropzone')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/css/fileinput.min.css" integrity="sha256-RqDjR2rg7YqFbTY08wiEilAVxcj7QtNImBPiAWEFNd0=" crossorigin="anonymous" />
@endpushonce

@pushonce('scripts:dropzone')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/plugins/purify.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/js/fileinput.min.js" integrity="sha256-v7Jnc/yVk1YcR/HyLdTezSVcMjyTeZbcc8CD/php0uI=" crossorigin="anonymous"></script>
@endpushonce

@php 
//Set $label Var to $name, if 'required' was passed, add a * to the end of the label name
if(isset($attributes) && (in_array('required' ,$attributes) || in_array('Required' ,$attributes))){ $label = $name.' *'; }else{ $label = $name; } 
   
 //if the value was not passed,null it
if(!isset($value)){ $value = null; }

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
	{{ Form::file($id, ['id' => $id]) }}
    <p class="help-block">@if(isset($helper_text)){{ $helper_text }}@endif</p>
</div>


 @push('scriptsdocumentready')
	$("#{{ $id }}").fileinput();
@endpush

