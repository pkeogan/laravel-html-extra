{{--
  -- | ----------------------------------------------------------------------------------------------------
  -- |      __                               __   __  __________  _____       _______  ____________  ___    
  -- |     / /  ____ __________ __   _____  / /  / / / /_  __/  |/  / /      / ____| |/ /_  __/ __ \/   |
  -- |    / /  / __ `/ ___/ __ `| | / / _ \/ /  / /_/ / / / / /|_/ / /      / __/  |   / / / / /_/ / /| |
  -- |   / /__/ /_/ / /  / /_/ /| |/ /  __/ /  / __  / / / / /  / / /___   / /___ /   | / / / _, _/ ___ |
  -- |  /_____\__,_/_/   \__,_/ |___/\___/_/  /_/ /_/ /_/ /_/  /_/_____/  /_____//_/|_|/_/ /_/ |_/_/  |_|
  -- | ----------------------------------------------------------------------------------------------------
  -- | Laravel HTML Extra - By Peter Keogan - Link:https://github.com/pkeogan/laravel-html-extra
  -- | ----------------------------------------------------------------------------------------------------
  -- |                                
  -- |  Bootstrap Toggle
  -- |  
  -- |  This component uses the bootstrap toggle javascript plugin.
  -- |  Link: http://www.bootstraptoggle.com/
  -- |  Default settings are in laravel-html-extra
  -- |
  -- |  Usage: See Readme.md
  --}}


@php if(isset($attributes['required']) && (in_array('required' ,$attributes) || in_array('Required' ,$attributes))){ $name = $name.' *'; } @endphp

<div class="form-group @if(isset($data['hidden']) && $data['hidden'])hidden @endif" id="{{ $id }}_group">
 <label for="middle_name" class="control-label">{{ $name }}</label>
@if(isset($attributes) && array_key_exists('placeholder', $attributes)) @if($attributes['placeholder'] != null ) placeholder: "{{ $attributes['placeholder'] }}", @endif @endif
<div class="label-control"> {{ Form::checkbox( $id, 'true', $value, ['id' => 'toggle-'.$id ]) }}  </div>
   <p class="help-block">{!! $helper_text  !!}</p>
</div>
  
@php if($value == null){$value = '0';} @endphp
  
 {{ Form::hidden($id, $value, ['id' => $id]) }}

@push('after-scripts')
<script>
$( document ).ready(function() {
      $(function() {
            $('#toggle-{{ $id }}').bootstrapToggle({
                                      on: '@if(isset($data['data-on'])){{ $data['data-on'] }}@elseif(isset($data['data-label'])){{ $data['data-label'] }} @else{{config('laravel-html-extra.toggle.data-on')}}@endif',
                                      off: '@if(isset($data['data-off'])){{ $data['data-off'] }}@elseif(isset($data['data-label'])){{ $data['data-label'] }} @else{{config('laravel-html-extra.toggle.data-off')}}@endif',
@if(!isset($data['data-size'])) width:   @if(isset($data['data-width'])){{ $data['data-width'] }}@else{{config('laravel-html-extra.toggle.data-width') }}@endif, @endif
@if(!isset($data['data-size'])) height:  @if(isset($data['data-height'])){{ $data['data-height'] }}@else{{config('laravel-html-extra.toggle.data-height')}}@endif, @endif
@if(isset($data['data-size']))  size:    @if(isset($data['data-size']))'{{ $data['data-size'] }}',@else'{{config('laravel-html-extra.toggle.data-size')}}', @endif @endif
                                      offstyle: '@if(isset($data['data-offstyle'])){{ $data['data-offstyle'] }}@else{{config('laravel-html-extra.toggle.data-offstyle')}}@endif',
                                      onstyle: '@if(isset($data['data-onstyle'])){{ $data['data-onstyle'] }}@else{{config('laravel-html-extra.toggle.data-onstyle')}}@endif',
            });
      })
      $(function() {
            $('#toggle-{{ $id }}').change(function() {
                  if($(this).prop('checked')){
                        $('#{{ $id }}').val('1')
                 
                  } else {
                        $('#{{ $id }}').val('0')   
             
                  }
            })
       })
                      $('#toggle-{{ $id }}').change(function() {
                                @if(isset($data['config']))
                      @php $config= json_encode( $data['config']); @endphp
                                  var config = JSON.parse('{!! $config !!}');
                                  if($(this).prop('checked')){
                                    $.each(config, function( id, settings ) {
                                        $.each(settings, function( index, setting) {
                                           if(setting == 'toggled-required'){ $('#'+id).requireInput(); }
                                           if(setting == 'toggled-disabled'){ $('#'+id).attr('disabled', true); }
                                           if(setting == 'untoggled-required'){ $('#'+id).unrequireInput(); }
                                           if(setting == 'untoggled-disabled'){ $('#'+id).removeAttr('disabled'); }
                                        });
                                      });
                                  } else {
                                    $.each(config, function( id, settings ) {
                                       $.each(settings, function( index, setting) {
                                          if(setting == 'toggled-required'){ $('#'+id).unrequireInput(); }
                                          if(setting == 'toggled-disabled'){ $('#'+id).removeAttr('disabled'); }
                                          if(setting == 'untoggled-required'){ $('#'+id).requireInput(); }
                                          if(setting == 'untoggled-disabled'){ $('#'+id).attr('disabled', true); }
                                        });
                                      });
                                  }
                               @endif
                      
                        @if(isset($data['show-id-if-toggled']))
                            @if($data['show-id-if-toggled'] != null)
                                  if($(this).prop('checked')){
                                      @foreach($data['show-id-if-toggled'] as $show)
                                           $('#{{$show}}').removeClass('hidden');
									  $('#{{$show}}').addClass('visible');
                                      @endforeach
                                  } else {
                                    @foreach($data['show-id-if-toggled'] as $show)
                                         $('#{{$show}}').addClass('hidden');
									  $('#{{$show}}').removeClass('visible');
                                    @endforeach
                                  }
                            @endif
                          @endif
                          @if(isset($data['hide-id-if-toggled']))
                              @if($data['hide-id-if-toggled'] != null)
                                    if($(this).prop('checked')){
                                            @foreach($data['hide-id-if-toggled'] as $hide)
                                                 $('#{{$hide}}').addClass('hidden')
                                            @endforeach
                                    } else {
                                      @foreach($data['hide-id-if-toggled'] as $hide)
                                             $('#{{$hide}}').removeClass('hidden')
                                       @endforeach
                                    }
                              @endif 
                          @endif
                         @if(isset($data['disable-select-if-toggled']))
                              @if($data['disable-select-if-toggled'] != null)
                                    if($(this).prop('checked')){
                                          @foreach($data['disable-select-if-toggled'] as $disable)
                                                $('.select-2-'.{{$disable}} ).prop("disabled", true);
                                          @endforeach
                                    }
                              @endif 
                          @endif
                           @if(isset($data['enable-select-if-toggled']))
                              @if($data['enable-select-if-toggled'] != null)
                                    if($(this).prop('checked')){
                                          @foreach($data['enable-select-if-toggled'] as $enable)
                                                $('.select-2-'.{{$enable}}).prop("disabled", false);
                                          @endforeach
                                    }
                              @endif 
                          @endif
                         @if(isset($data['disable-id-if-toggled']))
                              @if($data['disable-id-if-toggled'] != null)
                                    if($(this).prop('checked')){
                                          @foreach($data['disable-id-if-toggled'] as $disable)
                                               if($('#{{ 'toggle-'.$disable }}').attr('type') != 'checkbox'){
                                                  $('#{{ $disable }}').attr('disabled', true);
                                               } else {
                                                 $('#{{ 'toggle-'.$disable }}').bootstrapToggle('off')
                                               }
                                               
                                          @endforeach
                                    } else {
                                            @foreach($data['disable-id-if-toggled'] as $enable)
                                              if($('#{{ 'toggle-'.$enable }}').attr('type') != 'checkbox'){
                                                  $('#{{ $enable }}').removeAttr('disabled');
                                               } else {
                                                 $('#{{ 'toggle-'.$enable }}').bootstrapToggle('on')
                                               }
                                          @endforeach
                                    }
                              @endif 
                          @endif
                           @if(isset($data['enable-id-if-toggled']))
                              @if($data['enable-id-if-toggled'] != null)
                                    if($(this).prop('checked')){
                                          @foreach($data['enable-id-if-toggled'] as $enable)
                                              if($('#{{ 'toggle-'.$enable }}').attr('type') != 'checkbox'){
                                                  $('#{{ $enable }}').removeAttr('disabled');
                                               } else {
                                                 $('#{{ 'toggle-'.$enable }}').bootstrapToggle('on')
                                               }
                                          @endforeach
                                    } else {
                                          @foreach($data['enable-id-if-toggled'] as $disable)
                                               if($('#{{ 'toggle-'.$disable }}').attr('type') != 'checkbox'){
                                                  $('#{{ $disable }}').attr('disabled', true);
                                               } else {
                                                 $('#{{ 'toggle-'.$disable }}').bootstrapToggle('off')
                                               }
                                               
                                          @endforeach
                                    }
                              @endif 
                          @endif
                    });
})
</script>
@endpush