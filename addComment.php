<?php
if(isset($_POST['message']))
    {
        $username = $_POST['username'];
        $message = $_POST['message'];

        

        if(strlen($username) < 128)
        {
            //connect with db
            require_once "connect.php";

            try
            {

                //make connection
                $connection = new mysqli($host, $db_user, $db_password, $db_name);
                
                // get current date
                $date = date('Y-m-d H:i:s');

                if($connection->connect_errno != 0)
                {
                    throw new Exception($connection->mysqli_connect_errno());
                } else
                {
                    $sql = sprintf("INSERT INTO comments (username, date, message) VALUES ('%s', '%s', '%s')",
                        mysqli_real_escape_string($connection, $username),
                        mysqli_real_escape_string($connection, $date),
                        mysqli_real_escape_string($connection, $message));


                    if($result = $connection->query($sql))
                    {
                        $connection->close();
                        header('Location: index.php');
                    } else
                    {
                        throw new Exception($connection->error);
                    }
                }

            } catch(Exception $e)
            {
                echo "Data base error, please try again latter.";
                echo "Developers info: " . $e;
            }

        }
        
        
    } else
    {
        header("Location: index.php");
    }

?>