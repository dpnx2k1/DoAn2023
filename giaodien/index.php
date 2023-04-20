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
            if ($show_slideF) {                      
                 while ($result = $show_slideF->fetch_assoc()) { ?>
               <?php  echo'<img src="admin/Upload/'.$result['slide_img'].'"/>'; ?>
          <?php    }
             }
        ?>  
        </div>
    </section>
    <div class="dot-container">
        <div class="dot "></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
    <br><br><br>
<?php 
include "footerF.php";
?>