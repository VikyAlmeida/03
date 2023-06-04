<?php
    unset($_SESSION["user"]);
    $_SESSION["logout_message"]=true;
    
    echo "<script>window.location='home'</script>";