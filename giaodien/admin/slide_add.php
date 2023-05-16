<?php 
include "header.php";
include "./class/slide_class.php";
?>
<?php if($_SESSION['current_user']['_status']==1){
    $slide = new slide;
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $insert_slide = $slide->insert_slide($_FILES);
    }
?>
         <div class="admin-content-right">
             <div class="admin-content-right-product_add">
                <h1>Thêm hình ảnh slide</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Ảnh slide <span style="color: red;">*</span></label>
                    <input name="slide_img[]" required multiple="multiple" type="file">
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
<?php } ?>