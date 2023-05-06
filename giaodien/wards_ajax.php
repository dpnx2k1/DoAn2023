<?php 
include "./classF/delivery_class.php";
    $delivery = new delivery;
    $code = $_POST['code'];
?>
<?php 
        $show_wards_ajax= $delivery->show_wards_ajax($code);
            if ($show_wards_ajax) {
                    while ($resultA = $show_wards_ajax->fetch_assoc()) {                                        
            ?>
           
          <option value="<?php echo $resultA['code_w'] ?>"><?php echo $resultA['name_w'] ?></option>
            <?php 
              }
         } 
?>