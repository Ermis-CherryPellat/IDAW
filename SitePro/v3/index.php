<?php
    require_once("template_header.php");
    require_once("template_menu.php");
    $currentPageId = 'accueil';
    if(isset($_GET['page'])) {
    $currentPageId = $_GET['page'];
    } 
    if(isset($_GET['lang'])) {
        $currentLang = $_GET['lang'];
        } 
    else{
        $currentLang = 'fr';
    }
?>

<?php
    renderMenuToHTML($currentPageId,$currentLang);
?>

<section class="corps">
<!-- $currentLang . "/" .  -->
<?php
    $pageToInclude = $currentLang . "/" . $currentPageId . ".php";
    if(is_readable($pageToInclude))
    require_once($pageToInclude);
    else
    require_once("error.php");
?>

</section>
<?php
    require_once("template_footer.php");
?>