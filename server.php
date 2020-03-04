<?php
    $host = '127.0.0.1';
    $port = '3000';
    set_time_limit(0);

    $sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
    $result = socket_bind($sock, $host, $port) or die("Could not bind to socket\n");

    $result = socket_listen($sock, 3) or die("Could not set up socket listener\n");
    echo 'Listening for connections\n';

    while(true){
        $accept = socket_accept($sock) or die("Could not accept incoming connection\n");
        $msg = socket_read($accept, 1024) or die("Could not read input\n");

        $msg = trim($msg);
        $msg = explode("###", $msg);
        echo "Username: ".$msg[0]."\n";
        echo "Password: ".$msg[1]."\n";

        if(!file_exists(dirname(__FILE__)."/login.log")){
            $login_file = fopen("C:/xampp/htdocs/php_socket/login.log", "w") or die("Unable to open file!");
            echo "not exist\n";
        }
        else{
            $login_file = fopen(dirname(__FILE__)."/login.log", "a") or die("Unable to open file!");
            echo "exist\n";
        }
        $timestamp = time();
        $txt = $msg[0]." ".$timestamp." ";
        if((strlen($msg[0]) <= 50 && strlen($msg[1]) <= 50)){
            $txt .= "true\n";
            $reply = "Login Success";
        }
        else{
            $txt .= "false\n";
            $reply = "Login failed";
        }
        //$txt .= ((strlen($msg[0]) <= 50 && strlen($msg[1]) <= 50) ? "true\n" : "false\n");
        fwrite($login_file, $txt);
        fclose($login_file);
        
        socket_write($accept, $reply, strlen($reply)) or die("Could not write reply\n");
    }

    socket_close($accept, $sock);
?>