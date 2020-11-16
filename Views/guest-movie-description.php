<?php
  include_once('header.php'); 
  include_once('nav-bar-guess.php'); 
  
?>
  <!-- Page Content -->

  
<?php  foreach($moviesList as $movie ){ 
            if($movie->getId() == $show->getIdMovie()){
    ?>

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
    <div class="sidebar-container">
        <div class="content">
            <section class="section-long">

                <div class="section-line">
                    <div class="movie-info-entity">
                        <div class="entity-poster" data-role="hover-wrap">

                            <div class="embed-responsive embed-responsive-poster">
                                <img class="embed-responsive-item" src="https://image.tmdb.org/t/p/w185_and_h278_bestv2<?php echo $movie->getImage(); ?>" alt="" />
                            </div>
                            
                        </div>
                        
                        <div class="entity-content">
                            <h2 class="entity-title"><?php echo $movie->getTitle(); ?></h2>

                            <?php   
                                $namesGenre = array();
                                
                                foreach($genresList as $genre){
                                    for( $i=0 ; $i < count($movie->getGenres()) ; $i++ ){
                                    if($genre->getId() == $movie->getGenres()[$i]){
                                        array_push($namesGenre, $genre->getName());
                                    }
                                    }
                                    $arrayToString = implode(" - ", $namesGenre);
                                }
                            ?>
                            <div class="entity-category">
                                <span class="info-rest"><?php echo $arrayToString ;?></span>               
                            </div>

                            <div class="entity-info">
                                <div class="info-lines">
                                    <div class="info info-short">
                                        <span class="text-theme info-icon"><i class="fas fa-star"></i></span>
                                        <span class="info-text"><?php echo $movie->getScore(); ?></span>
                                        <span class="info-rest">/10</span>
                                    </div>
                                    <div class="info info-short">
                                        <span class="text-theme info-icon"><i class="fas fa-clock"></i></span>
                                        <span class="info-text"><?php echo $movie->getDuration(); ?></span>
                                        <span class="info-rest">&nbsp;min</span>
                                    </div>
                                </div>
                            </div>

                            <ul class="entity-list">
                                <li>
                                    <span class="entity-list-title">Language:</span><?php echo $movie->getOriginalLanguage(); ?>
                                </li>
                                <li>
                                    <span class="entity-list-title">Synopsis:</span><?php echo $movie->getOverview(); ?>
                                </li>
                                <li>
                                    <span class="entity-list-title">Room:</span><?php echo $show->getRoom(); ?>
                                </li>

                                <li>
                                    <span class="entity-list-title">Price:</span><?php 
                                        foreach($roomsList as $room){
                                            if($room["id_room"] == $show->getRoom()){
                                                echo $room["price"]; 
                                            }
                                        }
                                        ?>
                                </li>

                                <li>
                                    <form  action="<?php echo FRONT_ROOT ?>Purchase/Add" method="POST">

                                        <div class="form-group">
                                            <label>Cantidad de Entradas</label>
                                            <input  type="number" min="1" class="form-control col-sm-5" name="count_tickets" required/>
                                        </div>
                                        <?php 
                                        if($user){
                                            ?>
                                            <input type="hidden" name="id_user" value="<?php echo $user->getId(); ?>"/>

                                            <input type="hidden" name="id_show" value="<?php echo $show->getId(); ?>"/>
                                    
                                            <button type="submit" class="btn-theme btn"><i class="fas fa-ticket-alt"></i>&nbsp;&nbsp;Buy Ticket</button>
                                        <?php 
                                        }else{?>
                                            <label class="warrning-ticket">Tenes que estar logueado para poder comprar</label>
                                        <?php
                                        }
                                            ?>
                                    
                                    </form>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

                

            </section>
        </div>
    </div>
</div>

<?php 
            }    
        }
?>