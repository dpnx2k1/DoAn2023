<?php

use LDAP\Result;

include "header.php";
include "slider.php";
include "class/brand_class.php";
?>
<?php
    $brand = new brand;
    if(!isset($_GET["brand_id"]) || $_GET["brand_id"] == NULL){
        echo "<script>window.location='brand_list.php'</script>";
    }else {
        $brand_id = $_GET["brand_id"];
    
    $get_brand = $brand-> get_brand($brand_id);
    if ($get_brand) {
       $resultA= $get_brand->fetch_assoc();
    }   
}

    if($_SERVER["REQUEST_METHOD"] === "POST") { 
        $category_id = $_POST["category_id"];
        $brand_name = $_POST["brand_name"];
        $update_brand= $brand ->update_brand($brand_id,$brand_name,$category_id);
    }
?>
<style>
    select{
        margin: 5px 0;
        height: 35px;
        width: 200px;
    }
</style>
<div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>Thêm loại sản phẩm</h1>
                <form action="" method="POST">
                    <select name="category_id" id="">
                        <option value="">--Chọn danh mục</option>
                        <?php 
                        $show_category=$brand->show_category();
                        if ($show_category) {
                          while ($result_cate = $show_category -> fetch_assoc()) {                   
                        ?>
                        <option <?php if ($resultA['category_id']==$result_cate['category_id']) { echo "SELECTED";}?> 
                        value="<?php echo $result_cate['category_id'] ?>">
                        <?php echo $result_cate['category_name']?>
                        </option>
                        <?php
                         }
                        }
                        ?>
                    </select>
                    <br>
                    <input required name="brand_name" type="text" placeholder="nhập tên loại sản phẩm"
                    value="<?php echo $resultA['brand_name'] ?>">
                    <button type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>