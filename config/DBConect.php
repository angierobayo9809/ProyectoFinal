<?php
    class Database { 
        public $db;   // handle of the db connexion    
        private static $dns = "mysql:host=localhost;dbname=colegio"; 
        private static $user = "root"; 
        private static $pass = "";     
        private static $instance;

        public function __construct ()  
        {        
            $this->db = new PDO(self::$dns,self::$user,self::$pass);       
        } 

        // Se crea la instancia de la clase Database.
        // Se instancia la clase para iniciarla y poder acceder a las propiedades.
        public static function getInstance()
        { 
            if(!isset(self::$instance)) 
            { 
                $object= __CLASS__; 
                self::$instance=new $object; 
            } 
            return self::$instance; 
        } 

        public function DatosAutenticacion($username,$password) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombres,apellidos,username,role,identificacion from users where username=:username and password=:password"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("username" => $username,"password" => md5($password)); 
            $result->execute($params); 
            return ($result); 
        } 

        public function Registrar($username,$password,$nombres,$apellidos,$identificacion,$role) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO users (username,password,nombres,apellidos,identificacion,role) VALUES (:username, :password, :nombres, :apellidos, :identificacion, :role)");
                $result->execute(
                                    array(
                                        ':username'=>$username, 
                                        ':password'=>$password, 
                                        ':nombres'=>$nombres, 
                                        ':apellidos'=>$apellidos, 
                                        ':identificacion'=>$identificacion,
                                        ':role'=>$role
                                    )
                                );
                return "5";
            } catch(PDOException $e) {
                return "0";
            }
        } 


        public function ValidacionCorreo($username) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombres,apellidos,username,role from users where username=:username"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("username" => $username); 
            $result->execute($params); 
            return ($result); 
        } 

        public function DatosRoles() { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombre from roles"; 
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 


        public function DatosUsuarios() { 
            $conexion = Database::getInstance(); 
            $sql  ="SELECT users.id,users.nombres,users.apellidos,users.username,users.password,users.role,roles.nombre as role from users "; 
            $sql .="LEFT JOIN roles on (users.role=roles.id) ";
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function editUsuario($id) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombres,apellidos,username,password,role,identificacion from users where id=:id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("id" => $id); 
            $result->execute($params);
            return $result; 
        } 

        public function updateUsuario($id,$nombres,$apellidos,$username,$role,$password,$identificacion) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE users set nombres=:nombres,apellidos=:apellidos,username=:username,role=:role,password=:password,identificacion=:identificacion where id=:id ");
                $result->execute(
                                    array(
                                        ':nombres'=>$nombres,
                                        ':apellidos'=>$apellidos,
                                        ':username'=>$username,
                                        ':role'=>$role,
                                        ':password'=>$password,
                                        ':identificacion'=>$identificacion,
                                        ':id'=>$id
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        } 


        public function EliminarUsuario($id){
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM users WHERE id=?");
                $result->execute(array($id));

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        }

        public function DatosEstudiantes() { 
            $conexion = Database::getInstance(); 
            $sql  ="SELECT id,identificacion,nombres,apellidos,email,telefono,eps,tipoSanguineo,acudiente from estudiantes ";
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function CrearEstudiante($identificacion,$nombres,$apellidos,$email,$telefono,$eps,$tipoSanguineo,$acudiente) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO estudiantes (identificacion,nombres,apellidos,email,telefono,eps,tipoSanguineo,acudiente) VALUES (:identificacion,:nombres,:apellidos,:email,:telefono,:eps,:tipoSanguineo,:acudiente)");
                $result->execute(
                                    array(
                                        ':identificacion'=>$identificacion,
                                        ':nombres'=>$nombres,
                                        ':apellidos'=>$apellidos,
                                        ':email'=>$email,
                                        ':telefono'=>$telefono,
                                        ':eps'=>$eps,
                                        ':tipoSanguineo'=>$tipoSanguineo,
                                        ':acudiente'=>$acudiente
                                    )
                                );
                return "2";
            } catch(PDOException $e) {
                return "0";
            }
        }

        public function editEstudiante($id) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,identificacion,nombres,apellidos,email,telefono,eps,tipoSanguineo,acudiente from estudiantes where id=:id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("id" => $id); 
            $result->execute($params);
            return $result; 
        } 

        public function updateEstudiante($id,$nombres,$apellidos,$email,$telefono,$identificacion,$eps,$tipoSanguineo,$acudiente) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE estudiantes set nombres=:nombres,apellidos=:apellidos,email=:email,telefono=:telefono,identificacion=:identificacion,eps=:eps,tipoSanguineo=:tipoSanguineo,acudiente=:acudiente where id=:id ");
                $result->execute(
                                    array(
                                        ':nombres'=>$nombres,
                                        ':apellidos'=>$apellidos,
                                        ':email'=>$email,
                                        ':telefono'=>$telefono,
                                        ':identificacion'=>$identificacion,
                                        ':id'=>$id,
                                        ':eps'=>$eps,
                                        ':tipoSanguineo'=>$tipoSanguineo,
                                        ':acudiente'=>$acudiente
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        }
        
        public function EliminarEstudiante($id){
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM estudiantes WHERE id=?");
                $result->execute(array($id));

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        }


        public function DatosMaterias() { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombre,esElectiva,notaMin,notaMax from materias"; 
            $result = $conexion->db->prepare($sql);    
            $result->execute(); 
            return $result; 
        } 

        public function EliminarMateria($id){
            try{
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("DELETE FROM materias WHERE id=?");
                $result->execute(array($id));

                return "1";
            }catch (PDOException $e) {
                return "0";
            }
        }

        public function CrearMateria($nombre,$notaMin,$notaMax,$esElectiva) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("INSERT INTO materias (nombre,esElectiva,notaMin,notaMax) VALUES (:nombre,:esElectiva,:notaMin,:notaMax)");
                $result->execute(
                                    array(
                                        ':nombre'=>$nombre,
                                        ':esElectiva'=>$esElectiva,
                                        ':notaMin'=>$notaMin,
                                        ':notaMax'=>$notaMax
                                    )
                                );
                return "2";
            } catch(PDOException $e) {
                return "0";
            }
        } 

        public function editMateria($id) { 
            $conexion = Database::getInstance(); 
            $sql="SELECT id,nombre,esElectiva,notaMin,notaMax from materias where id=:id"; 
            $result = $conexion->db->prepare($sql);     
            $params = array("id" => $id); 
            $result->execute($params);
            return $result; 
        } 

        public function updateMateria($nombre,$id,$notaMin,$notaMax,$esElectiva) { 

            try {
                $conexion = Database::getInstance(); 
                $result = $conexion->db->prepare("UPDATE materias set nombre=:nombre,esElectiva=:esElectiva,notaMin=:notaMin,notaMax=:notaMax where id=:id ");
                $result->execute(
                                    array(
                                        ':nombre'=>$nombre,
                                        ':id'=>$id,
                                        ':esElectiva'=>$esElectiva,
                                        ':notaMin'=>$notaMin,
                                        ':notaMax'=>$notaMax
                                    )
                                );
                return "3";
            } catch(PDOException $e) {
                return "0";
            }
        }
    }
?>