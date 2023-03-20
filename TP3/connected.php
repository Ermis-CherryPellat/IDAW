<?php
    // on simule une base de données
    $users = array(
    // login => password
    'riri' => 'fifi',
    'yoda' => 'maitrejedi' );
    $login = "anonymous";
    $errorText = "";
    $successfullyLogged = false;
    if(isset($_POST['login']) && isset($_POST['password'])) {
        $tryLogin=$_POST['login'];
        $tryPwd=$_POST['password'];
        // si login existe et password correspond
        if( array_key_exists($tryLogin,$users) && $users[$tryLogin]==$tryPwd ) {
            $successfullyLogged = true;
            $login = $tryLogin;
        } else
        $errorText = "Erreur de login/password";
    } else
        $errorText = "Merci d'utiliser le formulaire de login";
    if(!$successfullyLogged) {
        echo $errorText;
    } else {
        session_start();
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['password']  = $_POST['password'];
        print_r($_SESSION);
        echo "<h1>Bienvenu ".$login."</h1>";
    }

    echo '<p><a href="pageTest.php">Page 2</a></p>';
    
    if(array_key_exists('button1', $_POST)) {
        button1();
    }
    
    function button1() {
        session_unset();
        session_destroy();
    }
 
    echo '<form method="post">
        <input type="submit" name="button1"
                class="button" value="deconnexion" />
    </form>';
    
?>