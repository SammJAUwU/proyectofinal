<nav class="navbar navbar-expand-lg" style="background-color: black;">
    <div class="container-fluid" style="background-color: black;">
        <a href="<?php echo $ruta . 'index.php'; ?>">
            <img class="img-fluid mx-3" src="<?php echo $ruta . 'assets/Logos/logo1-bg.png'; ?>" alt="logo" width="50px">
        </a>
        <a class="navbar-brand" style="color: rgb(51, 255, 0); font-family: 'Nerko One', cursive; font-size: 27px;" href="<?php echo $ruta . 'index.php'; ?>">TECHGAMING</a>
        <button class="navbar-toggler" style="background-color: rgb(51, 255, 0);" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" style="color: white; font-size: 22px;" aria-current="page" href="<?php echo $ruta . 'components/productos.php'; ?>">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" style="color: white; font-size: 22px;" aria-current="page" href="<?php echo $ruta . 'components/carrito.php'; ?>">Carrito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" style="color: white; font-size: 22px;" aria-current="page" href="<?php echo $ruta . 'components/nosotros.php'; ?>">Sobre Nosotros</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: rgb(51, 255, 0); font-size: 22px;">
                        Perfil
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        if (isset($_SESSION['usuario'])) {
                        ?>
                            <li><a class="dropdown-item" aria-current="page" href="<?php echo $ruta . 'components/Perfil.php'; ?>">Mi perfil</a></li>
                        <?php
                        } else {
                        ?>
                            <li><a class="dropdown-item" aria-current="page" href="<?php echo $ruta . 'components/CrearCuenta.php'; ?>">Mi perfil</a></li>
                        <?php
                        }
                        ?>
                        <li><a class="dropdown-item" aria-current="page" href="<?php echo $ruta . 'components/historial.php'; ?>">Mis compras</a></li>
                        <?php
                        if (isset($_SESSION['usuario'])) {
                        ?>
                            <li><a class="dropdown-item" aria-current="page" href="<?php echo $ruta . 'components/cerrarSesion.php'; ?>">Cerrar sesión</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
            </ul>
            <?php
            $rutaSearch = '';
            if ($ruta == '') {
                $rutaSearch = 'components/mostrarProducto.php';
            } else {
                $rutaSearch = 'mostrarProducto.php';
            }
            ?>
            <form class="form-inline d-flex gap-3" action="<?php echo $rutaSearch; ?>" method="get">
                <input class="form-control mr-sm-2 inputSearch" type="search" id="searchInput" placeholder="Buscar producto" aria-label="Buscar" name="searchP">
                <button class="btn btn-outline-success" style="background-color: rgb(51, 255, 0); color: black; font-size: 20px;" type="submit">Buscar</button>
            </form>
            <style>
                @media (min-width: 768px) {
                    .inputSearch {
                        width: 280px;
                    }
                }
            </style>
        </div>
    </div>
</nav>
<hr style="color: rgb(51, 255, 0); margin: 0;">