
<script src="./views/modules/private/partials/scripts.js"></script>
<!-- Modal -->

<?php
    $styleController = new ControllerStyle();
?>
<div class="modal fade" id="carrusel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Carrusel</h1>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row" id='carruselModal'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Titulo</label>
                                <input type="text" class="form-control" name="carruselTxt">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Imagen</label>
                                <input type="file" class="form-control" name="carruselImg">
                            </div>
                            <input type="hidden" name="newCarrusel">
                            <input type="hidden" name="id_establishment" id = 'establishment'>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                
                <?php
                    if(isset($_POST)):
                        if (isset($_POST["newCarrusel"])):
                            $styleController->validateDatum();
                        endif;
                    endif;
                ?>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="aboutUsImg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Carrusel</h1>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row" id='carruselModal'>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Imagen</label>
                                <input type="file" class="form-control" name="aboutUsImg">
                            </div>
                            <input type="hidden" name="newaboutUsImg">
                            <input type="hidden" name="id_establishment" id = 'establishment'>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                
                <?php
                    if(isset($_POST)):
                        if (isset($_POST["newaboutUsImg"])):
                            $styleController->validateDatum();
                        endif;
                    endif;
                ?>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cuentaAtras" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Carrusel</h1>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row" id='carruselModal'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Numero</label>
                                <input type="number" class="form-control" name="cuentaAtrasNum">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Titulo</label>
                                <input type="text" class="form-control" name="cuentaAtrasText">
                            <input type="hidden" name="id_establishment" id = 'establishment'>
                                <input type="hidden" name="cuentaAtras">
                            </div>
                        </div>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                
                <?php
                    if(isset($_POST)):
                        if (isset($_POST["cuentaAtras"])):
                            $styleController->validateDatum();
                        endif;
                    endif;
                ?>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="services" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Carrusel</h1>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row" id='carruselModal'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Titulo</label>
                                <input type="text" class="form-control" name="servicesTitle">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Texto</label>
                                <textarea name="servicesTxt" id=""></textarea>
                            <input type="hidden" name="id_establishment" id = 'establishment'>
                                <input type="hidden" name="services">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Imagen</label>
                                <input type="file" class="form-control" name="servicesImg">
                            </div>
                        </div>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                
                <?php
                    if(isset($_POST)):
                        if (isset($_POST["services"])):
                            $styleController->validateDatum();
                        endif;
                    endif;
                ?>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="trabajadores" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Carrusel</h1>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row" id='carruselModal'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Titulo</label>
                                <input type="text" class="form-control" name="trabajadoresTitle">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Texto</label>
                                <textarea name="trabajadoresTxt" id=""></textarea>
                            <input type="hidden" name="id_establishment" id = 'establishment'>
                                <input type="hidden" name="trabajadores">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Imagen</label>
                                <input type="file" class="form-control" name="trabajadoresImg">
                            </div>
                        </div>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                
                <?php
                    if(isset($_POST)):
                        if (isset($_POST["trabajadores"])):
                            $styleController->validateDatum();
                        endif;
                    endif;
                ?>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="blog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Carrusel</h1>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row" id='carruselModal'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Titulo</label>
                                <input type="text" class="form-control" name="blogTitle">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Texto</label>
                                <textarea name="blogTxt" id=""></textarea>
                            <input type="hidden" name="id_establishment" id = 'establishment'>
                                <input type="hidden" name="blog">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Imagen</label>
                                <input type="file" class="form-control" name="blogImg">
                            </div>
                        </div>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                
                <?php
                    if(isset($_POST)):
                        if (isset($_POST["blog"])):
                            $styleController->validateDatum();
                        endif;
                    endif;
                ?>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="reservar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Carrusel</h1>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row" id='carruselModal'>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Imagen</label>
                                <input type="file" class="form-control" name="reservar">
                                <input type="hidden" name="id_establishment" id = 'establishment'>
                                <input type="hidden" name="reservar">
                            </div>
                        </div>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                
                <?php
                    if(isset($_POST)):
                        if (isset($_POST["reservar"])):
                            $styleController->validateDatum();
                        endif;
                    endif;
                ?>
            </form>
            </div>
        </div>
    </div>
</div>
<script>
    var inputs = document.querySelectorAll('#establishment');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = establishment.id;
        var value = inputs[i].value;
        console.log(value);
    }
</script>