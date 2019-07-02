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




             <div class="col-sm-7 SettingsDiv">
                <h3>WPA Config</h3>
                  <br><div class="WPADiv">
                    <form action="submit.php" method="post">
                      <input type="text" class="form-control input-style" name="wpa-ssid-c" placeholder="wpa-ssid"><br>
                      <input type="password" class="form-control input-style" name="wpa-psk-c" placeholder="wpa-psk"><br>
                      <input type="submit" value="Create" class="btn btn-primary">
                      <a href="/files/wpa_supplicant-wlan1.conf" download="<?php echo "PandaWPAsupplicant".date('YmdHi');?>"><input type="button" class="btn btn-info" value="Download WPA Supplicant"></a>
                      </form>
                  <?php
                    $ssid = False;
                    $psk = False;
                    $wpaconflist = explode(PHP_EOL, WPAconfRead());
                    foreach ($wpaconflist as $wpaconf) {

                      if (strpos($wpaconf, 'ssid')){
                        echo '<br><div class="WPADiv">';
                        echo '<form action="submit.php" method="post">';
                        echo '<input type="text" value="'.StringBetween($wpaconf, '"', '"').'" class="form-control input-style" name="wpa-ssid" placeholder="wpa-ssid"><br>';
                        echo '<input type="hidden" value="'.StringBetween($wpaconf, '"', '"').'" name="wpa-ssid-old">';
                        $ssidold = StringBetween($wpaconf, '"', '"');
                      }
                      else if (strpos($wpaconf, 'psk')){
                        echo '<input type="hidden" value="'.StringBetween($wpaconf, '"', '"').'" name="wpa-psk-old">';
                        echo '<input type="password" value="'.StringBetween($wpaconf, '"', '"').'" class="form-control input-style" name="wpa-psk" placeholder="wpa-psk"><br>';
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
