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
  require_once("lib/machines.php");
  $teststats = [
    "mac" => "BB:BB:BB:BB:BB",
    "ip"  => "192.168.178.20",
    "Name" => "Main Server",
    "ipv6" => "2001:BEEF:BEEF:BEEF:BEEF:BEEF:BEEF:BEEF",
    "location" => "Main Room",
    "comment" => "Main Server",
    "owner" => "snake-whisper",
    "email" => "snake-whisper@web-utils.eu"];
    for ($i=0; $i < 13; $i++) {
      $t = new Machine($teststats);
      $t->printMachine();
    }
  ?>
</div>
</body>
</html>
