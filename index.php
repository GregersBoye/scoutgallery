<!DOCTYPE html>
<?php
$imageList = array();
if(isset($_GET["gallery"])){
$folder = $_GET["gallery"];
    if ($handle = opendir($_SERVER["DOCUMENT_ROOT"] ."/images/".$folder))  {
    while (false != ($file = readdir($handle)))  {
     if ($file!="." && $file !="..") {
        $ext = end(explode( ".", $file ));
        if (strtolower($ext)=="jpg" ) {
          $imageList[] = $file;
        }
      }
    }
  }
}

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spejdergalleri</title>

    <link href="css/index.css" rel="stylesheet">


  </head>
  <body>
  <div id="content">

    <div id="viewPort">
      <div id="slideContainer">
          <?php
          foreach($imageList AS $image){
            echo "<img src='crep.php/?l=".$folder."&f=".$image."'/>\n";

          }
?>
      </div>
      <div class="arrowContainer" id="leftContainer"><div class="arrow"></div></div>
      <div class="arrowContainer" id="rightContainer"><div class="arrow"></div></div>
      <br style="clear: both;height: 0;" />



    </div>
    <div id="gallery-box">
      <div id="gallery-slide">


      </div>
    </div>




</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script type='text/javascript'>
      $('document').ready(function(){
        images = $('#slideContainer img').length;
        $('#leftContainer').on('click', function(){
          if(parseInt($('#slideContainer').css('margin-left'))<0){
              $('#slideContainer').animate({'margin-left': "+=100%"});
          }
        })
        $('#rightContainer').on('click', function(){
          if(parseInt($('#slideContainer').css('margin-left'))>(-1*(images-1)*448)){
              $('#slideContainer').animate({'margin-left': "-=100%"});
          }
        })
      })
    </script>
  </body>
</html>