<?php
  //some startup variables
  //select options [functions, head, nav] true or false for the start file
  $start = [1,1,1];
  $page = "Settings";
  $docroot = $_SERVER["DOCUMENT_ROOT"];
  //include start file which in turn includes functions, head and nav file
  include("$docroot/files/php/start.php");
 ?>

 <div class="content" id="content">

 </div>
 <!-- Modal -->
 <div class="modal fade" id="WPAupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document">
 <form action="submit.php" method="post" enctype="multipart/form-data" id="upload_form">
 <div class="modal-content ModalStyle">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle">Upload WPA Config</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
   <progress id="progressBar" value="0" max="100" style="width:100%;"></progress><br><br>
    <div class="input-group mb-3">
 <div class="custom-file">
 <input required type="file" class="custom-file-input input-style" name="wpaconf" id="wpaconf">
 <label class="custom-file-label alt-input-style" for="wpaconf">Choose file</label>
 </div>
 </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <input type="button" class="btn btn-primary" value="Upload" onclick="uploadFile('wpaconf')">

  </div>
 </div>
 </form>
 </div>
 </div>
<script>
$("#content").load("get.php");
</script>
