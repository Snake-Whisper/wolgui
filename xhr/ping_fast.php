<?php
/*require_once "Net/Ping.php";
$ping = Net_Ping::factory();

if (PEAR::isError($ping)) {
    echo -1;
} else {
    echo $ping->checkhost($_GET["ip"]) ? 1 : 0; //TODO: it seems to be slow
}*/

//This file needs to be as fast as possible!!!

//TODO: Make windows conform!
filter_var($_GET["ip"], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) || die();
exec ("ping " . $_GET["ip"] . " -c1 -s1 -n -w1", $dummyOutput, $retVar);
echo $retVar == 0;

?>
