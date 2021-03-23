<?php
session_start();

if(isset($_POST['user_email']))
    {
        // sanitize & validate email
        $email = $_POST['user_email'];
        $emailSanitized = filter_var($email, FILTER_SANITIZE_EMAIL);

        if(filter_var($emailSanitized, FILTER_VALIDATE_EMAIL) && $emailSanitized == $email)
        {
            //email validate, pass email to database
            require_once "connect.php";

            //change to MYSQLI_REPORT_OFF
            mysqli_report(MYSQLI_REPORT_STRICT);

            try{
                // create connection to database
                $connection = new mysqli($host, $db_user, $db_password, $db_name);
                
                if($connection->connect_errno != 0)
                {
                    throw new Exception(mysqli_connect_errno());
                } else
                {
                    //query for records with such email
                    $sql_query = sprintf("SELECT * FROM newsletter WHERE email='%s'",
                        mysqli_real_escape_string($connection, $emailSanitized));
                    
                    if($result = $connection->query($sql_query))
                    {
                        /* Check if there is such a record with email given
                         * If there is one, print error
                         * Unless, insert it to database and print success msg
                        */
                        if($result->num_rows > 0)
                        {
                            $_SESSION['e_user_email'] = "The email is already signed up for newsletter!";
                            
                        } else
                        {
                            //mysqli query to database
                            $sql_query = sprintf("INSERT INTO newsletter VALUES(null, '%s')",
                            mysqli_real_escape_string($connection, $emailSanitized));

                            if($result = $connection->query($sql_query))
                            {
                                $_SESSION['s_user_email'] = "Success! You have been signed for a newsletter!";
                                unset($_SESSION['e_user_email']);
                            } else
                            {
                                throw new Exception($connection->error);
                            }
                        }
                        header("Location: index.php");
                    } else
                    {
                        throw new Exception($connection->error);
                    }
                }

                $connection->close();
            } catch (Exception $e)
            {
                echo "Data base error, please try again latter.";
                echo "Developers info: " . $e;
            }
        } else
        {
            $_SESSION['e_user_email'] = "Your email is not valid! Please provide another one :)";
            header("Location: index.php");
        }
    } else
    {
        header("Location: index.php");
    }