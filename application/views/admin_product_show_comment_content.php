					<!-- Begin Content -->
					<div id="content">
						<!-- Begin Products -->
						<div id="products"><!--Dodavanje proizvoda-->
							<?php
								foreach($product as $pro){
									echo "<h2>Komentari proizvoda <strong>".$pro->product_title."</strong><span class='title-bottom'>&nbsp;</span></h2>";
								}
								if(count($comments)>0){
									foreach($comments as $comment){
										echo "<div class='comment'>";
											echo "<div class='comment_top'><p class='comment_user'>".$comment->username."</p><a href='".$this->config->base_url()."admin_comments/manage/".$product_id."/".$comment->comment_id."/".$offset."'>X</a></div>";
											echo "<div class='comment_center'>".$comment->comment."</div>";
											echo "<div class='comment_bottom'><p class='comment_date'>".$comment->date."</p></div>";
										echo "</div>";
									}
								}else{
									echo "<h2>Nema komentara za proizvod<span class='title-bottom'>&nbsp;</span></h2>";
								}
							?>
						</div>
						<!-- End Products -->
						<?php
							echo "<div id='pagination'>".$this->pagination->create_links()."</div>";
						?>
					</div>
					<!-- End Content -->