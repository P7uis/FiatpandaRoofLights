<?php
  //some startup variables
  //select options [functions, head, nav] true or false for the start file
  $start = [1,1,1];
  $page = "Profiles";
  $docroot = $_SERVER["DOCUMENT_ROOT"];
  //include start file which in turn includes functions, head and nav file
  include("$docroot/files/php/start.php");
 ?>
 <div class="content">
   <?php
   ProfileLister();
    ?>
<script>

  function appendText() {
  var checkboxrow = '<div id="checkboxrow0" class="input-group mb-1"><div class="input-group-prepend"><div class="input-group-text alt-input-style"><input type="checkbox" value="1" name="profile00" class="profilecheck">&ensp;<input type="checkbox" value="1" name="profile01" class="profilecheck">&ensp;<input type="checkbox" value="1" name="profile02" class="profilecheck">&ensp;<input type="checkbox" value="1" name="profile03" class="profilecheck">&ensp;<input type="checkbox" value="1" name="profile04" class="profilecheck">&ensp;</div></div><input type="number" min="0.1" max="60" step="0.1" name="delay0" value="1" class="form-control  input-style" placeholder="delay"></div>';
  $("#checkboxrows").append(checkboxrow);   // Append new elements
}
</script>
