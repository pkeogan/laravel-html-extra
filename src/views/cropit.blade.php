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
  -- |  Cropper.js
  -- |  
  -- |  This component uses the cropper.js javascript plugin.
  -- |  Link: https://fengyuanchen.github.io/cropperjs/
  -- |  Default settings are in laravel-html-extra
  -- |
  -- |  Usage: See Readme.md
  --}}
@pushonce('style:cropper')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.2.2/cropper.min.css" integrity="sha256-nlV017uzwfK+erVNsfhJfG4ufyRK9gQOpTZCZIbiHBU=" crossorigin="anonymous" />
@endpushonce
@pushonce('scripts:cropper')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.2.2/cropper.js" integrity="sha256-QlmsK/cdKXsKjF680WvleMN1CNQaXaj9Hgh+5bogb6A=" crossorigin="anonymous"></script>
@endpushonce


@row
      @col(3) @endcol
  @col(6)
  <input type="hidden" id="image_data" name="image_data" value="">
<div id="image_container" class="image_container hide-div" style="max-height: 300px;">
    <img id="blah" src="@if(isset($img)){{$img}}@endif" alt="Image Preview" />
</div>

<label class="btn btn-info btn-file btn-block">
  Browse ... <input type="file" name="image" id="image" onchange="readURL(this);"/>
</label>

  @endcol 
     @col(3) @endcol
  @endrow



@push('after-scripts')
<script type="text/javascript" defer>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result)
                $('#image_container').removeClass('hide-div')

            };
            reader.readAsDataURL(input.files[0]);
            setTimeout(initCropper, 1000);
        }
    }
    function initCropper(){
        console.log("Came here")
        var image = document.getElementById('blah');
        var cropper = new Cropper(image, {
          mouseWheelZoom: false,
          aspectRatio: 1 / 1,
          crop: function(e) {
           var imgurl =  cropper('getCroppedCanvas', {width: 250}).toDataURL();
          $('#image_data').val(imgurl);
          }
        });
      
      image.addEventListener('crop', function (e) {
          var imgurl =  cropper.getCroppedCanvas().toDataURL();
          $('#image_container').removeClass('hide-div');
          $('#image_data').val(imgurl);
        });
      

    }
</script>
@endpush






  
 