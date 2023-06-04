<?php
/* if (isset($_GET['route'])) {
    $routeGET = $_GET['route'];
    if (isset($_SESSION["user"])):
        if(in_array($routeGET, $routes['public'])):
            include ('./views/modules/public/'.$_GET['route'].'.php');
        elseif(in_array($routeGET, $routes['private'])):
            include ('./views/modules/private/'.$_GET['route'].'.php');
        else: 
            include ('./views/modules/public/home.php');
        endif;
    else:
        if(in_array($routeGET, $routes['public']) || in_array($routeGET, $routes["login"])):
            include ('./views/modules/public/'.$_GET['route'].'.php');
        else: 
            include ('./views/modules/public/home.php');
        endif;
    endif;
} else {
    echo "aaa";	
    include ('./views/modules/public/home.php');
} */
if (isset($_GET["route"])):
    $routeGET = $_GET['route'];
    if (isset($_SESSION["user"])):
        if(in_array($routeGET, $routes['public'])):
            include ('./views/modules/public/'.$_GET['route'].'.php');
        elseif(in_array($routeGET, $routes['private'])):
            include ('./views/modules/private/'.$_GET['route'].'.php');
        else: 
            include ('./views/modules/public/home.php');
        endif;
    else:
        if(in_array($routeGET, $routes['public']) || in_array($routeGET, $routes["login"])):
            include ('./views/modules/public/'.$_GET['route'].'.php');
        else: 
            include ('./views/modules/public/home.php');
        endif;
    endif;
else:
    include ('./views/modules/public/home.php');
endif;