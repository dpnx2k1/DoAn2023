<?php 
include "header.php";
include "slider.php";
include "./class/slide_class.php";
?>
<?php
    $slide = new slide;
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $update_slide = $slide->update_slide();
        // var_dump($_FILES['slide_img']);
    }
?>
         <div class="admin-content-right">
             <div class="admin-content-right-product_add">
                <h1>sửa hình ảnh slide</h1>
                <form action="slide_edit.php?slide_id=<?=$_GET['slide_id']?>" method="POST" enctype="multipart/form-data">
                    <label for="">Ảnh slide <span style="color: red;">*</span></label>
                    <input name="slide_img[]" required multiple="multiple"  type="file">
                    <button type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>