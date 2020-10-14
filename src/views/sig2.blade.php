    
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
  -- |  signature_pad
  -- |  
  -- |  This component uses the signature_pad javascript plugin.
  -- |  Link: https://github.com/szimek/signature_pad
  -- |  Default settings are in laravel-html-extra
  -- |
  -- |  Usage: See Readme.md
  --}} 

  @pushonce('scripts:signature')
  <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js" integrity="sha256-W+ivNvVjmQX6FTlF0S+SCDMjAuTVNKzH16+kQvRWcTg=" crossorigin="anonymous"></script>
  @endpushonce
  
  @pushonce('styles:signature')
  <style>
  .wrapper {
      position: relative;
      width: 400px;
      height: 200px;
      -moz-user-select: none;
      -webkit-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
    
    .signature-pad {
      position: absolute;
      left: 0;
      top: 0;
      width:400px;
      height:200px;
      background-color: white;
    }
  </style>
  @endpushonce
  
  @php
  //Set $label Var to $name, if 'required' was passed, add a * to the end of the label name
  if(isset($attributes) && (in_array('required' ,$attributes) || in_array('Required' ,$attributes))){ $label = $name.' *'; }else{ $label = $name; } 
     
  if(empty($attributes['id'])){ $attributes['id'] = $id; } 
  
  //If array-input is set, add a [] to the end of the name attribue
  if(isset($data['arrayInput']) && $data['arrayInput'])
  {
      $attributes['name'] = $id . '[]';
  } 
  
  // add the class 'form-control'
  $attributes['class'] = 'form-control';
  
  if(isset($data['removeCard'])){
    $removeCard = true;
  } else {
    $removeCard = false;
  }
  
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
  
  @if($removeCard == true)
  
  
  
  
  <fieldset id="{{ $id }}Group" class="@if($showFormGroup) form-group @endif @if($errors->getBag('default')->has($id))has-error @endif @hideGroup()">
  <div class="wrapper">
    <canvas id="{{ $id }}-signature-pad" class="signature-pad" width="100%" height="200"></canvas>
    {{ Form::hidden($id, (old($id) ?? $value), $attributes) }}
  
  </div>
  
  
  
  </fieldset>
  
  
  
  @else
  
  <x-backend.card>
    <x-slot name="header">{{ $label }}
        <span id="{{ $id }}-signature-save-status" class="badge badge-success float-right invisible">Signature Saved</span>
    </x-slot>
    <x-slot name="body">
  
  
  <fieldset id="{{ $id }}Group" class="@if($showFormGroup) form-group @endif @if($errors->getBag('default')->has($id))has-error @endif @hideGroup()">
  @if(false)
    <label for="{{ $id }}">{{ $label }}  @labelRequired </label>
  @endif
  <div class="wrapper">
    <canvas id="{{ $id }}-signature-pad" class="signature-pad" ></canvas>
    {{ Form::hidden($id, (old($id) ?? $value), $attributes) }}
  
  </div>
  
  
  
  </fieldset>
  
  </x-slot>
  <x-slot name="footer">
    <button type="button" class="btn btn-sm btn-primary" @click="$dispatch('update-input', '{{$id}}')" id="{{$id}}-save-signature">Save</button>
    <button type="button" class="btn btn-sm btn-primary" id="{{$id}}-clear-signature">Clear</button>
  </x-slot>
  </x-backend.card>
  
  @endif
  
  
  
  @push('after-scripts')
  <script>
      const {{$id}}UpdateEvent = new Event('{{$id}}Updated');
  
  </script>
  @endpush
  
    
   @push('scriptsdocumentready')
   var canvas = document.getElementById('{{ $id }}-signature-pad');
  
   // Adjust canvas coordinate space taking into account pixel ratio,
   // to make it look crisp on mobile devices.
   // This also causes canvas to be cleared.
   function resizeCanvas() {
       // When zoomed out to less than 100%, for some very strange reason,
       // some browsers report devicePixelRatio as less than 1
       // and only part of the canvas is cleared then.
       var ratio =  Math.max(window.devicePixelRatio || 1, 1);
       canvas.width = (canvas.offsetWidth * ratio) - 75;
       canvas.height = (canvas.offsetHeight * ratio);
       canvas.getContext("2d").scale(ratio, ratio);
   }
   
   window.onresize = resizeCanvas;
   resizeCanvas();
   
   var {{$id}}signaturePad = new SignaturePad(canvas, {
     backgroundColor: 'rgb(255, 255, 255)', // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
   
     onBegin:  function () {
      $("#{{ $id }}-signature-save-status").addClass('invisible');
     },
     onEnd: function () {
  
      var data = {{$id}}signaturePad.toDataURL('image/png');
      //$("#{{ $id }}-signature-save-status").removeClass('invisible');
      document.getElementById("{{$id}}").value = data;
      //$('#{{$id}}').trigger('change');
  
      //var el = document.getElementById("{{$id}}");
      //$("#{{$id}}").val(data).trigger('change');
  
  
    }
   });
   
  document.getElementById('{{$id}}-save-signature').addEventListener('click', function () {
     if ({{$id}}signaturePad.isEmpty()) {
       return Swal.fire({
          icon: 'error',
          title: 'Signature Error.',
          text: 'Please provide a signature then click save!'
        });
     }
  
     document.dispatchEvent({{$id}}UpdateEvent);
  
  
     var data = {{$id}}signaturePad.toDataURL('image/png');
     $("#{{ $id }}-signature-save-status").removeClass('invisible');
        document.getElementById("{{$id}}").value = data;
        $('#{{$id}}').trigger('change');
      });
   
   
   document.getElementById('{{$id}}-clear-signature').addEventListener('click', function () {
      {{$id}}signaturePad.clear();
   });
   
   @if($value)
  {{$id}}signaturePad.fromDataURL("{{ $value }}");
   @endif
  
  @endpush
  
  
  