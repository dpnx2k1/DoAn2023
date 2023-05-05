<?php 
include "header.php";

include "class/category_class.php";
?>
<?php
    $category = new category;
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $category_name = $_POST["category_name"];
        $insert_category= $category ->insert_category($category_name);
    }
?>
<div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>Thêm Danh mục</h1>
                <form action="" method="POST">
                    <input required name="category_name" type="text" placeholder="nhập tên danh mục">
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>