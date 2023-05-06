<?php 
include "./classF/delivery_class.php";
    $delivery = new delivery;
    $code = $_POST['code'];
?>
<?php 
        $show_districts_ajax= $delivery->show_districts_ajax($code);
            if ($show_districts_ajax) {
                    while ($resultA = $show_districts_ajax->fetch_assoc()) {                                        
            ?>
          
          <option value="<?php echo $resultA['code_d'] ?>"><?php echo $resultA['name_d'] ?></option>
            <?php 
              }
         } 
?>