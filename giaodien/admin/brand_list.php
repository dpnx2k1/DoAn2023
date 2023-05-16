<?php 

include "header.php";


include "class/brand_class.php";
?>
<?php
    if($_SESSION['current_user']['_status']==1){
    $brand = new brand;
    $show_brand= $brand->show_brand();
?>
  <div class="admin-content-right">
            <div class="admin-content-right-category-list">
                <h1>Danh sách Danh mục</h1>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>Mã danh mục</th>
                        <th>Tên danh mục</th>
                        <th>Tên loại sản phẩm</th>
                        <th>Tùy biến</th>
                    </tr>
                    <?php
                        if ($show_brand) {
                            $i=0;
                            while ($result = $show_brand->fetch_assoc()) {           
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $result['brand_id'];?></td>
                        <td><?php echo $result['category_id'];?></td> 
                        <td><?php echo $result['category_name'];?></td>
                        <td><?php echo $result['brand_name'];?></td>
                        <td><a href="brand_edit.php?brand_id=<?php echo $result['brand_id']?>">sửa</a>|<a href="brand_delete.php?brand_id=<?php echo $result['brand_id']?>">xóa</a></td>
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
<?php } ?>