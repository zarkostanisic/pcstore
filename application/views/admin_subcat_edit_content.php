					<!-- Begin Content -->
					<div id="content">
						<!-- Begin Products -->
						<div id="products"><!--Dodavanje proizvoda-->
								<?php 
									foreach($subcategory as $subcat){
										echo "<h2>Izmeni podkategoriju <strong>".$subcat->category_title."</strong><span class='title-bottom'>&nbsp;</span></h2>";
										echo "<form action='".$this->config->base_url()."admin_subcategories/edit/".$subcat->category_id."' method='post'>";
										echo "<table class='table'>";
											echo "<tr>";
												echo "<td>Naziv:</td>";
												echo "<td><input type='text' name='subcategory_title' class='input' value='".$subcat->category_title."'/></td>";
												echo "<td>".form_error('subcategory_title')."</td>";
											echo "</tr>";
											echo "<tr>";
												echo "<td>Kategorija:</td>";
												echo "<td>";
													echo "<select class='select' name='category_id'>";
														echo "<option value='0' selected>Izaberi</option>";
															foreach($categories as $category){
																if($category->category_id==$subcat->parent_id){
																	echo "<option value='".$category->category_id."' selected>".$category->category_title."</option>";
																}else{
																	echo "<option value='".$category->category_id."'>".$category->category_title."</option>";
																}
															}
													echo "</select>";
												echo "</td>";
												echo "<td>".form_error('category_id')."</td>";
											echo "</tr>";
											echo "<tr>";
												echo "<td><input type='hidden' name='subcategory_id' value='".$subcat->category_id."'</td>";
												echo "<td><input type='submit' name='submit' class='submit' value='Izmeni'/></td>";
											echo "</tr>";
											if(isset($errors)){
												echo "<tr>";
													echo "<td colspan='2'>".$errors."</td>";
												echo "</tr>";
											}
											echo "</table>";
											echo "</form>";
									}
								?>
							<h2></h2>
						</div>
						<!-- End Products -->
					</div>
					<!-- End Content -->