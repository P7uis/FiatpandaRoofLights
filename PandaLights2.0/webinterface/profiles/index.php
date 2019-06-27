<?php
  //some startup variables
  //select options [functions, head, nav] true or false for the start file
  $start = [1,1,1];
  $page = "Profiles";
  $docroot = $_SERVER["DOCUMENT_ROOT"];
  //include start file which in turn includes functions, head and nav file
  include("$docroot/files/php/start.php");
 ?>
 <div class="content" id="content">

<script>
$("#content").load("get.php");

  function appendText(profile) {
    var lastrow = parseInt($('#max'+profile).val())
    var newrow = lastrow+1;
    if(rowchecker(profile)){
      $('#max'+profile).val(newrow);
      var checkboxrow = '<div id="checkboxrow'+newrow+'" class="input-group mb-1"><div class="input-group-prepend"><div class="input-group-text alt-input-style"><input type="checkbox" onchange="appendText('+profile+')" value="1" name="profile'+profile+newrow+'0" class="profilecheck">&ensp;<input type="checkbox" onchange="appendText('+profile+')" value="1" name="profile'+profile+newrow+'1" class="profilecheck">&ensp;<input type="checkbox" onchange="appendText('+profile+')" value="1" name="profile'+profile+newrow+'2" class="profilecheck">&ensp;<input type="checkbox" onchange="appendText('+profile+')" value="1" name="profile'+profile+newrow+'3" class="profilecheck">&ensp;<input type="checkbox" onchange="appendText('+profile+')" value="1" name="profile'+profile+newrow+'4" class="profilecheck">&ensp;</div></div><input type="number" min="0.1" max="60" step="0.1" name="delay'+newrow+'" value="1" class="form-control  input-style" placeholder="delay"></div>';
      $("#checkboxrows"+profile).append(checkboxrow);   // Append new elements
  }
}
function rowchecker(profile){
  var lastrow = parseInt($('#max'+profile).val())
  var secondlastrow = lastrow - 1;

  var lastcheck = false;
  for(var i = 0; i < 5; i++){
    if($('[name="profile'+profile+parseInt(lastrow)+i+'"]').is(':checked')){
      lastcheck = true;
      break;}
  }

  var secondlastcheck = false;
  for(var i = 0; i < 5; i++){
    if($('[name="profile'+profile+secondlastrow+i+'"]').is(':checked')){
      secondlastcheck = true;
      break;}
  }
  if(secondlastcheck){
    if(lastcheck){
      return true;
    }
    else {
      //do nothing
      return false;
    }
  }
  else {
    $('#max'+profile).val(parseInt(lastrow) - 1);
    $("#checkboxrow"+lastrow).remove();
    return false;
  }
}

</script>
