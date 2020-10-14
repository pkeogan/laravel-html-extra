    
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
  
  
  <div class="card p-0">
    <div class="card-header">{{ $label }}
      @if($value)
      <span id="{{ $id }}-signature-save-status" class="badge badge-success float-right">Signature Saved</span>
      @else
      <span id="{{ $id }}-signature-save-status" class="badge badge-success float-right invisible">Signature Saved</span>
      @endif
    </div>
    <div class="card-body p-0 m-0" style="background-color:#EEEEEE">
  
  
  <fieldset id="{{ $id }}Group" class="@if($showFormGroup) form-group @endif @if($errors->getBag('default')->has($id))has-error @endif @hideGroup()">
  @if(false)
    <label for="{{ $id }}">{{ $label }}  @labelRequired </label>
  @endif
  
 
  <div id="{{ $id }}-signature-image-div" class="text-center @if(!$value) d-none @endif">
  <img id="{{ $id }}-signature-image" src="@if($value){{$value}}@endif" class="img-fluid" alt="Responsive image">
  </div>

  
    <canvas id="{{ $id }}-signature-pad" width="500" height="155" style="width: 100%; height: 155px" @if($value)class="d-none"@endif ></canvas>
    {{ Form::hidden($id, (old($id) ?? $value), $attributes) }}
  
  </fieldset>
  
  </div>
  <div class="card-footer  m-0">
    <div class="row">
      <div class="col-sm-6">
        <button type="button" class="btn btn-block btn-primary @if($value) invisible hide @endif" @click="$dispatch('update-input', '{{$id}}')" id="{{$id}}-save-signature">Save</button>
      </div>
      <div class="col-sm-6">
        <button type="button" class="btn btn-block btn-primary" id="{{$id}}-clear-signature">Clear</button>
      </div>
    </div>
  
  </div>
  </div>
  
  
  
  
  @push('after-scripts')
  <script>
      const {{$id}}UpdateEvent = new Event('{{$id}}Updated');
  
  </script>
  @endpush
  
    
   @push('scriptsdocumentready')
  var {{$id}}canvas = document.getElementById('{{ $id }}-signature-pad');
  
  
   
   var {{$id}}signaturePad = new SignaturePad({{$id}}canvas, {
     backgroundColor: 'rgb(238, 238, 238)', // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
   
     onBegin:  function () {
      $("#{{ $id }}-signature-save-status").addClass('invisible');
     },
     onEnd: function () {
      var data = {{$id}}signaturePad.toDataURL('image/png');
      document.getElementById("{{$id}}").value = data;  
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
  
     //AJAX
     document.dispatchEvent({{$id}}UpdateEvent);
  
  
     var data = {{$id}}signaturePad.toDataURL('image/png');
     $("#{{ $id }}-signature-save-status").removeClass('invisible');
        //cvhanges hidden form value
        document.getElementById("{{$id}}").value = data;
        $('#{{$id}}').trigger('change');
        //hide canvas pad
        $('#{{ $id }}-signature-pad').addClass('d-none');
        //show image
        $('#{{ $id }}-signature-image').attr('src', data);
        $('#{{ $id }}-signature-image-div').removeClass('d-none');
        $('#{{ $id }}-save-signature').addClass('invisible');
        
      });
   
   
   document.getElementById('{{$id}}-clear-signature').addEventListener('click', function () {
     console.log('cleared');
      {{$id}}signaturePad.clear();
      //show canvas pad
      $('#{{ $id }}-signature-pad').removeClass('d-none');
      //hide image
      $('#{{ $id }}-signature-image-div').addClass('d-none');
      $("#{{ $id }}-signature-save-status").addClass('invisible');
      $('#{{ $id }}-save-signature').removeClass('invisible');
   });
  
  {{-- 
   @if($value)
  {{$id}}signaturePad.fromDataURL("{{ $value }}");
  console.log({{$id}}signaturePad.toDataURL('image/png'));
   @endif
  
  --}}
  @endpush
  
  
  