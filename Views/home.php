<?php include_once('header.php'); ?>

<main class="login">

    <!--
        LOGIN
    -->
    <form class="login-form" action="<?php echo FRONT_ROOT."Home/Login"?>" method="POST">
 
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" />
        </div>
        
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password">
        </div>

        <div class="actions">

            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#sign-up">
                Registrar usuario
            </button>
            
            <button type="submit" class="btn btn-dark">
                Login
            </button>
        
        </div>


        <!-- Esto como si no existiera -->
        <?php if(isset($successMje) || isset($errorMje)) { ?>
            <div class="alert <?php if(isset($successMje)) echo 'alert-success'; else echo 'alert-danger'; ?> alert-dismissible fade show mt-3" role="alert">
                <strong><?php if(isset($successMje)) echo $successMje; else echo $errorMje; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
    </form>

     <!--
        SIGN UP
    -->
    <div class="modal fade" id="sign-up" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form class="modal-content" action="<?php echo FRONT_ROOT."User/SignInUp"?>" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title">Registrar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" required/>
                    </div>

                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" class="form-control" name="apellido" required/>
                    </div>

                    <div class="form-group">
                        <label>DNI</label>
                        <input type="text" class="form-control" name="dni" required/>
                    </div>
                    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required/>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" required/>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-dark">Registrar</button>
                </div>
            </form>

        </div>
    </div>

</main>
