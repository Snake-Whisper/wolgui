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
  require_once("lib/SQLite3DB.php");

  $bk = new MachineStorageSQLite3Engine("lib/machines.db");

  function _h_buildMachinesPanel ($stats) {
    $t = new Machine($stats);
    $t->printMachine();
  }

  $bk->getMachines("_h_buildMachinesPanel");
  /*$teststats = [
    "Mac" => "BB:BB:BB:BB:BB",
    "IP"  => "192.168.178.20",
    "Name" => "Main Server",
    "IPv6" => "2001:BEEF:BEEF:BEEF:BEEF:BEEF:BEEF:BEEF",
    "Location" => "Main Room",
    "Comment" => "Main Server",
    "Owner" => "snake-whisper",
    "eMail" => "snake-whisper@web-utils.eu"];
    for ($i=0; $i < 13; $i++) {

    }*/

  ?>
</div>
</body>
</html>
