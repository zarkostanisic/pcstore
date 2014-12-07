					<!-- Begin Right Sidebar -->
					<div id="right-sidebar" class="sidebar">
						<ul>
							<li class="widget"><!--Korpa-->
								<h2>Korpa</h2>
								<div class="widget-entry">
									<a href="<?php echo $this->config->base_url(); ?>order/show_cart" class="items" title="Stavke korpe"><p id='number_cart'>&nbsp;</p></a>
								</div>
							</li>
							<li class="widget products-box"><!--Dodatno-->
								<h2>Najpopularniji</h2>
								<div class="widget-entry">
									<ul>
										<?php
											foreach($popular_products as $product){
												echo "<li>";
													echo "<a href='".$this->config->base_url()."products/show_product/".$product->product_id."' title='".$product->product_title."'>";
														echo "<div class='img'>";
															echo "<img src='".$this->config->base_url()."images/products/thumbs/".$product->image1."' alt='".$product->product_title."' />";
														echo "</div>";
														echo "<span class='info'>";
															echo "<span class='title'>".$product->product_title."</span>";
														echo "</span>";
														echo "<span class='cl'>&nbsp;</span>";
													echo "</a>";
												echo "</li>";
											}
										?>
									</ul>
									<div class="cl">&nbsp;</div>
								</div>
							</li>
						</ul>
					</div>
					<!-- End Sidebar -->
					<div class="cl">&nbsp;</div>
				</div>
			</div>
			<!-- End Inner -->
		</div>
		<!-- End Main -->