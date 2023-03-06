<?php

require "./models/data/Usuario.IDao.php";
require "./models/data/Persona.Dao.php";

class UsuarioDao extends PersonaDao implements UsuarioIDao
{
   public function __construct()
   {
      parent::__construct();
   }

   public function usuarioFindAll()
   {
      try {
         $query = $this->modelsData->connect()->prepare("SELECT * FROM usuario");
         $query->execute();
         $cnt = $query->rowCount();
         if ($cnt > 0) {
            return $query->fetchAll(PDO::FETCH_OBJ);
         } else {
            $array = ["fail" => "No hay datos para Mostrar.", "tipo" => "warning"];
            $object =  (object) $array;
            return $object;
         }
      } catch (PDOException $e) {
         $array = ["fail" => $e->getMessage(), "tipo" => "danger"];
         $object =  (object) $array;
         return $object;
      } finally {
         $query = null;
      }
   }

   public function usuarioSave(UsuarioEntity $usuario)
   {
      $findPersona = $this->personaFindOne($usuario->getId_persona());
      if (count($findPersona) == 1) {
         if ($usuario->getId() != null && $usuario->getId() > 0) {
            try {
               $sql = 'UPDATE usuario SET id_persona = :id_persona, id_grupo = :id_grupo, user = :user, password = :password, update_at = :update_at, state = :state WHERE id = :id';
               $query = $this->modelsData->connect()->prepare($sql);
               $query->execute([
                  "id" => $usuario->getId(),
                  "id_persona" => $usuario->getId_persona(),
                  "id_grupo" => $usuario->getId_grupo(),
                  "user" => $usuario->getUser(),
                  "password" => $usuario->getPassword(),
                  "update_at" => $usuario->getUpdate_at(),
                  "state" => $usuario->getState()
               ]);
               $cnt = $query->rowCount();
               if ($cnt > 0) {
                  $array = ["success" => "Se Actualizo correctamente.", "tipo" => "success"];
                  $object =  (object) $array;
                  return $object;
               } else {
                  $array = ["fail" => "No se pudo Actualizar.", "tipo" => "warning"];
                  $object =  (object) $array;
                  return $object;
               }
            } catch (PDOException $e) {
               $array = ["fail" => $e->getMessage(), "tipo" => "danger"];
               $object =  (object) $array;
               return $object;
            } finally {
               $query = null;
            }
         } else {
            try {
               $sql = 'INSERT INTO usuario ( id_persona, id_grupo, user, password, create_at, state) VALUES ( :id_persona, :id_grupo, :user, :password, :create_at, :state)';
               $query = $this->modelsData->connect()->prepare($sql);
               $query->execute([
                  "id_persona" => $usuario->getId_persona(),
                  "id_grupo" => $usuario->getId_grupo(),
                  "user" => $usuario->getUser(),
                  "password" => $usuario->getPassword(),
                  "create_at" => $usuario->getCreate_at(),
                  "state" => $usuario->getState()
               ]);
               $cnt = $query->rowCount();
               if ($cnt > 0) {
                  $array = ["success" => "Se Registro correctamente.", "tipo" => "success"];
                  $object =  (object) $array;
                  return $object;
               } else {
                  $array = ["fail" => "No se pudo registrar.", "tipo" => "warning"];
                  $object =  (object) $array;
                  return $object;
               }
            } catch (PDOException $e) {
               $array = ["fail" => $e->getMessage(), "tipo" => "danger"];
               $object =  (object) $array;
               return $object;
            } finally {
               $query = null;
            }
         }
      }
   }

   public function usuarioFindOne($id)
   {
      try {
         $query = $this->modelsData->connect()->prepare("SELECT U.id, U.id_persona , U.id_grupo, U.user, U.password, U.state, CONCAT(P.name, ' ', P.surname) as person FROM usuario U INNER JOIN persona P ON U.id_persona = P.id WHERE U.id = :id");
         $query->execute(["id" => $id]);
         $cnt = $query->rowCount();
         if ($cnt > 0) {
            return $query->fetchAll(PDO::FETCH_OBJ);
         } else {
            $array = ["fail" => "No hay datos para Mostrar.", "tipo" => "warning"];
            $object =  (object) $array;
            return $object;
         }
      } catch (PDOException $e) {
         $array = ["fail" => $e->getMessage(), "tipo" => "danger"];
         $object =  (object) $array;
         return $object;
      } finally {
         $query = null;
      }
   }

   public function usuarioDelete($id)
   {
      try {
         $query = $this->modelsData->connect()->prepare("DELETE FROM usuario WHERE id = :id");
         $query->execute(["id" => $id]);
         $cnt = $query->rowCount();
         if ($cnt > 0) {
            $array = ["success" => "Se elimino correctamente.", "tipo" => "success"];
            $object =  (object) $array;
            return $object;
         } else {
            $array = ["fail" => "No se pudo eliminar.", "tipo" => "warning"];
            $object =  (object) $array;
            return $object;
         }
      } catch (PDOException $e) {
         $array = ["fail" => $e->getMessage(), "tipo" => "danger"];
         $object =  (object) $array;
         return $object;
      } finally {
         $query = null;
      }
   }

   public function usuarioLogin(UsuarioEntity $usuario)
   {
      try {
         $query = $this->modelsData->connect()->prepare("SELECT U.user, U.password, P.name FROM usuario U INNER JOIN persona P ON U.id_persona = P.id WHERE user = :user");

         $query->execute([
            "user" => $usuario->getUser()
         ]);

         if ($query->rowCount() > 0) {
            $verificar = $query->fetch(PDO::FETCH_OBJ);

            if (password_verify($usuario->getPassword(), $verificar->password)) {
               $token = md5(uniqid(mt_rand(), true)) . (microtime(true));

               // $array = ["success" => "Datos correctos.", "tipo" => "success"];
               // $object =  (object) $array;
               // return $object;

               return $this->updateToken($verificar, $token);
            } else {
               $array = ["fail" => "Clave incorrecto.", "tipo" => "warning"];
               $object =  (object) $array;
               return $object;
            }
         } else {
            $array = ["fail" => "Usuario incorrecto.", "tipo" => "warning"];
            $object =  (object) $array;
            return $object;
         }
      } catch (PDOException $e) {
         $array = ["fail" => $e->getMessage(), "tipo" => "danger"];
         $object =  (object) $array;
         return $object;
      } finally {
         $query = null;
      }
   }


   public function updateToken($usuario, $token)
   {
      try {
         $sql = "UPDATE usuario SET token = :token WHERE user = :user AND password = :password";
         $query = $this->modelsData->connect()->prepare($sql);
         $query->execute([
            "user" => $usuario->user,
            "password" => $usuario->password,
            "token" => $token
         ]);

         if ($query->rowCount() > 0) {

            setcookie("token", $token, time() + 600, '/');
            setcookie("user", $usuario->user, time() + 600, '/');

            $array = ["success" => "Datos correctos.", "tipo" => "success"];
            $object =  (object) $array;
            return $object;
         } else {
            $array = ["fail" => "No se pudo registrar el Token.", "tipo" => "warning"];
            $object =  (object) $array;
            return $object;
         }
      } catch (PDOException $e) {
         $array = ["fail" => $e->getMessage() . " Fallo al designar el token", "tipo" => "danger"];
         $object =  (object) $array;
         return $object;
      } finally {
         $query = null;
      }
   }
}
