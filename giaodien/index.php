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
   <section class="section-info">
        <div class="container">
               <div class="main-info">
                <h4>Spring 2023</h4>
               </div>

       
          <?php 
          include "./classF/product_class.php";
          $product=new product;
          // print_r($_SESSION['brand_id']);exit;
           $pr_2=$product->show_product_hot();
           $rowcount=mysqli_num_rows($pr_2);

        ?>
          <section>
          <div class="product-related container">
                <div class="product-related-title">
                    <p>SẢN PHẨM NỔI BẬT</p>
                </div>
                <div class="product-content row">
                    <?php 
                  //  print_r($rowcount);exit;
                      $n=5;
                      if ($rowcount<5) {
                        $n=$rowcount;
                      }
                      if ($pr_2) {
                        for ($i=0; $i <$n ; $i++){  $show=$pr_2->fetch_assoc();?>
                        <div class="product-related-item">
                        <a href=<?php echo'product.php?product_id='.$show['product_id'].''; ?>><img src=<?php echo'"admin/Upload/'.$show['product_img'].'"'; ?> alt=""></a>
                        <h1 class="cart_title"><?php echo $show['product_name']  ?></h1>
                        <?php if(!empty($show['product_price_pro'])&& $show['product_price_pro'] >0) {
                                    ?>
                                    <div class="text"><h4><?=number_format($show['product_price'])?><sup>đ</sup></h4></div> 
                                    <p><?php echo number_format($show['product_price_pro']); ?><sup>đ</sup></p>
                                    <?php }else{ ?>
                                    <h4><?php echo number_format($show['product_price']); ?><sup>đ</sup></h4>
                        <?php  } ?>
                        </div>
              
                    <?php  }} ?>
                  </div>
             </div>
          </section>
        </div>
   </section>
<?php 
include "footerF.php";
?>