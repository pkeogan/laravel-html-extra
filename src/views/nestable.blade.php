    
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
  -- |  Nestable2 Component
  -- |  
  -- |  This component uses the Select2 javascript plugin.
  -- |  Link: https://github.com/RamonSmit/Nestable2/
  -- |  Default settings are in laravel-html-extra
  -- | <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css" integrity="sha256-Aldh2dIft1KOoBAzYerTrGI7RqXfeRqfFJRozIWzObw=" crossorigin="anonymous" />
  -- |  Usage: See Readme.md
  --}} 
@pushonce('afterstyles:nestable')
<style>
.dd {
  position: relative;
  display: block;
  margin: 0;
  padding: 0;
  max-width: 600px;
  list-style: none;
  font-size: 13px;
  line-height: 20px; }

.dd-list {
  display: block;
  position: relative;
  margin: 0;
  padding: 0;
  list-style: none; }
  .dd-list .dd-list {
    padding-left: 30px; }

.dd-item,
.dd-empty,
.dd-placeholder {
  display: block;
  position: relative;
  margin: 0;
  padding: 0;
  min-height: 30px;
   font-size: 20px;
    line-height: 32px; }

.dd-handle {
    display: block;
    height: 47px;
    margin: 3px 0;
    padding: 4px 10px;
    color: #333;
    /* font-weight: normal; */
    border: 1px solid #ccc;
    background: #fafafa;
    border-radius: 4px;
    box-sizing: border-box;}
  .dd-handle:hover {
    color: #2ea8e5;
    background: #fff; }

.dd-item > button {
  position: relative;
  cursor: pointer;
  float: left;
  width: 25px;
  height: 31px;
  margin: 5px 0;
  padding: 0;
  text-indent: 100%;
  white-space: nowrap;
  overflow: hidden;
  border: 0;
  background: transparent;
  font-size: 16px;
  line-height: 1;
  text-align: center;
  font-weight: bold; }
  .dd-item > button:before {
    display: block;
    position: absolute;
    width: 100%;
    text-align: center;
    text-indent: 0; }
  .dd-item > button.dd-expand:before {
    content: "\f067";
	font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;}
  .dd-item > button.dd-collapse:before {
    content: "\f068";
	font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;}

.dd-expand {
  display: none; }

.dd-collapsed .dd-list,
.dd-collapsed .dd-collapse {
  display: none; }

.dd-collapsed .dd-expand {
  display: block; }

.dd-empty,
.dd-placeholder {
  margin: 5px 0;
  padding: 0;
  min-height: 30px;
  background: #f2fbff;
  border: 1px dashed #b6bcbf;
  box-sizing: border-box;
  -moz-box-sizing: border-box; }

.dd-empty {
  border: 1px dashed #bbb;
  min-height: 100px;
  background-color: #e5e5e5;
  background-size: 60px 60px;
  background-position: 0 0, 30px 30px; }

.dd-dragel {
  position: absolute;
  pointer-events: none;
  z-index: 9999; }
  .dd-dragel > .dd-item .dd-handle {
    margin-top: 0; }
  .dd-dragel .dd-handle {
    box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, 0.1); }

.dd-nochildren .dd-placeholder {
  display: none; }
	</style>
@endpushonce

@pushonce('scripts:nestable')
<script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.js" integrity="sha256-tmhRiOihn1clDiIf5lSBCjb6yjKFF0ENJgEL+5HodOw=" crossorigin="anonymous"></script>
@endpushonce


<div class="dd" id="nestable-json"></div>

@row
@col(12)
  <div class="pull-right">
	   {{ Form::open(['url' => $data['posturl']]) }}
	    <input type="hidden" name="postdata" id='postdata'>

                  <button id="saveOrder2" class="btn btn-md btn-primary">Save Order</button>
                     {{ Form::close() }}
                </div><!--pull-right-->
@endcol
@endrow


  @push('scriptsdocumentready')    {{-- <script> --}}

	  var json = {!!$data['json']!!};
	var options = {'json': json,
				  'contentCallback': function(item) {return item.content || '' ? item.content : item.id;}, 
				  'callback': function(l,e){
								console.log( JSON.stringify($('.dd').nestable('toArray')) );
					  $('#postdata').val( JSON.stringify($('.dd').nestable('toArray')) );
    								}}
	$('#nestable-json').nestable(options);
	  
	  $( "#saveOrder" ).click(function() {
		
		  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
		  $.ajax({
  type: "POST",
  url: '{!! $data['posturl'] !!}',
  data: $('.dd').nestable('toArray')
});
		  
});
	  
    {{-- </script> 
--}}
@endpush
