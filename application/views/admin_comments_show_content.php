<form>
<?php 
	if(count($products)>0){
		foreach($products as $product){
			echo "<div class='product'>";
				echo "<a href='".$this->config->base_url()."admin_comments/manage/".$product->product_id."' title='".$product->product_title."' target='_blank'>";
					echo "<span class='title'>".$product->product_title."</span>";
					echo "<div class='img'>";
						echo "<img src='".$this->config->base_url()."images/products/thumbs/".$product->image1."' alt='Product Image 1' />";
					echo "</div>";
					echo "<span class='number'><input type='button' class='submit' value='Komentari' style='margin-left:20px;margin-top:10px;'/></span>";
				echo "</a>";
			echo "</div>";
		}
	}else{
		echo "<h2>Nema proizvoda sa takvim nazivom<span class='title-bottom'>&nbsp;</span></h2>";
	}
?>
</form>