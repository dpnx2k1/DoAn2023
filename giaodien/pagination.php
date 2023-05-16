
<style>
   .page_ad_pr button{  
       width: 25px;
       height: 25px;
    	border: 1px solid gray;
    }
    .page_ad_pr p{
        font-size: 16px;
    }
    .curren_page_item{
        background-color: black;
        color: white;  
    }
</style>
<div id="pagination">
<?php 
if($current_page > 3){
	$first_page = 1;?>
	<a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$first_page?>">
    <button style="width: 50px;"><p>First</p></button>    
    </a>
<?php }
if($current_page > 1){
	$prev_page = $current_page - 1;?>
	<a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$prev_page?>">
    <button style="width: 30px;"><p><i class="fa-sharp fa-solid fa-backward"></i></p></button>
    </a>
<?php }
for($num = 1; $num <= $totalPages; $num++){?>
	<?php if($num != $current_page){ ?>
		<?php if($num >  $current_page - 3 && $num < $current_page + 3){?>
			<a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$num?>">
            <button><p><?=$num?></p></button>
            </a>
		<?php } ?>
	<?php }else{ ?>
		<strong class="current-page page-item"> <button class="curren_page_item"><p><?=$num?></p></button></strong>
	<?php } ?>
<?php }
if($current_page < $totalPages - 1){
	$next_page = $current_page + 1;?>
	<a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$next_page?>">
	<button style="width: 30px;"><p><i class="fa-solid fa-forward"></i></p></button>
	</a>
<?php }
if($current_page < $totalPages - 3){
	$end_page = $totalPages;?>
	<a class="page-item" href="?per_page=<?=$item_per_page?>&page=<?=$end_page?>">
	<button style="width: 50px;"><p>Last</p></button>
	</a>
	<?php 
}
?>
</div>