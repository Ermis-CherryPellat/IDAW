<?php
    function renderMenuToHTML($currentPageId,$currentLang) {
        // un tableau qui d\'efinit la structure du site 2
        $mymenuFR = array(
        // idPage titre
            'accueil' => array( 'Accueil' ),
            'cv' => array( 'Cv' ),
            'projets' => array('Mes Projets'),
            'infos-techniques' => array('Infos techniques'),  
            'contact' => array('Contact')
        );
        $mymenuEN = array(
            // idPage titre
                'accueil' => array( 'Home' ),
                'cv' => array( 'Cv' ),
                'projets' => array('My Projects'),
                'infos-techniques' => array('Technical information'),  
                'contact' => array('Contact')
            );
    echo 
    '<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
    <div class="container px-5">
        <a class="navbar-brand fw-bold" href="index.php?lang='.$currentLang.'">Ermis Cherry-Pellat</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">';

    if($currentLang == 'fr'){
        foreach($mymenuFR as $pageId => $pageParameters) {
            if($pageId==$currentPageId){    
                echo '<li class="nav-item" id="currentpage"><a class="nav-link me-lg-3" href="index.php?page='.$pageId.'&lang=fr">'.$pageParameters[0].'</a></li>';
                    
            }
            else{
                echo '<li class="nav-item"><a class="nav-link me-lg-3" href="index.php?page='.$pageId.'&lang=fr">'.$pageParameters[0].' </a></li>';
            }
            echo '<br>'; 
            }
    }
    else{
        foreach($mymenuEN as $pageId => $pageParameters) {
            if($pageId==$currentPageId){    
                echo '<li class="nav-item" id="currentpage"><a class="nav-link me-lg-3" href="index.php?page='.$pageId.'&lang=en">'.$pageParameters[0].'</a></li>';
                    
            }
            else{
                echo '<li class="nav-item"><a class="nav-link me-lg-3" href="index.php?page='.$pageId.'&lang=en">'.$pageParameters[0].'</a></li>';
            }
            echo '<br>'; 
            }
    }
    
        
    echo '<div class="btn-group" role="group" aria-label="Basic example">
            <a class="btn-secondary" href="index.php?page='.$currentPageId.'&lang=fr"><button type="button" class="btn btn-secondary">Français</button></a>
            <a class="btn-secondary" href="index.php?page='.$currentPageId.'&lang=en"><button type="button" class="btn btn-secondary">English</button></a>
        </div>

            </ul>
        </div>
        </div>
        </nav>';
    
    

    }

    // <div class="btn-group" role="group" aria-label="Basic example">
    //             <button type="button" class="btn btn-secondary"><a class="nav-link me-lg-3" href="index.php?page='.$currentPageId.'&lang=fr">Français</button>
    //             <button type="button" class="btn btn-secondary"><a class="nav-link me-lg-3" href="index.php?page='.$currentPageId.'&lang=en">English</button>
    //         </div>