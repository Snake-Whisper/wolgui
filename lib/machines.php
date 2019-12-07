<?php
class Machine {
  function __construct($stats) {
    $this->stats = $stats;
  }

  function printMachine() {
    echo "<div class='machineBox'>
            <div  class='machineLabel'>
              <h2>" . $this->stats['Name'] . "</h2>
            </div>
            <div class='buttonBox'>
              <img src='img/redButton.svg' class='buttonVector'></img>
            </div>
            <table class='machineStats'>";
    foreach ($this->stats as $key => $value) {
      if ($key == "Name") {
        continue;
      }
      echo "<tr><th>$key</th><td>$value</td></tr>";
    }
    echo "</table></div>";
  }
}
 ?>
