<?php
include_once('header.php');
include_once('nav-bar-client.php');

?>
<!-- Page Content -->


<section class="after-head d-flex section-text-white position-relative">
    <div class="d-background" data-image-src="https://c1.wallpaperflare.com/preview/330/534/353/seat-chair-theatre-dark.jpg" data-parallax="scroll"></div>
    <div class="d-background bg-black-80"></div>
    <div class="top-block top-inner container">
        <div class="top-block-content">
            <h1 class="section-title">Movies list</h1>
            <div class="page-breadcrumbs">
                <span>Home</span>
                <span class="text-theme mx-2"><i class="fas fa-chevron-right"></i></span>
                <span>Movies</span>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <h2 style="color:white;">Your purchase:</h2>
</div>
<div class="container ticket-container">
    <div class="sidebar-container">
        <div class="content">
            <div class="section-line">
                <h2 class="entity-title"><?php 
                                                foreach ($moviesList as $movie) {
                                                    if ($movie->getId() == $userPurchase->GetShow()->getIdMovie()) {
                                                        $movieTitle = $movie->getTitle();
                                                    }
                                                }
                                                echo $movieTitle ?>
                </h2>
                <div class="entity-content qr-ticket-content">

                    <div class="entity-info">
                        <div class="info-lines">
                            <div class="info info-short">
                                <span class="text-theme info-icon"><i class="fas fa-film"></i></span>
                                <?php foreach ($roomsList as $room) {
                                    if ($room["id_room"] == $userPurchase->GetShow()->getRoom()) {
                                        $cinemaName = $room["cinema_name"];
                                    }
                                }
                                echo $cinemaName; ?>
                            </div>
                        </div>
                        <div class="info-lines">
                            <div class="info info-short">
                                <span class="text-theme info-icon"><i class="fas fa-chalkboard"></i></span>
                                <span class="info-text">Room:
                                    <?php foreach ($roomsList as $room) {
                                        if ($room["id_room"] == $userPurchase->GetShow()->getRoom()) {
                                            $roomName = $room["room_name"];
                                        }
                                    }
                                    echo $roomName; ?>
                                </span>
                            </div>
                        </div>
                        <div class="info-lines">
                            <div class="info info-short">
                                <span class="text-theme info-icon"><i class="fas fa-calendar-alt"></i></span>
                                <span class="info-text">Day: <?php echo $userPurchase->GetShow()->getDay(); ?></span>
                            </div>
                        </div>
                        <div class="info-lines">
                            <div class="info info-short">
                                <span class="text-theme info-icon"><i class="fas fa-clock"></i></span>
                                <span class="info-text"><?php echo $userPurchase->GetShow()->getHour(); ?></span>
                                <span class="info-rest">&nbsp;Hs</span>
                            </div>
                        </div>
                        <div class="info-lines">
                            <div class="info info-short">
                                <span class="text-theme info-icon"><i class="fas fa-money-bill-alt"></i></span>
                                <span class="info-rest">Price: $<?php echo $userPurchase->GetTotal() ?></span>
                            </div>
                        </div>
                        <div class="info-lines">
                            <div class="info info-short">
                                <span class="text-theme info-icon"><i class="fas fa-ticket-alt"></i></span> 
                                <span class="info-rest">Quantity: <?php echo $userPurchase->GetCountTicket() ?></span>
                            </div>
                        </div>

                    </div>
                    <?php 
                        $day = $userPurchase->GetShow()->getDay();
                        $hour = $userPurchase->GetShow()->getHour();
                        $price = $userPurchase->GetTotal();
                        $quantity = $userPurchase->GetCountTicket();
                        $movieTitle = str_replace(" ","+",$movieTitle);
                        $cinemaName = str_replace(" ", "+",$cinemaName);
                        $roomName = str_replace(" ", "+", $roomName);
                        $url = "https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=Movie:+{$movieTitle}+Cinema:+{$cinemaName}+Room:{$roomName}+Day:{$day}+Hour:{$hour}+Price:{$price}+Quantity:{$quantity}";
                        $contents = file_get_contents($url);
                        echo '<img class="qr-ticket" src="data:image/png;base64,'. base64_encode($contents) .'">';
                    ?>
                </div>
                <form action="<?php echo FRONT_ROOT ?>Purchase/Confirm" method="POST">
                    <input type="hidden" name="id_purchase" value="<?php echo $userPurchase->getIdUser(); ?>"/>
                    <input type="hidden" name="id_show" value="<?php echo $userPurchase->getShow()->getId(); ?>"/>
                    <input type="hidden" name="qr" value="<?php echo base64_encode($contents); ?>"/>
                    <button type="submit" class="btn-theme btn"><i class="fas fa-ticket-alt"></i>&nbsp;&nbsp;Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>