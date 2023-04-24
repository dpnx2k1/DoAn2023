<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/34e972a4c1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style_F.css">
    <script language="javascript" src="script.js"></script>
    <title>DPN Store</title>
</head>
<?php 
    include "./classF/index_class.php";
    $header= new index;
    $show_category= $header ->show_category_header();
    
?>
<body>
    <header>
        <div class="logo">
            <img src="image/2.png" alt="">
        </div>
        <div class="menu">
                   <?php 
                        if ($show_category) {
                            while ($result= $show_category->fetch_assoc()) {  
                                $category_id= $result['category_id']; 
                                $show_brand = $header->show_brand($category_id);
                                // if ($show_brand) {
                                //     $resultB=$show_brand->fetch_assoc();                                 
                        ?>
                    <li><a href="category.php"><?php echo $result['category_name']?></a>
                    <ul class="sub-menu">
                <?php  if ($show_brand) {
                            while ($resultB=$show_brand->fetch_assoc()) {                       
                 ?>  
                        <li><a href=<?php echo'category.php?brand_id='.$resultB['brand_id'].''; ?>><?php echo $resultB['brand_name']?></a></li>      
                <?php }} ?>
                    </ul>
                    </li>
               <?php 
               }}  
               ?>
        </div>
        <div class="orthe">
            <li><input type="text" placeholder="Tìm kiếm "><i class="fas fa-search"></i></li>
            <li><a class="fa fa-paw"></a></li>
            <li><a class="fa fa-user"></a></li>
            <li><a class="fa fa-shopping-bag"></a></li>
        </div>
    </header>