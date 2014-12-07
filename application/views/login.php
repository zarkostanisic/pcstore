		<!-- Begin Search -->
		<div id="search">
			<div class="shell">
				<form action="<?php echo $this->config->base_url().'user/login' ?>" method="POST" style="float:left;" ><!--Logovanje-->
					<div class="container">
						<p>Korisničko ime:</p><input type="text" name="username_login" title="Korisnik"/><?php echo form_error('username_login'); ?>
						<p>Šifra:</p><input type="password" name="password_login" title="Sifra" /><?php echo form_error('password_login'); ?>
					</div>
					<input class="login-button" type="submit" value="Submit" />
				</form>