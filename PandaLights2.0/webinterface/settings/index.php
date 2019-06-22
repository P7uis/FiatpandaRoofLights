<?php
  //some startup variables
  //select options [functions, head, nav] true or false for the start file
  $start = [1,1,1];
  $page = "Settings";
  $docroot = $_SERVER["DOCUMENT_ROOT"];
  //include start file which in turn includes functions, head and nav file
  include("$docroot/files/php/start.php");
 ?>
 <div class="content">
   <div class="container">
            <div class="row">

               <div class="col-sm SettingsDiv">
                  <h3>Theme (<?php echo ThemeCheck(); ?>)</h3>
                  <form action="submit.php" method="post"><br>
                    <input type="hidden" value="<?php echo ThemeCheck(); ?>" name="theme">
                    <input type="submit" value="Toggle Theme" class="btn btn-primary">
                  </form>
               </div>

          </div>

         </div>
 </div>
