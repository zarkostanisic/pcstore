<?php 
	if(count($products) > 0){
?>
<table width="100%" style="margin-bottom:20px;">
	<tr class="order">
		<th>Id</th>
		<th>Naziv prozvoda</th>
		<th>Kategorija</th>
		<th>Na lageru</th>
		<th>Pojedinačna cena</th>
	</tr>
<?php 
	foreach($products as $product){
		echo "<tr class='order'>
				<td>" . $product->product_id . "</td>
				<td style='text-align:left;letter-spacing:1px;'><strong>" . $product->product_title . "</strong></td>
				<td>" . $product->category_title . "</td>
				<td title='Klikni i promeni stanje' class='number_stats' id='" . $product->product_id . "'><b>" . $product->number . "</b></td>
				<td>" . $product->product_price . "</td>
			</tr>";
	}	
?>
</table>
<div id="pagination" class="pagination">
	<form>
		<input type="hidden" id="offset" value="<?php echo $offset; ?>">
	</form>
	<?php echo $this->pagination->create_links(); ?>
</div>
<?php 
	}else{
?>
<h2>Trenutno nema proizvoda<span class="title-bottom">&nbsp;</span></h2>
<?php
	}
 ?>