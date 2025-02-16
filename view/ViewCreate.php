<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Libro</title>
    <link rel="stylesheet" href="../public/css/Styles.css">
</head>
<body>
    <div class="background-image"></div>
    <div class="container">
        <div class="form-header">
            <h1>Agregar Nuevo Libro</h1>
        </div>
        
        <form action="../controller/controller.php" method="POST" class="book-form">
            <input type="hidden" name="action" value="create">
            
            <div class="form-row">
                <div class="form-group full-width">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" required 
                           placeholder="Ingrese el título del libro">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label for="autor">Autor:</label>
                    <input type="text" id="autor" name="autor" required 
                           placeholder="Ingrese el autor del libro">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="4" 
                              placeholder="Ingrese la descripción del libro"></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado">
                        <option value="No iniciado">No iniciado</option>
                        <option value="Leyendo">Leyendo</option>
                        <option value="Terminado">Terminado</option>
                        <option value="En pausa">En pausa</option>
                        <option value="Abandonado">Abandonado</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group rating-group">
                    <label>Calificación:</label>
                    <div class="star-rating">
                        <input type="radio" id="star5" name="calificacion" value="5">
                        <label for="star5">★</label>
                        <input type="radio" id="star4" name="calificacion" value="4">
                        <label for="star4">★</label>
                        <input type="radio" id="star3" name="calificacion" value="3">
                        <label for="star3">★</label>
                        <input type="radio" id="star2" name="calificacion" value="2">
                        <label for="star2">★</label>
                        <input type="radio" id="star1" name="calificacion" value="1">
                        <label for="star1">★</label>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Guardar Libro</button>
                <a href="index.php" class="btn-cancel">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>