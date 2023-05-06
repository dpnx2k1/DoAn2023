<!DOCTYPE html>
<html>
    <head>
        <title>Chi tiết đơn hàng</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./stlye_A.css">
    </head>
    <body>
        <?php
        session_start();
        if (!empty($_SESSION['current_user'])) {
            $con=mysqli_connect("localhost","root","123456789","db_doan");  
            $order = mysqli_query($con, "SELECT orders.user_name,orders.address_, orders.address_detail, orders.sdt, orders.note, order_detail.*, tbl_product.product_name 
            FROM orders
            INNER JOIN order_detail ON orders.order_id = order_detail.order_id
            INNER JOIN tbl_product ON tbl_product.product_id = order_detail.product_id
            WHERE orders.order_id = ".$_GET['id']."");
            $orders = $order->fetch_all();
            // var_dump($orders);exit;
            //print_r($orders);exit;
        }
        ?>
        <div class="order_detail_wapper">
            <div class="order-detail">
               <div class="order-top">
                <h1>Chi tiết đơn hàng</h1>
                <label>Người nhận: </label><span> <?= $orders[0][0] ?></span><br/>
                <label>Điện thoại: </label><span><?= $orders[0]['3'] ?> </span><br/>
                <label>Địa chỉ: </label><span><?= $orders[0]['1'] ?>-<?= $orders[0]['2'] ?></span>
                </div> 
                <br/>
                <hr/>
               <div class="order-content">
                <h3>Danh sách sản phẩm</h3>
                <ul>
                    <?php
                    $totalQuantity = 0;
                    $totalMoney = 0;
                    foreach ($orders as $row) {
                        ?>
                        <li>
                            <span class="item-name"><?= $row['12'] ?></span>
                            <span class="item-quantity"> - SL: <?= $row['8'] ?> sản phẩm</span>
                        </li>
                        <?php
                        $totalMoney += ($row['9'] * $row['8']);
                        $totalQuantity += $row['8'];
                    }
                    ?>
                </ul>
                </div>
                <hr/>
                <div class="order_bottom">
                <label>Tổng SL:</label> <?= $totalQuantity ?> - <label>Tổng tiền:</label> <?= number_format($totalMoney, 0, ",", ".") ?> đ
                <p><label>Ghi chú: </label><?= $orders[0]['4'] ?></p>
                </div>
            </div>
     </div>
    </body>
</html>