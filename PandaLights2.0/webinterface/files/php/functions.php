<?php
function SSIDcheck(){
  $ssid = shell_exec('iwgetid -r');
  $percent = shell_exec('/home/pi/getwifiquality.py');
  $strenght = str_replace('%', '', $percent);

  if($strenght > 0 && $strenght <= 33)echo '<img src="/files/img/wifi1.png" width="20" height="20"> '.$ssid;
  else if($strenght > 33 && $strenght <= 66)echo '<img src="/files/img/wifi2.png" width="20" height="20"> '.$ssid;
  else if($strenght > 66)echo '<img src="/files/img/wifi3.png" width="20" height="20"> '.$ssid;
  else echo '<img src="/files/img/wifi0.png" width="20" height="20"> Not connected';

}
function ThemeCheck(){
  $user = get_current_user();
  $themeconfR = fopen("/home/$user/panda/theme.conf", "r");
  if (filesize("/home/$user/panda/theme.conf") == 0){
    ThemeWrite("error");
    fclose($themeconfR);
    return "light";
  }
  else{
  $theme = fread($themeconfR, filesize("/home/$user/panda/theme.conf"));
  if($theme != "dark" && $theme != "light"){
    ThemeWrite("error");
    fclose($themeconfR);
    return "light";
  }
  else return $theme;
  fclose($themeconfR);
}
}

function ThemeWrite($optionW){
    $user = get_current_user();
    $themeconfW = fopen("/home/$user/panda/theme.conf", "w");

    if($optionW != "dark" && $optionW != "light")$optionW = "light";

    else if($optionW == "light")$optionW = "dark";

    else $optionW = "light";

    fwrite($themeconfW, $optionW);
    fclose($themeconfW);
}

function LightsToggle(){
  $user = get_current_user();
  $profiles = fopen("/home/$user/panda/current.enabled.conf", "r");
  if (filesize("/home/$user/panda/current.enabled.conf") == 0){
    fclose($profiles);
    return;
  }
  else{
    $toggle = explode(' ', fread($profiles, filesize("/home/$user/panda/current.enabled.conf")));
    if($toggle[0] == "True")$toggle = "False";
    else $toggle = "True";
  }
  fclose($profiles);
  $profilesW = fopen("/home/$user/panda/current.enabled.conf", "w");
  fwrite($profilesW, $toggle);
  fclose($profilesW);
}

function GetCurrentProfileID(){
  $user = get_current_user();
  $profiles = fopen("/home/$user/panda/current.profile.conf", "r");
  if (filesize("/home/$user/panda/current.profile.conf") == 0){
    fclose($profiles);
    return;
  }
  else{
    $profilemain = explode(PHP_EOL, fread($profiles, filesize("/home/$user/panda/current.profile.conf")));
    foreach ($profilemain as $profile) {
      if (substr($profile, 0, 2) == "ID"){
        $id = explode('-', $profile);
        return $id[1];
      }
    }
}
}
function GetCurrentProfileEnabled(){
  $user = get_current_user();
  $profiles = fopen("/home/$user/panda/current.enabled.conf", "r");
  if (filesize("/home/$user/panda/current.enabled.conf") == 0){
    fclose($profiles);
    return;
  }
  else{
    $toggle = explode(' ', fread($profiles, filesize("/home/$user/panda/current.enabled.conf")));
    if($toggle[0] == "True")return True;
    else return False;
  }
}

function LightsList(){
  $user = get_current_user();
  $profiles = fopen("/home/$user/panda/current.enabled.conf", "r");
  if (filesize("/home/$user/panda/current.enabled.conf") == 0){
    fclose($profiles);
    return;
  }
  else{
    $toggle = explode(' ', fread($profiles, filesize("/home/$user/panda/current.enabled.conf")));
    if($toggle[0] == "True")return "<button type='submit' class='btn btn-danger'>Toggle Lights Off</button>";
    else return "<button type='submit' class='btn btn-success'>Toggle Lights On</button>";
    fclose($profiles);
  }
}

function ProfileLister(){
  $h = 0;
  echo '
  <div class="container"><div class="row">
  <div class="col-sm-4 SettingsDiv">
     <form action="submit.php" method="post" style="display:inline;">
        <input type="hidden" name="create">
        <h3>New Profile</h3>
        <div class="input-group mb-1">
           <input type="text" required class="form-control input-style" placeholder="profile name" name="name">
           <div class="input-group-append "><span class="input-group-text alt-input-style">profile name</span></div>
        </div>
        <div class="input-group mb-1">
           <input type="number" id="alldelay'.$h.'" onchange="DelayChanger('.$h.')"onchange="DelayChanger('.$h.')" required class="form-control input-style" min="0.05" max="60" step="0.05" value="0.25" placeholder="delay">
           <div class="input-group-append "><span class="input-group-text alt-input-style">change all delays</span></div>
        </div>
        <br>
        <div id="checkboxrows0">
        <div id="checkboxrow0" class="input-group mb-1">
           <div class="input-group-prepend">
              <div class="input-group-text alt-input-style">
                <input type="checkbox" onchange="appendText('.$h.')" value="1" name="profile000" class="profilecheck">&ensp;
                <input type="checkbox" onchange="appendText('.$h.')" value="1" name="profile001" class="profilecheck">&ensp;
                <input type="checkbox" onchange="appendText('.$h.')" value="1" name="profile002" class="profilecheck">&ensp;
                <input type="checkbox" onchange="appendText('.$h.')" value="1" name="profile003" class="profilecheck">&ensp;
                <input type="checkbox" onchange="appendText('.$h.')" value="1" name="profile004" class="profilecheck">&ensp;
              </div>
           </div>
           <input type="number" required min="0.05" max="60" step="0.05" name="delay'.$h.'" value="0.25" class="form-control delay'.$h.' input-style" placeholder="delay">
        </div>
        </div>
        <br>
        <input type="hidden" value="0" id="max0">
        <input type="submit" value="Create" class="btn btn-primary btnprofilesettings">
        <button type="button" onclick="appendText('.$h.')" class="btn btn-warning btnprofilesettings">Add Line</button>
        <a href="/files/profiles.conf" download="PandaLightProfiles'.date('YmdHi').'.conf"><input type="button" class="btn btn-info btnprofilesettings" value="Download Profiles"></a>
        <input type="button" class="btn btn-info btnprofilesettings" value="Upload Profiles" data-toggle="modal" data-target="#ProfileUpload">
     </form></div>

  ';
  $user = get_current_user();
  $profiles = fopen("/home/$user/panda/profiles.conf", "r");
  if (filesize("/home/$user/panda/profiles.conf") == 0){
    fclose($profiles);
    return;
  }
  else{
    $profilemain = explode(PHP_EOL, fread($profiles, filesize("/home/$user/panda/profiles.conf")));
    foreach ($profilemain as $profile) {
      if (substr($profile, 0, 2) == "ID"){
        $h++;
        echo '<div class="col-sm-4 SettingsDiv">';
        echo "<form action='submit.php' method='post' style='display:inline;'>";
        $id = explode('-', $profile);
        echo '<input type="hidden" value="'.$id[1].'" name="edit">';
        echo '<input type="hidden" value="'.$h.'" name="profiles">';
      }
      else if (substr($profile, 0, 4) == "NAME"){
        $name = explode('-', $profile);

        echo "<h3>Profile: ".$name[1]."</h3>";
        echo '<div class="input-group mb-1">
              <input type="text" required class="form-control input-style" placeholder="profile name" value="'.$name[1].'" name="name">
              <div class="input-group-append "><span class="input-group-text alt-input-style">profile name</span></div></div>';
        echo '<div class="input-group mb-1">
              <input type="number" id="alldelay'.$h.'" onchange="DelayChanger('.$h.')"required class="form-control input-style" min=0.05 max=60 step=0.05 value="0.25" placeholder="delay">
              <div class="input-group-append "><span class="input-group-text alt-input-style">change all delays</span></div></div><br>';
      }

      else if (substr($profile, 0, 6) == "CYCLES"){
          echo '<div id="checkboxrows'.$h.'">';
          $cycles = explode('-', $profile);
          $i = 0;
          foreach ($cycles as $cycle) {
            if ($cycle == "CYCLES"){}
            else if(!StringBetween($cycle, '[', ']')){
              $checkboxes = explode(',', $cycle);
              $j = 0;
              echo '<div id="checkboxrow'.$i.'" class="input-group mb-1">';
              echo '<div class="input-group-prepend">';
              echo '<div class="input-group-text alt-input-style" >';
              foreach ($checkboxes as $checkbox) {
                if($checkbox == '1')echo '<input type="checkbox" onchange="appendText('.$h.')" checked value="1" name="profile'.$h.$i.$j.'" class="profilecheck">&ensp;';
                else if($checkbox == '0')echo '<input type="checkbox" onchange="appendText('.$h.')" value="1" name="profile'.$h.$i.$j.'" class="profilecheck">&ensp;';
                $j++;
              }
              echo '&ensp;</div></div>';
            }
            else{
                echo '<input type="number" required min=0.05 max=60 step=0.05 name="delay'.$i.'" value="'.StringBetween($cycle, '[', ']').'" class="form-control delay'.$h.' input-style" placeholder="delay">';
                $i++;
                echo "</div>";
            }
          }

          echo '
          </div><br>
          <input type="hidden" value="'.($i-1).'" id="max'.$h.'">
          <input type="submit" value="Change" class="btn btn-primary btnprofilesettings">
          <button type="button" onclick="appendText('.$h.')" class="btn btn-warning btnprofilesettings">Add Line</button>
          </form><form action="submit.php" method="post" style="display: inline;">
          <input type="hidden" value="'.$id[1].'" name="delete">
          <input type="submit" value="Delete" class="btn btn-danger btnprofilesettings">
          </form><form action="submit.php" method="post" style="display: inline;" class="swipeform" target="transFrame">
          <iframe style="display: none;" name="transFrame" id="transFrame"></iframe>
          <input type="hidden" value="'.$id[1].'" name="enable">
          <input type="submit" value="Enable" class="btn btn-success btnprofilesettings"></div></form>
          <script>
          $(\'.swipeform\').submit(function(e) {
          e.preventDefault();
          this.submit();
            setTimeout( function () {
               refreshLight()
           }, 300);
           setTimeout( function () {
              refreshLight()
          }, 300);
          setTimeout( function () {
             refreshLight()
          }, 300);
          });
          </script>
          ';
        }
    }
    echo '<input type="hidden" id="profilemax" value="'.$h.'">';
  }

  echo "</div></div>";
  fclose($profiles);
}

function ProfileSwiper(){
  $user = get_current_user();
  $profiles = fopen("/home/$user/panda/profiles.conf", "r");
  if (filesize("/home/$user/panda/profiles.conf") == 0){
    fclose($profiles);
    return;
  }
  else{
    echo '

    <div class="carousel-cell" id="ignore">
    <form target="transFrame" action="manoverride.php" id="manoverride" method="post" class="swipeform">
    <iframe style="display: none;" name="transFrame" id="transFrame"></iframe>
      <h3>Manual Override</h3>
      <input type="hidden" name="manoverride">
      <input type="checkbox" class="profilecheck" value="1" name="Light1" id="Light1">
      <input type="checkbox" class="profilecheck" value="1" name="Light2" id="Light2">
      <input type="checkbox" class="profilecheck" value="1" name="Light3" id="Light3">
      <input type="checkbox" class="profilecheck" value="1" name="Light4" id="Light4">
      <input type="checkbox" class="profilecheck" value="1" name="Light5" id="Light5">
      <br>
      <input type="submit" value="Override" class="btn btn-success widebtn"><br>
      <input type="button" onclick="ManToggle(1,0,0,0,1)" value="Enable 2 and override" class="btn btn-primary widebtn"><br>
      <input type="button" onclick="ManToggle(1,1,0,1,1)" value="Enable 4 and override" class="btn btn-primary widebtn"><br>
      <input type="button" onclick="ManToggle(1,1,1,1,1)" value="Enable all and override" class="btn btn-warning widebtn"><br>
      <input type="button" onclick="ManToggle(0,0,0,0,0)" value="Disable all and override" class="btn btn-danger widebtn">
      </form>
    </div>
    ';
    $profilemain = explode(PHP_EOL, fread($profiles, filesize("/home/$user/panda/profiles.conf")));
    foreach ($profilemain as $profile) {
      if (substr($profile, 0, 2) == "ID"){
        $id = explode('-', $profile);
        $id = $id[1];
        if(GetCurrentProfileEnabled() && GetCurrentProfileID() == $id){
          echo '<div class="carousel-cell" id="'.$id.'">
          <form target="transFrame" action="submit.php" method="post" class="swipeform" onsubmit="refreshall()">
          <iframe style="display: none;" name="transFrame" id="transFrame"></iframe>';
          echo '<input type="hidden" value="'.$id.'" name="disable">';
        }
        else{
          echo '<div class="carousel-cell" id="'.$id.'">
          <form target="transFrame" action="submit.php" method="post" class="swipeform" onsubmit="refreshall()">
          <iframe style="display: none;" name="transFrame" id="transFrame"></iframe>';
          echo '<input type="hidden" value="'.$id.'" name="enable">';
          }
      }
      else if (substr($profile, 0, 4) == "NAME"){
      $name = explode('-', $profile);
      $name = $name[1];
      if(GetCurrentProfileEnabled() && GetCurrentProfileID() == $id){
        echo '
          <h3>'.$name.'</h3><br><br>

          <input type="submit" value="Disable" class="btn btn-danger btnswiper">
          </form>
        </div>
        ';
      }
      else{
        echo '
          <h3>'.$name.'</h3><br><br>

          <input type="submit" value="Enable" class="btn btn-success btnswiper">
          </form>
        </div>
        ';
        }

      }
      }

    }
  fclose($profiles);
}

function ProfileCell($id_input){
  $user = get_current_user();
  $profiles = fopen("/home/$user/panda/profiles.conf", "r");
  if (filesize("/home/$user/panda/profiles.conf") == 0){
    fclose($profiles);
    return;
  }
  else{
    $profilemain = explode(PHP_EOL, fread($profiles, filesize("/home/$user/panda/profiles.conf")));
    foreach ($profilemain as $profile) {
      if (substr($profile, 0, 2) == "ID"){
        $id = explode('-', $profile);
        $id = $id[1];
        if($id_input == $id){
          if(GetCurrentProfileEnabled() && GetCurrentProfileID() == $id){
            echo '
            <form target="transFrame" action="submit.php" method="post" class="swipeform" onsubmit="refreshall()">
            <iframe style="display: none;" name="transFrame" id="transFrame"></iframe>';
            echo '<input type="hidden" value="'.$id.'" name="disable">';
          }
          else{
            echo '
            <form target="transFrame" action="submit.php" method="post" class="swipeform" onsubmit="refreshall()">
            <iframe style="display: none;" name="transFrame" id="transFrame"></iframe>';
            echo '<input type="hidden" value="'.$id.'" name="enable">';
            }
        }

      }
      else if (substr($profile, 0, 4) == "NAME"){
        if($id_input == $id){
          $name = explode('-', $profile);
          $name = $name[1];
          if(GetCurrentProfileEnabled() && GetCurrentProfileID() == $id){
            echo '
              <h3>'.$name.'</h3><br><br>

              <input type="submit" value="Disable" class="btn btn-danger btnswiper">
              </form>

            ';
          }
          else{
            echo '
              <h3>'.$name.'</h3><br><br>

              <input type="submit" value="Enable" class="btn btn-success btnswiper">
              </form>

            ';
            }
            return;
        }


      }

      }

    }
  fclose($profiles);
}

function ProfileEditor($id, $name, $cycles){
  $user = get_current_user();
  $profilesR = fopen("/home/$user/panda/profiles.conf", "r");
  if (filesize("/home/$user/panda/profiles.conf") == 0){
    fclose($profilesR);
    return;
  }
  else{
    $profilemain = explode(PHP_EOL, fread($profilesR, filesize("/home/$user/panda/profiles.conf")));
    $profilesnew = "";
    $i = 0;
    $ii = count($profilemain)-1;
    for($i; $i <= $ii; $i++){
      if($i < $ii)$eol = PHP_EOL;
      else $eol = NULL;

      if($i > 0 && $profilemain[$i-1] == $id){$profilesnew = $profilesnew.$name.$eol;}
      else if($i > 1 && $profilemain[$i-2] == $id){$profilesnew = $profilesnew.$cycles.$eol;}
      else{$profilesnew = $profilesnew.$profilemain[$i].$eol;}
  }
  fclose($profilesR);
  $profilesW = fopen("/home/$user/panda/profiles.conf", "w");
  fwrite($profilesW, $profilesnew);
  fclose($profilesW);
}}

function ProfileDeleter($id){
  $user = get_current_user();
  $profilesR = fopen("/home/$user/panda/profiles.conf", "r");
  if (filesize("/home/$user/panda/profiles.conf") == 0){
    fclose($profilesR);
    return;
  }
  else{
    $profilemain = explode(PHP_EOL, fread($profilesR, filesize("/home/$user/panda/profiles.conf")));
    $profilesnew = "";
    $i = 0;
    $ii = count($profilemain)-1;
    for($i; $i <= $ii; $i++){
      if($i < $ii)$eol = PHP_EOL;
      else $eol = NULL;
      if($profilemain[$i] == $id){}
      else if($i > 0 && $profilemain[$i-1] == $id){}
      else if($i > 1 && $profilemain[$i-2] == $id){}
      else{$profilesnew = $profilesnew.$profilemain[$i].$eol;}
  }
  fclose($profilesR);
  $profilesW = fopen("/home/$user/panda/profiles.conf", "w");
  fwrite($profilesW, $profilesnew);
  fclose($profilesW);
}}

function ProfileEnabler($id){
  $user = get_current_user();
  $profilesR = fopen("/home/$user/panda/profiles.conf", "r");
  if (filesize("/home/$user/panda/profiles.conf") == 0){
    fclose($profilesR);
    return;
  }
  else{
    $profilemain = explode(PHP_EOL, fread($profilesR, filesize("/home/$user/panda/profiles.conf")));
    $profilesnew = "";
    $i = 0;
    $ii = count($profilemain);
    for($i; $i < $ii; $i++){
      if($profilemain[$i] == $id){$profilesnew = $profilesnew.$profilemain[$i].PHP_EOL;}
      else if($i > 0 && $profilemain[$i-1] == $id){$profilesnew = $profilesnew.$profilemain[$i].PHP_EOL;}
      else if($i > 1 && $profilemain[$i-2] == $id){$profilesnew = $profilesnew.$profilemain[$i];}
  }
  fclose($profilesR);
  $profilesW = fopen("/home/$user/panda/current.profile.conf", "w");
  fwrite($profilesW, $profilesnew);
  fclose($profilesW);
  $toggle = "True";
  $profilesW = fopen("/home/$user/panda/current.enabled.conf", "w");
  fwrite($profilesW, $toggle);
  fclose($profilesW);
}}

function ProfileDisabler($id){
  $user = get_current_user();
  $toggle = "False";
  $profilesW = fopen("/home/$user/panda/current.enabled.conf", "w");
  fwrite($profilesW, $toggle);
  fclose($profilesW);
}

function ProfileCreater($id, $name, $cycles){

  $user = get_current_user();
  $profilesR = fopen("/home/$user/panda/profiles.conf", "r");
  if (filesize("/home/$user/panda/profiles.conf") == 0){
    fclose($profilesR);
    return;
  }
  else{
    $profilemain = explode(PHP_EOL, fread($profilesR, filesize("/home/$user/panda/profiles.conf")));
    $profilesnew = "";
    $i = 0;
    $ii = count($profilemain)-1;
    for($i; $i <= $ii; $i++)$profilesnew = $profilesnew.$profilemain[$i].PHP_EOL;
    $profilesnew = $profilesnew.$id.PHP_EOL;
    $profilesnew = $profilesnew.$name.PHP_EOL;
    $profilesnew = $profilesnew.$cycles;
  fclose($profilesR);
  $profilesW = fopen("/home/$user/panda/profiles.conf", "w");
  fwrite($profilesW, $profilesnew);
  fclose($profilesW);
  }}

function WPAconfRead(){
  $WPAconfR = fopen("/etc/wpa_supplicant/wpa_supplicant-wlan1.conf", "r");
  if (filesize("/etc/wpa_supplicant/wpa_supplicant-wlan1.conf") == 0){return;}
  else{
  $WPA = fread($WPAconfR, filesize("/etc/wpa_supplicant/wpa_supplicant-wlan1.conf"));
  return $WPA;
  fclose($WPAconfR);
}
}

function WPAconfWrite($ssid, $ssidold, $psk, $pskold){
  $wpaconfnew = "";
  $wpaconflist = explode(PHP_EOL, WPAconfRead());
  foreach ($wpaconflist as $wpaconf){
    if (strpos($wpaconf, $ssidold)){
      $wpaconfnew = $wpaconfnew.str_replace($ssidold, $ssid, $wpaconf).PHP_EOL;
    }
    else if (strpos($wpaconf, $pskold)){
      $wpaconfnew = $wpaconfnew.str_replace($pskold, $psk, $wpaconf).PHP_EOL;
    }
    else {
      $wpaconfnew = $wpaconfnew.$wpaconf.PHP_EOL;
    }
  }
  $WPAconfW = fopen("/etc/wpa_supplicant/wpa_supplicant-wlan1.conf", "w");
  fwrite($WPAconfW, $wpaconfnew);
  fclose($WPAconfW);

}

function WPAconfAdd($ssid, $psk){
  $wpaconfnew = "";
  $wpaconflist = explode(PHP_EOL, WPAconfRead());
  foreach ($wpaconflist as $wpaconf){
      $wpaconfnew = $wpaconfnew.$wpaconf.PHP_EOL;
  }
  $wpaconfnew = $wpaconfnew."network={".PHP_EOL;
  $wpaconfnew = $wpaconfnew."\tssid=\"$ssid\"".PHP_EOL;
  $wpaconfnew = $wpaconfnew."\tpsk=\"$psk\"".PHP_EOL;
  $wpaconfnew = $wpaconfnew."}".PHP_EOL;
  $WPAconfW = fopen("/etc/wpa_supplicant/wpa_supplicant-wlan1.conf", "w");
  fwrite($WPAconfW, $wpaconfnew);
  fclose($WPAconfW);

}

function WPAconfDelete($ssid, $psk){
  $wpaconfnew = "";
  $wpaconflist = explode(PHP_EOL, WPAconfRead());
  $i = 0;
  $del = False;
  $ii = count($wpaconflist)-2;
  for($i; $i <= $ii; $i++){
    if(strpos($wpaconflist[$i], $ssid) && strpos($wpaconflist[$i+1], $psk)){
      $i1 = $i-1;
      $i2 = $i;
      $i3 = $i+1;
      $i4 = $i+2;
      $del = True;
    }
    if($del){
      $i = 0;
      $wpaconfnew = "";
      foreach ($wpaconflist as $wpaconf){
        if($i == $i1 || $i == $i2 || $i == $i3 || $i == $i4){}
        else $wpaconfnew = $wpaconfnew.$wpaconf.PHP_EOL;
        $i++;
      }
      $WPAconfD = fopen("/etc/wpa_supplicant/wpa_supplicant-wlan1.conf", "w");
      fwrite($WPAconfD, $wpaconfnew);
      fclose($WPAconfD);
    }
    }

}

function StringBetween($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return false;
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
 ?>
