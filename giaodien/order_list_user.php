<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/34e972a4c1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style_F2.css">
    <title>DPN Store</title>
    <!--Start of Fchat.vn-->
    <script type="text/javascript" src="https://cdn.fchat.vn/assets/embed/webchat.js?id=6459be2fc86ea1395e6b9736" async="async"></script>
    <!--End of Fchat.vn-->
</head>
<body>
    
<?php 
   
        session_start();
   


$con=mysqli_connect("localhost","root","123456789","db_doan");   

    if (!empty($_GET['action'])&& $_GET['action'] == 'xoa') {
        $query="DELETE FROM `orders` WHERE (`order_id` = '".$_GET['id']."')";
        $result=mysqli_query($con,$query);
        header("Location:order_list_user.php");
    }
    if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){
        $_SESSION['order_filter'] = $_POST;
        // header("Location:order_list_user.php");
    }
    if(!empty($_SESSION['order_filter'])){
        $where = "";
        foreach ($_SESSION['order_filter'] as $field => $value) {
            if(!empty($value)){
                $kq=addcslashes($value,"qwertyuiopasdfghjklzxcvbnm0987654321");
                $result=str_replace("\\",'%',$kq);
                // echo $result;
                switch ($field) {
                    case 'user_name':
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
    $totalRecords = mysqli_query($con, "SELECT * FROM `orders` WHERE `user_id` = ".$_SESSION['current_user']['user_id']." ");
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(!empty($where)){
        $orders = mysqli_query($con, "SELECT * FROM `orders` where (".$where." AND `user_id` = ".$_SESSION['current_user']['user_id'].") ORDER BY `order_id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }else{
        $orders = mysqli_query($con, "SELECT * FROM `orders`where `user_id` = ".$_SESSION['current_user']['user_id']." ORDER BY `order_id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($con);
    ?>
  <div class="admin-content-right">
            <div class="admin-content-right-category-list">
                <h1>Danh sách đơn hàng</h1>
                <div class="order_search">
                <form id="order_search-form" action="order_list_user.php?action=search" method="POST">
                <fieldset>
                    <legend>Tìm kiếm đơn hàng</legend>
                  <label for="">ID :</label>   <input style="width: 35px;" type="text" name="order_id" value="<?=!empty($order_id)?$order_id:""?>">
                  <label for="">Tên :</label>   <input type="text" name="user_name" placeholder="<?=!empty($user_name)?$user_name:""?>">
                    <input type="submit" value="Tìm">
                </fieldset>
                    </form>
                </div>
             <div class="table_order">  <table>
                    <tr>
                        <th>ID</th> 
                        <th>Tên người nhận</th>
                        <th>Địa chỉ</th>
                        <th>SDT</th>
                        <th>Ngày tạo</th>
                        <th>chi tiết</th>
                        <th>Thao tác</th>
                        
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
                        <td><a href="order_detail.php?id=<?=$result['order_id']?>">xem</a></td>
                        <td><a href="order_list_user.php?action=xoa&id=<?=$result['order_id']?>">Xóa</a></td>

                    </tr>
                    <?php
                          }
                        }
                    ?>
                </table>
            </div> 
              <div class="page_ad_pr"> <?php
                 include './pagination.php';
                ?>
            </div> 
            </div>
        </div>
        <button style="background-color: white; width: 150px;height: 35px;"> 
        <a  href="index.php">Trang chủ</a>
       </button>
     
        
</body>

</html>