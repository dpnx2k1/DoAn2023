
<?php 
include "header.php";
include "./class/product_class.php";
$con=mysqli_connect("localhost","root","123456789","db_doan");   

if (!empty($_SESSION['current_user'])) {
    
    if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){
        $_SESSION['product_filter'] = $_POST;
        header('Location: product_list.php').exit;
    }
    if(!empty($_SESSION['product_filter'])){
        $where = "";
        foreach ($_SESSION['product_filter'] as $field => $value) {
            if(!empty($value)){
                $kq=addcslashes($value,"qwertyuiopasdfghjklzxcvbnm0987654321");
                $result=str_replace("\\",'%',$kq);
                // echo $result;
                switch ($field) {
                    case 'product_name':
                        $where .= (!empty($where))? " AND "."`".$field."` LIKE '%".$result."%'" : "`".$field."` LIKE '%".$result."%'";
                    break;
                    default:
                        $where .= (!empty($where))? " AND "."`".$field."` = ".$value."": "`".$field."` = ".$value."";
                    break;
                }
            }
        }
       // var_dump($_SESSION['product_filter']);
        extract($_SESSION['product_filter']);
    }

    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 5;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    $totalRecords = mysqli_query($con, "SELECT * FROM `tbl_product`");
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(!empty($where)){
        $products = mysqli_query($con, "SELECT * FROM `tbl_product` where (".$where.") ORDER BY `product_id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }else{
        $products = mysqli_query($con, "SELECT * FROM `tbl_product` ORDER BY `product_id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($con);
    ?>
  <div class="admin-content-right">
            <div class="admin-content-right-category-list">
                <h1>Danh sách sản phẩm</h1>
                <div class="product_search">
                <form id="product_search-form" action="product_list.php?action=search" method="POST">
                <fieldset>
                    <legend>Tìm kiếm sản phẩm</legend>
                    ID : <input style="width: 35px;" type="text" name="product_id" value="<?=!empty($product_id)?$product_id:""?>">
                    Tên : <input type="text" name="product_name" placeholder="<?=!empty($product_name)?$product_name:""?>">
                    <input type="submit" value="Tìm">
                </fieldset>
                    </form>
                </div>
                <table>
                    <tr>
                        <th>ID</th> 
                        <th>ID Danh Mục</th>
                        <th>ID loại SP</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Giá KM</th>
                        <th>Hình Ảnh</th>
                        <th>Size</th>
                        <th>Màu</th>
                        <th>số lượng</th>        
                        <th>Tùy biến</th>
                    </tr>
                    <?php
                        if ($products) {
              
                            while ($result = $products->fetch_assoc()) {           
                         
                    ?>
                    <tr>
                        <td><?=$result['product_id']?></td>
                        <td><?=$result['category_id']?></td>
                        <td><?=$result['brand_id']?></td>
                        <td><?=$result['product_name']?></td>
                        <td><?=$result['product_price']?></td>
                        <td><?=$result['product_price_pro']?></td>


                        <td><?php echo '<img style="width: 100px; height: 100px;" src="Upload/'.$result['product_img'].'"/>'?></td>    
                        <td><?=$result['product_size']?></td>
                        <td><?=$result['product_color_name']?></td>
                        <td><?=$result['product_total']?></td>    
                        <td><a href="edit_product.php?product_id=<?php echo $result['product_id']?>">Sửa</a>|
                        <a href="product_delete.php?product_id=<?php echo $result['product_id']?>">Xóa</a></td>
                    </tr>
                    <?php
                          }
                        }
                    ?>
                </table>
              <div class="page_ad_pr"> <?php
                 include './pagination.php';
                ?>
            </div> 
            </div>
        </div>
        <?php }else {
           echo "bạn chưa đăng nhập";?>
           <a href="../login.php">đăng nhập</a>
           <?php 
            } ?>
        </section>
</body>

</html>