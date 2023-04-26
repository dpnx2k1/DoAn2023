<style>
   .category-right-bottom-item button{  
       width: 25px;
       height: 25px;
        border: 1px solid gray;
    }
    .category-right-bottom-item p{
        font-size: 16px;
    }
    .curren_page_item{
        background-color: black;
        color: white;
   
    }
</style>

<?php 
    if ($curren_page>3) {
        $first=1;?>
     <a href="<?php echo'category.php?brand_id='.$_GET['brand_id'].''; ?>&item_per_page=<?=$item_per_page?>&page=<?=$first?>"> 
     <button style="width: 50px;"><p>First</p></button>
    </a>
        <?php }?>
<?php  
    if($curren_page>1){
        $prev=$curren_page-1;?>
    <a href="<?php echo'category.php?brand_id='.$_GET['brand_id'].''; ?>&item_per_page=<?=$item_per_page?>&page=<?=$prev?>"> 
     <button style="width: 30px;"><p><i class="fa-sharp fa-solid fa-backward"></i></p></button>
    </a>    
 <?php   }
?>
<?php 
 for ($num=1; $num <= $total_page; $num++) { ?>
  <?php  if ($num!=$curren_page) { 
            if($num>$curren_page - 3 && $num <$curren_page+3 ){
    
    ?>
    <a href="<?php echo'category.php?brand_id='.$_GET['brand_id'].''; ?>&item_per_page=<?=$item_per_page?>&page=<?=$num?>"> 
     <button>   <p><?=$num?></p></button>
    </a>

<?php }}else{?>
   
    <a href="<?php echo'category.php?brand_id='.$_GET['brand_id'].''; ?>&item_per_page=<?=$item_per_page?>&page=<?=$num?>"> 
      <button class="curren_page_item">  <p><?=$num?></p></button>
    </a>
    
<?php } } ?>

<?php  
    if($curren_page<$total_page){
        $next=$curren_page+1;?>
    <a href="<?php echo'category.php?brand_id='.$_GET['brand_id'].''; ?>&item_per_page=<?=$item_per_page?>&page=<?=$next?>"> 
     <button style="width: 30px;"><p><i class="fa-solid fa-forward"></i></p></button>
    </a>    
 <?php   }
?>

<?php 
    if ($curren_page < $total_page-3) {
        $end=$total_page;
    ?>
     <a href="<?php echo'category.php?brand_id='.$_GET['brand_id'].''; ?>&item_per_page=<?=$item_per_page?>&page=<?=$end?>"> 
      <button style="width: 50px;"><p>Last</p></button>
    </a>

<?php } ?>