					<!-- Begin Content -->
					<div id="content">
						<!-- Begin Products -->
						<?php 
							if(count($users) == 1){
								foreach($users as $user){
						 ?>
						<h2>Izmeni korisnika: <b><?php echo $user->username; ?></b><span class="title-bottom">&nbsp;</span></h2>
						<form action="<?php echo $this->config->base_url(); ?>admin_users/edit/<?php echo $user->user_id; ?>" method="post" enctype="multipart/form-data">
						<table class="table">
							<tr>
								<td>Ime:</td>
								<td><input type="text" name="first_name" class="input" value="<?php echo $user->first_name; ?>"/></td>
								<td><?php echo form_error('first_name'); ?></td>
							</tr>
							<tr>
								<td>Prezime:</td>
								<td><input type="text" name="last_name" class="input" value="<?php echo $user->last_name; ?>"/></td>
								<td><?php echo form_error('last_name'); ?></td>
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
								<td><input type="text" name="email" class="input" value="<?php echo $user->email; ?>"/></td>
								<td><?php echo form_error('email'); ?></td>
							</tr>
							<tr>
								<td>Telefon:</td>
								<td><input type="text" name="phone" class="input" value="<?php echo $user->phone; ?>"/></td>
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
												if($user->city == $city->city_id){
													echo "<option value='".$city->city_id."' selected>".$city->city_title."</option>";
												}else{
													echo "<option value='".$city->city_id."'>".$city->city_title."</option>";
												}
											}
										?>
									</select>
								</td>
								<td><?php echo form_error('city'); ?></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" name="change" value="Izmeni profil" class="submit">
									<input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>"/>
								</td>
							</tr>
							<tr>
								<td colspan="2" class="error"><?php echo $errors ?></td>
							</tr>
						</table>
						</form>
						<?php 
								}
							}
						 ?>
						<h2></h2>
						<!-- End Products -->
					</div>
					<!-- End Content -->