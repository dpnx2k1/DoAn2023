<?php
include "class/product_class.php";
    $product = new product;
    $category_id = $_GET['category_id'];
?>
<?php 
        $show_brand_ajax= $product->show_brand_ajax($category_id);
            if ($show_brand_ajax) {
                    while ($resultA = $show_brand_ajax->fetch_assoc()) {                                        
            ?>
          <option value="<?php echo $resultA['brand_id'] ?>"><?php echo $resultA['brand_name'] ?></option>
            <?php 
              }
         } 
?>
