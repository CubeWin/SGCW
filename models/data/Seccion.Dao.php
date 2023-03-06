<?php

require "./models/data/Seccion.IDao.php";

class SeccionDao extends Models implements SeccionIDao
{
    private $sql = "";
    private $query = null;
    private $count = 0;
    private $response = null;

    public function __construct()
    {
        parent::__construct();
    }

    public function seccionPageAll()
    {
        try {
            $this->sql = "SELECT P.id, P.nombre, S.id, S.nombre FROM seccion S INNER JOIN page P ON S.id_page = P.id;";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute();
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

    public function seccionPageName($id)
    {
        try {
            $this->sql = "SELECT S.nombre, P.nombre FROM seccion S INNER JOIN page P ON S.id_page = P.id WHERE S.id = :id";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "id" => $id
            ]);
            $this->count = $this->query->rowCount();
            if ($this->count > 0) {
                $this->response = $this->query->fetchAll(PDO::FETCH_OBJ);
            } else {
                $this->response = (object) ["fail" => "No hay datos que mostrar", "tipo" => "warning"];
            }
        } catch (PDOException $e) {
            $this->response = (object) ["fail" => $e->getMessage(), "tipo" => "danger"];
        }
    }

    public function seccionFinById($id)
    {
        try {
            $this->sql = "SELECT DT.id, DT.contenido, D.grupo, D.id id_detalle_pk, D.id_detalle id_detalle, B.id id_bloque, B.nombre, B.iterable FROM detalle D RIGHT JOIN detalle_texto DT ON D.id = DT.id_detalle INNER JOIN bloque B ON D.id_bloque = B.id
            WHERE D.id_seccion = :id_seccion ORDER BY  B.iterable ASC, D.id_detalle, B.id, D.grupo";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "id_seccion" => $id
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

    public function seccionViewHtml($id)
    {
    }

    public function bloqueViewHtml($id)
    {
    }

    public function disableSeccion($id)
    {
        try {
            $estadoSeccion = null;
            $state = null;
            $this->sql = "SELECT id, estado FROM seccion WHERE id = :id";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "id" => $id
            ]);
            $this->count = $this->query->rowCount();
            if ($this->count > 0) {
                $estadoSeccion = $this->query->fetchAll(PDO::FETCH_OBJ);
                $this->query = null;
                $state = ($estadoSeccion["estado"] == 1) ? 0 : 1;
                if ($state != null) {
                    $this->sql = "UPDATE seccion SET estado = :estado WHERE id = :id";
                    $this->query = $this->modelsData->connect()->prepare($this->sql);
                    $this->query->execute([
                        "id" => $id,
                        "estado" => $state
                    ]);
                    $this->count = $this->query->rowCount();
                    $resEstado = ($state == 1) ? "habilito" : "deshabilito";
                    if ($this->count > 0) {
                        $this->response = (object) ["success" => "Se " . $resEstado . " correctamente.", "tipo" => "success"];
                    } else {
                        $this->response = (object) ["fail" => "No se completo la tarea", "tipo" => "warning"];
                    }
                }
                // $this->response = (object) ["success" => "Se deshabilito correctamente", "tipo" => "success"];
            } else {
                $this->response = (object) ["fail" => "No se completo la tarea", "tipo" => "warning"];
            }
        } catch (PDOException $e) {
            $this->response = (object) ["fail" => $e->getMessage(), "tipo" => "danger"];
        } finally {
            return $this->response;
            $this->query = null;
        }
    }

    public function deleteDetalle($id)
    {
        try {
            $this->sql = "DELETE FROM detalle WHERE id = :id";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "id" => $id
            ]);
            $this->count = $this->query->rowCount();
            if ($this->count > 0) {
                $this->response = (object) ["success" => "se elimino correctamente", "tipo" => "success"];
            } else {
                $this->response = (object) ["fail" => "no se pudo realizar la tarea", "tipo" => "warning"];
            }
        } catch (PDOException $e) {
            $this->response = (object) ["fail" => $e->getMessage(), "tipo" => "danger"];
        } finally {
            return $this->response;
            $this->query = null;
        }
    }

    public function updateDetalleTexto($id, $contenido)
    {
        try {
            $this->sql = "UPDATE detalle_texto SET contenido = :contenido WHERE id = :id";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "id" => $id,
                "contenido" => $contenido
            ]);
            $this->count = $this->query->rowCount();
            if ($this->count > 0) {
                $this->response = (object) ["success" => "Se actualizo correctamente.", "tipo" => "success"];
            } else {
                $this->response = (object) ["fail" => "No se encontraron los datos.", "tipo" => "warning"];
            }
        } catch (PDOException $e) {
            $this->response = (object) ["fail" => $e->getMessage(), "tipo" => "danger"];
        } finally {
            return $this->response;
            $this->query = null;
        }
    }

    public function createDetalleTexto($seccion, $bloque, $id_detalle)
    {
        try {
            $selectBloque = null;
            $getIdDetalle = 0;
            $nextNumb = 0;
            /**
             * Busqueda del bloque para insertar
             */
            $this->sql = "SELECT  b.id, ce.linea FROM bloque b INNER JOIN contenido_html ch ON b.id = ch.id_bloque INNER JOIN contenido_editable ce ON ch.id = ce.id_contenido_html WHERE b.id = :id";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "id" => $bloque
            ]);
            $this->count = $this->query->rowCount();
            if ($this->count > 0) {
                $selectBloque = $this->query->fetchAll(PDO::FETCH_OBJ);
                /**
                 * insertamos en la tabla detalle
                 */
                $nextNumb = $this->nextOrden($seccion, $bloque, $id_detalle);
                $this->query = null;
                $this->sql = "INSERT INTO detalle (seccion, bloque, id_detalle, n_orden) VALUES (:seccion, :bloque, :id_detalle, :orden)";
                $this->query = $this->modelsData->connect()->prepare($this->sql);
                $this->query->execute([
                    "seccion" => $seccion,
                    "bloque" => $bloque,
                    "id_detalle" => $id_detalle,
                    "orden" => $nextNumb
                ]);
                $this->count = $this->query->rowCount();
                if ($this->count > 0) {
                    $getIdDetalle = $this->modelsData->connect()->lastInsertId();
                    /**
                     * insertamos el contenido en la tabla detalle_texto
                     */
                    foreach ($selectBloque as $bloq) {
                        $this->query = null;
                        $this->sql = "INSERT INTO detalle_texto (id_detalle, contenido, linea) VALUES (:id_detalle, '', :linea)";
                        $this->query = $this->modelsData->connect()->prepare($this->sql);
                        $this->query->execute([
                            "id_detalle" => $getIdDetalle,
                            "linea" => $bloq["linea"]
                        ]);
                    }
                } else {
                    $this->response = (object) ["fail" => "no se completo la tarea", "tipo" => "warning"];
                }
            } else {
                $this->response = (object) ["fail" => "no se encontro el bloque.", "tipo" => "warning"];
            }
        } catch (PDOException $e) {
            $this->response = (object) ["fail" => $e->getMessage(), "tipo" => "danger"];
        } finally {
            return $this->response;
            $this->query = null;
        }
    }

    public function readDetalleTexto($id)
    {
        try {
            $this->sql = "SELECT * FROM detalle_texto DT INNER JOIN detalle D ON DT.id_detalle = D.id WHERE id = :id";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "id" => $id
            ]);
            $this->count = $this->query->rowCount();
            if ($this->count > 0) {
                $this->response = $this->query->fetchAll(PDO::FETCH_OBJ);
            } else {
                $this->response = (object) ["fail" => "No se encontraron datos.", "tipo" => "warning"];
            }
        } catch (PDOException $e) {
            $this->response = (object) ["fail" => $e->getMessage(), "tipo" => "danger"];
        } finally {
            return $this->response;
            $this->query = null;
        }
    }

    public function nextOrden($seccion, $bloque, $id_detalle)
    {
        try {
            $tmp = null;
            $this->query = null;
            $this->sql = "SELECT n_orden + 1 orden FROM detalle WHERE id_seccion = :seccion AND id_bloque = :bloque AND id_detalle = :id_detalle ORDER BY n_orden DESC limit 1";
            $this->query = $this->modelsData->connect()->prepare($this->sql);
            $this->query->execute([
                "seccion" => $seccion,
                "bloque" => $bloque,
                "id_detalle" => $id_detalle
            ]);
            $this->count = $this->query->rowCount();
            if ($this->count > 0) {
                $tmp = $this->query->fetchAll(PDO::FETCH_OBJ);
                return $tmp["orden"];
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
