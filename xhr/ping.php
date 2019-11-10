<?php
require_once "Net/Ping.php";
$ping = Net_Ping::factory();

if (PEAR::isError($ping)) {
    echo -1;
} else {
    echo $ping->checkhost($_GET["ip"]) ? 1 : 0; //TODO: it seems to be slow
}
?>
