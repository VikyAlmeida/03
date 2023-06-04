<?php
    if(isset($_SESSION["logged_message"])):
        echo "<script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
          
          Toast.fire({
            icon: 'success',
            title: 'Has iniciado sesión'
          })</script>
        ";
        unset($_SESSION["logged_message"]);
    elseif(isset($_SESSION["logout_message"])):
      echo "<script>
      const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
      })
  
      Toast.fire({
      icon: 'success',
      title: 'Te has deslogueado'
      })</script>
      ";
      unset($_SESSION["logout_message"]);
    endif;
?>