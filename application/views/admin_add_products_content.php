					<!-- Begin Content -->
					<div id="content">
						<!-- Begin Products -->
						<div id="products"><!--Dodavanje proizvoda-->
							<h2>Dodaj proizvode<span class="title-bottom">&nbsp;</span></h2>
							<form action="<?php echo $this->config->base_url().'admin_products/add'; ?>" method="post" enctype="multipart/form-data">
							<table class="table">
								<tr>
									<td>Naziv:</td>
									<td><input type="text" name="product_title" class="input" value="<?php echo set_value('product_title'); ?>"/></td>
									<td><?php echo form_error('product_title'); ?></td>
								</tr>
								<tr>
									<td>Opis:</td>
									<td>
										<textarea name="product_description" class="textarea"><?php echo set_value('product_description'); ?></textarea>
									</td>
									<td><?php echo form_error('product_description'); ?></td>
								</tr>
								<tr>
									<td>Podkategorija:</td>
									<td>
										<select class="select" name="subcategory_id">
											<option value="0" selected>Izaberi</option>
											<?php 
												foreach($subcategories as $subcategory){
													echo "<option value='".$subcategory->category_id."'>".$subcategory->category_title."</option>";
												}
											?>
										</select>
									</td>
									<td><?php echo form_error('subcategory_id'); ?></td>
								</tr>
								<tr>
									<td>Cena:</td>
									<td><input type="text" name="product_price" class="input" value="<?php echo set_value('product_price'); ?>"/></td>
									<td><?php echo form_error('product_price'); ?></td>
								</tr>
								<tr>
									<td>Na stanju:</td>
									<td><input type="text" name="product_number" class="input" value="<?php echo set_value('product_number'); ?>"/></td>
									<td><?php echo form_error('product_number'); ?></td>
								</tr>
								<tr>
									<td>Slika 1:</td>
									<td>
										<div class="fileinputs">
											<input type="file" class="file" name="image1" />
											<div class="fakefile">
												<img src="<?php echo $this->config->base_url(); ?>css/images/file.png" />
											</div>
										</div>
									</td>
									<td class="errors">
										<?php 
											if(isset($error_image1)){
												echo $error_image1;
											}
										?>
									</td>
								</tr>
								<tr>
									<td>Slika 2:</td>
									<td>
										<div class="fileinputs">
											<input type="file" class="file" name="image2" />
											<div class="fakefile">
												<img src="<?php echo $this->config->base_url(); ?>css/images/file.png" />
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>Slika 3:</td>
									<td>
										<div class="fileinputs">
											<input type="file" class="file" name="image3" />
											<div class="fakefile">
												<img src="<?php echo $this->config->base_url(); ?>css/images/file.png" />
											</div>
										</div>
									</td>
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
						</div>
						<!-- End Products -->
					</div>
					<!-- End Content -->