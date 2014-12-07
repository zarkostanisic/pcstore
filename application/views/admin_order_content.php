					<!-- Begin Content -->
					<div id="content">
						<!-- Begin Products -->
						<div id="products"><!--Dodavanje proizvoda-->
							<h2>Narudžbine<span class="title-bottom">&nbsp;</span></h2>
							<?php 
								if(count($orders) > 0){
							 ?>
							<table style="width:100%;">
								<tr class="order">
									<th>Id</th>
									<th>Od koga</th>
									<th>Status</th>
									<th>Datum porudžbine</th>
									<th>Datum realizacije</th>
								</tr>
								<?php 
									foreach($orders as $order){
								?>
								<tr class="order">
									<td><?php echo $order->order_id; ?></td>
									<td><?php echo $order->first_name . " " . $order->last_name; ?></td>
									<td>
										<?php 
											$status = $order->status;

											if($status == "0"){
												echo "Nerealizovana";
											}else{
												echo "Realizovana";
											}
										?>
									</td>
									<td><?php echo $order->order_date; ?></td>
									<td>
										<?php
											$realization_date = $order->realization_date;

											if($realization_date == "0000-00-00 00:00:00"){
												echo "/";
											}else{
												echo $realization_date;
											}
										?>
									</td>
									<td><a href="<?php echo base_url(); ?>admin_orders/info/<?php echo $order->order_id; ?>" style="color:gray;text-decoration:underline;">Pregled</a></td>
								</tr>
								<?php  
									}
								?>
							</table>
							<div id="pagination" style="margin-top:10px;">
							<?php 
								echo $this->pagination->create_links();
							?>
							</div>
							<?php 
								}else{
							?>
							<h2>Trenutno nema narudžbina<span class="title-bottom">&nbsp;</span></h2>								
							<?php 
								}
							?>
						</div>
						<!-- End Products -->
					</div>
					<!-- End Content -->