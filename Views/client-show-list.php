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
        <div class="section-pannel">
          <div class="grid row">
              <div class="col-md-10">
              
                      <div class="row form-grid">

                        <!-- Filter for Genre -->
                          <div class="col-sm-6 col-lg-3">
                              <div class="input-view-flat input-group">

                                <div class="dropdown drop-category">
                                    <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Category
                                    </button>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                    <?php   foreach($genresList as $genre){ ?>
                                        <a class="dropdown-item" href="<?php echo FRONT_ROOT."Home/MovieListByGenre?id=".$genre->getId()?>" > <?php echo $genre->getName(); ?>  </a>
                                    <?php } ?>

                                    </div>
                                </div>
                              </div>
                          </div>

                        
                        <!-- Filter for Date -->
                          <div class="col-sm-8 col-lg-4 row">
                            <form class="input-view-flat input-group" action="<?php echo FRONT_ROOT."Home/MovieListByDate";?>" method="POST">
          
                                <input class="col-8 form-control lg" id="date" type="date" step="1" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" name="day"/>  
                                <hr>
                                <button type="submit" class="col-3 btn btn-dark"> Filtrar </button>
                            </form>
                          </div>

                      </div>
                 
              </div>
            
          </div>
        </div>


    <div class="row">
        

        <?php   foreach($moviesList as $movie){ 
                  foreach($showsList as $show){ 
                      if($movie->getId() == $show->getIdMovie()){  
                        if($show->getState()){?>

          <article class="movie-line-entity">
            <div class="entity-poster" data-role="hover-wrap">
              <div class="embed-responsive embed-responsive-poster">
                <a href="<?php echo FRONT_ROOT."Home/MovieDescription?id_movie=".$show->getId();?>" >
                  <img class="embed-responsive-item" src="https://image.tmdb.org/t/p/w185_and_h278_bestv2<?php echo $movie->getImage(); ?>" alt="" />
                </a>
              </div>
            </div>
            <div class="entity-content">
              <h4 class="entity-title">
                  <a class="content-link" href="<?php echo FRONT_ROOT."Home/MovieDescription?id_movie=".$show->getId();?>"><?php echo $movie->getTitle(); ?></a>
              </h4>

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
              <p class="text-short entity-text">
                <?php echo $movie->getOverview(); ?>
              </p>
            </div>
            <div class="entity-extra">
              <div class="text-uppercase entity-extra-title">Showtimes</div>

              <?php
                foreach($showsList as $show){ 
                        if($movie->getId() == $show->getIdMovie()) { ?>

                    <form action="<?php echo FRONT_ROOT ?>Home/MovieDescription"  method = "post">
                        <div class="entity-showtime">
                            <button type="submit" name="id_show" class="btn btn-warning" value="<?php echo $show->getId(); ?>" ?>  <?php echo $show->getDay()."  ".$show->getHour() ; ?> </button>
                        </div>
                    </form>

              <?php 
                            
                        }
                    }
            ?>


            </div>
          </article>

          <?php 
                            break;
                            }
                          }
                        }
                    }
            ?>

    </div>
    <!-- /.row -->

</div>
  <!-- /.container -->
