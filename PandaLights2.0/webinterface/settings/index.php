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
                <div class="col-sm">
                  <div class="row">
                    <div class="col-sm SettingsDiv SettingsDivNest">
                       <h3>Theme (<?php echo ThemeCheck(); ?>)</h3>
                       <form action="submit.php" method="post"><br>
                         <input type="hidden" value="<?php echo ThemeCheck(); ?>" name="theme">
                         <input type="submit" value="Toggle Theme" class="btn btn-primary">
                       </form>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm SettingsDiv SettingsDivNest">
                       <h3>Set light theme hours</h3>
                       <form action="submit.php" method="post"><br>
                         <input type="checkbox" value="" name="themeauto" class="input-style"> Toggle automatic change<br><br>
                         <input type="time" value="" name="themestart" class="form-control input-style"><br>
                         <input type="time" value="" name="themeend" class="form-control input-style"><br>
                         <input type="submit" value="Change" class="btn btn-primary">
                       </form>
                    </div>
                  </div>
                </div>




             <div class="col-sm-7 SettingsDiv">
                <h3>WPA Config</h3>
                  <?php
                    $ssid = False;
                    $psk = False;
                    $wpaconflist = explode(PHP_EOL, WPAconfRead());
                    foreach ($wpaconflist as $wpaconf) {

                      if (strpos($wpaconf, 'ssid')){
                        echo '<br><div class="WPADiv">';
                        echo '<form action="submit.php" method="post">';
                        echo '<input type="text" value="'.StringBetween($wpaconf, '"', '"').'" class="form-control input-style" name="wpa-ssid"><br>';
                        echo '<input type="hidden" value="'.StringBetween($wpaconf, '"', '"').'" name="wpa-ssid-old">';
                        $ssidold = StringBetween($wpaconf, '"', '"');
                      }
                      else if (strpos($wpaconf, 'psk')){
                        echo '<input type="hidden" value="'.StringBetween($wpaconf, '"', '"').'" name="wpa-psk-old">';
                        echo '<input type="password" value="'.StringBetween($wpaconf, '"', '"').'" class="form-control input-style" name="wpa-psk"><br>';
                        echo '<input type="submit" value="Change" class="btn btn-primary"> ';
                        $pskold = StringBetween($wpaconf, '"', '"');
                        echo '</form>';
                        echo '<form action="submit.php" method="post">';
                        echo '<input type="submit" value="Delete" class="btn btn-danger">';
                        echo '<input type="hidden" value="'.$ssidold.'" name="wpa-ssid-del">';
                        echo '<input type="hidden" value="'.$pskold.'" name="wpa-psk-del">';
                        echo '</form>';
                        echo '</div>';
                      }
                    }
                ?>
                </form>
             </div>
           </div>

         </div>
 </div>
