<?php
require_once '../model/DB/Database.php';
require_once '../model/Libro.php';

class Controller {
    private $libro;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->libro = new Libro($db);
    }

    public function getAllLibros($search, $estado, $order) {
        return $this->libro->getAll($search, $estado, $order);
    }

    public function getLibroById($id) {
        return $this->libro->getById($id);
    }

    public function createLibro($titulo, $autor, $descripcion, $estado, $calificacion) {
        return $this->libro->create($titulo, $autor, $descripcion, $estado, $calificacion);
    }

    public function updateLibro($id, $titulo, $autor, $descripcion, $estado, $calificacion) {
        return $this->libro->update($id, $titulo, $autor, $descripcion, $estado, $calificacion);
    }

    public function deleteLibro($id) {
        return $this->libro->delete($id);
    }
}

// Manejo de solicitudes POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new Controller();

    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case 'create':
                $titulo = $_POST['titulo'];
                $autor = $_POST['autor'];
                $descripcion = $_POST['descripcion'];
                $estado = $_POST['estado'];
                $calificacion = $_POST['calificacion'];

                if ($controller->createLibro($titulo, $autor, $descripcion, $estado, $calificacion)) {
                    header('Location: ../view/index.php');
                } else {
                    echo "Error al crear el libro.";
                }
                break;

            case 'update':
                $id = $_POST['id'];
                $titulo = $_POST['titulo'];
                $autor = $_POST['autor'];
                $descripcion = $_POST['descripcion'];
                $estado = $_POST['estado'];
                $calificacion = $_POST['calificacion'];

                if ($controller->updateLibro($id, $titulo, $autor, $descripcion, $estado, $calificacion)) {
                    header('Location: ../view/index.php');
                } else {
                    echo "Error al actualizar el libro.";
                }
                break;

            case 'delete':
                $id = $_POST['id'];

                if ($controller->deleteLibro($id)) {
                    header('Location: ../view/index.php');
                } else {
                    echo "Error al eliminar el libro.";
                }
                break;
        }
    }
}

// Manejo de solicitudes GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new Controller();

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $estado = isset($_GET['estado']) ? $_GET['estado'] : '';
    $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

    $libros = $controller->getAllLibros($search, $estado, $order);
}
?>