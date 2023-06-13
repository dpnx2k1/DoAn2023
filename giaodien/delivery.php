<?php
include "./classF/delivery_class.php";
include "./classF/cart_class.php";
include "classF/user_class.php";
if (session_id() === ''){
    session_start();
   }
    $delivery=new delivery;  
    $cart=new cartF;
    $error=false;
    $success;
    $i=0;
    $price=0;
    $str= implode(",",array_keys($_SESSION['cart']));
    if (isset($_SESSION['cart'])) {
       if ($str!="") {
       $show_product_list=$cart->show_product_list($str);
       }else {
        $show_product_list=array();
       }
    }
   
    switch ($_GET['action']) {
        case 'submit':
            if (isset($_POST['thanhtoan'])) {
                if (empty($_POST['hoten'])) {
                  $error="Bạn chưa nhập tên";
                }
                elseif (empty($_POST['sdt'])) {
                    $error="Bạn chưa nhập số điện thoại";
                }
                elseif (empty($_POST['diachi'])) {
                    $error="Bạn chưa nhập số địa chỉ";
                }
                elseif (empty($_SESSION['cart'])) {
                    $error="Giỏ hàng rỗng";
                }elseif($error==false && !empty($_SESSION['cart'])){
                        $addr="";
                    //    .="".$_POST['provinces'].",".$_POST['districts'].",".$_POST['wards']."";
                        $provines_n=$delivery->get_name_p();
                        $districts_n=$delivery->get_name_d();
                        $wards=$delivery->get_name_w();
                        
                        $addr.="".$provines_n.",".$districts_n.",".$wards."";
                       // $insert_order=$delivery->insert_order($addr);
                        $con=mysqli_connect("localhost","root","123456789","db_doan");  
                        $user_id=0;
                        // $user_id=$_SESSION['current_user']?$_SESSION['current_user']['user_id']:Null;
                        if (!empty($_SESSION['current_user'])) {
                            $user_id=$_SESSION['current_user']['user_id'];
                        }
                        $user_name =$_POST['hoten'];
                        $sdt=$_POST['sdt'];
                        $address_detail=$_POST['diachi'];
                        
                        $note=$_POST['note'];
                        $total=$_SESSION['tong'];
                        $query = "INSERT INTO `orders`(
                            `order_id`,
                            `user_id`,
                            `user_name`,
                            `sdt`,
                            `address_`,
                           `address_detail`,
                            `note`,
                            `total`,
                            `created_time`,
                            `last_updated`
                    ) VALUES(null,'$user_id','$user_name','$sdt','$addr','$address_detail','$note','$total','".time()."','".time()."')";
                     $insert_order = mysqli_query($con,$query);
                     $order_id=mysqli_insert_id($con);
                     $_SESSION['order_id']=$order_id;
                        // $order_id=$delivery->get_id_order();
                     //  var_dump($order_id);exit;
                            $orderProducts=array();
                            while ($row = mysqli_fetch_array($show_product_list)) {
                                $orderProducts[] = $row;  
                            }
                                $insert_str="";
                                foreach ($orderProducts as $key => $product) {
                                    $insert_str .= "(NULL, '" . $order_id . "', '" . $product['product_id'] . "',
                                     '" . $_POST['quantity'][$product['product_id']] . "',
                                      '" . $price . "', '" . time() . "', '" . time() . "')";
                                   if ($key != count($orderProducts) - 1) {
                                        $insert_str .=",";
                                   }
                             
                                  
                                }
                                if ($_SESSION['current_user']['point']==0) {
                                    $user=new user;
                                     $set_point=$user->update_point_zero($_SESSION['current_user']['user_id']);
                                }
                               
                                $insert_order_detail=$delivery->insert_order_detail($insert_str);
                                $success="Đặt hàng thành công !";
                                unset($_SESSION['cart']);

                        
                }
            }
            break;
        

    }
 
?>

    <!----------------delivery-------------------------- -->
   <?php
   if(!empty($error)){ ?>
    <div class="notify">
        <?=$error?>
        <a href="javascript:history.back()">quay lại</a>
    </div> 
    <?php }elseif(!empty($success)){ ?>
    <div class="notify">
        <?=$success?>
        <a href="order_detail.php">Chi tiết đơn hàng</a>
        <a href="./category.php?brand_id=21&item_per_page=8&page=1">Tiếp tục mua hàng</a>
    </div>
   <?php }else{
    include "headerF.php";
    ?>
    <form action="delivery.php?action=submit" method="POST">
    <section class="delivery">
        <div class="container">
            <div class="delivery-top-wrap">
                <div class="delivery-top">
                    <div class="delivery-top-shopping delivery-top-item">
                        <i class="fa-sharp fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="delivery-top-address delivery-top-item">
                        <i class="fa-solid fa-map"></i>
                    </div>
                    <div class="delivery-top-money delivery-top-item">
                        <i class="fa-solid fa-money-bill-transfer" ></i>
                    </div>    
                </div>
            </div>
        </div> 
       
        <div class="container row">
            <div class="delivery-content row">
                <div class="delivery-content-left">
                    <?php if (empty($_SESSION['current_user'])) {
                    
                     ?>
                       <p>Vui lòng chọn địa chỉ giao hàng</p>
                        <div class="delivery-content-left-login row">
                            <i class="fas fa-sign-in-alt"></i>
                            <p> <a href="login.php"> Đăng nhập</a>(nếu bạn đã có tài khoản)</p>
                        </div>
                        <div class="delivery-content-left-khachle row">
                            <input checked type="radio" name="loại khách" value="Khách lẻ">
                            <p><span style="font-weight: bold;">Khách lẻ</span> (Nếu bạn muốn lưu lại thông tin)</p>
                        </div>
                        <div class="delivery-content-left-signup row">
                            <input  type="radio" name="loại khách" value="Khách lẻ">
                            <p><span style="font-weight: bold;"> <a href="register.php">Đăng ký</a></span> (Tạo mới tài khoản với thông tin bên dưới )</p>
                        </div>
                        <?php } ?>
                        <div class="delivery-content-left-input-top row">
                            <div class="delivery-content-left-input-top-item">
                                <label for="">Họ Tên <span style="color: red;">*</span></label>
                                <input name="hoten" type="text">
                            </div>
                            <div class="delivery-content-left-input-top-item">
                                <label for="">Số Điện Thoại <span style="color: red;">*</span></label>
                                <input name="sdt" type="text">
                            </div>
                            <div class="delivery-content-left-input-top-item">
                                <label for=""> Tỉnh/TP <span style="color: red;">*</span></label>
                                <select name="provinces" id="provinces">
                                 <option value="#">--Chọn Tỉnh--</option>
                                 <?php $show_provinces=$delivery->show_provinces();
                                      if ($show_provinces) {
                                       while ($result=$show_provinces->fetch_assoc()) {
                                                 
                                     ?>
                              
                                 <option value="<?php echo $result['code_p'] ?>"><?php echo $result['name_p'] ?></option>
                               <?php     }
                                         } ?>
                                </select> 
                            </div>
                            <div class="delivery-content-left-input-top-item">
                                <label for=""> Quận huyện <span style="color: red;">*</span></label>
                                <select name="districts" id="districts">
                                <option value="#">--Chọn Huyện--</option>
                                 </select>
                            </div>
                            <div class="delivery-content-left-input-top-item">
                                <label for=""> Xã/Phường <span style="color: red;">*</span></label>
                                <select name="wards" id="wards">
                                <option value="#">--Chọn Xã--</option>
                                 </select>
                            </div>
                        </div>
                        <div class="delivery-content-left-input-bottom">
                            <label for=""> Địa chỉ <span style="color: red;">*</span></label>
                                <input name="diachi" type="text">
                        </div>
                        <br>
                        <div class="delivery-content-left-input-bottom">
                            <label for=""> Note <span style="color: red;">*</span></label>
                                <input name="note" type="text">
                        </div>
                      <div class="delivery-content-left-button row">
                        <a href="javascript:history.back()"><span>&#171;</span>Quay lại giỏ hàng</a>
                        <button type="submit" name="thanhtoan" style="text-transform: uppercase; font-weight: bold;">Thanh Toán và giao hàng</button>
                      </div>
                </div>
                <div class="delivery-content-right">
                    <table>
                        <tr>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Thành Tiền</th>
                        </tr>
                        <?php 
                       // $total_pay=0;
                        if(!empty($show_product_list)){
                            
                            while ($row= $show_product_list->fetch_assoc()) {  
                                $i++;
                              
                                if (!empty($row['product_price_pro'])) {
                                 $price=$row['product_price_pro'];
                                }else{
                                    $price=$row['product_price'];
                                }
                               // $pay=$price*$_SESSION['cart'][$row['product_id']];
                               // $total_pay+=$pay;
                                 
                      ?>  
                        <tr>
                            <td><p><?php echo $row['product_name']; ?></p></td>
                        
                            <td><?php echo $_SESSION['cart'][$row['product_id']] ;?></td>
                            <!-- truyen số lượng từng loại sp lưu ở biến POST[quantity_pr['.$row['product_id']] -->
                            <input type="text" style="display: none;" 
                            name="<?php echo 'quantity['.$row['product_id'].']'?>" 
                            value="<?=$_SESSION['cart'][$row['product_id']]?>">
                            <td><p><?php $price*$_SESSION['cart'][$row['product_id']]; ?><sup>đ</sup></p></td>
                        </tr>

                        <?php      }
                        }?> 
                        <tr>
                            <td style="font-weight: bold; border-top:2px solid #dddddd;" colspan="2">Tổng</td>
                            <td style="font-weight: bold"><p><?=$_SESSION['total_pay'];?> <sup>đ</sup></p></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;" colspan="2">Thuế VAT</td>
                            <td style="font-weight: bold"><p><?php $thue= 10*$_SESSION['total_pay']/100; echo $thue?> <sup>đ</sup></p></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;" colspan="2">Giảm Giá</td>
                            <td style="font-weight: bold"><p><?php if(!empty($_SESSION['sale_price'])){echo $_SESSION['sale_price']?> <sup>đ</sup> <?php } ?></p></td>
                        </tr>

                        <tr>
                            <td style="font-weight: bold;" colspan="2">Tổng Tiền Hàng</td>
                            <td style="font-weight: bold"><p><?php if(!empty($_SESSION['sale_price'])){
                                                                     $_SESSION['tong'] = $_SESSION['total_pay'] + $thue - $_SESSION['sale_price'];
                                                                    }else{
                                                                        $_SESSION['tong'] =$_SESSION['total_pay'] + $thue;
                                                                    }
                                                                      echo $_SESSION['tong']?><sup>đ</sup></p></td>
                        </tr>
                    </table>
                </div>
            </div>
       
        </div>

    </section>
     </form> 
    <?php include "footerF.php";}?>

    <script>
     $(document).ready(function() {
		$("#provinces").click(function() {
            //  alert($(this).val());
            var x = $(this).val();
			$.post("districts_ajax.php",{code:x},function(data){
				$("#districts").html(data);
			});
		});
	});
    </script>
      <script>
     $(document).ready(function() {
		$("#districts").click(function() {
            //  alert($(this).val());
            var x = $(this).val();
			$.post("wards_ajax.php",{code:x},function(data){
				$("#wards").html(data);
			});
		});
	});
    </script>
