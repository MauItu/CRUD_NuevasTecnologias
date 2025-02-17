<?php
require_once '../controller/Controller.php';

$controller = new Controller();

//para las busquedas
$search = isset($_GET['search']) ? $_GET['search'] : ''; 
$estado = isset($_GET['estado']) ? $_GET['estado'] : '';
$order = isset($_GET['order']) ? $_GET['order'] : '';

$libros = $controller->getAllLibros($search, $estado, $order);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de libros</title>
    <link rel="stylesheet" href="../public/css/Styles.css">
    <script>
        function toggleAdvancedSearch() {
            const advancedSearch = document.querySelector('.advanced-search');
            advancedSearch.classList.toggle('active');
        }
    </script>
</head>
<body>
    <div class="background-image"></div>    
    <div class="content"></div>
    <div class="container">
        <h1>Lista de libros</h1>
        
        <div class="actions">
            <form action="ViewCreate.php" method="GET">
                <button type="submit" class="btn-add">
                    <i class="fas fa-plus"></i> Agregar Nuevo Libro
                </button>
            </form>
        </div>

        <div class="search-filter">
            <form action="index.php" method="GET">
                <input type="text" name="search" placeholder="Buscar por título o autor" value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">Buscar</button>
                <button type="button" class="advanced-search-toggle" onclick="toggleAdvancedSearch()">Búsqueda Avanzada</button>
            </form>
            <div class="advanced-search">
                <form action="index.php" method="GET">
                    <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
                    <select name="estado">
                        <option value="">Todos los estados</option>
                        <option value="No iniciado" <?php echo ($estado == 'No iniciado') ? 'selected' : ''; ?>>No iniciado</option>
                        <option value="Leyendo" <?php echo ($estado == 'Leyendo') ? 'selected' : ''; ?>>Leyendo</option>
                        <option value="Terminado" <?php echo ($estado == 'Terminado') ? 'selected' : ''; ?>>Terminado</option>
                        <option value="En pausa" <?php echo ($estado == 'En pausa') ? 'selected' : ''; ?>>En pausa</option>
                        <option value="Abandonado" <?php echo ($estado == 'Abandonado') ? 'selected' : ''; ?>>Abandonado</option>
                    </select>
                    <select name="order">
                        <option value="">Sin ordenar</option>
                        <option value="ASC" <?php echo ($order == 'ASC') ? 'selected' : ''; ?>>Calificación Ascendente</option>
                        <option value="DESC" <?php echo ($order == 'DESC') ? 'selected' : ''; ?>>Calificación Descendente</option>
                    </select>
                    <button type="submit">Aplicar Filtros</button>
                </form>
            </div>
        </div>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Calificación</th>
                        <th>Acciones</th> <!-- editar y eliminar -->
                    </tr>
                </thead>
                <tbody>
                    <?php if ($libros->rowCount() > 0): ?>
                        <?php while ($row = $libros->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                                <td><?php echo htmlspecialchars($row['autor']); ?></td>
                                <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                                <td class="status-cell"><?php echo htmlspecialchars($row['estado']); ?></td>
                                <td class="rating-cell">
                                    <?php 
                                        $rating = intval($row['calificacion']);
                                        for($i = 0; $i < 5; $i++) {
                                            echo $i < $rating ? '★' : '☆'; //mostrar calificacion en forma de estrellas
                                        }
                                    ?>
                                </td>
                                <td class="actions-cell"> <!-- editar y eliminar -->
                                    <a href="ViewUpdate.php?id=<?php echo $row['id']; ?>" class="btn-edit">Editar</a>
                                    <form action="../controller/Controller.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="btn-delete" onclick="return confirm('¿Estás seguro de eliminar este libro?');">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="no-records">No hay libros registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>