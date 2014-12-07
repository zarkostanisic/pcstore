					<div id="content">
						<?php
							if(!$this->input->post('reset')){
						?>
						<!-- Begin Products -->
						<h2>Narudžbina broj: <?php echo count($orders);foreach($orders as $order){echo $order->order_id;} ?><span class="title-bottom">&nbsp;</span></h2>
						<form action="<?php echo $this->config->base_url() . "admin_orders/info/" . $order->order_id; ?>" method="post">
						<table class="table">
							<tr>
								<td colspan="3" style="color:white;padding:10px 10px;">Podaci o korisniku</td>
							</tr>
							<?php 
								foreach($users as $user){
							 ?>
							<tr>
								<td>Ime</td>
								<td colspan="2"><?php echo $user->first_name; ?></td>
							</tr>
							<tr>
								<td>Prezime</td>
								<td colspan="2"><?php echo $user->last_name; ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td colspan="2"><?php echo $user->email; ?></td>
							</tr>
							<tr>
								<td>Telefon</td>
								<td colspan="2"><?php echo $user->phone; ?></td>
							</tr>
							<tr>
								<td>Grad</td>
								<td colspan="2"><?php echo $user->city_title; ?></td>
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
								$total = 0;
								foreach($articles as $article){
									$total += $article->product_price * $article->qty;
									echo "<tr style='color:white;font-size:16px;'>";
										echo "<td>" . $article->product_title . "</td>";
										echo "<td style='text-align:center;'>" . $article->qty . "</td>";
										echo "<td>" . $article->product_price . "</td>";
									echo "</tr>";
								}
						 	?>
						 	<tr>
						 		<td colspan="2">Ukupna cena:</td>
						 		<td colspan="1"><?php echo $total; ?> RSD</td>
						 	</tr>
						 	<tr>
						 		<td colspan="3">
						 			<input type="submit" name="confirm" value="Potvrdi" class="submit" style="margin:0px auto;display:inline-block;float:left;"/>
						 			<input type="submit" name="reset" value="Poništi" class="submit" style="margin:0px auto;display:inline-block;float:right;"/>
						 		</td>
						 	</tr>
						 	<?php 
						 		if($this->input->post('confirm')){
						 			echo "<tr>
						 					<td colspan='3'>" . $success . "</td>
						 				</tr>";
						 		}
						 	 ?>
						</table>
						<?php 
							}else{
								echo "<h2>" . $success . "<span class='title-bottom'>&nbsp;</span></h2>";
							}	
						 ?>
						</form>					
						<!-- End Products -->
					</div>