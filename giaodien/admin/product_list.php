<?php 
include "header.php";
include "slider.php";
include "./class/product_class.php";
include "../config/session.php";
?>
<?php
    $product = new product;
    $show_product= $product->show_product();
?>
  <div class="admin-content-right">
            <div class="admin-content-right-category-list">
                <h1>Danh sách sản phẩm</h1>
                <!-- <label for=""></label>
                <input name="find_product" type="text"> -->
                <table>
                    <tr>
                        <th>ID</th> 
                        <th>ID Danh Mục</th>
                        <th>ID loại SP</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Giá KM</th>
                        <th>Hình Ảnh</th>
                        <th>Size</th>
                        <th>Màu</th>
                        <th>số lượng</th>        
                        <th>Tùy biến</th>
                    </tr>
                    <?php
                        if ($show_product) {
              
                            while ($result = $show_product->fetch_assoc()) {           
                         
                    ?>
                    <tr>
                        <td><?=$result['product_id']?></td>
                        <td><?=$result['category_id']?></td>
                        <td><?=$result['brand_id']?></td>
                        <td><?=$result['product_name']?></td>
                        <td><?=$result['product_price']?></td>
                        <td><?=$result['product_price_pro']?></td>


                        <td><?php echo '<img style="width: 100px; height: 100px;" src="Upload/'.$result['product_img'].'"/>'?></td>    
                        <td><?=$result['product_size']?></td>
                        <td><?=$result['product_color_name']?></td>
                        <td><?=$result['product_total']?></td>    
                        <td><a href="edit_product.php?product_id=<?php echo $result['product_id']?>">Sửa</a>|
                        <a href="product_delete.php?product_id=<?php echo $result['product_id']?>">Xóa</a></td>
                    </tr>
                    <?php
                          }
                        }
                    ?>
                </table>
            </div>
        </div>
    </section>
</body>

</html>