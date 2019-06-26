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

function ProfileLister(){
  $user = get_current_user();
  $profiles = fopen("/home/$user/panda/profiles.conf", "r");
  if (filesize("/home/$user/panda/profiles.conf") == 0){
    fclose($profiles);
    return;
  }
  else{
    echo '<div class="container"><div class="row">';
    $profilemain = explode(PHP_EOL, fread($profiles, filesize("/home/$user/panda/profiles.conf")));
    foreach ($profilemain as $profile) {
      if (substr($profile, 0, 2) == "ID"){
        echo '<div class="col-sm-4 SettingsDiv">';
        echo "<form action='submit.php' method='post' style='display:inline;'>";
        $id = explode('-', $profile);
        echo '<input type="hidden" value="'.$id[1].'" name="id">';
      }
      else if (substr($profile, 0, 4) == "NAME"){
        $name = explode('-', $profile);

        echo "<h3>Profile: ".$name[1]."</h3>";
        echo '<div class="input-group mb-1">
              <input type="text" class="form-control input-style" placeholder="profile name" value="'.$name[1].'" name="name">
              <div class="input-group-append "><span class="input-group-text alt-input-style">profile name</span></div></div>';
        echo '<div class="input-group mb-1">
              <input type="number" class="form-control input-style" min=0.1 max=60 step=0.1 value="1" placeholder="delay">
              <div class="input-group-append "><span class="input-group-text alt-input-style">change all delays</span></div></div><br>';
      }

      else if (substr($profile, 0, 6) == "CYCLES"){
          $cycles = explode('-', $profile);
          $i = 0;
          foreach ($cycles as $cycle) {
            if ($cycle == "CYCLES"){}
            else if(strlen($cycle) >= 5){
              $checkboxes = explode(',', $cycle);
              $j = 0;
              echo '<div class="input-group mb-1">';
              echo '<div class="input-group-prepend">';
              echo '<div class="input-group-text alt-input-style" >';
              foreach ($checkboxes as $checkbox) {
                if($checkbox == '1')echo '<input type="checkbox" checked value="1" name="profile'.$i.$j.'" class="profilecheck">&ensp;';
                else if($checkbox == '0')echo '<input type="checkbox" value="1" name="profile'.$i.$j.'" class="profilecheck">&ensp;';
                $j++;
              }
              echo '&ensp;</div></div>';
            }
            else{
                echo '<input type="number" min=0.1 max=60 step=0.1 name="delay'.$i.'" value="'.StringBetween($cycle, '[', ']').'" class="form-control  input-style" placeholder="delay">';
                $i++;
                echo "</div>";
            }
          }

          //echo "<br><input type='submit' class='btn btn-primary'></form></div>";
          echo '
          <br>
          <input type="submit" value="Change" class="btn btn-primary btnprofilesettings">
          </form><form action="submit.php" method="post" style="display: inline;">
          <input type="submit" value="Delete" class="btn btn-danger btnprofilesettings">
          </form><form action="submit.php" method="post" style="display: inline;">
          <input type="submit" value="Enable" class="btn btn-success btnprofilesettings"></div></form>
          ';
        }
    }
  }
  echo "</div></div>";
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
      //TODO random number generator for create function
      //echo round($salt = uniqid(mt_rand(), true))."<br>";
      if($i < $ii)$eol = PHP_EOL;
      else $eol = NULL;

      if($i > 0 && $profilemain[$i-1] == $id){
        $profilesnew = $profilesnew.$name.$eol;
      }
      else if($i > 1 && $profilemain[$i-2] == $id){
        $profilesnew = $profilesnew.$cycles.$eol;
      }
      else{
        $profilesnew = $profilesnew.$profilemain[$i].$eol;
      }
  }
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
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
 ?>
