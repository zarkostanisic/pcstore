					<!-- Begin Content -->
					<div id="content">
						<!-- Begin Products -->
						<div id="products"><!--Dodavanje proizvoda-->
						    <h2>Pristigli komentari<span class="title-bottom">&nbsp;</span></h2>
							<?php
								if(count($comments)>0){
									foreach($comments as $comment){
										echo "<div class='comment'>";
											echo "<div class='comment_top'><p class='comment_user'>".$comment->username."</p><a href='".$this->config->base_url()."admin_comments/manage_received/delete/".$comment->comment_id."'>X</a></div>";
											echo "<div class='comment_center'>".$comment->comment."</div>";
											echo "<div class='comment_bottom'><p class='comment_date'>".$comment->date."</p></div>";
											echo "<div class='comment_top'><p class='comment_user'>".$comment->username."</p><a href='".$this->config->base_url()."admin_comments/manage_received/allow/".$comment->comment_id."'>Odobri</a></div>";
										echo "</div>";
									}
								}else{
									echo "<h2>Nema pristiglih komentara<span class='title-bottom'>&nbsp;</span></h2>";
								}
							?>
						</div>
						<!-- End Products -->
					</div>
					<!-- End Content -->