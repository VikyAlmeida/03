<?php
class ControllerStyle{
    public function home($ruta) {
        if($_SERVER['REQUEST_METHOD'] === 'POST'):   
            if($ruta == 'banner'):     
                $name =  Generales::sanar_datos($_POST["name"],'string', $errores, 'nombre'); 
                $photo = Generales::foto($_FILES["banner_img"],"./views/style1/img/banner/", $errores);

                if ($_FILES["banner_img"]["size"]>0) {
                    $id = StyleModel::addData($photo);
                    StyleModel::delete(1);   
                    StyleModel::addStyleHome($id,1);
                } 
                if ($name) 
                    $id = StyleModel::addData($name);
                    StyleModel::delete(2);   
                    StyleModel::addStyleHome($id['id'],2);    
                
            else:
                $title =  Generales::sanar_datos($_POST["title"],'string', $errores, 'nombre'); 
                $subtitle =  Generales::sanar_datos($_POST["subtitle"],'string', $errores, 'nombre'); 
                $btn =  Generales::sanar_datos($_POST["btn"],'string', $errores, 'nombre'); 

                if ($title) {
                    $id = StyleModel::addData($title);
                    StyleModel::delete(3);   
                    StyleModel::addStyleHome($id['id'],3);
                } 
                if ($subtitle) {
                    $id = StyleModel::addData($subtitle);
                    StyleModel::delete(4);   
                    StyleModel::addStyleHome($id['id'],4); }
                if ($btn) {
                    $id = StyleModel::addData($btn);
                    StyleModel::delete(5);   
                    StyleModel::addStyleHome($id['id'],5); }
            endif;
            echo "<script>
            Swal.fire(
                'Insertada!',
                'Se ha registrado la categoria ".$name." en el sistema.',
                'success'
            ).then( () => window.location='preview');
         </script>"; 
        endif;
    }
    public static function getDataById($id) {
        $data = StyleModel::getDataById($id);
        return $data;
    }
    public function mostrarHome($section) {
        // recoger el id del la data que tiene esa section en style home
        $data = StyleModel::getDataBySection($section);
        // recoger la data por el id
        $data = self::getDataById($data['data']);
        return $data;
    }

    public function validateDatum () {
        if($_SERVER['REQUEST_METHOD'] === 'POST'):
            $sectionController = new ControllerSection();
            $id_establishment = $_POST['id_establishment'];
            foreach ($_POST as $key => $value) {
                $datum = Generales::sanar_datos($value,'string', $errores, ''); 
                if ($datum && $key !== 'id_establishment') {
                    $id_data = self::addData($datum)['id'];
                    $section = $sectionController->ctrGetSections("name like '".$key."'");
                    $section_id = $section['id'];
                    $datos = compact('section_id', 'id_data', 'id_establishment');
                    self::addStyle($datos);
                }
            }
            foreach ($_FILES as $key => $value) { 
                $datum = Generales::foto($_FILES[$key],"./views/style3/img/config/", $errores); 
                if ($datum && $key !== 'id_establishment') {
                    $section = $sectionController->ctrGetSections("name like '".$key."'");
                    $section_id = $section['id'];
                    $id_data = self::addData($datum)['id'];
                    $datos = compact('section_id', 'id_data', 'id_establishment');
                    self::addStyle($datos);
                }
            }             
            echo "<script>
                    Swal.fire(
                        'Insertada!',
                        'Se ha registrado el estilo en el sistema.',
                        'success'
                    ).then( () => window.location='previewEstablishment');
                 </script>"; 
        endif;
    }

    public static function addData($datum) {
        $id = StyleModel::addData($datum);
        return $id;
    }
    public static function addStyle($datos) {
        $data = StyleModel::addStyle($datos);
        return $data['id'];
    }
    public function showData($section){
        $establishment = explode("?", $_SERVER['REQUEST_URI'])[1];
        $query = 'SELECT * FROM style_establishment join data on data_id=id where establishments_id = '.$establishment;
        if ($section){
            $query .= ' && sections_id = '.$section;
        }
        $registros = StyleModel::getData($query);
        return $registros;
    }
    
    public function deleteData(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'): 
            foreach ($_POST['ids'] as $id) { 
                StyleModel::deleteStyle($id); 
                StyleModel::deleteData($id); 
            }
            echo "<script>
                    Swal.fire(
                        'Eliminada!',
                        'Se ha eliminado el estilo en el sistema.',
                        'success'
                    ).then( () => window.location='previewEstablishment');
                 </script>"; 
        endif;
    }
    public function reservar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'):
            try{
                $id_establishment = $_POST['establishment'];
                $establishmentController = new ControllerEstablishment();
                $establishment = $establishmentController->ctrGetEstablishment('id = '.$id_establishment);
                echo '<script> console.log('.  json_encode($establishment) .') </script>';
                $registros['email'] = $_POST['email'];
                $registros['name'] = $_POST['name'];
                $message = '
                <div style="padding:2em; border: 1px solid aqua; width: 30%; margin: 0 auto;">
                    <h1 style="color: rgb(3, 3, 142);">Se ha realizado una reserva en el establecimiento '.$establishment['name'].' por '.$_POST['name'].'</h1>
                    <h2>La reserva se efectuara en la fecha '.$_POST['date'].' a la hora '.$_POST['time'].', la reserva se ha efectuado para '.$_POST['person'].' personas</h2>
                    <p>La reserva ha sido registrada por la persona con DNI '.$_POST['DNI'].'</p>
                    <p>Un saludo!</p>
                </div>';
                $classEmail = new SendEmail();
                $classEmail->sendEmail($registros, 'Reserva', $message);
                echo "<script>
                        Swal.fire(
                            'Enviada!',
                            'Tu reserva ha sido enviada con exito.',
                            'success'
                        ).then( () => window.location='previewEstablishment');
                     </script>"; 
            }
            catch(PDOexception $e){ echo '<script>alert("'.$e->getMessage().'")</script>';echo $e->getMessage();}
        endif;
    }
}