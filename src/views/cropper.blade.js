

  
  @row
      @col(3) @endcol
  @col(6)
  <input type="file" name="image" id="image" onchange="readURL(this);"/>

<div class="image_container">
    <img id="blah" src="#" alt="your image" />
</div>
<button id="crop_button">Crop</button> // Will trigger crop event
  @endcol 
     @col(3) @endcol
  @endrow



@push('after-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.2.2/cropper.js" integrity="sha256-QlmsK/cdKXsKjF680WvleMN1CNQaXaj9Hgh+5bogb6A=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.2.2/cropper.min.css" integrity="sha256-nlV017uzwfK+erVNsfhJfG4ufyRK9gQOpTZCZIbiHBU=" crossorigin="anonymous" />

<script type="text/javascript" defer>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result)
            };
            reader.readAsDataURL(input.files[0]);
            setTimeout(initCropper, 1000);
        }
    }
    function initCropper(){
        console.log("Came here")
        var image = document.getElementById('blah');
        var cropper = new Cropper(image, {
          aspectRatio: 1 / 1,
          crop: function(e) {
            console.log(e.detail.x);
            console.log(e.detail.y);
          }
        });

        // On crop button clicked
        document.getElementById('crop_button').addEventListener('click', function(){
            var imgurl =  cropper.getCroppedCanvas().toDataURL();
            var img = document.createElement("img");
            img.src = imgurl;
            document.getElementById("cropped_result").appendChild(img);

            /* ---------------- SEND IMAGE TO THE SERVER-------------------------

                cropper.getCroppedCanvas().toBlob(function (blob) {
                      var formData = new FormData();
                      formData.append('croppedImage', blob);
                      // Use `jQuery.ajax` method
                      $.ajax('/path/to/upload', {
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function () {
                          console.log('Upload success');
                        },
                        error: function () {
                          console.log('Upload error');
                        }
                      });
                });
            ----------------------------------------------------*/
        })
    }
</script>
@endpush