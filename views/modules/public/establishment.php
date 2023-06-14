<?php
    $id = explode("?", $_SERVER['REQUEST_URI'])[1];
    $establishmentController = new ControllerEstablishment();
    $establishment = $establishmentController->ctrGetEstablishment('id = '.$id);
    $establishment_json = json_encode($establishment);
    $styleController = new ControllerStyle();
    $carrouselTXT = $styleController->showData(1);
    $carrouselFile = $styleController->showData(2); 
    $aboutUsFile = $styleController->showData(3);
    $cuentaAtrasNum = $styleController->showData(4);
    $cuentaAtrasText = $styleController->showData(5); 
    $servicesImg = $styleController->showData(6); 
    $servicesTitle = $styleController->showData(7); 
    $servicesTxt = $styleController->showData(8); 
    $trabajadoresTitle = $styleController->showData(9); 
    $trabajadoresTxt = $styleController->showData(10); 
    $trabajadoresImg = $styleController->showData(11); 
    $blogTitle = $styleController->showData(12); 
    $blogTxt = $styleController->showData(13); 
    $blogImg = $styleController->showData(14); 
    $reservaImg = $styleController->showData(15); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Feliciano - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./views/style3/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="./views/style3/css/animate.css">
    <link rel="stylesheet" href="./views/style3/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./views/style3/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./views/style3/css/magnific-popup.css">
    <link rel="stylesheet" href="./views/style3/css/aos.css">
    <link rel="stylesheet" href="./views/style3/css/ionicons.min.css">
    <link rel="stylesheet" href="./views/style3/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="./views/style3/css/jquery.timepicker.css">
    <link rel="stylesheet" href="./views/style3/css/flaticon.css">
    <link rel="stylesheet" href="./views/style3/css/icomoon.css">
    <link rel="stylesheet" href="./views/style3/css/style.css">
    
    <script>
        const establishment = <?= $establishment_json ?> || null;
        if (establishment == null) location.href = 'menu'; 
    </script>
  </head>
  <body>
    <div class="py-1 bg-black top">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
		    			<div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text"><script>document.write(establishment.tlf);</script></span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text"><script>document.write(establishment.email);</script></span>
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
    </div>
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="home"><script>document.write(establishment.name);</script></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	        	<li class="nav-item active"><a href="previewEstablishment" class="nav-link">Home</a></li>
	        	<li class="nav-item"><a href="menu" class="nav-link">Menu</a></li>
	            <li class="nav-item cta" id="reserva"><a href="reservation" class="nav-link">Book a table</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    <section class="home-slider owl-carousel js-fullheight">    
        <?php
            if ($carrouselFile):
                for ($i=0; $i < count($carrouselFile); $i++) { 
                    ?>
                        <div class="slider-item js-fullheight" style="background-image: url(<?= $carrouselFile[$i]['datum'] ?>);">
                        <div class="overlay"></div>
                                <div class="container">
                                <div class="row slider-text js-fullheight justify-content-center align-items-center" data-scrollax-parent="true">
                                    <div class="col-md-12 col-sm-12 text-center ftco-animate">
                                        <span class="subheading"><script>document.write(establishment.name);</script></span>
                                        <h1 class="mb-4"><?= $carrouselTXT[$i]['datum'] ?></h1>
                                    </div>
                                </div>
                                </div>
                            </div>
                    <?php
                }
            endif;
        ?>
   </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb" >
    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-md-12">
    				<div class="featured">
    					<div class="row">
                        <?php
                                if ($carrouselFile):
                                    for ($i=0; $i < 4; $i++) { 
                                        if(isset($carrouselFile[$i])):
                                        ?>
                                            <div class="col-md-3"style="margin-top: -1em;">
                                                <div class="featured-menus ftco-animate">
                                                    <div class="menu-img img" style="background-image: url(<?= $carrouselFile[$i]['datum'] ?>);"></div>
                                                    <div class="text text-center">
                                                        <h3><?= $carrouselTXT[$i]['datum'] ?></h3>
                                                        <div style="display: flex; text-align:center;justify-content: center;"> 
                                                            <form action="" method="post" style="margin-left:0.5em">
                                                                <?php
                                                                    if(isset($_POST)):
                                                                        if (isset($_POST["delete"])):
                                                                            $styleController->deleteData();
                                                                        endif;
                                                                    endif;
                                                                ?>
                                                            </form>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                            
                                        <?php
                                    endif;
                                }
                            endif;
                        ?>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
		<section class="ftco-section ftco-wrap-about">
			<div class="container">
				<div class="row">
					<div class="col-md-7 d-flex">
                        <?php
                            for ($i=0; $i < 2; $i++) { 
                                if(isset($aboutUsFile[$i])):
                                    ?>
                                        <div class="img img-1 mr-md-2" style="background-image: url(<?= $aboutUsFile[$i]['datum'] ?>);"></div>                                
                                    
                                        <div style="display: flex; text-align:center;justify-content: center;"> 
                                                <form action="" method="post" style="margin-left:0.5em">
                                                    <?php
                                                        if(isset($_POST)):
                                                            if (isset($_POST["delete"])):
                                                                $styleController->deleteData();
                                                            endif;
                                                        endif;
                                                    ?>
                                                </form>
                                        </div>
                                    <?php
                                endif;
                            }
                        ?>
					</div>
					<div class="col-md-5 wrap-about pt-5 pt-md-5 pb-md-3 ftco-animate">
	          <div class="heading-section mb-4 my-5 my-md-0">
	          	<span class="subheading">About</span>
	            <h2 class="mb-4"><script>document.write(establishment.name);</script></h2>
	          </div>
	          <p><script>document.write(establishment.AboutUs);</script></p>
						<pc class="time">
							<span><a href="#"><script>document.write(establishment.tlf);</script></a></span>
						</p>
					</div>
				</div>
			</div>
		</section>

		
		<section class="ftco-section ftco-counter img ftco-no-pt" id="section-counter">
    	<div class="container">
    		<div class="row d-md-flex">
    			<div class="col-md-9">
    				<div class="row d-md-flex align-items-center">
                        <?php
                            for ($i=0; $i < 4; $i++) { 
                                if(isset($cuentaAtrasNum[$i])):
                                    ?>
                                        <div class="col-md-6 col-lg-3 mb-4 mb-lg-0 d-flex justify-content-center counter-wrap ftco-animate">
                                            <div class="block-18">
                                            <div class="text">
                                                <strong class="number" data-number="<?= $cuentaAtrasNum[$i]['datum'] ?>">0</strong>
                                                <span><?= $cuentaAtrasText[$i]['datum'] ?></span>
                                            </div>
                                            </div>
                                        </div>                                
                                    <?php
                                endif;
                            }
                        ?>
                    </div>
	          </div>
          </div>
          <div class="col-md-3 text-center text-md-left">
          	<p><script>document.write(establishment.description);</script></p>
          </div>
        </div>
    	</div>
    </section>

		<section class="ftco-section bg-light">
			<div class="container">
				<div class="row justify-content-center mb-5 pb-2">
          <div class="col-md-12 text-center heading-section ftco-animate">
          	<span class="subheading">Services</span>
          </div>
        </div>
        <div class="row">
            <?php
                for ($i=0; $i < 3; $i++) { 
                    if(isset($servicesImg[$i])):
                        ?>
                            <div class="col-md-4 d-flex align-self-stretch ftco-animate text-center">
                                <div class="media block-6 services d-block">
                                <div class="icon d-flex justify-content-center align-items-center">
                                        <img src="<?= $servicesImg[$i]['datum'] ?>" alt="">
                                </div>
                                <div class="media-body p-2 mt-3">
                                    <h3 class="heading"><?= $servicesTitle[$i]['datum'] ?></h3>
                                    <p><?= $servicesTxt[$i]['datum'] ?></p>

                                </div>
                                </div>      
                            </div>                              
                        <?php
                    endif;
                }
            ?>
        </div>
			</div>
		</section>
    
		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center mb-5 pb-2">
          <div class="col-md-12 text-center heading-section ftco-animate">
          	<span class="subheading">Trabajores favoritos</span>
          </div>
        </div>	
				<div class="row">
                    <?php
                        for ($i=0; $i < 3; $i++) { 
                            if(isset($trabajadoresImg[$i])):
                                ?>
                                    <div class="col-md-6 col-lg-3 ftco-animate">
                                        <div class="staff">
                                            <div class="img" style="background-image: url(<?= $trabajadoresImg[$i]['datum'] ?>);"></div>
                                            <div class="text pt-4">
                                                <h3><?= $trabajadoresTitle[$i]['datum'] ?></h3>
                                                <span class="position mb-2"><?= $trabajadoresTxt[$i]['datum'] ?></span>
                                                    <div class="faded">
                                                    
                                                        
                                                    </div>  
                                                </div>
                                            </div>  
                                        </div>
                                    </div>                           
                                <?php
                            endif;
                        }
                    ?>
				</div>
			</div>
		</section>
        <?php
            for ($i=0; $i < 1; $i++) { 
                if(isset($reservaImg[$i])):
                    ?>
                        
                        <section class="ftco-section img" style="background-image: url(<?= $reservaImg[$i]['datum'] ?>)" data-stellar-background-ratio="0.5">
                            <div class="container">
                                <div class="row d-flex">
                        <div class="col-md-7 ftco-animate makereservation p-4 px-md-5 pb-md-5">
                            <div class="heading-section ftco-animate mb-5 text-center">
                                <span class="subheading">Book a table</span>
                                <h2 class="mb-4">Reservar</h2>
                            </div>
                            <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">DNI</label>
                                    <input type="text" class="form-control" placeholder="Tu DNI" name="DNI">
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" class="form-control" placeholder="Tu nombre" name="name">
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" placeholder="Tu correo" name="email">
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha</label>
                                    <input type="text" class="form-control" id="book_date" placeholder="Date" name="date">
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Hora</label>
                                    <input type="text" class="form-control" id="book_time" placeholder="Time" name="time">
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">N Person</label>
                                    <div class="select-wrap one-third">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="person" id="" class="form-control">
                                        <option value="0">Person</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4+</option>
                                    </select>
                                    <input type="hidden" name="reservaEnvio">
                                    <input type="hidden" name="establishment" id="establishment">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                <div class="form-group text-center">
                                    <input type="submit" value="Make a Reservation" class="btn btn-primary py-3 px-5">
                                    <?php
                                        if(isset($_POST)):
                                            if (isset($_POST["reservaEnvio"])):
                                                $styleController->reservar();
                                            endif;
                                        endif;
                                    ?>
                                </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        </div>
                            </div>
                        </section>                          
                    <?php
                else:
                    ?>
                    <div class="col-md-6 col-lg-4 ftco-animate">
                        <div class="staff">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reservar">
                                Ingresa una imagen para disponer de reservar
                            </button>
                        </div>
                    </div>
                    <?php
                endif;
            }
        ?>
		
		
		<section class="ftco-section bg-light">
			<div class="container">
				<div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Blog</span>
            <h2 class="mb-4">Recent Posts</h2>
          </div>
        </div>
				<div class="row">
                    
                <?php
                        for ($i=0; $i < 3; $i++) { 
                            if(isset($blogImg[$i])):
                                $d = new DateTime($blogImg[$i]['created_at']);
                                setlocale(LC_ALL, 'spanish');
                                $monthNum  = $d->format('m');
                                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                                $monthName = strftime('%B', $dateObj->getTimestamp());
                                $fecha = $d->format('d').' de '.$monthName.' del '.$d->format('y');
                                ?>
                                
                                    <div class="col-md-4 ftco-animate">
                                        <div class="blog-entry">
                                        <a class="block-20" style="background-image: url(<?= $blogImg[$i]['datum'] ?>);">
                                        </a>
                                        <div class="text pt-3 pb-4 px-4">
                                            <div class="meta">
                                            <div><a><?= $fecha ?></a></div>
                                            </div>
                                            <h3 class="heading"><?= $blogTitle[$i]['datum'] ?></h3>
                                            <p><?= $blogTxt[$i]['datum'] ?></p>
                                        </div>
                                        </div>
                    </div>                        
                                <?php
                            endif;
                        }
                    ?>
		</section>
  <!-- loader -->

  <script src="./views/style3/js/jquery.min.js"></script>
  <script src="./views/style3/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="./views/style3/js/popper.min.js"></script>
  <script src="./views/style3/js/bootstrap.min.js"></script>
  <script src="./views/style3/js/jquery.easing.1.3.js"></script>
  <script src="./views/style3/js/jquery.waypoints.min.js"></script>
  <script src="./views/style3/js/jquery.stellar.min.js"></script>
  <script src="./views/style3/js/owl.carousel.min.js"></script>
  <script src="./views/style3/js/jquery.magnific-popup.min.js"></script>
  <script src="./views/style3/js/aos.js"></script>
  <script src="./views/style3/js/jquery.animateNumber.min.js"></script>
  <script src="./views/style3/js/bootstrap-datepicker.js"></script>
  <script src="./views/style3/js/jquery.timepicker.min.js"></script>
  <script src="./views/style3/js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="./views/style3/js/google-map.js"></script>
  <script src="./views/style3/js/main.js"></script>
    
<script>
    var inputs = document.querySelectorAll('#establishment');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = establishment.id;
        var value = inputs[i].value;
        console.log(value);
    }
</script>
  </body>
</html>