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
  -- |  Date/Range Picker Component
  -- |  
  -- |  This component uses the bootstrap-datepicker javascript plugin.
  -- |  Link: http://bootstrap-datepicker.readthedocs.io/en/latest/index.html
  -- |  Default settings are in laravel-html-extra
  -- |
  -- |  Usage: See Readme.md
  --}} 

@php if(isset($attributes['required'])){ $name = $name.' *'; } @endphp
<div class="form-group @if($errors->getBag('default')->has($id))has-error @endif" id="{{ $id }}">
    {{ Form::label($id, $name, ['class' => 'control-label']) }}
    <div class="input-group date">
        {{ Form::text($id, null, array_merge(['class' => 'form-control'], $attributes)) }}
        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
    </div>
    <p class="help-block" >{{ $helper_text }}</p>
</div>
  @push('after-scripts')
    <script>
    $(document).ready(function() {
       $('#{{ $id }} .input-group.date').datepicker({
           autoclose: true,
          format: "mm-dd-yyyy"
        });
    });
    </script>
@endpush