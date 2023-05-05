<?php 
include "header.php";

include "class/category_class.php";
?>
<?php
    $category = new category;
    if(!isset($_GET["category_id"]) || $_GET["category_id"] == NULL){
        echo "<script>window.location='category_List.php'</script>";
    }else {
        $category_id = $_GET["category_id"];
    
    $get_category = $category-> get_category($category_id);
    if ($get_category) {
       $resultA = $get_category->fetch_assoc();
    }   
}
?>
<?php
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $category_name = $_POST["category_name"];
            $update_category= $category ->update_category($category_id,$category_name);     
        }    
?>
<div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>Thêm Danh mục</h1>
                <form action="" method="POST">
                    <input required name="category_name" type="text"
                     value="<?php echo $result['category_name'] ?>">
                    <button type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>

