					<!-- Begin Content -->
					<div id="content">
						<!-- Begin Products -->
						<div id="products"><!--Dodavanje proizvoda-->
							<?php 
								foreach($products as $product){
									echo "<h2>Izmeni proizvod <strong>".$product->product_title."</strong><span class='title-bottom'>&nbsp;</span></h2>";
									echo "<form action='".$this->config->base_url()."admin_products/edit_product/".$product->product_id."' method='post' enctype='multipart/form-data'>";
									echo "<table class='table'>";
										echo "<tr>";
											echo "<td>Naziv:</td>";
											echo "<td><input type='text' name='product_title' class='input' value='".$product->product_title."'/></td>";
											echo "<td>".form_error('product_title')."</td>";
										echo "</tr>";
										echo "<tr>";
											echo "<td>Opis:</td>";
											echo "<td>";
												echo "<textarea name='product_description' class='textarea'>".$product->product_description."</textarea>";
											echo "<td>".form_error('product_description')."</td>";
										echo "</tr>";
										echo "<tr>";
											echo "<td>Podkategorija:</td>";
											echo "<td>";
												echo "<select class='select' name='subcategory_id'>";
													echo "<option value='0' selected>Izaberi</option>";
													foreach($subcategories as $subcategory){
														if($subcategory->category_id==$product->category_id){
															echo "<option value='".$subcategory->category_id."' selected>".$subcategory->category_title."</option>";
														}else{
															echo "<option value='".$subcategory->category_id."'>".$subcategory->category_title."</option>";	
														}
													}
												echo "</select>";
											echo "</td>";
											echo "<td>".form_error('subcategory_id')."</td>";
										echo "</tr>";
										echo "<tr>";
											echo "<td>Cena:</td>";
											echo "<td><input type='text' name='product_price' class='input' value='".$product->product_price."'/></td>";
											echo "<td>".form_error('product_price')."</td>";
										echo "</tr>";
										echo "<tr>";
											echo "<td>Na stanju:</td>";
											echo "<td><input type='text' name='product_number' class='input' value='".$product->number."'/></td>";
											echo "<td>".form_error('product_number')."</td>";
										echo "</tr>";
										echo "<tr>";
											echo "<td>Slika 1:</td>";
											echo "<td>";
												echo "<div class='fileinputs'>";
													echo "<input type='file' class='file' name='image1' />";
													echo "<div class='fakefile'>";
														echo "<img src='".$this->config->base_url()."css/images/file.png' />";
													echo "</div>";
												echo "</div>";
											echo "</td>";
											echo "<td class='errors'>";
												if(isset($error_image1)){
													echo $error_image1;
												}
											echo "</td>";
										echo "</tr>";
										echo "<tr>";
											echo "<td>Slika 2:</td>";
											echo "<td>";
												echo "<div class='fileinputs'>";
													echo "<input type='file' class='file' name='image2' />";
													echo "<div class='fakefile'>";
														echo "<img src='".$this->config->base_url()."css/images/file.png' />";
													echo "</div>";
												echo "</div>";
											echo "</td>";
										echo "</tr>";
										echo "<tr>";
											echo "<td>Slika 3:</td>";
											echo "<td>";
												echo "<div class='fileinputs'>";
													echo "<input type='file' class='file' name='image3' />";
													echo "<div class='fakefile'>";
														echo "<img src='".$this->config->base_url()."css/images/file.png' />";
													echo "</div>";
												echo "</div>";
											echo "</td>";
										echo "</tr>";
										echo "<tr>";
											echo "<td><input type='hidden' name='product_id' value='".$product->product_id."'/></td>";
											echo "<td>";
												echo "<input type='submit' name='submit' class='submit' value='Izmeni'/>";
											echo "</td>";
										echo "</tr>";
										echo "<tr>";
											echo "<td colspan='2' class='error'>";
												if(isset($errors)){
													echo $errors;
												}
											echo "</td>";
										echo "</tr>";
									echo "</table>";
									echo"</form>";
								}
							?>
							<h2></h2>
						</div>
						<!-- End Products -->
					</div>
					<!-- End Content -->