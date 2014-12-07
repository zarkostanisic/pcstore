					<!-- Begin Content -->
					<div id="content">
						<!-- Begin Products -->
						<h2>Registracija<span class="title-bottom">&nbsp;</span></h2>
						<form action="<?php echo $this->config->base_url().'user/registration'; ?>" method="post" enctype="multipart/form-data">
						<table class="table">
							<tr>
								<td>Ime:</td>
								<td><input type="text" name="first_name" class="input" value="<?php echo set_value('first_name'); ?>"/></td>
								<td><?php echo form_error('first_name'); ?></td>
							</tr>
							<tr>
								<td>Prezime:</td>
								<td><input type="text" name="last_name" class="input" value="<?php echo set_value('last_name'); ?>"/></td>
								<td><?php echo form_error('last_name'); ?></td>
							</tr>
							<tr>
								<td>Korisnicko ime:</td>
								<td><input type="text" name="username" class="input" value="<?php echo set_value('username'); ?>"/></td>
								<td><?php echo form_error('username'); ?></td>
							</tr>
							<tr>
								<td>Sifra:</td>
								<td><input type="password" name="password" class="input" /></td>
								<td><?php echo form_error('password'); ?></td>
							</tr>
							<tr>
								<td>Ponovi sifru:</td>
								<td><input type="password" name="password2" class="input"/></td>
							</tr>
							<tr>
								<td>Email:</td>
								<td><input type="text" name="email" class="input" value="<?php echo set_value('email'); ?>"/></td>
								<td><?php echo form_error('email'); ?></td>
							</tr>
							<tr>
								<td>Telefon:</td>
								<td><input type="text" name="phone" class="input" value="<?php echo set_value('phone'); ?>"/></td>
								<td><?php echo form_error('phone'); ?></td>
							</tr>
							<tr>
								<td>Slika:</td>
								<td>
									<div class="fileinputs">
										<input type="file" class="file" name="image" />
										<div class="fakefile">
											<img src="<?php echo base_url(); ?>css/images/file.png" />
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>Grad:</td>
								<td>
									<select class="select" name="city">
										<option value="0" selected>Izaberi</option>
										<?php 
											foreach($cities as $city){
												echo "<option value='".$city->city_id."'>".$city->city_title."</option>";
											}
										?>
									</select>
								</td>
								<td><?php echo form_error('city'); ?></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" name="submit" value="Registruj se" class="submit">
									<input type="button" name="submit" class="submit" value="Poništi" id="reset"/>
								</td>
							</tr>
							<tr>
								<td colspan="2" class="error"><?php echo $errors ?></td>
							</tr>
						</table>
						</form>
						<h2></h2>
						<!-- End Products -->
					</div>
					<!-- End Content -->