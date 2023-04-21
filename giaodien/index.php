<?php 
include "headerF.php";
?>
<?php 
    $slideF= new index;
    $show_slideF= $slideF->show_slideF();
?>
    <section id="slider">
        <div class="aspect-ratio-169">
        <?php
            $i=0;
            if ($show_slideF) {                      
                 while ($result = $show_slideF->fetch_assoc()) {
                    $i++;
                    ?>
               <?php  echo'<img src="admin/Upload/'.$result['slide_img'].'"/>'; ?>
          <?php    }
             }
        ?>  
        </div>
    </section>
    <div class="dot-container">
    <?php     
      for ($x=0; $x <$i ; $x++) { 
        ?>  
        <div class="dot "></div>
      <?php } ?>
       
    </div>
    <br><br><br>
<?php 
include "footerF.php";
?>