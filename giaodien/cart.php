<?php
include "headerF.php";
include "classF/cart_class.php";
include "classF/product_class.php";
  
 $cart=new cartF;
 $total_pay=0;
 $i=0;
 if (session_id() === ''){
     session_start();
    }
    if(!isset($_SESSION['product_list'])){
        $_SESSION['product_list']=array();

    }
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart']=array();

    }
    if (isset($_GET['action'])) { 
    function update($add=false){
        foreach ($_POST['quantity_pr'] as $id => $quatity) {       
                if ($add) {
               $_SESSION['cart'][$id] += $quatity;
                 }else { 
                $_SESSION['cart'][$id] = $quatity;
                 }          
       }
     }
        switch ($_GET['action']) {
            case 'add':
               $product = $cart->get_product_id($_POST);
               if ($product) {
                $kq=$product->fetch_assoc();
               }
               update(true);
               header("location:cart.php");
                break;
            case 'delete':
                if (isset($_GET['id'])) {
                    unset($_SESSION['cart'][$_GET['id']]);
                }
                header("location:cart.php");
                break;
            case 'submit':
                if (isset($_POST['update_click'])) {
                    update();
                }elseif (isset($_POST['order_click'])) {
                  header('location:delivery.php?action=submit');
                }elseif (isset($_POST['sale'])) {
                    $sale=$cart->get_sale($_POST['sale']);
                    if (!empty($sale)) {
                        while ($sale_price=$sale->fetch_assoc()) {
                            $_SESSION['sale_price']=$sale_price['product_sale_price'];
                             $total_pay= $total_pay - $_SESSION['sale_price'];          
                        }                   
                    }else {
                        $msg="Mã giảm giá sai hoặc không tồn tại !";
                    }
                    
                }
                break;
            

        }
    } 
    $str= implode(",",array_keys($_SESSION['cart']));
    if (isset($_SESSION['cart'])) {
       if ($str!="") {
       $show_product_list=$cart->show_product_list($str);
       }else {
        $show_product_list=array();
       }
    }
?>

  <!-- cart -->
  <form action="cart.php?action=submit" method="POST">
  <section class="cart">
        <div class="container">
            <div class="cart-top-wrap">
                <div class="cart-top">
                    <div class="cart-top-shopping cart-top-item">
                        <i class="fas fa-shopping-cart "></i>
                    </div>
                    <div class="cart-top-address cart-top-item">
                        <i class="fa-solid fa-map"></i>
                    </div>
                    <div class="cart-top-money cart-top-item">
                        <i class="fa-solid fa-money-bill-transfer" ></i>
                    </div>    
                </div>
            </div>
        </div>
        <div class="container">
            <div class="cart-content row">
                <div class="cart-content-left ">
                    <table>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Màu</th>
                            <th>Size</th>
                            <th>SL</th>
                            <th>Thành Tiền</th>
                            <th>Xóa</th>
                        </tr>
                      <?php 
                        if($show_product_list){
                            
                            while ($row= $show_product_list->fetch_assoc()) {  
                                $i++;
                                $pay=$row['product_price_pro']*$_SESSION['cart'][$row['product_id']];
                                $total_pay+=$pay;
                      ?>  
                        <tr>
                            <td>
                            <img src=<?php echo'"admin/Upload/'.$row['product_img'].'"'; ?> alt="">
                            </td>
                            <td><p><?php echo $row['product_name']; ?></p></td>
                            <td> <?php echo $row['product_color_name'];
                                 $product= new product; 
                                $color= $product->get_color_id_by_product_id($row['product_color_name']);
                                if ($color) {
                                   while ($kq=$color->fetch_assoc()) {
                            ?>
                            <i class="fa-solid fa-circle-check" style=<?php echo '"color:'.$kq['color_id'].';margin-left:12px"'?>></i>
                            <?php } }?>
                            </td>
                            <td><p><?php  echo $row['product_size']; ?></p></td>
                            <td>
                                <input type="number" min="1" value="<?php echo $_SESSION['cart'][$row['product_id']];?>"  name="<?php echo 'quantity_pr['.$row['product_id'].']'?>" >
                            </td>

                            <td><p><?php echo $row['product_price_pro']*$_SESSION['cart'][$row['product_id']]; ?><sup>đ</sup>
                            </p></td>
                            <td><span><a href="cart.php?action=delete&id=<?php echo $row['product_id']?>">X</a></span></td>
                        </tr>
                        <?php      }
                        }?> 
                        <!-- <tr>
                            <td colspan="5"><?php //var_dump($_POST); ?></td>
                        </tr> -->
                        <tr><td colspan="6">
                         <button type="submit" name="update_click" value="CẬP NHẬT GIỎ HÀNG">CẬP NHẬT GIỎ HÀNG</button>
                         <p style="color: tomato;margin-left: 20%;margin-top: 20px;">
                            Nếu bạn thay đổi số lượng sản phẩm hãy cập nhật lại giỏ hàng trước khi mua nhé !
                        </p>
                        </td></tr>
                    </table>
                </div>
                <div class="cart-content-right">
                    <table>
                        <tr>
                            <th colspan="2">Tổng Tiền Giỏ Hàng</th>
                        </tr>
                        <tr>
                            <td>
                                TỔNG SẢN PHẨM
                            </td>
                            <td><?=$i?></td>
                         <!-- tính tien sau khi có mã giảm giá  -->
                            <?php 
                            if ($total_pay<=0) {
                                $total_last=0;
                            }else {
                                $total_last=$total_pay;
                            }
                           ?>
                        <!-- ------------------------------- -->
                        <tr>
                            <td>TẠM TÍNH</td>
                            <td><p><?=$total_pay?> <sup>đ</sup></p></td>
                        </tr> 
                          <!-- sale -->
                        </tr>
                        <form action="cart.php?action=submit">
                        <tr> 
                            <td>
                                <label for="sale">MÃ GIẢM GIÁ : </label>
                                <input type="text" name="sale" style=" width: 150px; height: 30px;">
                                <input style="background-color: red; color: white; border: 1px solid tomato; width: 50px; height: 30px;" type="submit" name="sale_off" value="Đồng ý">
                                <?php if (!empty($msg)) {?>
                                    <br><br>
                                    <p style="color: red;"><?=$msg?></p>
                                    <br>
                               <?php }?>
                            </td>
                        </tr> </form>
                        <tr>
                           <td>TỔNG TIỀN HÀNG</td>
                          
                            <td><p style="color: black; font-weight:bold;"><?=$total_last?> <sup>đ</sup></p></td>
                        </tr>
                    </table>
                    <div class="cart-content-right-text">
                         <?php if ($total_pay < 1000000) { $them=1000000 - $total_pay?>
                        <p>bạn sẽ được miễn phí ship đơn hàng nếu tổng tiền hàng của bạn lớn hơn 1.000.000<sup>đ</sup></p>
                        <p style="color:red;font-weight:bold">Mua thêm <span style="font-size: 18px;"><?=$them?></span> <sub>đ</sub> để được miễn phí SHIP</p>
                        <?php  } ?>
                    </div>
                    <div class="cart-content-right-button">
                       <button> <a href="./category.php?brand_id=12&item_per_page=8&page=1">TIẾP TỤC MUA SẮM</a></button>
                        <button type="submit" name="order_click">THANH TOÁN</button>
                    </div>
                    <div class="cart-content-right-login">
                        <p>TÀI KHOẢN</p>
                        <p>Hãy <a href="login.php " style="color: gray;">đăng nhập</a> tài khoản của bạn để tích điểm thành viên</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </form>

<?php
include "footerF.php";
?>