<?php 
 include('header.php');
 include('nav-bar-admin.php');
 require_once("validate-session.php");
?>

    <main class="p-5">
        <div class="container">

            <h1 class="mb-5">Listado de Cines</h1>

            <form class="form-inline" action="<?php echo FRONT_ROOT."Cine/Remove"?>" method="">

                <div class="form-group mb-4">
                    <button type="button" class="btn btn-light mr-4" data-toggle="modal" data-target="#create-post">
                        <object type="image/svg+xml" data="<?php echo ICONS_PATH."plus.svg"?>" width="16" height="16"></object>
                    </button>

                </div>

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Capacidad</th>
                            <th>Valor Entrada</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php   $contadorId = 0;
                            foreach($cinesList as $cine){ ?>

                                <tr>
                                    <td><?php echo $contadorId ?></td>
                                    <td><?php echo $cine->getNombre(); ?></td>
                                    <td><?php echo $cine->getDireccion(); ?></td>
                                    <td><?php echo $cine->getCapacidad(); ?></td>
                                    <td><?php echo $cine->getValorEntrada(); ?></td>

                                    <td>
                                    <button type="submit" name="nombre" class="btn" value="<?php echo $contadorId ?>"> 
                                        <object type="image/svg+xml" data="<?php echo ICONS_PATH."trash-2.svg"?>" width="16" height="16">
                                            Your browser does not support SVG
                                        </object>
                                    </button>
                                    </a>
                                    </td>
                                </tr>  
                                <?php
                            $contadorId++;
                            }
                        ?>

                    </tbody>
                </table>
            </form>

            <!-- Esto como si no existiera -->
            <?php if(isset($successMje) || isset($errorMje)) { ?>
                <div class="alert <?php if(isset($successMje)) echo 'alert-success'; else echo 'alert-danger'; ?> alert-dismissible fade show mt-3" role="alert">
                    <strong><?php if(isset($successMje)) echo $successMje; else echo $errorMje; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
        </div>
    </main>

    <!--
        ADD CINE
    -->
    <div class="modal fade" id="create-post" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form class="modal-content" action="<?php echo FRONT_ROOT."Cine/Add"?>" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title">Registrar Cine</h5>
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
                        <label>Direccion</label>
                        <input type="text" class="form-control" name="direccion" required/>
                    </div>

                    <div class="form-group">
                        <label>Capacidad</label>
                        <input type="text" class="form-control" name="capacidad" required/>
                    </div>

                    <div class="form-group">
                        <label>Valor Entrada</label>
                        <input type="text" class="form-control" name="valorEntrada" required/>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-dark">Agregar</button>
                </div>
            </form>

        </div>
    </div>

    <?php include('footer.php'); ?>