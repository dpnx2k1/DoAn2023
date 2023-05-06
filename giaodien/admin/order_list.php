
<?php 
include "header.php";

$con=mysqli_connect("localhost","root","123456789","db_doan");   

if (!empty($_SESSION['current_user'])) {
    
    if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){
        $_SESSION['order_filter'] = $_POST;
        header('Location: order_list.php').exit;
    }
    if(!empty($_SESSION['order_filter'])){
        $where = "";
        foreach ($_SESSION['order_filter'] as $field => $value) {
            if(!empty($value)){
                $kq=addcslashes($value,"qwertyuiopasdfghjklzxcvbnm0987654321");
                $result=str_replace("\\",'%',$kq);
                // echo $result;
                switch ($field) {
                    case 'order_name':
                        $where .= (!empty($where))? " AND "."`".$field."` LIKE '%".$result."%'" : "`".$field."` LIKE '%".$result."%'";
                    break;
                    default:
                        $where .= (!empty($where))? " AND "."`".$field."` = ".$value."": "`".$field."` = ".$value."";
                    break;
                }
            }
        }
       // var_dump($_SESSION['order_filter']);
        extract($_SESSION['order_filter']);
    }

    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 5;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    $totalRecords = mysqli_query($con, "SELECT * FROM `orders`");
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(!empty($where)){
        $orders = mysqli_query($con, "SELECT * FROM `orders` where (".$where.") ORDER BY `order_id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }else{
        $orders = mysqli_query($con, "SELECT * FROM `orders` ORDER BY `order_id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($con);
    ?>
  <div class="admin-content-right">
            <div class="admin-content-right-category-list">
                <h1>Danh sách đơn hàng</h1>
                <div class="order_search">
                <form id="order_search-form" action="order_list.php?action=search" method="POST">
                <fieldset>
                    <legend>Tìm kiếm đơn hàng</legend>
                    ID : <input style="width: 35px;" type="text" name="order_id" value="<?=!empty($order_id)?$order_id:""?>">
                    Tên : <input type="text" name="order_name" placeholder="<?=!empty($order_name)?$order_name:""?>">
                    <input type="submit" value="Tìm">
                </fieldset>
                    </form>
                </div>
                <table>
                    <tr>
                        <th>ID</th> 
                        <th>Tên người nhận</th>
                        <th>Địa chỉ</th>
                        <th>SDT</th>
                        <th>Ngày tạo</th>
                        <th>in đơn</th>
                        
                    </tr>
                    <?php
                        if ($orders) {
              
                            while ($result = $orders->fetch_assoc()) {           
                         
                    ?>
                    <tr>
                        <td><?=$result['order_id']?></td>
                        <td><?=$result['user_name']?></td>
                        <td><?php echo "".$result['address_']."-".$result['address_detail']."";?></td>
                        <td><?=$result['sdt']?></td>
                        <td><?=date("d/m/y H:i",$result['created_time'])?></td>
                        <td><a href="oder_printing.php?id=<?=$result['order_id']?>" target="_blank">In</a></td>


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