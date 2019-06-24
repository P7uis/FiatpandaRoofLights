<?php
function ThemeCheck(){
  $user = get_current_user();
  $themeconfR = fopen("/home/$user/panda/theme.conf", "r");
  if (filesize("/home/$user/panda/theme.conf") == 0){
    ThemeWrite("error");
    return "light";
    fclose($themeconfR);
  }
  else{
  $theme = fread($themeconfR, filesize("/home/$user/panda/theme.conf"));
  if($theme != "dark" && $theme != "light"){
    ThemeWrite("error");
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
  $profilemain = explode('\n', fread($profiles, filesize("/home/$user/panda/profiles.conf")));
  foreach ($profilemain as $profile) {
    $profilesub = explode('|', $profile);
    echo "Profile name: ".$profilesub[0];
    $cycles = explode('~', $profile[1]);
    foreach ($cycles as $cycle) {
      echo $cycle;

    }
  }


  fclose($profiles);
}

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
