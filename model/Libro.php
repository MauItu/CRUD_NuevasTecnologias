<?php
class Libro {
    private $conn;
    private $table_name = "libros";

    public $id;
    public $titulo;
    public $autor;
    public $descripcion;
    public $estado;
    public $calificacion;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para crear un libro
    public function create($titulo, $autor, $descripcion, $estado, $calificacion) {
        $query = "INSERT INTO " . $this->table_name . " (titulo, autor, descripcion, estado, calificacion) VALUES (:titulo, :autor, :descripcion, :estado, :calificacion)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':calificacion', $calificacion);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para obtener libros por medio de busqueda y filtros
    public function getAll($search = '', $estado = '', $order = '') {
        $query = "SELECT * FROM " . $this->table_name . " WHERE 1=1";

        if ($search) {
            $query .= " AND (titulo LIKE :search OR autor LIKE :search)";
        }

        if ($estado) {
            $query .= " AND estado = :estado";
        }

        if ($order) {
            $query .= " ORDER BY calificacion " . $order;
        }

        $stmt = $this->conn->prepare($query);

        if ($search) {
            $search = "%$search%";
            $stmt->bindParam(':search', $search);
        }

        if ($estado) {
            $stmt->bindParam(':estado', $estado);
        }

        $stmt->execute();

        return $stmt;
    }

    // Método para obtener un libro por su ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para actualizar un libro
    public function update($id, $titulo, $autor, $descripcion, $estado, $calificacion) {
        $query = "UPDATE " . $this->table_name . " SET titulo = :titulo, autor = :autor, descripcion = :descripcion, estado = :estado, calificacion = :calificacion WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':calificacion', $calificacion);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para eliminar un libro
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>