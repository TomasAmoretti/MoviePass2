<?php
require_once(VIEWS_PATH."nav-bar-cliente.php");
?>

<div id="mainav">
    <?php 

    foreach($genre_list as $value){ 
    ?>
      <li><a href="<?php echo FRONT_ROOT; ?>Billboard/showMovies/<?php echo $value->getId()?>"><?php echo $value->getName()?></a></li>

    <?php } ?>

</div>


<div id="mainav">
    <?php 

    foreach($movie_list as $movie){
        
        echo "<li>";
        echo    "<div class='card' >";
        echo        "<div ><img src='http://image.tmdb.org/t/p/w185".$movie->GetImagen()."'></div>";
        echo           "<div class='title'>
                          <p>".$movie->GetTitulo()."</p>
                     </div>";
        echo    "</div>";
        echo "</li>";
        }
        ?>

</div>