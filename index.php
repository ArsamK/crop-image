<html>  
  <?php include("header.php"); ?>
<body>  
<div class="container" style="margin-top:20px;padding:20px;">  
    <div class="card">
      <div class="card-header">
        Crop And Upload Image using PHP and JQuery Ajax - Croppie Image Cropper
      </div>
      <div class="card-body">
        <h5 class="card-title">Select Image</h5>
        <input type="file" name="upload_image" id="upload_image" />       
      </div>
    </div>
 
    <div class="card text-center" id="uploadimage" style='display:none'>
      <div class="card-header">
        Upload & Crop Image
      </div>
      <div class="card-body text-center">
            <div id="image_demo" style="width:350px; margin-top:30px"></div>
            <div id="uploaded_image" style="width:350px; margin-top:30px;"></div>  
      </div>
      <div class="card-footer text-muted">
        <button class="crop_image">Crop & Upload Image</button>
      </div>
    </div>
</div>
</body>  
</html>
  
<script>  
$(document).ready(function(){
 $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'circle' //circle
    },
    boundary:{
      width:300,
      height:300
    }
  });
  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }) 
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimage').show();
  });
  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"upload.php",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
           $('#uploaded_image').html(data)
        }
      });
    })
  });
});  
</script>