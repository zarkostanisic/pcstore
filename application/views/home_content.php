					<!-- Begin Content -->
					<div id="content">
						<!-- Begin Products -->
						<div id="products"><!--Dodavanje proizvoda-->
							<h2>Izdvajamo iz ponude<span class="title-bottom">&nbsp;</span></h2>
							<?php 
								$number_products=0;
								foreach($products as $product){
									$number_products++;
									echo "<div class='product'>";
										echo "<a href='".$this->config->base_url()."products/show_product/".$product->product_id."' title='".$product->product_title."'>";
											echo "<span class='title'>".$product->product_title."</span>";
											echo "<div class='img'>";
												echo "<img src='".$this->config->base_url()."images/products/thumbs/".$product->image1."' alt='Product Image 1' />";
											echo "</div>";
											echo "<span class='number'>Proizvod ".$product->product_id."</span>";
											echo "<span class='price'>".$product->product_price."<span> RSD</span></span>";
										echo "</a>";
									echo "</div>";
								}
								if($number_products==0){
									echo "<h2>Trenutno nemamo proizvoda u ponudi<span class='title-bottom'>&nbsp;</span></h2>";
								}
							?>
						</div>
						<!-- End Products -->
					</div>
					<!-- End Content -->