		<!-- Begin Navigation -->
		<div id="navigation">
			<div class="shell">
				<ul>
					<li><a href="<?php echo $this->config->base_url(); ?>" title="Početna">Početna</a></li>
					<li><a href="<?php echo $this->config->base_url()."home/about"; ?>" title="O nama">O nama</a></li>
					<li><a href="<?php echo $this->config->base_url()."admin_categories"; ?>" title="Administracija">Administracija</a></li>
					<li><a href="<?php echo $this->config->base_url(); ?>user/profile/<?php echo $user_profile_id; ?>" title="Profil">Profil</a></li>
					<li style="border:none;"><a href="<?php echo $this->config->base_url().'home/contact'; ?>" title="Kontakt">Kontakt</a></li>
				</ul>
				<div class="cl">&nbsp;</div>
			</div>
		</div>
		<!-- End Navigation -->