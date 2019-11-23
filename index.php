<html>
<head>
  <link rel="stylesheet" href="css/machineBox.css">
  <link rel="stylesheet" href="css/layout.css">
  <style>



  </style>
</head>
<body>
  <div id='machinesContainer'>
<?php
    function printMachine($stats, $commands = array()) {
      echo "<div class='machineBox'>
              <div class='buttonBox'>
                <img src='img/redButton.svg' class='buttonVector'></img>
              </div><table class='machineStats'>";
      foreach ($stats as $key => $value) {
        echo "<tr><th>$key</th><td>$value</td></tr>";
      }
      echo "</table></div>";
    }
    $teststats = [
    "mac" => "BB:BB:BB:BB:BB",
    "ip"  => "192.168.178.20",
    "Name" => "Main Server",
    "ipv6" => "2001:BEEF:BEEF:BEEF:BEEF:BEEF:BEEF:BEEF",
    "location" => "Main Room",
    "comment" => "Main Server",
    "owner" => "snake-whisper",
    "email" => "snake-whisper@web-utils.eu"];
    for ($i=0; $i < 50; $i++) {
    printMachine($teststats);
    }
  ?>
</div>
</body>
</html>
