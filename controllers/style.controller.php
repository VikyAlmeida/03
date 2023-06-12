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
}