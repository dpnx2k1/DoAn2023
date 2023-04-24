<?php
include "headerF.php";
include "classF/cart_class.php";
include "classF/product_class.php";
  
 $cart=new cartF;
 if (session_id() === '')
     session_start();
     function update(){
        foreach ($_POST['quantity_pr'] as $id => $quatity) {
            $_SESSION['cart'][$id] = $quatity;
       }
     }
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart']=array();
    }
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'add':
               $product = $cart->get_product_id($_POST);
               if ($product) {
                $kq=$product->fetch_assoc();
               }
               update();
               header("location:cart.php");
                break;
            case 'delete':
                if (isset($_GET['id'])) {
                    unset($_SESSION['cart'][$_GET['id']]);
                }
                header("location:cart.php");
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
                                <input type="number" min="1" value="<?php echo $_SESSION['cart'][$row['product_id']]; ?>">
                            </td>

                            <td><p><?php  echo $row['product_price']*$_SESSION['cart'][$row['product_id']]; ?><sup>đ</sup></p></td>
                            <td><span><a href="cart.php?action=delete&id=<?php echo $row['product_id']?>">X</a></span></td>
                        </tr>
                        <?php      }
                        }?> 
                        <!-- <tr>
                            <td colspan="5"><?php var_dump($_POST); ?></td>
                        </tr> -->
                        <tr><td colspan="6">

                         <button type="submit" name="update_click">CẬP NHẬT GIỎ HÀNG</button>
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
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>TỔNG TIỀN HÀNG</td>
                            <td><p>489.000 <sup>đ</sup></p></td>
                        </tr>
                        <tr>
                            <td>TẠM TÍNH</td>
                            <td><p style="color: black; font-weight:bold;">489.000 <sup>đ</sup></p></td>
                        </tr>
                    </table>
                    <div class="cart-content-right-text">
                        <p>bạn sẽ được miễn phí ship đơn hàng nếu tổng tiền hàng của bạn lớn hơn 2.000.000<sup>đ</sup></p>
                        <p style="color:red;font-weight:bold">Mua thêm <span style="font-size: 18px;">1.511.000</span> <sub>đ</sub> để được miễn phí SHIP</p>
                    </div>
                    <div class="cart-content-right-button">
                        <button>TIẾP TỤC MUA SẮM</button>
                        <button>THANH TOÁN</button>
                    </div>
                    <div class="cart-content-right-login">
                        <p>TÀI KHOẢN</p>
                        <p>Hãy <a href="http://localhost:3000/giaodien/login.html " style="color: gray;">đăng nhập</a> tài khoản của bạn để tích điểm thành viên</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
include "footerF.php";
?>