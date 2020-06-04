<?php

require "./models/data/Content.IDao.php";

class ContentDao extends Models  implements ContentIDao
{

    private $sql = "";
    private $query = null;
    private $count = 0;
    private $response = null;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * LISTAR DE LA TABLA CENTRAL LOS ELEMENTOS EDITABLES
     */
    public function selectAll($final)
    {
        try {
            $this->sql = "SELECT id, content, id_tipo_texto, iterable_list FROM contenido_estatico WHERE id_final = :final";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "final" => $final
            ]);
            $this->count = $this->query->rowCount();
            if ($this->count > 0) {
                $this->response = $this->query->fetchAll(PDO::FETCH_OBJ);
            } else {
                $this->response = (object) ["fail" => "No hay datos para mostrar", "tipo" => "warning"];
            }
        } catch (PDOException $e) {
            $this->response = (object) ["fail" => $e->getMessage(), "tipo" => "danger"];
        } finally {
            return $this->response;
            $this->query = null;
        }
    }

    /**
     * EDITAR EL TEXTO SELECCIONADO
     */
    public function updateOne($final, $content, $id)
    {
        try {
            $this->sql = "UPDATE contenido_estatico SET content = :content WHERE id = :id AND id_final = :id_final";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "content" => $content,
                "id" => $id,
                "id_final" => $final
            ]);
            $this->count = $this->query->rowCount();
            if ($this->count > 0) {
                $this->response = (object) ["success" => "Se actualizo correctamente.", "type" => "success"];
            } else {
                $this->response = (object) ["fail" => "No se encontro coincidencia para actualizar", "type" => "warning"];
            }
        } catch (PDOException $e) {
            $this->response = (object) ["fail" => $e->getMessage(), "type" => "danger"];
        } finally {
            return $this->response;
            $this->query = null;
        }
    }

    /**
     * DESABILITAR TODOS LOS BLOQUE, ACTUALIZAR EL ESTADO EN LA TABLA FINAL
     */
    public function disableContent($final)
    {
        try {
            $this->sql = "UPDATE final SET state = 0 WHERE id = :id";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "id" => $final
            ]);
            $this->count = $this->query->rowCount();
            if ($this->count > 0) {
                $this->response = (object) ["success" => "Se deshabilito correctamente.", "type" => "success"];
            } else {
                $this->response = (object) ["fail" => "No se encontro coincidencia para deshabilitar", "type" => "warning"];
            }
        } catch (PDOException $e) {
            $this->response = (object) ["fail" => $e->getMessage(), "type" => "danger"];
        } finally {
            return $this->response;
            $this->query = null;
        }
    }

    /**
     * MOSTRAR LA VISTA HTML
     */
    public function preView($final)
    {
        try {
            $this->sql = "CALL bloque(:id)";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "id" => $final
            ]);
            $this->count = $this->query->rowCount();
            if ($this->count > 0) {
                $this->response = $this->query->fetchAll(PDO::FETCH_OBJ);
            } else {
                $this->response = (object) ["fail" =>  "No se encontro coincidencia para mostrar.", "type" => "warning"];
            }
        } catch (PDOException $e) {
            $this->response = (object) ["fail" => $e->getMessage(), "type" => "danger"];
        } finally {
            return $this->response;
            $this->query = null;
        }
    }

    /**
     * SELECCIONAR EL CONTENIDO PARA ACTUALIZAR EL TEXTO
     */
    public function selectOne($final, $id)
    {
        try {
            $this->sql = "SELECT * FROM contenido_estatico WHERE id = :id AND id_final = :id_final";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "id" => $id,
                "id_final" => $final
            ]);
            $this->count = $this->query->rowCount();
            if ($this->count > 0) {
                $this->response = $this->query->fetchAll(PDO::FETCH_OBJ);
            } else {
                $this->response = (object) ["fail" => "No hay datos para mostrar", "tipo" => "warning"];
            }
        } catch (PDOException $e) {
            $this->response = (object) ["fail" => $e->getMessage(), "tipo" => "danger"];
        } finally {
            return $this->response;
            $this->query = null;
        }
    }

    /**
     * AGREGAR A LA TABLA CENTRAL UN CONTENIDO ITERABLE DESDE LA TABLA FANTASMA
     */
    public function createIterable($final)
    {
        $nexVal = 0;
        $fantasma = null;
        $valid_respuesta = false;
        try {
            $this->sql = "SELECT * FROM estatico_fantasma WHERE id_final = :id";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "id" => $final
            ]);
            $this->count = $this->query->rowCount();
            if ($this->count > 0) {
                $fantasma = $this->query->fetchAll(PDO::FETCH_OBJ);
                $this->query = null;
                $nexVal = $this->nextIterable($final);
                if ($nexVal > 0) {
                    foreach ($fantasma as $fant) {
                        $this->sql = "INSERT INTO contenido_estatico (id_seccion, id_tipo_texto, id_final, line, content, create_at, state, iterable_list) VALUES (:id_seccion, :id_tipo_texto, :id_final, :line, :content, :create_at, :state, :iterable_list)";
                        $this->query = $this->modelsData->connect()->prepare($this->sql);
                        $this->query->execute([
                            "id_seccion" => $fant[0],
                            "id_tipo_texto" => $fant[1],
                            "id_final" => $fant[2],
                            "line" => $fant[3],
                            "content" => "",
                            "create_at" => gmdate("Y-m-d H:i:s", time() + 3600 * (-6 + date("I"))),
                            "state" => 1,
                            "iterable_list" => $nexVal
                        ]);
                        $this->count = $this->query->rowCount();
                        if ($this->count > 0) {
                            $valid_respuesta = true;
                        } else {
                            $valid_respuesta = false;
                            break;
                        }
                    }
                    if ($valid_respuesta == true) {
                        $this->response = (object) ["success" => "Se registro un elemento mas correctamente.", "tipo" => "success"];
                    } else {
                        $this->response = (object) ["fail" => "No se completo el registro del elemento.", "tipo" => "danger"];
                    }
                } else {
                    $this->response = (object) ["fail" => "No se encontro la referencia al elemento.", "tipo" => "warning"];
                }
            } else {
                $this->response = (object) ["fail" => "No se puede registrar mas elementos de este tipo.", "tipo" => "warning"];
            }
        } catch (PDOException $e) {
            $this->response = (object) ["fail" => $e->getMessage(), "tipo" => "danger"];
        } finally {
            return $this->response;
            $this->query = null;
        }
    }

    /**
     * ELIMINAR UN ITERABLE POR EL BLOQUE
     */
    public function deleteIterable($final, $bloque)
    {
        try {
            $this->sql = "DELETE FROM contenido_estatico WHERE id_final = :id_final AND iterable_list = :bloque";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "id_final" => $final,
                "bloque" => $bloque
            ]);
            $this->count = $this->query->rowCount();
            if ($this->count > 0) {
                $this->response = (object) ["success" => "Se elimino correctamente.", "tipo" => "success"];
            } else {
                $this->response = (object) ["fail" => "No se encontro elemento para eliminar.", "tipo" => "warning"];
            }
        } catch (PDOException $e) {
            $this->response = (object) ["fail" => $e->getMessage(), "tipo" => "danger"];
        } finally {
            return $this->response;
            $this->query = null;
        }
    }

    /**
     * OBTENEMOS EL NUMERO SIGUIENTE PARA INSERTAR UN ITERABLE
     */
    public function nextIterable($final)
    {
        $tmp = null;
        try {
            $this->sql = "SELECT id_final, iterable_list FROM contenido_estatico GROUP BY id_final, iterable_list HAVING id_final = :id_final  ORDER BY iterable_list DESC limit 1";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "id_fina" => $final
            ]);
            $this->count = $this->query->rowCount();
            if ($this->count > 0) {
                $tmp = $this->query->fetchAll(PDO::FETCH_OBJ);
                return $tmp["iterable_list"] + 1;
            } else {
                return 1;
            }
        } catch (PDOException $e) {
            return -1;
        } finally {
            $this->query = null;
        }
    }
}
