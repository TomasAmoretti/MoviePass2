<?php
include_once('header.php');
include_once('nav-bar-client.php');
?>

<main class="p-5">


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
        <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> <?php echo $user->getFirstName()." ".$user->getLastName()?></h6>
            </div>
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Purchase List</h6>
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
                                <th>Count Tickets</th>
                                <th>Price $$</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($purchaseList as $purchase) {
                                if ($purchase["id_user"] == $user->getId()) {
                                    foreach ($showsList as $show) {
                                        if ($show->getId() == $purchase["id_show"]) {
                                            foreach ($moviesList as $movie) {
                                                if ($movie->getId() == $show->getIdMovie()) {
                            ?>

                                                    <tr id="row">
                                                        <td><?php echo $movie->getTitle(); ?></td>
                                                        <td><?php echo $purchase["cinema_name"]; ?></td>
                                                        <td><?php echo $purchase["room_name"]; ?></td>
                                                        <td><?php echo $purchase["day"]; ?></td>
                                                        <td><?php echo $purchase["hour"]; ?></td>
                                                        <td><?php echo $purchase["count_tickets"]; ?></td>
                                                        <td><?php echo $purchase["total"]; ?></td>
                                                    </tr>
                            <?php
                                                }
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

<?php if (isset($message)) { ?>
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

?>