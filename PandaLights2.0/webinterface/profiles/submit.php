<?php
$i = 0;
while (True){
  if(isset($_POST['row'.$i])){
    for($j = 0; $j <= 4; $j++) {
      if(isset($_POST['profile'.$i.$j]))echo '<input type="checkbox" checked>';
      else echo '<input type="checkbox" >';
    }
    $i++;
    echo "<br>";
  }
  else break;
}
 ?>
