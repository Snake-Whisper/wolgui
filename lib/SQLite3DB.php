<?php

  interface iMachineStorageEngine {
    public function initDB();
    public function addMachine($params);
    /*public function delMachine($id);
    public function getMachines($handler);
    public function getMainCommand($id);
    public function getCommand($id, $cmdId);*/
  }

  class MachineStorageSQLite3Engine implements iMachineStorageEngine {
    function __construct($dbName) {
      $this->db = new SQLite3($dbName);
    }

    public function initDB () {
      ob_start();
      require ("schema.sql");
      $sql = ob_get_contents();
      ob_end_clean();
      $this->db->exec($sql);
    }

    public function addMachine($params) {
      $sql = $this->db->prepare("INSERT
                INTO machines
                (Name, Mac, IP, IPv6, Location, Com, Owner, eMail, Cmd)
                VALUES
                (:Name, :Mac, :IP, :IPv6, :Location, :Com, :Owner, :eMail, :cmd)");

      $sql->bindValue(':Name', $params['Name'] ?? 'Not Set'); //fix -> sql unique cond!!!
      $sql->bindValue(':Mac', $params['Mac'] ?? 'NULL');
      $sql->bindValue(':IP', $params['IP'] ?? 'NULL');
      $sql->bindValue(':IPv6', $params['IPv6'] ?? 'NULL');
      $sql->bindValue(':Location', $params['Location'] ?? 'NULL');
      $sql->bindValue(':Com', $params['Comment'] ?? 'NULL');
      $sql->bindValue(':Owner', $params['Owner'] ?? 'NULL');
      $sql->bindValue(':eMail', $params['eMail'] ?? 'NULL');
      $sql->bindValue(':Cmd', $params['Command'] ?? 'NULL');
      $sql->execute();
    }
  }

    //testCode
    $teststats = [
      "Mac" => "BB:BB:BB:BB:BB",
      "IP"  => "192.168.178.20",
      "Name" => "Main Server",
      "IPv6" => "2001:BEEF:BEEF:BEEF:BEEF:BEEF:BEEF:BEEF",
      "Location" => "Main Room",
      "Comment" => "Main Server",
      "Owner" => "snake-whisper",
      "eMail" => "snake-whisper@web-utils.eu"];
    $tmp = new MachineStorageSQLite3Engine("machines.db");
    $tmp->initDB();
    $tmp->addMachine($teststats);
 ?>
