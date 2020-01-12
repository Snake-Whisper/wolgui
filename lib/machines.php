<?php
class Machine {
  function __construct($stats) {
    $this->stats = $stats;
  }

  function printMachine() {
    echo "<div class='machineBox'>
            <div  class='machineLabel'>
              <h2>" . $this->stats['id'] . ": " . $this->stats['Name'] . "</h2>
            </div>
            <div class='buttonBox'>
              <a href=?id=" . $this->stats['id'] . "&action=wol><img src='img/redButton.svg' class='buttonVector'></img></a>
            </div>
            <table class='machineStats'>";
    foreach ($this->stats as $key => $value) {
      if ($key == "Name" || $key == "cmd" || $key == "id") {
        continue;
      }
      echo "<tr><th>$key</th><td>$value</td></tr>";
    }
    echo "</table></div>";
  }
}
 ?>
