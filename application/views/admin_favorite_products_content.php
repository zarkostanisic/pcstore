					<!-- Begin Content -->
					<div id="content">
						<!-- Begin Products -->
						<div id="products"><!--Dodavanje proizvoda-->
							<h2>Izdvojeni proizvodi<span class="title-bottom">&nbsp;</span></h2>
							<?php 
								if(count($products)>0){
									foreach($products as $product){
										echo "<div class='product'>";
											echo "<a href='".$this->config->base_url()."admin_products/favorite/".$product->product_id."/".$offset."' title='".$product->product_title."'>";
												echo "<span class='title'>".$product->product_title."</span>";
												echo "<div class='img'>";
													echo "<img src='".$this->config->base_url()."images/products/thumbs/".$product->image1."' alt='Product Image 1' />";
												echo "</div>";
												echo "<span class='number'><input type='button' class='submit' value='Ukloni' style='margin-left:20px;margin-top:10px;'/></span>";
											echo "</a>";
										echo "</div>";
									}
								}else{
									echo "<h2>Trenutno nema izdvojenih proizvoda<span class='title-bottom'>&nbsp;</span></h2>";
								}
							?>
						</div>
						<!-- End Products -->
						<?php 
							echo "<div id='pagination'>".$this->pagination->create_links()."</div>";
						?>
					</div>
					<!-- End Content -->