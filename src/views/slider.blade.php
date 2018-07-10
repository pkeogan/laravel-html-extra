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

@pushonce('styles:slider')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/11.0.3/nouislider.min.css" integrity="sha256-YuvPeY5+RJF4aGha0ONgpI5Y9kYVWuobgWIf9wx13qY=" crossorigin="anonymous" />
@endpushonce
@pushonce('scripts:slider')
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/11.0.3/nouislider.min.js" integrity="sha256-oj880/QiddQHkKfC9iOmsu+Hu5V4KCHfS3RY3RaZdZc=" crossorigin="anonymous"></script>
@endpushonce

@php
if(!is_null(old($id)))
{
	$value = old($id);
}
@endphp

<div class="form-group @if($errors->getBag('default')->has($id))has-error @endif">
    {{ Form::label($id, $name, ['class' => 'control-label']) }}
    <div class=" col-lg-12 col-centered"  style="    height: 34px; margin-top: 5px;">

				<div id="{{$id}}-slider"></div>
				 {{ Form::hidden($id, $value, ['id' => $id]) }}

			
    </div>
    <p class="help-block" > &nbsp; @if(!isset($attributes['helper_text'])){{ $helper_text }}@endif</p>
</div><!--form control-->
  @push('after-scripts')
<script type="text/javascript">
$(document).ready(function() {
		
   var rangeSlider{{ $id }} = document.getElementById('{{ $id }}-slider');

noUiSlider.create(rangeSlider{{ $id }}, {
	start: [ @if($value == null) {{ $data['max'] / 2 }} @else {{ $value }} @endif ],
		tooltips: [true],
	step: {{ $data['step'] }},
	range: {
		'min': [  {{ $data['min'] }} ],
		'max': [ {{ $data['max'] }} ]
	},
	@if(isset($data['pips']))
	pips: {
		mode: 'range',
		density: {{ $data['pips'] }}
	}
	@endif
});
		var inputFormat = document.getElementById('{{$id}}');

rangeSlider{{ $id }}.noUiSlider.on('update', function( values, handle ) {
	inputFormat.value = values[handle];
});
	
});
</script>
@endpush