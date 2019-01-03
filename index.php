<?php
 if($_GET['btn5']){echo shell_exec("echo '5' > /home/pi/scripts/numbers.txt");;}
 if($_GET['btn4']){echo shell_exec("echo '4' > /home/pi/scripts/numbers.txt");;}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
  </head>
  <body>
    <button id="btn5" name="btn5" onClick='location.href="?button5"'>5</button>
    <button id="btn4" name="btn4" onClick='location.href="?button4"'>4</button>
  </body>
</html>
