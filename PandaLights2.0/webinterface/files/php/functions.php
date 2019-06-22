<?php
function ThemeCheck(){
  $user = get_current_user();
  $themeconfR = fopen("/home/$user/panda/theme.conf", "r");
  $theme = fread($themeconfR, filesize("/home/$user/panda/theme.conf"));
  //$theme = substr($theme, 0, -1);
  if($theme != "dark" && $theme != "light"){
    ThemeWrite("error");
    return "light";
  }
  else return $theme;
  fclose($themeconfR);
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
 ?>
