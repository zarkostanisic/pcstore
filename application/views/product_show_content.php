					<!-- Begin Content -->
					<div id="content">
						<div id="fb-root"></div>
						<!-- Begin Products -->
						<div id="products"><!--Dodavanje proizvoda-->
								<?php
									foreach($products as $product){
										$image[1]=$product->image1;
										$image[2]=$product->image2;
										$image[3]=$product->image3;

										echo "<h2>";
											echo $product->product_title;
											echo "<span class='price'>".$product->product_price." RSD</span>";
											echo "<span class='title-bottom'>&nbsp;</span>";
										echo "</h2>";
										echo "<div id='product'>";
											echo "<div id='product-images'>";
												echo "<ul>";
													for($i=1;$i<=3;$i++){
														echo "<li><img src='".$this->config->base_url()."images/products/thumbs/".$image[$i]."' class='product-image' id='image".$i."'/></li>";
													}	
												echo "</ul>";
											echo "</div>";
											echo "<div id='product-thumbs'>";
												echo "<ul>";
													for($i=1;$i<=3;$i++){
														if($image[$i]!=""){
															echo "<li><img src='".$this->config->base_url()."images/products/thumbs/".$image[$i]."' class='product-thumb' id='image".$i."'/></li>";
														}else{
															echo "<li><img src='".$this->config->base_url()."images/products/noimage.png' class='no-image'/></li>";
														}
													}
												echo "</ul>";
											echo "</div>";
										echo "</div>";
										echo "<h2 style='text-align:right;padding-right:50px;'>";
								?>
								<div class="fb-like" data-href="<?php echo $this->config->base_url(). "products/show_product/" . $product->product_id; ?>" style="float:left;margin-right:20px;" data-send="false" data-layout="button_count" data-width="50" data-show-faces="false" data-font="tahoma"></div>
								<div style="float:left;"><g:plusone size="medium"></g:plusone></div>
								<?php
										if($product->number > 0){
											echo "<form>";
												echo "Količina: <input type='text' id='number' value='1' class='input2'/>";
												echo "<input type='button' value='Dodaj u korpu' class='submit2' onClick='add_cart(" . $product->product_id . ")'/>";
											echo "</form>";
										}else{
											echo "Nije na lageru";
										}
											echo "<span class='title-bottom'>&nbsp;</span>";
										echo "</h2>";
										echo "<div id='tabs'>";
											echo "<ul class='tabs'>";
												echo "<li><a href='#tab1' class='noactive'>Opis</a></li>";
												echo "<li><a href='#tab2' class='noactive'>Komentari</a></li>";
											echo "</ul>";
											echo "<div id='tab1'>".$product->product_description."</div>";
											echo "<div id='tab2'>";
												if($this->session->userdata('role')){
													echo "<div class='comment'>";
														echo "<form action='".$this->config->base_url()."products/show_product/".$product->product_id."#tab2' method='post'>";
														echo "<table style='margin:0px auto;'>";
															echo "<tr>";
																echo "<td>";
																	echo "<textarea class='comment_textarea' name='comment'>".set_value('comment')."</textarea>";
																echo "</td>";
																echo "<td>".form_error('comment')."</td>";
															echo "</tr>";
															echo "<tr>";
																echo "<td>";
																	echo "<input type='submit' name='submit' value='Komentariši' class='submit'/>";
																	echo "<input type='hidden' name='product_id' value='".$product->product_id."'/><input type='button' name='submit' class='submit' value='Poništi' id='reset'/>";
																echo "</td>";
																echo "<td></td>";
															echo "</tr>";
															echo "<tr>";
																echo "<td colspan='2' class='error'>";
																	if(isset($errors)){
																		echo $errors;
																	}
																echo "</td>";
															echo "</tr>";
														echo "</table>";
														echo "</form>";
													echo "</div>";
												}else{
													echo "<div class='comment'>Morate biti ulogovani da bi komentarisali</div>";
												}
												foreach($comments as $comment){
													echo "<div class='comment'>";
													echo "<div class='comment_top'><p class='comment_user'>".$comment->username."</p></div>";
													echo "<div class='comment_center'>".$comment->comment."</div>";
													echo "<div class='comment_bottom'><p class='comment_date'>".$comment->date."</p></div>";
													echo "</div>";
												}
												echo "<div id='pagination'>".$this->pagination->create_links()."</div>";
											echo "</div>";
										echo "</div>";
									}
								?>
						</div>
						<!-- End Products -->
					</div>
					<!-- End Content -->