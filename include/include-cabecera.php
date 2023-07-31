<style>
    .custom-bg {
        background-color: #000;
    }

    .navbar-brand {
        background-color: #fff;
        border-radius: 50%;
    }

    .navbar-brand img {
        max-width: 70%;
        height: auto;
        margin-left: 15px;
    }

    .navbar-brand {
        font-size: 18px;
    }

    .nav-link {
        position: relative;
        overflow: hidden;
        display: inline-block;
        text-decoration: none;
        color: #fff;
    }

    .nav-link:hover::after {
        left: 0;
    }

    .nav-link::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: #37D362;
        transition: left 0.8s;
    }
</style>

<!-- Navbar -->
<div class="container-fluid custom-bg">
    <nav class="navbar navbar-expand-lg navbar-dark custom-bg">
        <a class="navbar-brand" href="" style="margin-left: 5px;"><img src="../fotos/icono.png" id="logo"
                class="ImgContenidoLogin" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="justify-content: flex-end;">
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="racconcode.php">CODIFICAR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="raccondecode.php">DECODIFICAR</a>
                </li>
            </ul>
        </div>
    </nav>
</div>