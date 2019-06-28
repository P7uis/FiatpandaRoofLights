<?php
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

function LightsList(){
  $user = get_current_user();
  $profiles = fopen("/home/$user/panda/current.enabled.conf", "r");
  if (filesize("/home/$user/panda/current.enabled.conf") == 0){
    fclose($profiles);
    return;
  }
  else{
    $toggle = explode(' ', fread($profiles, filesize("/home/$user/panda/current.enabled.conf")));
    if($toggle[0] == "True")return "<button class='btn btn-danger'>Toggle Lights Off</button>";
    else return "<button class='btn btn-success'>Toggle Lights On</button>";
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
           <input type="number" id="alldelay'.$h.'" onchange="DelayChanger('.$h.')"onchange="DelayChanger('.$h.')" required class="form-control input-style" min="0.1" max="60" step="0.1" value="1" placeholder="delay">
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
           <input type="number"  id="'.$h.'" required min="0.1" max="60" step="0.1" name="delay'.$h.'" value="1" class="form-control  input-style" placeholder="delay">
        </div>
        </div>
        <br>
        <input type="hidden" value="0" id="max0">
        <input type="submit" value="Create" class="btn btn-primary btnprofilesettings">
        <button type="button" onclick="appendText('.$h.')" class="btn btn-warning btnprofilesettings">Add Line</button>
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
              <input type="number" id="alldelay'.$h.'" onchange="DelayChanger('.$h.')"required class="form-control input-style" min=0.1 max=60 step=0.1 value="1" placeholder="delay">
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
                echo '<input type="number" id="'.$h.'" required min=0.1 max=60 step=0.1 name="delay'.$i.'" value="'.StringBetween($cycle, '[', ']').'" class="form-control  input-style" placeholder="delay">';
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
          </form><form action="submit.php" method="post" style="display: inline;">
          <input type="hidden" value="'.$id[1].'" name="enable">
          <input type="submit" value="Enable" class="btn btn-success btnprofilesettings"></div></form>
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
    $profilemain = explode(PHP_EOL, fread($profiles, filesize("/home/$user/panda/profiles.conf")));
    foreach ($profilemain as $profile) {
      if (substr($profile, 0, 2) == "ID"){
        echo '<div class="swiper-slide">
        <form onsubmit="FormNotify()" target="transFrame" action="submit.php" method="post">
        <iframe style="display: none;" name="transFrame" id="transFrame"></iframe>';
        $id = explode('-', $profile);
        $id = $id[1];
        echo '<input type="hidden" value="'.$id.'" name="enable">';
      }
      else if (substr($profile, 0, 4) == "NAME"){
      $name = explode('-', $profile);
      $name = $name[1];
        echo '
          <h3>'.$name.'</h3><br><br>

          <input type="submit" value="Enable" class="btn btn-success btnprofilesettings">
          </form>
        </div>
        ';
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
