<?php 
include "headerF.php";
include "./classF/category_class.php";
?>
<?php 

      if (session_id()=='') {
        session_start();
      }
      $category= new categoryF;
      if (isset($_GET['brand_id'])) {
      $brand_id=$_GET['brand_id'];
      $_SESSION['brand_id']=$brand_id;
      $show_brand_name = $category->show_brand_c($brand_id);
      if ($show_brand_name) {
      $resultC=$show_brand_name->fetch_assoc();   
     } 

      $param = "";
      $sortParam = "brand_id=".$_SESSION['brand_id']."&item_per_page=8&page=1&";
      $orderConditon = "";
      //tim kiem
        $search = isset($_GET['name']) ? $_GET['name'] : "";
        if ($search) {   
            $where = "WHERE `name` LIKE '%" . $search . "%'";
            $param .= "name=".$search."&";
            $sortParam =  "name=".$search."&"."brand_id=".$_SESSION['brand_id']."&item_per_page=8&page=1&";
        }

         //Sắp xếp
    $orderField = isset($_GET['field']) ? $_GET['field'] : "";
    $orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";
    if(!empty($orderField)
        && !empty($orderSort)){
        $orderConditon = "ORDER BY `tbl_product`.`".$orderField."` ".$orderSort;
        $param .= "field=".$orderField."&sort=".$orderSort."&"."brand_id=". $_SESSION['brand_id']."&";
    }

 
    
    
?>
 <!---------------------------------- category ------------------------------------>
 <section class="category">
        <div class="container">
            <div class="category-top row">
                <p><a href="index.php">Trang chủ</a></p><span>&#8594;</span>
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

                        <div class="category-right-top-item-seach">
                        <form id="product-search" method="GET">

                        <input style="display: none;"  type="text" name="brand_id" value="<?= $_SESSION['brand_id']?>">
                        <input style="display: none;"  type="text" name="item_per_page" value="8">
                        <input style="display: none;"  type="text" name="page" value="1">
                        <input type="text" value="<?=isset($_GET['name']) ? $_GET['name'] : ""?>" name="name" placeholder="tìm kiếm"/>
                        <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                        </div>
                        <div class="category-right-top-item ">
                        <select id="sort-box" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)">
                    <option value="">Sắp xếp giá</option> 
                    <option <?php if(isset($_GET['sort']) && $_GET['sort'] == "desc"&& isset($_GET['field']) && $_GET['field'] == "product_price_pro") { ?> selected <?php } ?> value="?<?=$sortParam?>field=product_price_pro&sort=desc">Giá KM Cao -> thấp</option>
                    <option <?php if(isset($_GET['sort']) && $_GET['sort'] == "asc"&& isset($_GET['field']) && $_GET['field'] == "product_price_pro") { ?> selected <?php } ?> value="?<?=$sortParam?>field=product_price_pro&sort=asc">Giá KM Thấp -> cao</option>
                    <option <?php if(isset($_GET['sort']) && $_GET['sort'] == "desc" && isset($_GET['field']) && $_GET['field'] == "product_price") { ?> selected <?php } ?> value="?<?=$sortParam?>field=product_price&sort=desc">Giá Cao -> thấp</option>
                    <option <?php if(isset($_GET['sort']) && $_GET['sort'] == "asc" && isset($_GET['field']) && $_GET['field'] == "product_price") { ?> selected <?php } ?> value="?<?=$sortParam?>field=product_price&sort=asc">Giá Thấp -> cao</option>
                   
                    </select>
                        </div>
                    </div>
                    <div class="category-right-content row">
                        <?php 
                            $brand_id_show=$_GET['brand_id'];
                            $item_per_page=!empty($_GET['item_per_page'])?$_GET['item_per_page']:8;
                            $curren_page=!empty($_GET['page'])?$_GET['page']:1;
                            $offset=($curren_page-1)*$item_per_page;
                            
                            if($search){
                                $product_category=$category->show_product_by_brandid2($orderConditon,$search,$brand_id_show,$item_per_page,$offset);
                                $total=$category->show_product_by_brandid3($orderConditon,$search,$brand_id_show);
                                if ($total) {
                                   $total=$total->num_rows;  //var_dump($total);exit;
                                }
                                $total_page=ceil($total/$item_per_page);
                            }
                            else{ 
                              $total =$category->show_product_total($_SESSION['brand_id']);
                                if ( $total) {
                                     $total=$total->num_rows;// var_dump($total);exit;
                                }      
                                $total_page=ceil($total/$item_per_page);
                                $product_category=$category->show_product_by_brandid($orderConditon,$brand_id_show,$item_per_page,$offset);}
                            if ($product_category) {
                               while ($kq=$product_category->fetch_assoc()) {
                        
                        ?>
                            <div  class="category-right-content-item">
                                <a href=<?php echo'product.php?product_id='.$kq['product_id'].''; ?>><img src=<?php echo'"admin/Upload/'.$kq['product_img'].'"'; ?> alt=""></a>
                           
                                <h3 class="cart_title"><?php echo $kq['product_name']  ?></h3>
                          
                            <?php if(!empty($kq['product_price_pro'])&& $kq['product_price_pro'] >0) {
                             ?>
                             <div class="text"><h4><?=number_format($kq['product_price'])?><sup>đ</sup></h4></div> 
                             <p><?php echo number_format($kq['product_price_pro']); ?><sup>đ</sup></p>
                            <?php }else{ ?>
                            <h4><?php echo number_format($kq['product_price']); ?><sup>đ</sup></h4>
                           <?php  } ?>
                        
                            </div>
                    
                            
                         <?php }} ?>
                 
                                  
                 </div>
                 <div class="category-right-bottom row">
                            <div class="category-right-bottom-item">
                                <?php include "./pageCategory.php"; ?>
                            </div>
                </div>  
         </div>
    </div>
    </section>
<?php 
include "footerF.php";}
?>