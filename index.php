<?php
include('./controllers/cons.controller.php');

include('./controllers/repository.controller.php');
include('./controllers/users.controller.php');
include('./controllers/template.controller.php');
include('./controllers/email.controller.php');
include('./controllers/category.controller.php');
include('./controllers/establishment.controller.php');
include('./controllers/rol.controller.php');
include("./controllers/setions.controller.php");
include("./controllers/style.controller.php");

include('./models/users.model.php');
include('./models/roles.model.php');
include('./models/categories.model.php');
include('./models/establishment.model.php');
include("./models/sections.model.php");
include("./models/style.model.php");

session_start();
    $template = new ControllerTemplate();
    $template->ctrTemplate();
