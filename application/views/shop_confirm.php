					<div id="content">
						<!-- Begin Products -->
						<form action="<?php echo $this->config->base_url() . "shop/send"; ?>" method="post">
						<table class="table">
							<tr>
								<td colspan="3" style="color:white;padding:10px 10px;">Podaci o korisniku</td>
							</tr>
							<?php 
								foreach($sender as $send){
							 ?>
							<tr>
								<td>Ime</td>
								<td colspan="2"><?php echo $send->first_name; ?></td>
							</tr>
							<tr>
								<td>Prezime</td>
								<td colspan="2"><?php echo $send->last_name; ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td colspan="2"><?php echo $send->email; ?></td>
							</tr>
							<tr>
								<td>Telefon</td>
								<td colspan="2"><?php echo $send->phone; ?></td>
							</tr>
							<tr>
								<td>Grad</td>
								<td colspan="2"><?php echo $send->city_title; ?></td>
							</tr>
							<?php 
								}
							 ?>
							<tr>
								<td colspan="3" style="color:white;padding:10px 10px;">Proizvodi koji su izabrani</td>
							</tr>
							<tr>
								<td>Naziv</td>
								<td style="text-align:center;">Količina</td>
								<td>Cena</td>
							</tr>
							<?php 
								foreach($cart as $item){
									echo "<tr style='color:white;font-size:16px;'>";
										echo "<td>" . $item['name'] . "</td>";
										echo "<td style='text-align:center;'>" . $item['qty'] . "</td>";
										echo "<td>" . $item['price'] . "</td>";
									echo "</tr>";
								}
						 	?>
						 	<tr>
						 		<td colspan="2">Ukupna cena:</td>
						 		<td colspan="1"><?php echo $total; ?> RSD</td>
						 	</tr>	
						 	<tr>
						 		<td colspan="3"><input type="button" id="send" value="Potvrdi kupovinu" class="submit" style="margin:0px auto;display:block;"/></td>
						 	</tr>
						</table>
						</form>					
						<!-- End Products -->
					</div>