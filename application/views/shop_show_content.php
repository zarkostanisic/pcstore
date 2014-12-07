<?php
	$cart = $this->cart->contents();
	$name = array();
	$qty = array();
	$price = array();
	$total = $this->cart->total();
	if($this->cart->total() > 0){
		echo "<form action='" . $this->config->base_url() . "shop/confirm' method='post'>";
		echo "<table class='table'>";
			echo "<tr><td>Naziv proizvoda</td><td>Količina</td><td>Cena</td><td></td></tr>";
		foreach($cart as $product){
			echo "<tr>";
				echo "<td>" . $product['name'] . "</td>";
				echo "<td><input type='text' id='" . $product['id'] . "' onBlur='change_number(" . $product['id'] . ",\"" . $product['rowid'] ."\")' class='input2' value='" . $product['qty'] ."'/></td>";
				echo "<td>" . $product['price'] . "</td>";
				echo "<td><input type='button' onClick='shop_remove(\"" . $product['rowid'] . "\")' value='Ukloni' class='submit2'/></td>";
			echo "</tr>";
		}
		echo "<tr><td colspan='2' ><br/>Ukupna cena:</td><td colspan='2'><br/>" . $this->cart->total() . " RSD</td></tr>";
		echo "<td colspan='4'><input type='button' value='Naruči porizvode' class='submit' id='confirm' style='margin:0px auto;display:block;'/></td>";
		echo "</table>";
		echo "</form>";
	}else{
		echo "<h2>Vaša korpa je prazna, izaberite proizvode<span class='title-bottom'>&nbsp;</span></h2>";
	}
 ?>