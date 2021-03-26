<!doctype html>
<?php
    session_start();

    /////////////////////////////////// TIMER /////////////////////////////////
    //get date from server
    $server_date = new DateTime();
    $server_date_formatted = $server_date->format('Y-m-d H:i:s');
    $release_date = DateTime::createFromFormat('Y-m-d H:i:s', '2021-4-1 20:00:00');
    
    //calculate time till release date
    $time_till_release = $server_date->diff($release_date); //this is a DateInterval object!
    $time_till_release_formatted = $time_till_release->format('%d days, %h:%i:%s');
    
    //format result
    $days_release = $time_till_release->format('%d days, ');
    $time_release = $time_till_release->format('%h:%i:%s');
?>

<html>
    <head>
        <meta charset="utf-8">

        <title>Schrute Revenge</title>
        <meta name="description" content="Schrute Revenge game forum">
        <meta name="author" content="Jakub Woźny">

        <link rel="stylesheet" href="css\\shapedstyle.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;1,300&display=swap" rel="stylesheet">
        <link href="css/fontello.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <header class="general-header">
                <img src="img/napis.png" alt="Schrute Revenge" >
            </header>

            <section class="clip-section">
                <div class="clip-section-container">
                    <div class="youtube-frame">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/9aYTdzE-ibI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                        
                    <div class="timer-container">
                        <h3>Do premiery pozostało:</h3>
                        <!--<h1>10:13:25</h1>-->
                        <?php /*echo "<p>Server time: " . $server_date_formatted . "</p>";
                        echo "<p>Release time: " . $release_date->format('Y-m-d H:i:s'). "</p>";
                        echo "<p>Difference time: " . $time_till_release_formatted .  "</p>";*/
                        echo '<p class="timespan">' . $days_release . '<span id="timer">' . $time_release . '</span></p>';
                        ?>
                    </div>
                </div>
                
            </section>

            <section class="photo1-section" data-parallax="scroll" data-image-src="img/screenshot2.png" data-z-index="8">
            </section>
        
            <section class="newsletter-section">
                <div class="newsletter-section-container">
                    <div class="interested">
                        <h1>Zainteresowany?</h1>
                    </div>

                    <div class="newsletter-signup-section">
                        <form method="POST" action="newsletterSignUp.php">
                            <label>
                                <p>Zapisz się na newsletter żeby nie przegapić premiery!</p>
                                <input type="text" name="user_email">
                            </label>
                            <input type="submit" value="Wyślij!">
                        </form>
                        <?php
                        if(isset($_SESSION['e_user_email']))
                        {
                            echo '<div class="error">' . $_SESSION['e_user_email'] . "</div>";
                            unset($_SESSION['e_user_email']);
                        }
                        if(isset($_SESSION['s_user_email']))
                        {
                            echo '<div class="success">' . $_SESSION['s_user_email'] . "</div>";
                            unset($_SESSION['s_user_email']);
                        }
                        ?>
                    </div>
                </div>
            </section>

            <section class="photo2-section" data-parallax="scroll" data-image-src="img/screenshot1.png" data-z-index="6">
                
            </section>

            <section class="comments-section">
                <div class='comments-section-container'>
                    <h1>Komentarze</h1>
                    <form method='post' action="addComment.php">
                        <input type='text' name='username' value='Anonim'/></br>
                        <textarea name="message"></textarea></br>
                        <input type='submit' value='Skomentuj!' />
                    </form>

<?php
/*                  PRINT COMMENTS                  */
    require_once "connect.php";
    // create connection with database
    try{
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if($connection->connect_errno != 0)
        {
            throw new Exception(mysqli_connect_errno());
        }

        $sql = "SELECT * FROM comments ORDER BY date DESC";

        if($result = $connection->query($sql))
        {
            // print comments
            $counter = 0;
            while($row = $result->fetch_assoc())
            {
                echo "<div class='comment-container' id='c" . $counter . "'>";
                echo "<div class='comment'>";
                    echo "<p class='comment-username'><b>" . htmlentities($row['username']) . "</b> | " . $row['date'] ."</p>";
                    echo "<p class='comment-message'>" . nl2br(htmlentities($row['message'])) . "</p>";
                echo "</div></div>";
                $counter++;
            }
            if($counter >= 5)
            {
                echo "<div id='commentButton'>Pokaż mniej</div>";
            }
        } else
        {
            throw new Exception($connection->error);
        }
    } catch(Exception $e)
    {
        echo "Data base error, please try again latter.";
        echo "Developers info: " . $e;
    }
?>
                </div>
            </section>

            <footer class="general-footer">
                <div class="contact-section">
                    <h3>Skontaktuj się ze mną:</h2>
                    <ul>
                        <li><i class="icon-mail"></i>Jckob21@gmail.com</li>
                        <li><a href="https://www.linkedin.com/in/jakub-wo%C5%BAny-99a172200/"><i class="icon-linkedin-squared"></i>Linked in</a></li>
                    </ul>
                    <h3>Odwiedź moją stronę:</h2>
                    <a href="http://jakubwozny.pl/"><i class="icon-globe"></i>jakubwozny.pl</a>
                </div>
                <div class="donate-section">
                    <h3>Wesprzyj:</h3>
                    <a href="https://www.paypal.com/paypalme/kubawozny"><i class="icon-paypal"></i></a>
                </div>
                <div class="dwight-photo-section">
                    <img src="./img/Dwight.png" alt="Your browser does not support displaying images.">
                    <p>MAY THE FORCE BE WITH YOU</p>
                </div>
                <div class="bottom-footer">All right reserved</div>
            </footer>
        </div>
    </body>
    
    <script src="scripts/timer.js"></script>
    <script src="scripts/commentSectionManager.js"></script>
</html>