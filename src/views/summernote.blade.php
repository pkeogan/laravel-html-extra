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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" integrity="sha256-1uHhBaI19Fpk6DF4OY0VVh3TdrDba1fJ4HpiW5fuVH0=" crossorigin="anonymous" />
@endpushonce
@pushonce('scripts:summernote')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.min.js" integrity="sha256-XQ00qNI8haIYWjFizD+WhH3ZGg1y3ik1rp2Aneo2dfk=" crossorigin="anonymous"></script>
@endpushonce

<div class="form-group">
<label>{{ $name }}</label>
{{ Form::textarea($name,
                  null,
                  array_merge(['id' => $id, 'class' => 'form-control'], $attributes)) }}
    
<p class="help-block">{{ $helper_text }}</p>
</div>
  @push('after-scripts')
    <script type="text/javascript">
    $(document).ready(function() {
        $('#{{ $id }}').summernote({
            @if(array_key_exists('height', $attributes)) height:"{{$attributes['height']}}" @endif
        });
    });
    </script>
@endpush


