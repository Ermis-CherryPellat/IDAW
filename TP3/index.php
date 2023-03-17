<!doctype html> 

<?php
    // setcookie("testCookie", "blabla", time() - 3600);
    // print_r($_COOKIE);
?>

<html>
<head>
<meta charset="utf-8">
<title>Hello World Wild Web</title>
<?php 

    $currentStyle = 'style1';

    print_r($_COOKIE); 

    if(isset($_COOKIE['style'])) {
        $currentStyle=$_COOKIE['style'];
    } 

    if(isset($_GET['css'])){
        $currentStyle = $_GET['css'];
        setcookie("style", $currentStyle, time() + 3600);
    }

    echo '<link href="'.$currentStyle.'.css" rel="stylesheet" />';

?>
</head> <body>

<?php
    if(isset($login)){
        echo "<h1>Bienvenu ".$login."</h1>";
    }
?>
<h1>Formulaire</h1> </body>
<?php
    require_once("login.php");

?>

<form id="style_form" action="index.php" method="GET">
    <select name="css">
        <option value="style1" <?php if($currentStyle=="style1") echo "selected";?>>style1</option>
        <option value="style2" <?php if($currentStyle=="style2") echo "selected";?>>style2</option>
    </select>
    <input type="submit" value="Appliquer" />
</form>



</html>

