<?php

  interface iMachineStorageEngine {
    public function initDB();
    /*public function addMachine($params, $commands = array());
    public function delMachine($id);
    public function getMachines($handler);
    public function getMainCommand($id);
    public function getCommand($id, $cmdId);*/
  }

  class MachineStorageSQLite3Engine implements iMachineStorageEngine {
    function __construct($dbName) {
      $this->db = new SQLite3($dbName);
    }

    function initDB () {
      $this->db->exec("show Tables;");
    }
  }

    //testCode
    $tmp = new MachineStorageSQLite3Engine("test.db");
 ?>
