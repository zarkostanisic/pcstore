					<!-- Begin Content -->
					<div id="content">
						<!-- Begin Products -->
						<div id="products"><!--Dodavanje proizvoda-->
							<?php 
								if(count($one_sub) == 1){
									foreach($one_sub as $sub){
										echo "<h2>".$sub->category_title."<span class='title-bottom'>&nbsp;</span></h2>";
									}
								}
								
								if($products != ""){	
									foreach($products as $product){
							
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
								}else{
									echo "<h2>Trenutno nemamo proizvode u ponudi<span class='title-bottom'>&nbsp;</span></h2>";
								}
							?>
						</div>
							<?php 
								echo "<div id='pagination'>".$this->pagination->create_links()."</div>";
							?>
						<!-- End Products -->
					</div>
					<!-- End Content -->