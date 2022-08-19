<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div id="#page"></div>
  <!-- src jquery -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script>
    $.ajax({
      type: "POST",
      url: "example.php",
      data: {
        columns: "*",
        table: "tbUsers",
        conditions: ""
      },
      success: function(results) {
        //parse json
        var data = JSON.parse(results);
        console.log(data[0].message_content);
      }
    });
  </script>



</body>

</html>