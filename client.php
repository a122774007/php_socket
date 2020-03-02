<html>
    <head>
        <style>
            .container{
                position: absolute;
                top: 50%;
                left: 40%;
                transform: translateY(-50%);
            }
            input{
                width: 100%;
                height: 48px;
                font-size: 18px;
                padding: 8px;
                box-sizing: border-box;
            }
            label{
                width: 100%;
                font-size: 18px;
            }
            #submitBtn{
                width: 100%;
                height: 48px;
                font-size: 18px;
                background-color: rgb(55, 152, 238);
                color: white;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form method="POST">
                <table>
                    <tr>
                        <td>
                            <label>Username</label><br>
                            <input type="text" name="username"><br>
                            <label>Password</label><br>
                            <input type="password" name="password"><br>

                            <input type="submit" id="submitBtn" name="btnSend" value="LOGIN">
                        </td>
                    </tr>
                    <?php 
                        $host = '127.0.0.1';
                        $port = '3000';

                        if(isset($_POST['btnSend'])){
                            $username = $_REQUEST['username'];
                            $password = $_REQUEST['password'];
                            $msg = $username."###".$password;

                            $sock = socket_create(AF_INET, SOCK_STREAM, 0);
                            socket_connect($sock, $host, $port);

                            socket_write($sock, $msg, strlen($msg));

                            $reply = socket_read($sock, 1024);
                            $reply = trim($reply);
                            $reply = "server say:\t".$reply;
                        }
                    ?>
                    <script>alert("<?php echo $reply; ?>")</script>
                </table>
            </form>
        </div>
    </body>
</html>