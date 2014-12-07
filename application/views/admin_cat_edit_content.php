					<!-- Begin Content -->
					<div id="content">
						<!-- Begin Products -->
						<div id="products"><!--Dodavanje proizvoda-->
								<?php 
									foreach($category as $cat){
										echo "<h2>Izmeni kategoriju <strong>".$cat->category_title."</strong><span class='title-bottom'>&nbsp;</span></h2>";
										echo "<form action='".$this->config->base_url()."admin_categories/edit/".$cat->category_id."' method='post'>";
										echo "<table class='table'>";
											echo "<tr>";
												echo "<td>Naziv:</td>";
												echo "<td><input type='text' name='category_title' class='input' value='".$cat->category_title."'/></td>";
												echo "<td>".form_error('category_title')."</td>";
											echo "</tr>";
											echo "<tr>";
												echo "<td><input type='hidden' name='category_id' value='".$cat->category_id."'</td>";
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