<?php
include "header.php";

include "class/product_class.php";
?>
<?php

    $product = new product;
    if($_SERVER["REQUEST_METHOD"] === "POST") {
       
        $update_product=$product->update_product($_POST,$_FILES);
    } 
    $product_id=$_GET['product_id'];
    $show_pro=$product->show_product_byid($product_id);
    if($show_pro){
        $pr=$show_pro->fetch_assoc();
    }
    $show_cate=$product->show_category_byid($pr['category_id']);
     if ($show_cate) {
            $kq=$show_cate->fetch_assoc(); 
    }
    $show_brand=$product->show_brand_byid($pr['brand_id']);
    if ($show_brand) {
        $kq2=$show_brand->fetch_assoc(); }
        
?>                  
         <div class="admin-content-right">
             <div class="admin-content-right-product_add">
                <h1>Sửa Sản phẩm</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Nhập tên Sản Phẩm <span style="color: red;">*</span></label>
                    <input name="product_name" required type="text" placeholder="nhập tên sản phẩm" value="<?=$pr['product_name']?>" >
                    <label for="">Chọn danh mục<span style="color: red;">*</span></label>
                    <select name="category_id" id="category_id">     
                        <option value="<?=$kq['category_id']?>"><?php echo $kq['category_name']?></option>
                        <?php $show_category=$product->show_category();
                        if ($show_category) {
                            while ($result=$show_category->fetch_assoc()) {
                                                 
                        ?>
                        <option value="<?php echo $result['category_id'] ?>"><?php echo $result['category_name'] ?></option>
                        <?php     }
                        } ?>
                    </select>
                    <label for="">Chọn loại Sản Phẩm <span style="color: red;">*</span></label>
                    <select name="brand_id" id="brand_id">
                        <option value="<?=$pr['brand_id']?>"><?=$kq2['brand_name']?></option>
                    </select>
                    <label for="product_size">Chọn size <span style="color: red;">*</span></label>
                    <select name="product_size" id="product_size">
                        <option value="<?=$pr['product_size']?>"><?=$pr['product_size']?></option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>         
                    </select>
                    <label for="product_color_name">Chọn màu <span style="color: red;">*</span></label>
                    <select name="product_color_name" id="product_color_name">
                    <option value="<?=$pr['product_color_name']?>"><?=$pr['product_color_name']?></option>
                        <option value="Xanh lá">Xanh lá</option>
                        <option value="Đỏ">Đỏ</option>
                        <option value="Tím">Tím</option>
                        <option value="Vàng">Vàng</option>
                        <option value="Lục">Lục</option>  
                        <option value="Xanh Da Trời">Xanh Da Trời</option>
                        <option value="Hồng">Hồng</option>
                        <option value="Be">Be</option>        
                    </select>
                    <label for="">Số Lượng Sản phẩm <span style="color: red;">*</span></label>
                    <input name="product_total"  required type="text" value="<?=$pr['product_total']?>">
                    <label for="">Giá Sản phẩm <span style="color: red;">*</span></label>
                    <input name="product_price"  required type="text" value="<?=$pr['product_price']?>">
                    <label for="">Giá Khuyến mãi<span style="color: red;">*</span></label>
                    <input name="product_price_pro" required type="text" value="<?=$pr['product_price_pro']?>">
                    <label for="">Mô Tả sản phẩm<span style="color: red;">*</span></label>
                    <textarea name="product_description" id="editor" cols="500" rows="50"><?=$pr['product_description']?></textarea>
                    <label for="">hướng dẫn bảo quản sản phẩm<span style="color: red;">*</span></label>
                    <textarea name="product_pre" id="editor2" cols="500" rows="50"><?=$pr['product_pre']?></textarea>
                    <label for="">Ảnh sản phẩm <span style="color: red;">*</span></label>
                    <input name="product_img" required  type="file" value="Upload/<?=$pr['product_img']?>">
                    <label for="">ảnh mô tả Sản Phẩm <span style="color: red;">*</span></label>
                    <input name="product_img_desciption[]" required  type="file" multiple="multiple">
                    <button type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>
    <script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
      <script>
    ClassicEditor
        .create( document.querySelector( '#editor2' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
    <script>
     $(document).ready(function() {
		$("#category_id").click(function() {
            //  alert($(this).val());
            var x = $(this).val();
			$.get("product_add_ajax.php",{category_id:x},function(data){
				$("#brand_id").html(data);
			});
		});
	});
    </script>
</html>
