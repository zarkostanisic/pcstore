					<!-- Begin Content -->
					<div id="content">
						<!-- Begin Products -->
						<?php 
							foreach($users as $user){
						 ?>
						<h2>Profil korisnika: <?php echo $user->username; ?><span class="title-bottom">&nbsp;</span></h2>
						<table class="table">
							<tr>
								<td rowspan="5">
									<img src="<?php echo $this->config->base_url(); ?>/images/users/small/<?php echo $user->image; ?>">
								</td>
								<td>Ime:</td>
								<td><?php echo $user->first_name; ?></td>
							</tr>
							<tr>
								<td>Prezime:</td>
								<td><?php echo $user->last_name; ?></td>
							</tr>
							<tr>
								<td>Email:</td>
								<td><?php echo $user->email; ?></td>
							</tr>
							<tr>
								<td>Telefon:</td>
								<td><?php echo $user->phone; ?></td>
							</tr>
							<tr>
								<td>Grad:</td>
								<td><?php echo $user->city_title; ?></td>
							</tr>
						</table>
						<?php  
							}
						?>
						<h2></h2>
						<!-- End Products -->
					</div>
					<!-- End Content -->