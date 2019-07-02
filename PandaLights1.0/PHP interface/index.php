<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<br> <button id="btn1" class="btn btn-default">verstuur bericht!</button>
<br> <button id="btn2" class="btn btn-default">verstuur bericht 2!</button>
<div id="div1"></div>
<script>

$("#btn1").click(function(){
  $("#div1").load("send.php", function(responseTxt, statusTxt, xhr){
    if(statusTxt == "success")
      //alert("Bericht verzonden!");
    if(statusTxt == "error")
      alert("Error: " + xhr.status + ": " + xhr.statusText);
  });
});

$("#btn2").click(function(){
  $("#div1").load("send.php", function(responseTxt, statusTxt, xhr){
    if(statusTxt == "success")
      //alert("Bericht verzonden!");
    if(statusTxt == "error")
      alert("Error: " + xhr.status + ": " + xhr.statusText);
  });
});

</script>
