    
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
  -- |  PDF Component
  -- |  
  -- |  This component uses the DropZone javascript plugin.
  -- |  Link: https://www.dropzonejs.com/#installation
  -- |  Default settings are in laravel-html-extra
  -- |
  -- |  Usage: See Readme.md
  --}} 


@pushonce('scripts:dropzone')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.0.201604172/pdfobject.min.js" integrity="sha256-dUe7c2jPkbycNGu4OSy/3FbLKU5FK1aM62Vc5Ni7sgs=" crossorigin="anonymous"></script>@endpushonce

<div class="embed-responsive embed-responsive-4by3">

<div id="{{ $id }}"></div>

</div>

 @push('scriptsdocumentready')
PDFObject.embed("{{ $data['url'] }}", "#{{ $id }}", {height: "100%"});
@endpush

