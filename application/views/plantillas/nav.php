<nav class="navbar navbar-expand-sm  sticky-top">

    <ul class="navbar-nav">

        <li class="nav-item">
            <a class="nav-link" href="<?= site_url() ?>"> <img src="<?= base_url() . 'assets/img/pagina/home.png' ?>" width="40px" title="Menu inicio">
            </a>
        </li>
    </ul>

    <?php if ($this->session->has_userdata('usuario') and $this->session->userdata("usuario")["tipo"] === "cliente") : ?>

        <ul class="navbar-nav">
            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" style="color:darkgreen"> <i class="fas fa-bars"></i> Menu </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= site_url('ModificarDatos/mostrarFormulario') ?>"> <i class="fas fa-user-edit"></i> Datos personales </a>
                    <a class="dropdown-item" href=""> <i class="fas fa-file-invoice"></i> Mis pedidos</a>
                    <a class="dropdown-item" href="<?= site_url("Baja") ?>"> <i class="fas fa-user-times"></i> Darse de baja </a>
                </div>
            </li>

        </ul>
    <?php endif ?>

    <?php if ($this->session->has_userdata('usuario') and $this->session->userdata("usuario")["tipo"] === "administrador") : ?>

        <ul class="navbar-nav">
            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" style="color:chocolate"> Menu </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#"> Crud categorias </a>
                    <a class="dropdown-item" href="#"> Crud Productos </a>
                    <a class="dropdown-item" href="#"> Cambiar estado pedidos </a>
                    <a class="dropdown-item" href="#"> Importar/exportar xml </a>
                    <a class="dropdown-item" href="#"> Importar/exportar excel </a>
                </div>
            </li>

        </ul>
    <?php endif ?>

    <ul class="navbar-nav ml-auto">
        <li class="menuCarrito">
            <img src="<?= base_url() . 'assets/img/pagina/carrito.png' ?>" title="Carrito compra"> <span id="numeroDeProductos"> 0 </span>
        </li>
    </ul>

</nav>