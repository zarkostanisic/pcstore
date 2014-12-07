					<!-- Begin Content -->
					<div id="content">
						<!-- Begin Products -->
						<h2>Kontakt<span class="title-bottom">&nbsp;</span></h2>
						<form action="<?php echo $this->config->base_url().'home/contact'; ?>" method="post" enctype="multipart/form-data">
						<table class="table">
							<tr>
								<td>Od:</td>
								<td><input type="text" name="sender" class="input"/></td>
								<td><?php echo form_error('sender'); ?></td>
							</tr>
							<tr>
								<td>Email:</td>
								<td><input type="text" name="email" class="input"/></td>
								<td><?php echo form_error('email'); ?></td>
							</tr>
							<tr>
								<td>Poruka:</td>
								<td>
									<textarea name="message" class="input" style="max-width:200px;max-height:200px;"></textarea>
								</td>
								<td><?php echo form_error('message'); ?></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" name="send" value="Pošalji" class="submit">
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