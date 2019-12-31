<?php

  function wol($mac, $broadcast) {
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

function execInBackground($cmd) {
    if (substr(php_uname(), 0, 7) == "Windows"){
        pclose(popen("start /B ". $cmd, "r"));
    }
    else {
        exec($cmd . " > /dev/null &");
    }
}
 ?>
