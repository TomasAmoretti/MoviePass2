<?php
  include_once('header.php'); 
  include_once('nav-bar-admin.php'); 
  
?>

<main class="p-5">


    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"> </h1>
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cinemas List</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">

        <div class="form-group mb-4">
                <button type="button" class="btn btn-success mr-4" data-toggle="modal" data-target="#form-cine">
                    <img src="<?php echo ICONS_PATH."plus.svg"?>" width="16" height="16" alt="Add"/>   Add Row 
                </button>
        </div>
        
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Adress</th>

                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php   foreach($cinemasList as $cinema){   ?>   
                        
                <tr id="row-<?php echo $cinema->getId(); ?>">

                    <td><?php echo $cinema->getName(); ?></td>
                    <td><?php echo $cinema->getAdress(); ?></td>

                    <td>
                    <div class="form-inline" >
                        <form action="<?php echo FRONT_ROOT."Cinema/Remove"?>">
                            <button type="submit" name="remove" class="btn btn-danger" value="<?php echo $cinema->getId() ?>"> 
                                <img src="<?php echo ICONS_PATH."trash-2.svg"?>" width="16" height="16" alt="Remove"/>    
                            </button>
                        </form>


                        <button class="btn btn--edit btn-info ml-4 " data-id="<?php echo $cinema->getId(); ?>" data-toggle="modal" data-target="#form-cine"> 
                            <img src="<?php echo ICONS_PATH."edit.svg"?>" width="16" height="16" alt="Update"/>
                        </button>
                    </div>
                    </td>

                </tr>  
            <?php   } ?>

            </tbody>

        </table>
        </div>
    </div>
    </div>

    </div>
    <!-- /.container-fluid -->

</main>

<!--
    ADD CIne
-->
<div class="modal fade" id="form-cine" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <form class="modal-content" action="<?php echo FRONT_ROOT ?>Cinema/Middleware" method="POST">

            <div class="modal-header">
                <h5 class="modal-title">Registrar Cine</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                                
                <div class="form-group">
                    <label>Nombre</label>
                    <input pattern="[a-zA-Z\s]+" title="Please enter on alphabets only" type="text" class="form-control" name="name" required/>
                </div>
            
                <div class="form-group">
                    <label>Direccion</label>
                    <input pattern="[a-zA-Z0-9\s]+" title="Please enter on alphabets only" type="text" class="form-control" name="adress" required/>
                </div>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark">Add</button>
            </div>

            <input type="hidden" name="id" value=""/>
            
        </form>

    </div>
</div>

<?php if(isset($message)) { ?>
    <div id="message-toast" class="toast showing bg-danger" role="alert" aria-live="assertive" aria-atomic="true" style="position:fixed;bottom:0;right:0; min-height:100px; z-index:10000">
        <div class="toast-header bg-danger text-white border-bottom-0">
            <strong class="mr-auto">MoviePass</strong>
            <button type="button" class="ml-2 mb-1 close text-white" id="btn-close-toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body bg-danger text-white">
        <?php echo $message; ?>
        </div>
    </div>
<?php } ?>

<script type="text/javascript">
    function init($) {
        $('#form-cine').on('hide.bs.modal', function (e) {
            $("#form-cine .form-control[name='name']").val('')
            $("#form-cine .form-control[name='adress']").val('')
            $("#form-cine .form-control[name='name']").attr('readonly', false)
            $('#form-cine .modal-title').text("Add Cine");
            $('#form-cine .modal-footer > button[type=submit]').text("Add")
        })
        $(".btn--edit").click(function() {
            $('#form-cine .modal-title').text("Update Cinema");
            $('#form-cine .modal-footer > button[type=submit]').text("Update")
            var cine = {
                id: $(this).data("id")
            };
            var containerQuery = "#row-" + cine.id;
            var cells = $(containerQuery+ '> td')
            for (var i = 0; i < cells.length; i++) {
                switch (i) {
                    case 0:
                        cine.name = $(cells[i]).text();
                    break;
                    case 1:
                        cine.adress = $(cells[i]).text();
                    break;
                
                    default:
                        break;
                }
            }

            for (var attr in cine) {
                var element = $("#form-cine input[name='" + attr + "']");
                element.val(cine[attr]);
            }
        })
    }
</script>

<?php
  include_once('footer.php'); 
?>

