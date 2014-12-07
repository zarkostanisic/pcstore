<form>
<?php 
	if(count($users)>0){
		foreach($users as $user){
			echo "<div class='admin_category'>";
				echo "<div class='admin_category_top'><a href='#' onClick='delete_user(".$user->user_id.");'>X</a></div>";											
				echo "<div class='admin_category_center'><a href='" . $this->config->base_url() . "user/profile/" . $user->user_id . "' target='_blank'>".$user->username."</a></div>";
				echo "<div class='admin_category_bottom'><a href='" . $this->config->base_url() . "admin_users/edit/" . $user->user_id . "' target='_blank'>Izmeni</a></div>";	
			echo "</div>";
		}
	}else{
		echo "<h2>Nema korisnika sa takvim imenom<span class='title-bottom'>&nbsp;</span></h2>";
	}
?>
</form>