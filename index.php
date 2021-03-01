<!doctype html>
<?php
    session_start();
    /*if(isset($_POST['user_email']))
    {
        header("Location ")
    }*/

    $server_date = new DateTime();
    $server_date_formatted = $server_date->format('Y-m-d H:i:s');
    
    $release_date = DateTime::createFromFormat('Y-m-d H:i:s', '2021-4-1 20:00:00');

    $time_till_release = $server_date->diff($release_date); //this is a DateInterval object!
    $time_till_release_formatted = $time_till_release->format('%d days, %h:%i:%s');
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
        
            <section class="newsletter-section">
                <div class="newsletter-section-container">
                    <div class="interested">
                        <h1>Zainteresowany?</h1>
                    </div>

                    <div class="newsletter-signup-section">
                        <form method="POST">
                            <label>
                                <p>Zapisz się na newsletter żeby nie przegapić premiery!</p>
                                <input type="text" name="user_email">
                            </label>
                            <input type="submit" value="Wyślij!">
                        </form>
                        
                    </div>
                </div>
            </section>

            <section class="comments-section">

            </section>

            <footer class="general-footer">

            </footer>
        </div>


         
    </body>
    
    <script src="scripts/timer.js"></script>
</html>