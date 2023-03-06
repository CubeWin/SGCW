<?php

require "./models/data/Persona.IDao.php";

class PersonaDao extends Models implements PersonaIDao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function personaFindAll()
    {
        try {
            $query = $this->modelsData->connect()->prepare("SELECT * FROM persona");
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

    public function personaFindByNameAndSurname($dato)
    {
        try {
            $sql = "SELECT * FROM persona WHERE name LIKE CONCAT('%', :name, '%') OR surname LIKE CONCAT('%', :surname, '%')";
            $query = $this->modelsData->connect()->prepare($sql);
            $query->execute([
                "name" => $dato,
                "surname" => $dato
            ]);
            $cnt = $query->rowCount();
            if ($cnt > 0) {
                return $query->fetchAll(PDO::FETCH_OBJ);
            } else {
                $array = ["fail" => "No hay datos para Mostrar.".$sql, "tipo" => "warning"];
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

    public function personaSave(PersonaEntity $persona)
    {
        if ($persona->getId() != null && $persona->getId() > 0) {
            try {
                $sql = 'UPDATE persona SET name = :name, surname = :surname, telephone = :telephone, email = :email, gender = :gender, update_at = :update_at, state = :state WHERE id = :id';
                $query = $this->modelsData->connect()->prepare($sql);
                $query->execute([
                    "id" => $persona->getId(),
                    "name" => $persona->getName(),
                    "surname" => $persona->getSurname(),
                    "telephone" => $persona->getTelephone(),
                    "email" => $persona->getEmail(),
                    "gender" => $persona->getGender(),
                    "update_at" => $persona->getUpdate_at(),
                    "state" => $persona->getState()
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
                $sql = 'INSERT INTO persona( name, surname, telephone, email, gender, create_at, state) VALUES (:name, :surname, :telephone, :email, :gender, :create_at, :state)';
                $query = $this->modelsData->connect()->prepare($sql);
                $query->execute([
                    "name" => $persona->getName(),
                    "surname" => $persona->getSurname(),
                    "telephone" => $persona->getTelephone(),
                    "email" => $persona->getEmail(),
                    "gender" => $persona->getGender(),
                    "create_at" => $persona->getCreate_at(),
                    "state" => $persona->getState()
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

    public function personaFindOne($id)
    {
        try {
            $query = $this->modelsData->connect()->prepare("SELECT id, name, surname, telephone, email, gender, state FROM persona WHERE id = :id");
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

    public function personaDelete($id)
    {
        try {
            $query = $this->modelsData->connect()->prepare("DELETE FROM persona WHERE id = :id");
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
            $array = ["fail" => $e->getMessage(). "\n\nRecuerde Eliminar las cuentas de usuario enlazadas a esta persona", "tipo" => "danger"];
            $object =  (object) $array;
            return $object;
        } finally {
            $query = null;
        }
    }
}
