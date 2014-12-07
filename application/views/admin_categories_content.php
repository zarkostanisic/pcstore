					<!-- Begin Content -->
					<div id="content">
						<!-- Begin Products -->
						<div id="products"><!--Dodavanje proizvoda-->
							<h2>Kategorije<span class="title-bottom">&nbsp;</span></h2>
							<form action="<?php echo $this->config->base_url().'admin_categories/manage'; ?>" method="post">
							<table class="table">
								<tr>
									<td>Naziv:</td>
									<td><input type="text" name="category_title" class="input" value="<?php echo set_value('category_title'); ?>"/></td>
									<td><?php echo form_error('category_title'); ?></td>
								</tr>
								<tr>
									<td></td>
									<td>
										<input type="submit" name="submit" class="submit" value="Dodaj"/>
										<input type="button" name="submit" class="submit" value="Poništi" id="reset"/>
									</td>
								</tr>
								<tr>
									<td colspan="2" class="error">
										<?php 
											if(isset($errors)){
												echo $errors;
											}
									 	?>
									</td>
								</tr>
							</table>
							</form>
							<h2></h2>
							<?php 
								foreach($admin_categories as $category){
									echo "<div class='admin_category'>";
										echo "<div class='admin_category_top'><a href='".$this->config->base_url()."admin_categories/manage/".$category->category_id."/".$offset."'>X</a></div>";											
										echo "<div class='admin_category_center'>".$category->category_title."</div>";
										echo "<div class='admin_category_bottom'><a href='".$this->config->base_url()."admin_categories/edit/".$category->category_id."'>Izmeni</a></div>";
									echo "</div>";
								}
							?>
						</div>
						<?php 
							echo "<div id='pagination'>".$this->pagination->create_links()."</div>";
						?>
						<!-- End Products -->
					</div>
					<!-- End Content -->