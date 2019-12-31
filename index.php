<html>
<head>
  <link rel="stylesheet" href="css/machineBox.css">
  <link rel="stylesheet" href="css/layout.css">
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
  ?>
</div>
</body>
</html>
