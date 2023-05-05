<?php 
include "header.php";
include "./class/slide_class.php";
?>
<?php
    $slide = new slide;
    $show_slide= $slide->show_slide();
?>
  <div class="admin-content-right">
            <div class="admin-content-right-category-list">
                <h1>Danh sách Danh mục</h1>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>Hình Ảnh</th>
                        <th>Tùy biến</th>
                    </tr>
                    <?php
                        if ($show_slide) {
                            $i=0;
                            while ($result = $show_slide->fetch_assoc()) {           
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $result['slide_id'];?></td>
                        <td><?php echo '<img style="width: 100px; height: 100px;" src="Upload/'.$result['slide_img'].'"/>'?></td>         
                        <td><a href="slide_edit.php?slide_id=<?php echo $result['slide_id']?>">Sửa</a>|
                        <a href="slide_delete.php?slide_id=<?php echo $result['slide_id']?>">Xóa</a></td>
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