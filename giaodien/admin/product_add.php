<?php 
include "header.php";

include "class/product_class.php";
?>
<?php
    $product = new product;
    if($_SERVER["REQUEST_METHOD"] === "POST") {
    //  echo '<pre>';
    //     echo print_r($_FILES['product_img_desciption']['name']);
    //  echo '</pre>';
        // var_dump($_POST);
        // var_dump($_FILES);
        $insert_product=$product->insert_product($_POST,$_FILES);
    }
?>
         <div class="admin-content-right">
             <div class="admin-content-right-product_add">
                <h1>Thêm Sản phẩm</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Nhập tên Sản Phẩm <span style="color: red;">*</span></label>
                    <input name="product_name" required type="text" placeholder="nhập tên sản phẩm">
                    <label for="">Chọn danh mục<span style="color: red;">*</span></label>
                    <select name="category_id" id="category_id">
                        <option value="#">--Chọn--</option>
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
                        <option value="#">--Chọn--</option>
                    </select>
                    <label for="product_size">Chọn size <span style="color: red;">*</span></label>
                    <select name="product_size" id="product_size">
                        <option value="#">--Chọn--</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>         
                    </select>
                    <label for="product_color_name">Chọn màu <span style="color: red;">*</span></label>
                    <select name="product_color_name" id="product_color_name">
                        <option value="#">--Chọn--</option>
                        <option value="Xanh lá">Xanh lá</option>
                        <option value="Đỏ">Đỏ</option>
                        <option value="Tím">Tím</option>
                        <option value="Vàng">Vàng</option>
                        <option value="Lục">Lục</option>  
                        <option value="Xanh Da Trời">Xanh Da Trời</option>
                        <option value="Hồng">Hồng</option>
                        <option value="Be">Be</option> 
                        <option value="Trắng">Trắng</option> 
                        <option value="Trắng">Đen</option>      
                    </select>
                    <label for="">Số Lượng Sản phẩm <span style="color: red;">*</span></label>
                    <input name="product_total"  required type="text">
                    <label for="">Giá Sản phẩm <span style="color: red;">*</span></label>
                    <input name="product_price"  required type="text">
                    <label for="">Giá Khuyến mãi <span style="color: red;">*</span></label>
                    <input name="product_price_pro" required type="text">
                    <label for="">Mô Tả sản phẩm<span style="color: red;">*</span></label>
                    <textarea name="product_description" id="editor" cols="500" rows="50"></textarea>
                    <label for="">hướng dẫn bảo quản sản phẩm<span style="color: red;">*</span></label>
                    <textarea name="product_pre" id="editor2" cols="500" rows="50"></textarea>
                    <label for="">Ảnh sản phẩm <span style="color: red;">*</span></label>
                    <input name="product_img" required  type="file">
                    <label for="">ảnh mô tả Sản Phẩm (4 ảnh)<span style="color: red;">*</span></label>
                    <input name="product_img_desciption[]" required  type="file" multiple="multiple">
                    <button type="submit">Thêm</button>
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