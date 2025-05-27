<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Sencillo con Bootstrap 5</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="assets/cms/css/cms.css">
</head>
<body>
<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Mi CMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Galería</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>

<!-- Cabecera -->
<header class="cms-header text-center">
    <div class="container">
        <h1>Mi Sitio Web con CMS</h1>
        <p class="lead">Un sistema de gestión de contenido sencillo construido con Bootstrap 5</p>
    </div>
</header>

<!-- Contenido principal -->
<main class="container">
    <!-- Sección de Proyectos -->
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Otros Proyectos</h2>
            <button type="button" id="addFeaturedBtn" class="btn btn-primary btn-add-project" data-bs-toggle="modal" data-bs-target="#newCardModal">
                <i class="fas fa-plus"></i> Agregar Destacado
            </button>
        </div>

        <!-- Contenedor para Proyectos destacados -->
        <div id="featured-articles-container">
            <?php
            function renderLeft($k1, $k2, $k3, $k4, $k5, $k6): void {
                echo("<form method='POST'>"); // <-- FORMULARIO
                echo("<input type='hidden' name='post_id' value='$k5'>");
                echo("<input type='hidden' name='post_tabla' value='$k6'>");
                echo("<div class='card mb-3' style='max-width: 100%;'>");
                echo("<div class='row g-0'>");
                echo("<div class='col-md-4'>");
                echo("<img src='$k4' class='img-fluid rounded-start' alt='Imagen de ejemplo'>");
                echo("</div>");
                echo("<div class='col-md-8'>");
                echo("<div class='card-body'>");
                echo("<h5 class='card-title'>$k1</h5>");
                echo("<p class='card-text'>$k2</p>");
                echo("<p class='card-text'><small class='text-muted'>Última actualización $k3</small></p>");
                echo("<div class='d-flex'>");
                echo("<a href='#' class='btn btn-outline-primary me-2'>Leer más</a>");
                echo("<button type='submit' name='delete_button' class='btn btn-outline-danger btn-delete-featured'>");
                echo("<i class='fas fa-trash'></i>");
                echo("</button>");
                echo("</div>");
                echo("</div>");
                echo("</div>");
                echo("</div>");
                echo("</div>");
                echo("</form>");
            }

            function renderRight($k1, $k2, $k3, $k4, $k5, $k6): void {
                echo("<form method='POST'>"); // <-- FORMULARIO
                echo("<input type='hidden' name='post_id' value='$k5'>");
                echo("<input type='hidden' name='post_tabla' value='$k6'>");
                echo("<div class='card mb-3' style='max-width: 100%;'>");
                echo("<div class='row g-0'>");
                echo("<div class='col-md-8'>");
                echo("<div class='card-body'>");
                echo("<h5 class='card-title'>$k1</h5>");
                echo("<p class='card-text'>$k2</p>");
                echo("<p class='card-text'><small class='text-muted'>Última actualización $k3</small></p>");
                echo("<div class='d-flex'>");
                echo("<button type='submit' name='delete_button' class='btn btn-outline-danger btn-delete-featured'>");
                echo("<i class='fas fa-trash'></i>");
                echo("</button>");
                echo("</button>");
                echo("</div>");
                echo("</div>");
                echo("</div>");
                echo("<div class='col-md-4'>");
                echo("<img src='$k4' class='img-fluid rounded-start' alt='Imagen de ejemplo'>");
                echo("</div>");
                echo("</div>");
                echo("</div>");
                echo("</form>");
            }


            // Por si acaso, requerimos la lógica de CMS también
            require_once './cms_logic.php';


            // CREDENCIALES DE PRUEBAS, NO PARA PRODUCCION
             $username = "fery";
            $password = "pruebas456";
            // Nos conectamos a la BB.DD. con las credenciales especificadas anteriormente
            $pdo = new PDO("mysql:host=localhost", $username, $password);
            // Cambiamos los errores a Exceptions
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Utilizamos la BB.DD. creada por cms_logic (SIEMPRE HAY QUE IR A CMS_LOGIC
            $pdo->query("USE coordicms");
            // Listamos las tablas por si hay expansión
            $tablas = ['atencion', 'empleo', 'igualdad', 'formacion', 'ocio'];
            // Para evitar errores, ponemos este código aqui. Si no, causamos un error por que los headers ya están listos.
            if (isset($_POST['delete_button'])) {
                $id = $_POST['post_id'];
                $tabla = $_POST['post_tabla'];

                if (in_array($tabla, $tablas)) { // Validamos la tabla por seguridad
                    $stmt = $pdo->prepare("DELETE FROM $tabla WHERE PostId = :id");
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    // Recargar para reflejar los cambios
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit;
                } else {
                    echo "Tabla no permitida.";
                }
            }
            // Creamos un array para guardar todos los posts.
            $allPosts = [];

            // Vamos por cada tabla del array, y vamos guardando todos los resultados, combinandolos en el array.
            foreach ($tablas as $tabla) {
                $stmt = $pdo->prepare("SELECT PostId, PostTitle, PostDescription, PostDate, ImageLink, '$tabla' as Tabla FROM $tabla");
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $allPosts = array_merge($allPosts, $rows);
            }

            // Mejor lógica de izquierda y derecha.
            $rightimage = false;
            foreach ($allPosts as $post) {
                if ($rightimage) {
                    renderRight($post['PostTitle'], $post['PostDescription'], $post['PostDate'], $post['ImageLink'], $post['PostId'],$post['Tabla']);
                } else {
                    renderLeft($post['PostTitle'], $post['PostDescription'], $post['PostDate'], $post['ImageLink'], $post['PostId'],$post['Tabla']);
                }
                $rightimage = !$rightimage;
            }



            ?>
    </section>

    <!-- Sección de tarjetas dinámicas (agregadas por el usuario) -->
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Proyectos</h2>
            <button type="button" id="addProjectBtn" class="btn btn-success btn-add-project" data-bs-toggle="modal" data-bs-target="#newCardModal">
                <i class="fas fa-plus"></i> Agregar Proyecto
            </button>
        </div>

        <!-- Grid de 3 columnas para las tarjetas dinámicas -->
        <div class="row" id="dynamic-cards-container">
            <!-- Aquí se insertarán dinámicamente las tarjetas creadas por el usuario -->
            <!-- Ejemplo de las tarjetas de la imagen de muestra -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 border">
                    <img src="assets/img/" class="card-img-top" alt="Laurisilva Proyecto">
                    <div class="card-body">
                        <h5 class="card-title">Proyecto 1</h5>
                        <p class="card-text">Un breve ejemplo de contenido para construir sobre el título de la tarjeta.</p>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-primary">Leer más</a>
                            <button class="btn btn-danger btn-delete-card" data-id="project1">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border">
                    <img src="assets/img/" class="card-img-top" alt="Proyecto SEDA">
                    <div class="card-body">
                        <h5 class="card-title">Proyecto 2</h5>
                        <p class="card-text">Otro ejemplo de contenido interesante para esta tarjeta.</p>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-primary">Leer más</a>
                            <button class="btn btn-danger btn-delete-card" data-id="project2">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border">
                    <img src="assets/img" class="card-img-top" alt="Proyecto Tarajal">
                    <div class="card-body">
                        <h5 class="card-title">Proyecto 3</h5>
                        <p class="card-text">Un ejemplo más de contenido para esta tarjeta de proyecto.</p>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-primary">Leer más</a>
                            <button class="btn btn-danger btn-delete-card" data-id="project3">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Footer simplificado -->
<footer class="cms-footer text-center">
    <div class="container">
        <p class="m-0">© 2025 Mi CMS. Todos los derechos reservados.</p>
    </div>
</footer>

<!-- Modal para agregar nueva card de proyecto -->
<div class="modal fade" id="newCardModal" tabindex="-1" aria-labelledby="newCardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCardModalLabel">Agregar Nuevo Proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="formhandler.php" method="POST" id="newCardForm">
                    <div class="mb-3">
                        <label for="newCardTitle" class="form-label">Título del Proyecto</label>
                        <input type="text" name="pname" class="form-control" id="newCardTitle" required placeholder="Ej: Proyecto Laurisilva">
                    </div>
                    <div class="mb-3">
                        <label for="newCardContent" class="form-label">Descripción</label>
                        <textarea class="form-control" name="pdesc" id="newCardContent" required rows="3" placeholder="Ej: Un breve ejemplo de contenido para este proyecto..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="newcardSection" class="form-label">Sección del Proyecto</label>
                        <select class="form-select" name="parea" id="newcardSection" required>
                            <option selected disabled value="">Seleccione...</option>
                            <option value="integral.html">Atención Integral</option>
                            <option value="ocio.html">Ocio y Tiempo Libre</option>
                            <option value="empleo.html">Empleo</option>
                            <option value="Igualdad.html">Mujer e Igualdad</option>
                            <option value="formacion.html">Formación e Innovación</option>
                        </select>
                        <div class="form-text">No dejes sin seleccionar o no aparecerá</div>
                    </div>
                    <div class="mb-3">
                        <label for="newCardImage"  class="form-label">URL de la imagen</label>
                        <input type="text" class="form-control" name="pimage" id="newCardImage" placeholder="URL de la imagen (opcional)">
                        <div class="form-text">Deja en blanco para usar una imagen predeterminada</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="newCardForm" class="btn btn-success">Agregar Proyecto</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript de Bootstrap y dependencias -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<!-- JavaScript modular para el CMS -->
<script src="assets/cms/js/utils.js"></script>
<script src="assets/cms/js/project.js"></script>
<!--<script src="assets/cms/js/featured.js"></script>-->
<script src="assets/cms/js/app.js"></script>
</body>
</html>