<?php
    $host = '127.0.0.1';
    $port = '3000';
    set_time_limit(0);

    $sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
    $result = socket_bind($sock, $host, $port) or die("Could not bind to socket\n");

    $result = socket_listen($sock, 3) or die("Could not set up socket listener\n");
    echo 'Listening for connections';

    while(true){
        $accept = socket_accept($sock) or die("Could not accept incoming connection\n");
        $msg = socket_read($accept, 1024) or die("Could not read input\n");

        $msg = trim($msg);
        echo 'Client says:\t'.$msg.'\n\n';

        echo 'Enter Reply:\t';
        $reply = rtrim(fgets(STDIN));
        
        socket_write($accept, $reply, strlen($reply)) or die("Could not write output\n");
    }

    socket_close($accept, $sock);
?>