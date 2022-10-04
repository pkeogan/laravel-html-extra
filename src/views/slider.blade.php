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
  -- |  noUiSlider Component
  -- |  
  -- |  This component uses the noUiSlider javascript plugin.
  -- |  Link: https://refreshless.com/nouislider/
  -- |  Default settings are in laravel-html-extra
  -- |
  -- |  Usage: See Readme.md
  --}} 
@php
if(!is_null(old($id)))
{
	$value = old($id);
}

if(!isset($data['step'])){
$data['step'] = 1;
}
if(!isset($data['max'])){
$data['max'] = 10;
}
if(!isset($data['min'])){
$data['min'] = 0;
}
@endphp

<div id="{{$id}}Group"  class="form-group @if($errors->getBag('default')->has($id))has-error @endif">
    {{ Form::label($id, $name, ['class' => 'control-label']) }}
    <div class=" col-lg-12 col-centered"  style="height: 34px; padding-bottom: 50px;padding-top: 50px; margin-bottom:25px">

				<div id="{{$id}}-slider"></div>
				 {{ Form::hidden($id, $value, ['id' => $id]) }}

			
    </div>
    <p class="help-block" > &nbsp; @if(!isset($attributes['helper_text'])){{ $helper_text }}@endif</p>
</div><!--form control-->
  @push('after-scripts')
<script type="text/javascript">
$(document).ready(function() {
  
  console.log('start:{{$value}}');
  
   window.rangeSlider{{ $id }} = document.getElementById('{{ $id }}-slider');
noUiSlider.create(window.rangeSlider{{ $id }}, {
	start: [@if($value == null) {{ $data['max'] / 2 }} @else {{ $value }} @endif],
		tooltips: [true],
      connect: "lower",
        @if(isset($data['ana']) && $data['ana'] == true)
      format: {
        to: function (value) {
          if(value == @if(isset($data['notrated'])) 0 @else -1 @endif){
            return 'Not Answered';
          }
          {{--
          @if(isset($data['setpip1']))
          if(value == 1){
                      return '{{ $data['setpip1'] }}';
                    }
          @endif
          @if(isset($data['setpip2']))
          if(value == 2){
                      return '{{ $data['setpip2'] }}';
                    }
          @endif
          @if(isset($data['setpip3']))
          if(value == 3){
                      return '{{ $data['setpip3'] }}';
                    }
          @endif
          @if(isset($data['setpip4']))
          if(value == 4){
                      return '{{ $data['setpip4'] }}';
                    }
          @endif
          @if(isset($data['setpip5']))
          if(value == 5){
                      return '{{ $data['setpip5'] }}';
                    }
          @endif
          --}}
          return Math.round(value);

           
        },
        from: function (value) {
          if(value == null)
            {
              return @if(isset($data['notrated'])) 0 @else -1 @endif;
            } else {
            return Math.round(value);
            }
        }
    },
      @else
        format: {
        to: function (value) {
            return value;     
        },
        from: function (value) {
            return value;
        }
    },
  @endif
      
	step: {{ $data['step'] }},
	range: {
		'min': [  {{ $data['min'] }} ],
		'max': [ {{ $data['max'] }} ]
	},
    
    	@if(isset($data['pipsvalue']))
	pips: {
		mode: 'values',
    values: {!! $data['pipsvalue'] !!},
    format: {
        to: function (value) {
          @if(isset($data['notrated']))
          if(value == 0){
              return '';
            }
          @else
            if(value == -1){
              return '';
            }
          @endif
          @if(isset($data['setpip1']))
          if(value == 1){
                      return '{{ $data['setpip1'] }}';
                    }
          @endif
          @if(isset($data['setpip2']))
          if(value == 2){
                      return '{{ $data['setpip2'] }}';
                    }
          @endif
          @if(isset($data['setpip3']))
          if(value == 3){
                      return '{{ $data['setpip3'] }}';
                    }
          @endif
          @if(isset($data['setpip4']))
          if(value == 4){
                      return '{{ $data['setpip4'] }}';
                    }
          @endif
          @if(isset($data['setpip5']))
          if(value == 5){
                      return '{{ $data['setpip5'] }}';
                    }
          @endif
          return value;
        },
        from: function (value) {
            return value;
        }
    }
   },
	@endif
	@if(isset($data['pips']))
	pips: {
		mode: 'range',
		density: {{ $data['pips'] }}
	}
	@endif
})@if(isset($data['default'])).set($data['default'])@endif;
		var inputFormat = document.getElementById('{{$id}}');

window.rangeSlider{{ $id }}.noUiSlider.on('update', function( values, handle ) {
	inputFormat.value = values[handle];
});
    

    
	
});
</script>
@endpush