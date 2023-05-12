<?php 
include "config/session.php";
include "headerF.php";
include "./classF/product_class.php";

    // $session= new Session;
    // $session_Pr=$session->init();
     $product= new product;
    if (isset($_GET['product_id'])) {
    
        $product_id =$_GET['product_id'];
        $show_product= $product->show_product_byid($product_id);
        if ($show_product) {
            $result_pr= $show_product->fetch_assoc();
        }
        $category_id = $result_pr['category_id'];
        $show_category_pr= $product->show_category_in_product($category_id);
        if ($show_category_pr) {
            $category_name=$show_category_pr->fetch_assoc();
        }
        $brand_id = $result_pr['brand_id'];
        $show_brand_pr= $product->show_brand_in_product($brand_id);
        if ($show_brand_pr) {
            $brand_name=$show_brand_pr->fetch_assoc();
        }
        // $product_name=$result_pr['product_name'];
        // if(!isset( $_SESSION['product_name'] ) )
        // {
        //     $_SESSION['product_name'] =$product_name;
        // }
        // else
        // {   
        //     $_SESSION['product_name'] = '';
        // }
    }
    
?>
   <!-- ----------------------------product-------------------------------- -->
   
   <section>
        <div class="product">
            <div class="container">
                <div class="product-top row">
                    <p><a href="index.php">Trang chủ</a></p>
                    <span>&#8594;
                    </span><p><?php  echo $category_name['category_name']?></p><span>
                    &#8594;
                    </span><?php echo $brand_name['brand_name']?><p></p><span>
                    &#8594;
                    </span><p><?php echo $result_pr['product_name']?></p>
                </div>
                <div class="product-content row">
                    <div class="product-content-left row">
                        <div class="product-content-left-big-img">
                        <img src=<?php echo'"admin/Upload/'.$result_pr['product_img'].'"'; ?> alt="">
                        </div>
                        <div class="product-content-left-small-img">
                            <?php $product_img_des=$product->get_product_img_small($product_id);
                                if ($product_img_des) {
                                    while ($img_small=$product_img_des->fetch_assoc()) {                              
                            ?>
                            <img src=<?php echo'"admin/Upload/'.$img_small['product_img_desciption'].'"'; ?> alt="">
                     <?php     }}  ?>
                        </div>
                    </div>
                    <div class="product-content-right">
                        <div class="product-content-right-product-name">
                            <h1><?php echo $result_pr['product_name']; ?></h1>
                            <p>MSP:<?php echo $result_pr['product_id']; ?></p>   
                        </div>
                        <div class="product-content-right-product-price row"> 
                                
                             <?php if(!empty($result_pr['product_price_pro'])) {
                             ?>
                             <p style="text-decoration: solid line-through;"><?=number_format($result_pr['product_price'])?><sup>đ</sup></p>
                             <p><?php echo number_format($result_pr['product_price_pro']); ?><sup>đ</sup></p>
                            <?php }else{ ?>
                            <p><?php echo number_format($result_pr['product_price']); ?><sup>đ</sup></p>
                           <?php  } ?>
                            
                        </div>
                        <div class="product-content-right-product-color">
                            <p><span style="font-weight: bold;">Màu Sắc :</span>
                            <?php
                            echo $result_pr['product_color_name'];
                             ?><span style="color: red">*</span></p>
                        </div>
                        <div class="product-content-right-product-color-img">
                            <?php 
                             $get_color_id= $product->get_color_id_by_product_id($result_pr['product_color_name']);
                            if ($get_color_id) {
                           
                               while ($color_id=$get_color_id->fetch_assoc()) {
                               
                              ?>
                             <i class="fa-solid fa-circle-check" style=<?php echo '"color:'.$color_id['color_id'].';margin-right:12px"'?>></i>
                              <?php }
                            } ?>
                        </div>
                        <!-- <?php //echo'"product.php?product_id='.$result_pr['product_id'].'"'?> -->
                        <form action="cart.php?action=add" method="POST">
                        <div class="product-content-right-product-size">
                            <p style="font-weight: bold;padding-top: 2px;margin-right: 5px;">Size :</p>
                            <div class="size">   
                              <select name="product_size" id="product_size">
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXl</option>
                              </select>
                              <input type="text" name="product_color_name" style="display: none;" value="<?php echo $result_pr['product_color_name'];?>">
                              <input type="text" name="product_name" style="display: none;" value="<?php echo $result_pr['product_name'];?>">
                            
                            </div> 
                        </div>
                        <div class="quantity">
                            <p style="font-weight: bold;">Số Lượng :</p>
                            <input name="<?php echo 'quantity_pr['.$result_pr['product_id'].']'?>" type="number" min="0" value="1"> 
                        </div>
                    
                        <div class="product-content-right-product-button">
                               <a href="cart.php"> <button type="submit">
                                    <i class="fa-brands fa-shopify"></i>
                                    <p>MUA NGAY</p>
                                </button></a>

                                <a href="cart.php"><button type="submit">
                                   <p>THÊM VÀO GIỎ HÀNG</p>
                                </button> </a>
                        </div>
                        </form>
                        <br> 
                 
                        <div class="product-content-right-product-icon row">
                            <div class="product-content-right-product-icon-item">
                                <i class="fa-solid fa-phone"></i> 
                                <p>Hotline :0349146200</p>
                            </div>
                            <div class="product-content-right-product-icon-item">
                                <i class="fa-solid fa-envelope"></i>
                                <p>Email :dpnx1234@gmail.com</p>
                            </div>
                        </div>
                        <div class="product-content-right-product-bottom">
                            <div class="product-content-right-product-bottom-top">
                                &#8744;
                            </div>
                            <div class="product-content-right-product-bottom-content-big">
                                <div class="product-content-right-product-bottom-content-big-title row">
                                    <div class="product-content-right-product-bottom-content-big-title-item chitiet">
                                            <p>Giới Thiệu |</p>
                                    </div>
                                    <div class="product-content-right-product-bottom-content-big-title-item baoquan">
                                            <p>Bảo Quản </p>
                                    </div>
                                    <!-- <div class="product-content-right-product-bottom-content-big-title-item thamkhao">
                                            <p>Tham khảo Size</p>
                                    </div> -->
                                </div>
                                <div class="product-content-right-product-bottom-content-center">
                                    <div class="product-content-right-product-bottom-content-center-chitiet">
                                    <?php echo $result_pr['product_description']?>
                                    </div>
                                    <div class="product-content-right-product-bottom-content-center-baoquan">
                                    <?php echo $result_pr['product_pre']?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
  
    </section>
    <!-- ----product liên quan  -->
    <section>
        <div class="product-related container">
            <div class="product-related-title">
                <p>SẢN PHẨM LIÊN QUAN</p>
            </div>
            <div class="product-content row">
                <div class="product-related-item">
                    <img src="image/sp2.jpg" alt="">
                    <h1>AO SƠ MI CỔ TRÒN</h1>
                    <p>79.000 <sup>đ</sup></p>
                </div>
                <div class="product-related-item">
                    <img src="image/sp3.jpg" alt="">
                    <h1>AO SƠ MI CỔ TRÒN</h1>
                    <p>79.000 <sup>đ</sup></p>
                </div>
                <div class="product-related-item">
                    <img src="image/sp4.jpg" alt="">
                    <h1>AO SƠ MI CỔ TRÒN</h1>
                    <p>79.000 <sup>đ</sup></p>
                </div>
                <div class="product-related-item">
                    <img src="image/sp5.jpg" alt="">
                    <h1>AO SƠ MI CỔ TRÒN</h1>
                    <p>79.000 <sup>đ</sup></p>
                </div>
                <div class="product-related-item">
                    <img src="image/sp5.jpg" alt="">
                    <h1>AO SƠ MI CỔ TRÒN</h1>
                    <p>79.000 <sup>đ</sup></p>
                </div>
            </div>
        </div>
    </section>

<?php 
include "footerF.php";
?>