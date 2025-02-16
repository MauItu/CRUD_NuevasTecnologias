<?php
require_once '../model/DB/Database.php';
require_once '../model/Libro.php';

$database = new Database();
$db = $database->getConnection();
$libro = new Libro($db);

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: ID not found.');
$book = $libro->getById($id);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Libro</title>
    <link rel="stylesheet" href="../public/css/Styles.css">
</head>
<body>
    <div class="background-image"></div>
    <div class="container">
        <div class="form-header">
            <h1>Actualizar Libro</h1>
        </div>
        
        <form action="../controller/controller.php" method="POST" class="book-form">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($book['id']); ?>">
            
            <div class="form-row">
                <div class="form-group full-width">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" 
                           value="<?php echo htmlspecialchars($book['titulo']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label for="autor">Autor:</label>
                    <input type="text" id="autor" name="autor" 
                           value="<?php echo htmlspecialchars($book['autor']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" 
                              rows="4"><?php echo htmlspecialchars($book['descripcion']); ?></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado">
                        <option value="No iniciado" <?php echo ($book['estado'] == 'No iniciado') ? 'selected' : ''; ?>>
                            No iniciado
                        </option>
                        <option value="Leyendo" <?php echo ($book['estado'] == 'Leyendo') ? 'selected' : ''; ?>>
                            Leyendo
                        </option>
                        <option value="Terminado" <?php echo ($book['estado'] == 'Terminado') ? 'selected' : ''; ?>>
                            Terminado
                        </option>
                        <option value="En pausa" <?php echo ($book['estado'] == 'En pausa') ? 'selected' : ''; ?>>
                            En pausa
                        </option>
                        <option value="Abandonado" <?php echo ($book['estado'] == 'Abandonado') ? 'selected' : ''; ?>>
                            Abandonado
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group rating-group">
                    <label>Calificación:</label>
                    <div class="star-rating">
                        <?php $rating = intval($book['calificacion']); ?>
                        <input type="radio" id="star5" name="calificacion" value="5" <?php echo ($rating == 5) ? 'checked' : ''; ?>>
                        <label for="star5">★</label>
                        <input type="radio" id="star4" name="calificacion" value="4" <?php echo ($rating == 4) ? 'checked' : ''; ?>>
                        <label for="star4">★</label>
                        <input type="radio" id="star3" name="calificacion" value="3" <?php echo ($rating == 3) ? 'checked' : ''; ?>>
                        <label for="star3">★</label>
                        <input type="radio" id="star2" name="calificacion" value="2" <?php echo ($rating == 2) ? 'checked' : ''; ?>>
                        <label for="star2">★</label>
                        <input type="radio" id="star1" name="calificacion" value="1" <?php echo ($rating == 1) ? 'checked' : ''; ?>>
                        <label for="star1">★</label>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Actualizar Libro</button>
                <a href="index.php" class="btn-cancel">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>