<?php
     require_once("Config/Autoload.php");
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Movie Pass</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Cartelera</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT."Home/Logout"?>">Logout</a>
            </li>
        </ul>
        <span class="navbar-text text-white">
            <strong>(Hola <?php echo $_SESSION['loggedUser']->getNombre(); ?>)</strong>
        </span>
    </div>
</nav>