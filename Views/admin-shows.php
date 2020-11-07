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
        <h6 class="m-0 font-weight-bold text-primary"> Function List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

        <div class="form-group mb-4">
                <button type="button" class="btn btn-light mr-4" data-toggle="modal" data-target="#form-cine">
                    <img src="<?php echo ICONS_PATH."plus.svg"?>" width="16" height="16" alt="Add"/>    
                </button>
        </div>
        
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

            <thead>
                <tr>
                    <th>Movie</th>
                    <th>Cinema</th>
                    <th>Room</th>
                    <th>Date</th>
                    <th>Hour</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>
            <?php   foreach($showsList as $shows){ 
                                foreach($moviesList as $movie){ 
                                    if($shows["id_movie"] == $movie->getId()){
                       ?>   
                        
                    <tr id="row">
                    <td><?php echo $movie->getTitle(); ?></td>
                    <td><?php echo $shows["cinema_name"]; ?></td>
                    <td><?php echo $shows["room_name"]; ?></td>
                    <td><?php echo $shows["day"]; ?></td>
                    <td><?php echo $shows["hour"]; ?></td>

                    <td>
                        <div class="form-inline">
                            <form action="<?php echo FRONT_ROOT."Show/Remove"?>">
                                <button type="submit" name="remove" class="btn btn-danger" value="<?php echo $shows["id_show"] ?>"> 
                                    <img src="<?php echo ICONS_PATH."trash-2.svg"?>" width="16" height="16" alt="Remove"/>    
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>  
            <?php 
                                    
                            }
                        }
                    }
            ?>

            </tbody>

        </table>
        </div>
    </div>
    </div>

    </div>
    <!-- /.container-fluid -->

</main>

<!--
    ADD Function
-->
<div class="modal fade" id="form-cine" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <form class="modal-content" action="<?php echo FRONT_ROOT ?>Show/Add" method="POST">

            <div class="modal-header">
                <h5 class="modal-title">Add Function</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <label>Movies</label>
                    <select name="id_movie" class="form-control">
                        <?php foreach($moviesList as $movie){ ?>                                
                            <option value="<?php echo $movie->getId();?>"> <?php echo $movie->getTitle();?> </option>
                        <?php } ?>
                    </select>
                </div>


                <div class="form-group" id="room-form-group">
                    <label>Room  | Cinema</label>
                    <select name="id_room" class="form-control">
                    <?php foreach($roomsList as $room){ ?>                                
                            <option value="<?php echo $room["id_room"];?>"> <?php echo $room["room_name"]." | ".$room["cinema_name"];?> </option>
                        <?php } ?></select>
                </div>


                <div class="form-group">
                    <label>Date</label>
                    <input  type="date" step="1" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" class="form-control" name="day" required/>
                </div>

            
                <div class="form-group">
                    <label>Hour</label>
                    <input type="time" class="form-control" name="hour" required/>
                </div>

                <div class="invalid-feedback">
                    You must agree before submitting.
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link btn--add" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark">Add</button>
            </div>
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


<?php
  //include_once('footer.php'); 
?>

