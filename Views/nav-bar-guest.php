<header class="header header-horizontal header-view-pannel">
  <div class="container">
    <nav class="navbar">
        <a class="navbar-brand" href="<?php echo FRONT_ROOT."Home/ShowsViewClient"?>">
            <span class="logo-element">
                <span class="logo-text text-uppercase">
                  Movie Pass
                </span>
            </span>
        </a>
        <button class="navbar-toggler" type="button">
            <span class="th-dots-active-close th-dots th-bars">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </button>
        <div class="navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item nav-item-arrow-down nav-hover-show-sub">
                    <a class="nav-link" href="#"><i class="fas fa-user-circle fa-fw"></i> <?php //echo $_SESSION["loggedUser"]->getFirstName(); ?> <?php //echo $_SESSION["loggedUser"]->getLastName(); ?></a>
                    <div class="nav-arrow"><i class="fas fa-chevron-down"></i></div>
                    <ul class="collapse nav">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">LogIn/Register</a>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                        </li>-->
                    </ul>
                </li>
            </ul>

        </div>
    </nav>
  </div>
</header>