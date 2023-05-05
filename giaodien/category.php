<?php 
include "headerF.php";
include "./classF/category_class.php";
?>
<?php 
    $category= new categoryF;
    if (isset($_GET['brand_id'])) {
    $brand_id=$_GET['brand_id'];
    $show_brand_name = $category->show_brand_c($brand_id);
    if ($show_brand_name) {
    $resultC=$show_brand_name->fetch_assoc();   
   } 
    }else {
        header('location:category.php?brand_id=12&item_per_page=8&page=1');
    }
    
?>
 <!---------------------------------- category ------------------------------------>
 <section class="category">
        <div class="container">
            <div class="category-top row">
                <p>Trang chủ</p><span>&#8594;</span>
                <p>
                <?php 
                    $category_id=$resultC['category_id'];
                    $show_cate_name=$category->show_category_by_id($category_id);
                  if ($show_cate_name) {
                       $kq=$show_cate_name-> fetch_assoc();
                  }
                 echo $kq['category_name']?></p>
                 <span>&#8594;</span>
                 <p><?php echo $resultC['brand_name'];?></p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="category-left">
                    <ul>   
                        <?php 
                        $show_category= $header ->show_category_header();
                         if($show_category) {
                            while ($result= $show_category->fetch_assoc()) { 
                                $category_id= $result['category_id']; 
                               
                        ?>
                       <li class="category-letf-li "><a href="#"><?php echo $result['category_name']?></a> 
                        <ul>
                        <?php  
                         $show_brand = $header->show_brand($category_id);
                            if($show_brand){
                            while($resultB=$show_brand->fetch_assoc()){                       
                          ?>  
                            <li><a href=<?php echo'category.php?brand_id='.$resultB['brand_id'].''; ?>><?php echo $resultB['brand_name']?></a></li> 
                        <?php }}?>
                    </ul>
                    </li>
                      <?php }}?>
                </ul>
                </div>
                <div class="category-right"> 
                    <div class="row">
                         <div class="category-right-top-item ">
                            <p><?php echo $resultC['brand_name'];?></p>
                        </div>
                   
                        <div class="category-right-top-item ">
                            <button><span>Bộ lọc</span><i class="fas fa-sort-down"></i></button>
                        </div>
                        <div class="category-right-top-item ">
                            <select name="sapxep" id="">
                                <option value="">sắp xếp</option>
                                <option value="">Giá cáo đến thấp</option>
                                <option value="">Giá thấp đến cao</option>
                            </select>
                        </div>
                    </div>
                    <div class="category-right-content row">
                        <?php 
                            $brand_id_show=$_GET['brand_id'];
                            $item_per_page=!empty($_GET['item_per_page'])?$_GET['item_per_page']:8;
                            $curren_page=!empty($_GET['page'])?$_GET['page']:1;
                            $offset=($curren_page-1)*$item_per_page;
                            $total=$category->show_product_total($brand_id);
                            $total=$total->num_rows; // var_dump($total);
                            $total_page=ceil($total/$item_per_page);
                            $product_category=$category->show_product_by_brandid($brand_id_show,$item_per_page,$offset);
                            if ($product_category) {
                               while ($kq=$product_category->fetch_assoc()) {
                        
                        ?>
                            <div  class="category-right-content-item ">
                                <a href=<?php echo'product.php?product_id='.$kq['product_id'].''; ?>><img src=<?php echo'"admin/Upload/'.$kq['product_img'].'"'; ?> alt=""></a>
                                <h1><?php echo $kq['product_name']  ?></h1>
                                <p><?php echo $kq['product_price']  ?><sup>đ</sup></p>
                            </div>
                            
                         <?php }} ?>
                 
                                  
                 </div>
                 <div class="category-right-bottom row">
                            <div class="category-right-bottom-item">
                                <p>Hiển thị 2 <span>|</span> 4 sản phẩm</p>
                            </div>
                            <div class="category-right-bottom-item">
                                <?php include "./pageCategory.php"; ?>
                            </div>
                </div>  
         </div>
    </div>
    </section>
<?php 
include "footerF.php";
?>