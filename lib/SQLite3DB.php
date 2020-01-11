<?php

  interface iMachineStorageEngine {
    public function initDB();
    public function addMachine($params);
    public function delMachineByID($id);
    public function delMachineByName($id); //need?
    public function getMachines($handler);
    public function getMainCommandByMAchine($id);
    public function getCommand($cmdid);
    public function addCommand($cmd);
    public function delCommand($id);
    public function alterCommand($id, $cmd);
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
      $sql->bindValue(':cmd', $params['Command'] ?? 'NULL');
      $sql->execute();
    }

    public function delMachineByID($id) {
      $sql = $this->db->prepare("DELETE FROM machines WHERE id=:id");
      $sql->bindValue(":id", $id);
      $sql->execute();
    }

    public function delMachineByName($name) {
      $sql = $this->db->prepare("DELETE FROM machines WHERE Name=:Name");
      $sql->bindValue(":Name", $name);
      $sql->execute();
    }

    public function getMachines($handler) {
      $result = $this->db->query('SELECT
                                  Name, Mac, IP, IPv6, Location, Com, Owner, eMail, Cmd, Id
                                  FROM machines');
      while ($row = $result->fetchArray(1)) {
        $handler($row);
      }
    }

    public function getIPv4CIDR($id) {
      $sql = $this->db->prepare("SELECT IP
                                  FROM machines
                                  WHERE machines.id =:id");
     $sql->bindValue("id", $id);
     $result = $sql->execute();
     return $result->fetchArray()["IP"];
    }

    public function getMainCommandByMachine($id) {
      $sql = $this->db->prepare("SELECT commands.cmd
                                  FROM commands, machines
                                  WHERE machines.id =:id AND
                                  commands.id = machines.cmd");
     $sql->bindValue("id", $id);
     $result = $sql->execute();
     return $result->fetchArray()["cmd"] ?? ""; //optimze for single querys
    }

    public function addCommand($cmd) {
      $sql = $this->db->prepare("INSERT INTO commands (cmd) VALUES (:cmd)");
      $sql->bindValue(":cmd", $cmd);
      $sql->execute();
    }

    public function getCommand($cmdid) {
      $sql = $this->db->prepare("SELECT cmd FROM commands WHERE id=:id");
      $sql->bindValue(":id", $cmdid);
      $result = $sql->execute();
      return $result->fetchArray()["cmd"] ?? ""; //optimze for single querys
    }

    public function delCommand($id) {
      $sql = $this->db->prepare("DELETE FROM commands WHERE id=:id");
      $sql->bindValue(":id", $id);
      $result = $sql->execute();
    }

    public function alterCommand($id, $cmd) {
      $sql = $this->db->prepare("UPDATE commands SET cmd=:cmd WHERE id=:id");
      $sql->bindValue(":id", $id);
      $sql->bindValue(":cmd", $cmd);
      $result = $sql->execute();
    }
  }
 ?>
