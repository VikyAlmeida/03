<?php
class ControllerCategory{
    public function ctrGetCategories($condition) {
        $categories = CategoriesModel::get($condition);
        return $categories;
    }
    public function ctr
    public function ctrAllCategories() {
        $categories = CategoriesModel::all();
        return $categories;
    }
    public function ctrInsertCategories(&$errores) {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){            
            $condicion = "name like '".$_POST["name"]."'";
            $category = CategoriesModel::get($condicion);

            if (!$category):
                $name =  Generales::sanar_datos($_POST["name"],'string', $errores, 'nombre');
                $description =  Generales::sanar_datos($_POST["description"],'string', $errores, 'descripcion');       
                $photo = Generales::foto($_FILES["photo"],"./views/style1/img/users/", $errores);
                
                $datos = compact('name','description', 'photo');
                
                if(CategoriesModel::insert($datos)):                  
                    echo "<script>
                            Swal.fire(
                                'Insertada!',
                                'Se ha registrado la categoria ".$name." en el sistema.',
                                'success'
                            ).then( () => window.location='login');
                         </script>"; 
                else:
                    echo "<script>
                            Swal.fire(
                                'Oops...!',
                                'Esa categoria ya existe en nuestro sistema.',
                                'error'
                            );
                        </script>"; 
                endif;
            else:
                echo "<script>
                        Swal.fire(
                            'Oops...!',
                            'Esa categoria ya existe en nuestro sistema.',
                            'error'
                        );
                    </script>"; 
            endif;
        }
    }
    public function ctrUpdateCategories() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){     
            echo "hola";
            $id = $_POST["id"];
            $name =  Generales::sanar_datos($_POST["name"],'string', $errores, 'nombre');
            $description =  Generales::sanar_datos($_POST["description"],'string', $errores, 'descripcion');        
            $photo = Generales::foto($_FILES["photo"],"./views/style1/img/users/", $errores);
            var_dump($_POST);
            $datos = compact('name','description', 'photo');
            
            if(CategoriesModel::update($datos, $id)):                  
                echo "<script>
                        Swal.fire(
                            'Actualizada!',
                            'Se ha actualizado la categoria ".$name." en el sistema.',
                            'success'
                        ).then( () => window.location='menu');
                        </script>"; 
            else:
                echo "<script>
                        Swal.fire(
                            'Oops...!',
                            'Esa categoria no existe en nuestro sistema.',
                            'error'
                        );
                    </script>"; 
            endif;
        }
    }
    public function ctrDeleteCategories() {   
        if($_SERVER['REQUEST_METHOD'] === 'POST'){    
            $condicion = "id like '".$_POST["id"]."'";
            $category = CategoriesModel::get($condicion);

            if ($category):
                if(CategoriesModel::delete($condicion)):                  
                    echo "<script>
                            Swal.fire(
                                'Eliminada!',
                                'Se ha eliminado la categoria ".$category["name"]." en el sistema.',
                                'success'
                            ).then( () => window.location='menu');
                            </script>"; 
                else:
                    echo "<script>
                            Swal.fire(
                                'Oops...!',
                                'Esa categoria no existe en nuestro sistema.',
                                'error'
                            );
                        </script>"; 
                endif;
            else: 
                echo "<script>
                        Swal.fire(
                            'Oops...!',
                            'Esa categoria no existe en nuestro sistema.',
                            'error'
                        );
                    </script>"; 
            endif;
        }
    }
}