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
  require_once("lib/misc.php");

  //storage backend

  $bk = new MachineStorageSQLite3Engine("lib/machines.db");

  //begin helper functions

  function _h_buildMachinesPanel ($stats) {
    $t = new Machine($stats);
    $t->printMachine();
  }

  //end helper functions

  //begin actionscheck

  if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
      case 'cmd':
        $cmd = $bk->getMainCommandByMachine($_GET["id"]);
        execInBackground($cmd); //never cu again
        break;
      case 'wol':
        $bk->machineWakeUp($_GET["id"]);
    }
  }

  //end actionscheck

  //begin build webUI

  $bk->getMachines("_h_buildMachinesPanel");

  //end build webUI
  ?>
</div>
</body>
</html>
