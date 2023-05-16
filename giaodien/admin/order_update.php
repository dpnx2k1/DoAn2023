<?php 

$con=mysqli_connect("localhost","root","123456789","db_doan");   
    if(!empty($_GET['id'])&& !empty($_POST['status'])){
       // print_r($_POST['status']);exit;
        $query="UPDATE `orders` SET `status_` = '".$_POST['status']."' WHERE (`order_id` = '".$_GET['id']."')";
        $update_status=mysqli_query($con,$query);
        header("Location:order_list.php");
    }
    $query="SELECT * FROM orders WHERE order_id=".$_GET['id'].";";
    $respon=mysqli_query($con,$query)->fetch_assoc();
    //print_r($status);exit;
    if ($respon['status_']==3) {
        $point=$respon['total']/100;
        $query="UPDATE `user` SET `point` = '".$point."' WHERE (`user_id` = '".$respon['user_id']."')";
        $update_point=mysqli_query($con,$query);
    }

?>
    <style></style>
            <div class="admin-content-right-category-add">
                <h1>Cập Nhật Trạng Thái Đơn hàng</h1>
                <form action="" method="POST">
                    <select name="status" id="">
                        <option value="1">Chuẩn bị</option>
                        <option value="2">Đang Giao</option>
                        <option value="3">Đã Giao</option>
                        <option value="4">Hàng Hoàn</option>
                    </select>
                    <button type="submit">Sửa</button>
                    
                </form>
            </div>
    