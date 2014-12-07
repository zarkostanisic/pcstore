				<form action="<?php echo $this->config->base_url().'products/search' ?>" method="POST" ><!--Pretraga-->
					<div class="container">
						<?php echo form_error('product_title_search'); ?>
						<p>Pretraga:</p><input type="text" name="product_title_search" title="Pretraga" />
					</div>
					<input class="search-button" type="submit" value="Submit" />
				</form>
				<div class="cl">&nbsp;</div>
			</div>
		</div>
		<!-- End Search -->