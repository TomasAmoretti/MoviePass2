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
        <h6 class="m-0 font-weight-bold text-primary"> Rooms List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

        <div class="form-group mb-4">
                <button type="button" class="btn btn-success mr-4" data-toggle="modal" data-target="#form-room">
                    <img src="<?php echo ICONS_PATH."plus.svg"?>" width="16" height="16" alt="Add"/>    Add Row
                </button>
        </div>
        
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

            <thead>
                <tr>
                    <th>Cinema</th>
                    <th>Name</th>
                    <th>Capacity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php   foreach($roomsList as $row){ ?>   
                        
                <tr id="row-<?php echo $row["id_room"]; ?>">

                    <td><?php  echo  $row["cinema_name"]; ?></td>
                    <td><?php  echo  $row["room_name"];  ?></td>
                    <td><?php  echo  $row["capacity"];  ?></td>
                    <td><?php  echo  $row["price"]; ?></td>

                    <td>
                        <div class="form-inline">
                            <form action="<?php echo FRONT_ROOT."Room/Remove"?>">
                                <button type="submit" name="remove" class="btn btn-danger" value="<?php echo $row["id_room"] ?>"> 
                                    <img src="<?php echo ICONS_PATH."trash-2.svg"?>" width="16" height="16" alt="Remove"/>    
                                </button>
                            </form>

                            <button class="btn btn--edit btn-info ml-4" data-id="<?php echo $row["id_room"] ?>" data-toggle="modal" data-target="#form-room"> 
                                <img src="<?php echo ICONS_PATH."edit.svg"?>" width="16" height="16" alt="Update"/>
                            </button>
                        </div>
                    </td>

                </tr>  

            <?php   
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
    ADD Room
-->
<div class="modal fade" id="form-room" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <form class="modal-content" action="<?php echo FRONT_ROOT ?>Room/Middleware" method="POST">

            <div class="modal-header">
                <h5 class="modal-title">Add Room</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                                
                <div class="form-group">
                    <label>Cinemas</label>
                    <select name="id_cinema" class="form-control">
                        <?php foreach($cinemasList as $cinema){ ?>                                
                            <option value="<?php echo $cinema->getId();?>"> <?php echo $cinema->getName();?> </option>
                        <?php } ?>
                    </select>
                </div>


                <div class="form-group">
                    <label>Name</label>
                    <input pattern="[a-zA-Z0-9\s]+" title="Please enter on alphabets only" type="text" class="form-control" name="room_name" required/>
                </div>

            
                <div class="form-group">
                    <label>Capacity</label>
                    <input type="number" min="1" class="form-control" name="capacity" required/>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" min="1" class="form-control" name="price" required/>
                </div>


                <div class="invalid-feedback">
                    You must agree before submitting.
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

<script type="text/javascript">
    function init($) {
        $('#form-room').on('hide.bs.modal', function (e) {
            $("#form-room .form-control[name='room_name']").val('')
            $("#form-room .form-control[name='capacity']").val('')
            $("#form-room .form-control[name='price']").val('')
            $("#form-room .form-control[name='room_name']").attr('readonly', false)
            $('#form-room .modal-title').text("Add Room");
            $('#form-room .modal-footer > button[type=submit]').text("Add")
        })
        $(".btn--edit").click(function() {
            $('#form-room .modal-title').text("Update Room");
            $('#form-room .modal-footer > button[type=submit]').text("Update")
       
            var room = {
                id: $(this).data("id")
            };
            var containerQuery = "#row-" + room.id;
            var cells = $(containerQuery+ '> td')
            for (var i = 0; i < cells.length; i++) {
                switch (i) {
                    case 0:
                        room.id_cinema = $(cells[i]).text();
                    break;
                    case 1:
                        room.room_name = $(cells[i]).text();
                    break;
                    case 2:
                        room.capacity = $(cells[i]).text();
                    break;
                    case 3:
                        room.price = $(cells[i]).text();
                    break;
                    default:
                        break;
                }
            }

            for (var attr in room) {
                console.log(attr);
                var element = $("#form-room input[name='" + attr + "']");
                element.val(room[attr]);
            }
        })
    }
</script>

<?php
  include_once('footer.php'); 
?>

