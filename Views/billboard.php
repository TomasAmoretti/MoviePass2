<?php
require_once(VIEWS_PATH."nav-bar-cliente.php");
?>

<div id="mainav">
    <?php 

    foreach($genre_list as $value){ 
    ?>
      <li><a href="<?php echo FRONT_ROOT; ?>Cartelera/showMovies/<?php echo $value->getId()?>"><?php echo $value->getName()?></a></li>

    <?php }?>

</div>


<div id="mainav2">
    <?php 

    foreach($movie_list as $movie){
        
        echo "<li>";
        echo    "<div class='card' >";
        echo        "<div ><img src='http://image.tmdb.org/t/p/w185".$movie->getImagen()."'></div>";
        echo           "<div class='title'>
                          <p>".$movie->getTitulo()."</p>
                      </div>";
                      echo           "<div class='title'>
                          <p>".$movie->getRating()."</p>
                      </div>";
                      echo           "<div class='title'>
                          <p>".$movie->getLenguaje()."</p>
                      </div>";
        echo    "</div>";
        echo "</li>";
        }
        ?>

</div>