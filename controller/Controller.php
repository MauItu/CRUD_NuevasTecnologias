<?php
require_once '../model/DB/Database.php';
require_once '../model/Libro.php';

// Crear libro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $database = new Database();
    $db = $database->getConnection();
    $libro = new Libro($db);

    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];
    $calificacion = $_POST['calificacion'];

    if ($libro->create($titulo, $autor, $descripcion, $estado, $calificacion)) {
        header('Location: ../view/index.php');
    } else {
        echo "Error al crear el libro.";
    }
}

// Actualizar libro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $database = new Database();
    $db = $database->getConnection();
    $libro = new Libro($db);

    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];
    $calificacion = $_POST['calificacion'];

    if ($libro->update($id, $titulo, $autor, $descripcion, $estado, $calificacion)) {
        header('Location: ../view/index.php');
    } else {
        echo "Error al actualizar el libro.";
    }
}

// Eliminar libro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $database = new Database();
    $db = $database->getConnection();
    $libro = new Libro($db);

    $id = $_POST['id'];

    if ($libro->delete($id)) {
        header('Location: ../view/index.php');
    } else {
        echo "Error al eliminar el libro.";
    }
}

// Buscar y filtrar libros
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $database = new Database();
    $db = $database->getConnection();
    $libro = new Libro($db);

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $estado = isset($_GET['estado']) ? $_GET['estado'] : '';
    $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

    $libros = $libro->getAll($search, $estado, $order);
}
?>