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
@pushonce('afterstyles:toggle')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" />
@endpushonce
@pushonce('scripts:toggle')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endpushonce

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
})
</script>
@endpush


@if(isset($data['show-id-if-toggled']) || isset($data['disable_select_if_toggled']) || isset($data['enable_select_if_toggled']) ||isset($data['disable-id-if-toggled']) || isset($data['enable-id-if-toggled']) || isset($data['hide-id-if-toggled']))
@push('after-scripts') 
<script type="text/javascript">
      $( document ).ready(function() {
              $(function() {
                    $('#toggle-{{ $id }}').change(function() {
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
                                               $('#{{ 'toggle-'.$disable }}').bootstrapToggle('off')
                                          @endforeach
                                    }
                              @endif 
                          @endif
                           @if(isset($data['enable-id-if-toggled']))
                              @if($data['enable-id-if-toggled'] != null)
                                    if($(this).prop('checked')){
                                          @foreach($data['enable-id-if-toggled'] as $enable)
                                               $('#{{ 'toggle-'.$enable }}').bootstrapToggle('on')
                                          @endforeach
                                    }
                              @endif 
                          @endif
                    })
              })
      })
</script>
@endpush
@endif