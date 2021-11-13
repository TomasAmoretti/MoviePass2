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
        <h6 class="m-0 font-weight-bold text-primary"> Purchase Info </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">

        
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

            <thead>
                <tr>
                    <th>Movie</th>
                    <th>Cinema</th>
                    <th>Room</th>
                    <th>Date</th>
                    <th>Hour</th>
                    <th>Last Date Purchase</th>
                    <th>Quantity Sold</th>
                    <th>Remainder</th>
                    <th> Sold ($) </th>

                </tr>
            </thead>

            <tbody>
            <?php   foreach($purchasesList as $purchase){ 
                        foreach($showsListTotal as $shows){
                            if($shows->getId() == $purchase["id_show"]){
                                foreach($moviesList as $movie){ 
                                    if($shows->getIdMovie() == $movie->getId()){
                       ?>   
                        
                    <tr id="row">
                    
                    <td><?php echo $movie->getTitle(); ?></td>
                    <td><?php echo $purchase["cinema_name"]; ?></td>
                    <td><?php echo $purchase["room_name"]; ?></td>
                    <td><?php echo $purchase["day"]; ?></td>
                    <td><?php echo $purchase["hour"]; ?></td>
                    <td><?php echo $purchase["date_purchase"]; ?></td>

                    <td><?php echo $purchase["count_tickets"]; ?></td>
                    <td><?php $remainder = $purchase["capacity"] - $purchase["count_tickets"]; 
                            if($remainder< 0){
                                echo 0;
                            }else{
                                echo $remainder;
                            }?></td>
                    <td><?php echo $purchase["total"]; ?></td>
                </tr>  
            <?php 
                                    }
                                }
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