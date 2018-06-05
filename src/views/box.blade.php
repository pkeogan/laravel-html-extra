    
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
  -- |  Box Component
  -- |  
  -- |  This component uses the Select2 javascript plugin.
  -- |  Link: https://select2.org/
  -- |  Default settings are in laravel-html-extra
  -- |
  -- |  Usage: See Readme.md
  --}} 

<div id="{{$id}}" class="@if(isset($data['hidden']) && $data['hidden'])hidden @endif">
@component('adminlte::box')
  @slot('style', $data['box_style'])
  @slot('title', $data['box_title'])
  @if(isset($data['box_label']) && $data['box_label']) @slot('label'){{ $data['box_label'] }} @endslot @endif
  @if(isset($data['box_minimize']) && $data['box_minimize']) @slot('tools') @collapseButton @endslot @endif
  @slot('body')
	<div class="row">
		@if(isset($questions))
			@php
			$questionsColumns = $questions->split($data['box_columns']);
			@endphp
			@foreach($questionsColumns as $questions)
				<div class="col-md-{{ round(12 / $data['box_columns']) }}">
					@foreach($questions as $question)
						{!! $question->render() !!}
					@endforeach
				</div>
			@endforeach
		@endif
	</div>
  @endslot
  @if($data['box_footer']) @slot('footer'){{ $data['box_footer'] }} @endslot @endif
@endcomponent
