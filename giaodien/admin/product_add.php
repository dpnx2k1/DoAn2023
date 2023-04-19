<?php 
include "header.php";
include "slider.php";
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
                    <label for="">Giá Sản phẩm <span style="color: red;">*</span></label>
                    <input name="product_price"  required type="text">
                    <label for="">Giá Khuyến mãi<span style="color: red;">*</span></label>
                    <input name="product_price_pro" required type="text">
                    <label for="">Mô Tả sản phẩm<span style="color: red;">*</span></label>
                    <textarea name="product_description" id="editor" cols="500" rows="10"></textarea>
                    <label for="">Ảnh sản phẩm <span style="color: red;">*</span></label>
                    <input name="product_img" required  type="file">
                    <label for="">ảnh mô tả Sản Phẩm <span style="color: red;">*</span></label>
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
     $(document).ready(function() {
		$("#category_id").change(function() {
            // alert($(this).val());
            var x = $(this).val();
			$.get("product_add_ajax.php",{category_id:x},function(data){
				$("#brand_id").html(data);
			});
		});
	});
    </script>
</html>