<?php

  function v4cidr2mask ($cidr) {
    $long = 0xffffffff << (32 - $cidr);
    return long2ip($long);
  }

  function extractBroadcastIPv4($ipWithMask) {
    list($ip, $cidr) = explode("/", $ipWithMask);
    $mask = v4cidr2mask($cidr);

    $wcmask=long2ip( ~ip2long($mask) );
    $subnet=long2ip( ip2long($ip) & ip2long($mask) );
    $bcast=long2ip( ip2long($ip) | ip2long($wcmask) );

    return $bcast;
  }

  function wolv4($mac, $IPv4) {
    $broadcast = extractBroadcastIPv4($IPv4);
    $hwaddr = pack('H*', preg_replace('/[^0-9a-fA-F]/', '', $mac));

    // Create Magic Packet
    $packet = sprintf(
        '%s%s',
        str_repeat(chr(255), 6),
        str_repeat($hwaddr, 16)
    );

    $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

    if ($sock !== false) {
        $options = socket_set_option($sock, SOL_SOCKET, SO_BROADCAST, true);

        if ($options !== false) {
            socket_sendto($sock, $packet, strlen($packet), 0, $broadcast, 7);
            socket_close($sock);
        }
    }
  }

function chkOnline ($ip) { //TODO: Make windows conform!
  exec ("ping $ip -c1 -s1 -n -w1", $dummyOutput, $retVar);
  return $retVar == 0;
}

function execInBackground($cmd) {
    if (substr(php_uname(), 0, 7) == "Windows"){
        pclose(popen("start /B ". $cmd, "r"));
    }
    else {
        exec($cmd . " > /dev/null &");
    }
}


/*function v6cidr2mask ($cidr) {
  $long = 0xffffffffffffffffffffffffffffffff << (128 - $cidr);
  return inet_pton($long);
}*/

//var_dump(v6cidr2mask(127));



//  wolv4("d4:be:d9:93:60:4d", "192.168.178.39/24");
?>
