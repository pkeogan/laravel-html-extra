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
  -- |  Summernote Editor
  -- |  
  -- |  This component uses the summernote javascript plugin.
  -- |  Link: https://summernote.org/
  -- |  Default settings are in laravel-html-extra
  -- |
  -- |  Usage: See Readme.md
  --}}
@pushonce('styles:summernote')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" integrity="sha512-pDpLmYKym2pnF0DNYDKxRnOk1wkM9fISpSOjt8kWFKQeDmBTjSnBZhTd41tXwh8+bRMoSaFsRnznZUiH9i3pxA==" crossorigin="anonymous" />
@endpushonce
@pushonce('scripts:summernote')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js" integrity="sha512-kZv5Zq4Cj/9aTpjyYFrt7CmyTUlvBday8NGjD9MxJyOY/f2UfRYluKsFzek26XWQaiAp7SZ0ekE7ooL9IYMM2A==" crossorigin="anonymous"></script>
@endpushonce

@php
if(!isset($data)){
$data = config('laravel-html-extra.summernote');
} else {
$data = array_merge($data, config('laravel-html-extra.summernote'));
}
@endphp


<div class="form-group">
<label>{{ $name }}</label>
{{ Form::textarea($id,
                  $value,
                  array_merge(['id' => $id, 'class' => 'form-control'], $attributes)) }}
    
<p class="help-block">{{ $helper_text }}</p>
</div>
  @push('after-scripts')
    <script type="text/javascript">
    $(document).ready(function() {
        $('#{{ $id }}').summernote(
			{!! json_encode($data) !!}
        );
    });
    </script>
@endpush


