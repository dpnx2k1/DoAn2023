<?php 
include "headerF.php";
include "./classF/product_class.php";
    $product= new product;
    $product_id=$_GET['product_id'];
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
?>
   <!-- ----------------------------product-------------------------------- -->
   <section>
        <div class="product">
            <div class="container">
                <div class="product-top row">
                    <p><a href="index.php">Trang chủ</a></p>
                    <span>&#8594;
                    </span><p><?php echo $category_name['category_name']?></p><span>
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
                             <p><?php echo $result_pr['product_price']; ?><sup>đ</sup></p>
                             <p><?php echo $result_pr['product_price_pro']; ?><sup>đ</sup></p>
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
                             <i class="fa-solid fa-circle-check" style=<?php echo '"color:'.$color_id['product_color_id'].';margin-right:12px"'?>></i></label>
                              <?php }
                            } ?>
                        </div>
                        <div class="product-content-right-product-size">
                            <p style="font-weight: bold">Size :</p>
                            <div class="size">
                                <span>S</span>
                                <span>M</span>
                                <span>L</span>
                                <span>XL</span>
                                <span>XXL</span>
                            </div>
                        </div>
                        <div class="quantity">
                            <p style="font-weight: bold">Số Lượng :</p>
                            <input type="number" min="0" value="1">
                            
                        </div>
                        <p style="color: red;">vui lòng chọn size</p> 
                        <div class="product-content-right-product-button">
                                <button>
                                    <i class="fa-brands fa-shopify"></i>
                                    <p>MUA HÀNG</p>
                                </button>
                                <button>
                                   <p>TÌM TẠI CỦA HÀNG</p>
                                </button>
                        </div>
                        <div class="product-content-right-product-icon row">
                            <div class="product-content-right-product-icon-item">
                                <i class="fa-solid fa-phone"></i> 
                                <p>Hotline</p>
                            </div>
                            <div class="product-content-right-product-icon-item">
                                <i class="fa-regular fa-comment"></i>
                                <p>Chat</p>
                            </div>
                            <div class="product-content-right-product-icon-item">
                                <i class="fa-solid fa-envelope"></i>
                                <p>Email</p>
                            </div>
                        </div>
                        <div class="product-content-right-product-QR">
                            <img src="image/QR.png" alt="">
                        </div>
                        <div class="product-content-right-product-bottom">
                            <div class="product-content-right-product-bottom-top">
                                &#8744;
                            </div>
                            <div class="product-content-right-product-bottom-content-big">
                                <div class="product-content-right-product-bottom-content-big-title row">
                                    <div class="product-content-right-product-bottom-content-big-title-item chitiet">
                                            <p>Chi tiết</p>
                                    </div>
                                    <div class="product-content-right-product-bottom-content-big-title-item baoquan">
                                            <p>Bảo Quản</p>
                                    </div>
                                    <div class="product-content-right-product-bottom-content-big-title-item">
                                            <p>Tham khảo Size</p>
                                    </div>
                                </div>
                                <div class="product-content-right-product-bottom-content-center">
                                    <div class="product-content-right-product-bottom-content-center-chitiet">
                                        <p>Đầm dự tiệc phối hoa bản to nổi bật và ấn tượng, tạo điểm nhấn nhá trên trang phục của nàng, phù hợp để mặc đi dự các sự kiện lớn, tiệc tùng,... Thiết kế vai chờm vừa kín đáo vừa khoe được cánh tay thon gọn đồng thời tôn lên vóc dáng cân đối của nàng. Đầm dáng ôm, độ dài qua đầu gối, phần chân váy xẻ tà 1 bên quyến rũ. Kết hợp cùng chất vải tuytsi mềm mại, đứng phom càng tăng nét sang trọng cho bộ trang phục.
                                            <br>
                                            Thông tin mẫu:
                                            <br>
                                            Chiều cao: 167 cm
                                            <br>
                                            Cân nặng: 50 kg
                                            <br>
                                            Số đo 3 vòng: 83-65-93 cm
                                            <br>
                                            Mẫu mặc size M
                                            <br>
                                            Lưu ý: Màu sắc sản phẩm thực tế sẽ có sự chênh lệch nhỏ so với ảnh do điều kiện ánh sáng khi chụp và màu sắc hiển thị qua màn hình máy tính/ điện thoại.</p>
                                    </div>
                                    <div class="product-content-right-product-bottom-content-center-baoquan">
                                        <p>abczzz</p>
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