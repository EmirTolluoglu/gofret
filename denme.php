<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>fadeOut demo</title>
  <style>
  .box,
  button {
    float: left;
    margin: 5px 10px 5px 0;
  }
  .box {
    height: 80px;
    width: 80px;
    background: #090;
  }
  </style>
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
</head>
<body>
 
<button id="btn1">fade out</button>
<button id="btn2">show</button>
 
<div id="log"></div>
 
<div id="box1" class="box">linear</div>
<div id="box2" class="box">swing</div>
 
<script>
$( "#btn1" ).click(function() {
  $(this).fadeOut( 1600, "linear", function(){
    $(this).remove();
  } );
});
</script>
 
</body>
</html>