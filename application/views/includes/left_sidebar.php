		<!-- Begin Main -->
		<div id="main">
			<!-- Begin Inner -->
			<div class="inner">
				<div class="shell">
					<!-- Begin Left Sidebar -->
					<div id="left-sidebar" class="sidebar">
						<ul>
							<?php 
								foreach($categories as $category){
									echo "<li class='widget'>";
										echo "<h2>".$category->category_title."</h2>";
										echo "<div class='widget-entry'>";
											echo "<ul>";
												foreach($subcategories as $subcategory){
													if($category->category_id==$subcategory->parent_id){
														echo "<li><a href='".$this->config->base_url()."products/show/".$subcategory->category_id."' title='".$subcategory->category_title."'><span>".$subcategory->category_title."</span></a></li>";
													}
												}	
											echo "</ul>";
										echo "</div>";
									echo "</li>";
								}
							?>
						</ul>
					</div>
					<!-- End Sidebar -->