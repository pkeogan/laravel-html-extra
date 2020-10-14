    
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


@pushonce('styles:dropzone')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/css/fileinput.min.css" integrity="sha512-KrsXJaSKHqHogNzPCOHPvkyvH4ZQGzUcR/Q6R3qywbdtrvOHPuPz9iRIoJoiKguuIgkDGsj+PwPh3QKnlwwQPA==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/themes/explorer-fa/theme.min.css" integrity="sha512-+Uz8lwvjo+AYZvvI9w2ZNkInUh9i+onT2cQwraXQHrOjF77fvpvXFrBnSRX2OXB4QXKuZojs8ZveKuImg9uNzQ==" crossorigin="anonymous" />
@endpushonce

@pushonce('scripts:dropzone')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/js/plugins/piexif.min.js" integrity="sha512-rOFfpB1/58CtdhJdLV7Z9r4XcPv46dOngI3bAxgK8SUZEFjVtW4rG7BUu+3L5PxHMh3s52kpE65Cl29skN9rRw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/js/plugins/sortable.min.js" integrity="sha512-ELgdXEUQM5x+vB2mycmnSCsiDZWQYXKwlzh9+p+Hff4f5LA+uf0w2pOp3j7UAuSAajxfEzmYZNOOLQuiotrt9Q==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/js/plugins/purify.min.js" integrity="sha512-V7J88Yl+H1mHHMZViS6l5dX13Qp/Q57pjypaooPBUVgsQ6wAi+Hcax0rFisOFH2DHgS+ufrQ6ewPQVn/LbBfgA==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/js/fileinput.min.js" integrity="sha512-wvbv0QlgtUZ1jkgRfB7HNUICt+27sqAUh2IwVJXfN9q7rtrmgbdI6LQjhzurdLo1+vxO645+GY+Kq8Vop0WA4w==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/themes/explorer-fa/theme.min.js" integrity="sha512-bm8WPklXxJzflPpHNiY09i9ODXJuNdqdOtTOLkSUdbgRz5SPo/7AjvmvUn08WaeZZGEQYcgX3gYibf1SBbcP0A==" crossorigin="anonymous"></script>
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

if(!isset($removeLabel)){
  $showLabel = true;
} else {
  $showLabel = ! $removeLabel;
}


// add the class 'form-control'
$attributes['class'] = 'form-control';
$attributes['id'] = $id;

@endphp

<div id="{{ $id }}_group" class="form-group @if($errors->getBag('default')->has($id))has-error @endif @if(isset($data['hidden']) && $data['hidden'])hidden @endif">
     @if($showLabel) {{ Form::label($id, $label, ['class' => 'control-label']) }} @endif
     @if(in_array('multiple', $attributes))
     {{ Form::file($id.'[]', $attributes) }}
     @else
     {{ Form::file($id, $attributes) }}
     @endif
     

    <p class="help-block">@if(isset($helper_text)){{ $helper_text }}@endif</p>
</div>


 @push('scriptsdocumentready')
  $("#{{ $id }}").fileinput({
    theme:'explorer-fa',
    maxFileSize: 20000,
    showUpload:false,
   previewFileType:'any',
  });
@endpush

