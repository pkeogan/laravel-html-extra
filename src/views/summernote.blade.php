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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote.css" integrity="sha256-3en7oGyoTD7A1GPFbWeqdIGvDlNWU5+4oWgJQE2dnQs=" crossorigin="anonymous" />
@endpushonce
@pushonce('scripts:summernote')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote.js" integrity="sha256-9tvAQTHltclSRZubN4xerdlqLhVmxj/Z311rAkOzXd0=" crossorigin="anonymous"></script>
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


