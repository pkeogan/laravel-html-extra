    
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
  -- |  Select2 Component
  -- |  
  -- |  This component uses the Select2 javascript plugin.
  -- |  Link: https://select2.org/
  -- |  Default settings are in laravel-html-extra
  -- |
  -- |  Usage: See Readme.md
  --}} 

@php 
//if incoming $data['report_model'] is true, then we need to pull set the $value within here
if(isset($data['select_model']) && isset($data['select_model']))
{
		$value = get_report_selection_models($data['select_model_type'], $data['select_model_scope']);
}

//check is given value is a collection, if it is, set it to be an array
if(isset($value) && !is_array($value) && (new \ReflectionClass($value))->getShortName() == "Collection") //use reflection class. its faster link:https://stackoverflow.com/questions/19901850/how-do-i-get-an-objects-unqualified-short-class-name
{
    $value = $value->all();
}
//Check if provided value is set, and is a array
  if( ! is_array($value) ){ 
      $value = ['1' =>'Error Loading Values, Please notify system administrator. ']; 
      Log::warning('Laravel HTML Extra: A Select 2 Module received a value that was not an array on page: ' . url()->full() ); 
  }

if(isset($attributes['multiple']) && $attributes['multiple'] == 'multiple'){$formID = $id.'[]'; }else{$formID = $id;}
if(! isset($data['default'] )){ $data['default'] = null; }

if(isset($attributes)){ if( in_array('required', $attributes) ){ $label = $name.' '; }else{ $label = $name; } }else{ $label = $name; } //Set $label Var, if required was passed, add a * to the end of the label name
if( !empty($attributes['placeholder']) && empty($attributes['multiple'])){
array_unshift($value, "");
}

if(!isset($attributes['placeholder'])){$attributes['placeholder'] = 'Select '. $name;}

if(!isset($removeLabel)){
$showLabel = true;
} else {
$showLabel = ! $removeLabel;
}

@endphp

  @push('scriptsdocumentready')    {{-- <script> --}}

        $('.select-2-{{ $id }}').select2({
            @if(array_key_exists('allow-clear', $attributes))  allowClear:{{$attributes['allow-clear']}},@else allowClear:true, @endif
            @if(array_key_exists('tags', $attributes)) @if($attributes['tags'] == 'true') tags:true, @endif @endif
            @if(!empty($attributes['placeholder'])) placeholder: "{{ $attributes['placeholder'] }}", @endif
            @if(array_key_exists('multiple', $attributes))@if(array_key_exists('maximumSelectionLength', $attributes)) @if($attributes['maximumSelectionLength'] != null ) maximumSelectionLength: "{{ $attributes['maximumSelectionLength'] }}", @endif @endif @endif
            theme: "bootstrap4",
        });
        @if(isset($data['logic']))
        var selecteddata = $('.select-2-{{ $id }}').select2('data');
        selecteddata.forEach(function(entry) {
            @foreach($data['logic'] as $key=>$value2)
                if(entry.id == '{{ $key }}'){$("#{{ $value2 }}").removeClass('hidden');}else{$("#{{ $value2 }}").addClass('hidden');}
             @endforeach
        });
        @endif

    {{-- </script> --}}
@endpush

<div id="{{ $id }}Group" id="{{ $id }}Group"class="form-group  @hideGroup() @if($errors->getBag('default')->has($id))has-error @endif">
  @if($showLabel)
  <label for="{{ $id }}" class="control-label">{{ $label }}  @labelRequired() </label>
  @endif
    @php
  if(isset($attributes['multiple']) && $attributes['multiple'] == 'multiple'){{ unset($attributes['placeholder']); }}
    @endphp
    {{ Form::select($formID, $value, $data['default'], array_merge(['id' => $id, 
                                                      'class' => 'select-2-'.$id.' form-control',
                                                      'name' => $formID, 
                                                      'style' => 'width: 100%'
                                                        ], $attributes)) }}
    @if(isset($helper_text))
<p class="help-block" >{{ $helper_text }}</p>
	@endif
</div>
@if(isset($data['logic']))
  @push('scriptsdocumentready')
  {{-- <script> --}}
    $('.select-2-{{ $id }}').on('select2:select', function (e) {
      @foreach($data['logic'] as $key=>$value)

     
          if(e.params.data.id == '{{ $key }}'){
			  $("#{{ $value }}").removeClass('hidden');
			  $("#{{ $value }}").addClass('visible');
											  }else{
												  $("#{{ $value }}").addClass('hidden');
												  $("#{{ $value }}").removeClass('visible');
											  }
      @endforeach
		$('.hidden :input').prop('disabled', true);
		$('.visible :input').prop('disabled', false);
		
    });
  @endpush
@endif


@php $rgSet = isset($data['requiredGroups']);
    $ogSet = isset($data['optionalGroups']);
    @endphp
@if($rgSet || $ogSet)
  @push('scriptsdocumentready')

    $('.select-2-{{ $id }}').on('select2:select', function (e) {
      //hide all form inputs
      var cid = $(this).attr('id');
      console.log(cid + " was selected");
            $(this).closest('form').find('.form-group').each(function( index ) {
              if($(this).attr('id') != '{{$id}}Group') {
             $(this).removeClass('visible');
             $(this).addClass('hidden');
            }
      });
      $(this).closest('form').find(':input').not(':input[type=button], :input[type=submit], :input[type=reset]').each(function( index ) {
        //dont want to hide and disable this current elment
        if($(this).attr('id') != cid){
          $(this).prop('required', true);
          $(this).prop('required', false);
          $(this).closest('div .form-group').find('.form-input-required-label').remove();
            $(this).closest('div .form-group').addClass('hidden'); 
        }
        
      });
      console.log(e.params.data.id);
      @if($rgSet)
      @foreach($data['requiredGroups'] as $key=>$value)
      if(e.params.data.id == '{{ $key }}'){
        @if(is_array($value))
          @foreach($value as $key2=>$val2)
            $("#{{ $val2 }}Group").removeClass('hidden');
            $("#{{ $val2 }}Group").addClass('visible');
            $("#{{ $val2 }}").prop('disabled', false);
            $("#{{ $val2 }}").prop('required', true);
            $("#{{ $val2 }}Group label").append('<span class="form-input-required-label">(required)</span>');
       
        
          @endforeach
        @else
            $("#{{ $value }}Group").removeClass('hidden');
            $("#{{ $value }}Group").addClass('visible');
            $("#{{ $value }}").prop('disabled', false);
            $("#{{ $val2 }}").prop('required', true);
            $("#{{ $val2 }}Group label").append('<span class="form-input-required-label">(required)</span>');

        @endif
      }
      @endforeach
        @endif
          @if($ogSet)
        @foreach($data['optionalGroups'] as $key=>$value)
        if(e.params.data.id == '{{ $key }}'){
        @if(is_array($value))
          @foreach($value as $key2=>$val2)
            $("#{{ $val2 }}Group").removeClass('hidden');
            $("#{{ $val2 }}Group").addClass('visible');
            $("#{{ $val2 }}").prop('disabled', false);
            $("#{{ $val2 }}").prop('required', false);
          @endforeach
        @else
            $("#{{ $value }}Group").removeClass('hidden');
            $("#{{ $value }}Group").addClass('visible');
            $("#{{ $value }}").prop('disabled', false);
            $("#{{ $val2 }}").prop('required', false);
        @endif
        }
      @endforeach
          @endif
      
		$('.hidden :input').prop('disabled', true);
		$('.visible :input').prop('disabled', false);
     $('.hidden select').prop('disabled', true);
		$('.visible select').prop('disabled', false);
		
    });
  {{-- </script> --}}
  @endpush
@endif


@if(isset($data['disable_id_if_selected']))
  @push('scriptsdocumentready')
  {{-- <script> --}}
    $('.select-2-{{ $id }}').on('select2:select', function (e) {
      @foreach($data['disable_id_if_selected'] as $key=>$values)
          if(e.params.data.id == '{{ $key }}')
          {
              @foreach($values as $value)
                    $("#{{ $value }}").prop('disabled', true);
              @endforeach
              
          }
      @endforeach
    });
  {{-- </script> --}}
  @endpush
@endif

@if(isset($data['enable_id_if_selected']))
  @push('scriptsdocumentready')
  {{-- <script> --}}
    $('.select-2-{{ $id }}').on('select2:select', function (e) {
      @foreach($data['enable_id_if_selected'] as $key=>$values)
          if(e.params.data.id == '{{ $key }}')
          {
              @foreach($values as $value)
                    $("#{{ $value }}").prop('disabled', false);
              @endforeach
              
          }
      @endforeach
    });
  {{-- </script> --}}
  @endpush
@endif

@if(isset($data['hide_and_disable_id_if_selected']))
  @push('scriptsdocumentready')
  {{-- <script> --}}
    $('.select-2-{{ $id }}').on('select2:select', function (e) {
      @foreach($data['hide_and_disable_id_if_selected'] as $key=>$values)
          if(e.params.data.id == '{{ $key }}')
          {
              @foreach($values as $value)
                   
              $("#{{ $value }}_group").addClass('hidden');
                    $("#{{ $value }}").prop('disabled', true);
              @endforeach
              
          }
      @endforeach
    });
  {{-- </script> --}}
  @endpush
@endif

@if(isset($data['show_and_enable_id_if_selected']))
  @push('scriptsdocumentready')
  {{-- <script> --}}
    $('.select-2-{{ $id }}').on('select2:select', function (e) {
      @foreach($data['show_and_enable_id_if_selected'] as $key=>$values)
          if(e.params.data.id == '{{ $key }}')
          {
              @foreach($values as $value)
                 $("#{{ $value }}_group").removeClass('hidden');
                 $("#{{ $value }}").prop('disabled', false);
              @endforeach
              
          }
      @endforeach
    });
  {{-- </script> --}}
  @endpush
@endif

@if(isset($data['disable_all_then_show_and_enable_id_if_selected']))
  @push('scriptsdocumentready')
  {{-- <script> --}}
    $('.select-2-{{ $id }}').on('select2:select', function (e) {
        @foreach($data['disable_all_then_show_and_enable_id_if_selected'] as $key=>$values)
              @foreach($values as $value)
                 $("#{{ $value }}_group").addClass('hidden');
                 $("#{{ $value }}").prop('disabled', true);
              @endforeach
      @endforeach
        
      @foreach($data['disable_all_then_show_and_enable_id_if_selected'] as $key=>$values)
          if(e.params.data.id == '{{ $key }}')
          {
              @foreach($values as $value)
                 $("#{{ $value }}_group").removeClass('hidden');
                 $("#{{ $value }}").prop('disabled', false);
              @endforeach
              
          }
      @endforeach
    });
  {{-- </script> --}}
  @endpush
@endif