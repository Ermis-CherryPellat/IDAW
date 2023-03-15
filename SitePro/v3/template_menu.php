<?php
    function renderMenuToHTML($currentPageId) {
        // un tableau qui d\'efinit la structure du site 2
        $mymenu = array(
        // idPage titre
            'accueil' => array( 'Accueil' ),
            'cv' => array( 'Cv' ),
            'projets' => array('Mes Projets'),
            'infos-techniques' => array('Infos techniques'),  
            'contact' => array('Contact')
        );
    echo 
    '<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
    <div class="container px-5">
        <a class="navbar-brand fw-bold" href="index.php">Ermis Cherry-Pellat</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">';


    foreach($mymenu as $pageId => $pageParameters) {
        if($pageId==$currentPageId){    
            echo '<li class="nav-item" id="currentpage"><a class="nav-link me-lg-3" href="index.php?page='.$pageId.'">'.$pageParameters[0].'</a></li>';
                
        }
        else{
            echo '<li class="nav-item"><a class="nav-link me-lg-3" href="index.php?page='.$pageId.'">'.$pageParameters[0].'</a></li>';
        }
        echo '<br>'; 
    }
        
    echo '</ul>
        </div>
        </div>
        </nav>';
    }

    