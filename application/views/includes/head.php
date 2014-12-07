<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title><?php echo $title; ?> | Prodavnica računara</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="css/images/icon.png" />
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>css/style.css" type="text/css" media="all" />
	<script type="text/javascript" src="<?php echo $this->config->base_url(); ?>jquery/jquery-1.8.0.min.js"></script>
	<script language="javascript">
			$(document).ready(function (){
					$('.product-thumb').click(function(){
						var thumb=$(this).attr('id');
						
						$('.product-thumb').css({'opacity':'1'});
						$(this).css({'opacity':'.7'});
						
						$('.product-image').hide();
						$('#product-images').find('#' + thumb).css({'opacity':'0.7'}).show().animate({'opacity':'1'},1500);
					});

					$('ul.tabs').each(function(){
					    var $active, $content, $links = $(this).find('a');

					    $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
					    $active.addClass('active');
					    $content = $($active.attr('href'));

					    $links.not($active).each(function () {
					        $($(this).attr('href')).hide();
					    });

					    $(this).on('click', 'a', function(e){
					        $active.removeClass('active');
					        $content.hide();

					        $active = $(this);
					        $content = $($(this).attr('href'));

					        $active.addClass('active');
					        $content.show();

					        e.preventDefault();
					    });
					});

					$('#reset').click(function(){
						$('.input').val("");
						$('.textarea').val("");
						$('.comment_textarea').val("");
						$('.error').hide();
					});

					$('#show_del').click(function(){
						var data={
							product_title:$('#product_title').val()
						};

						$.ajax({
							url:"<?php echo $this->config->base_url()."admin_products/delete_show_products"; ?>",
							type:"POST",
							data:data,
							success:function(msg){
								$('#show_products').html(msg);
							}
						});

						return false;
					});

					$('#show_edit').click(function(){
						var data={
							product_title:$('#product_title').val()
						};

						$.ajax({
							url:"<?php echo $this->config->base_url()."admin_products/edit_show_products"; ?>",
							type:"POST",
							data:data,
							success:function(msg){
								$('#show_products').html(msg);
							}
						});

						return false;
					});

					$('#show_com').click(function(){
						var data={
							product_title:$('#product_title').val()
						};

						$.ajax({
							url:"<?php echo $this->config->base_url()?>admin_comments/show_comments",
							type:"POST",
							data:data,
							success:function(msg){
								$('#show_products').html(msg);
							}
						});

						return false;
					});

					$('#show_ext').click(function(){
						var data={
							product_title:$('#product_title').val()
						};

						$.ajax({
							url:"<?php echo $this->config->base_url()."admin_products/extract_show_product"; ?>",
							type:"POST",
							data:data,
							success:function(msg){
								$('#show_products').html(msg);
							}
						});

						return false;
					});

					var set = 0;

					$(document).on('click', '.number_stats', function(){

						if(set == 0){

							set = 1;

							var id = $(this).attr('id');
							var data = {
								id:id
							}

							$.ajax({
								url:"<?php echo $this->config->base_url()."admin_products/number"; ?>",
								type:"POST",
								data:data,
								success:function(msg){
									$('#' + id).find('b').html(msg);
								}
							});
						}
					});

					$(document).on('blur', '.product_stats_input', function(){

						var id = $(this).attr('id');
						var val = $(this).val();
						var data = {
							id:id,
							val:val
						}

						$.ajax({
							url:"<?php echo $this->config->base_url()."admin_products/change"; ?>",
							type:"POST",
							data:data,
							success:function(msg){
								$('#' + id).find('b').html(msg);
							}
						});

						set = 0;
					});

					$(document).on('click', '.pagination a', function(){
						var title = $("#product_stats_title").val();

						var data = {
							title:title
						}

						$.ajax({
							url:$(this).attr('href'),
							type:"POST",
							data:data,
							success:function(msg){
								$("#product_stats_show").html(msg);
							}
						});

						return false;
					});

					$("#product_stats_button").click(function(){
						var title = $("#product_stats_title").val();

						var data = {
							title:title
						}

						$.ajax({
							url:"<?php echo $this->config->base_url()."admin_products/stats_show"; ?>",
							type:"POST",
							data:data,
							success:function(msg){
								$("#product_stats_show").html(msg);
							}
						});						
					});

					shop_number();
			});
	</script>
	<script type="text/JavaScript">
		function delete_product(product_id){
			var id=product_id;
			var data={
				product_id:id,
				product_title:$('#product_title').val()
			};

			$.ajax({
				url:"<?php echo $this->config->base_url().'admin_products/delete_product'; ?>",
				type:"POST",
				data:data,
				success:function(msg){
					$('#show_products').html(msg);
				}
			});
		}

		function extract_product(product_id){
			var id=product_id;
			var data={
				product_id:id,
				product_title:$('#product_title').val()
			};

			$.ajax({
				url:"<?php echo $this->config->base_url().'admin_products/extract_product'; ?>",
				type:"POST",
				data:data,
				success:function(msg){
					$('#show_products').html(msg);
				}
			});
		}

		function show_users(){
				var data={
					username:$('#username').val()
				};

				$.ajax({
					url:"<?php echo $this->config->base_url()."admin_users/show"; ?>",
					type:"POST",
					data:data,
					success:function(msg){
						$('#show_users').html(msg);
					}
				});
		}

		function delete_user(user_id){
			var id=user_id;
			var data={
				id:id
			};

			$.ajax({
				url:"<?php echo $this->config->base_url().'admin_users/delete'; ?>",
				type:"POST",
				data:data,
				success:show_users
			});

		}

		function add_cart(product_id){
			var id = product_id;
			var number = $("#number").val();
			var data={
				product_id:id,
				number:number
			};

			$.ajax({
				url:"<?php echo $this->config->base_url().'order/add'; ?>",
				type:"POST",
				data:data,
				success:function(msg){
					if(msg == ""){
						shop_number();
					}else{
						alert(msg);
					}
					
				}
			});
		}

		function shop_number(){
			$.ajax({
				url:"<?php echo $this->config->base_url().'order/number'; ?>",
				type:"POST",
				success:function(msg){
					$("#number_cart").html(msg);
				}
			});
		}

		function shop_cart(){
			$.ajax({
				url:"<?php echo $this->config->base_url().'order/show'; ?>",
				type:"POST",
				success:function(msg){
					$("#shop_show").html(msg);
				}
			});
		}

		function shop_remove(id){
			var id = id;
			var data = {
				id:id
			}

			$.ajax({
				url:"<?php echo $this->config->base_url().'order/remove' ?>",
				type:"POST",
				data:data,
				success:function(){
					shop_cart();
					shop_number();
				}
			});
		}

		function change_number(id,rowid){
			var data = {
				id:id,
				rowid:rowid,
				value:$("#" + id).val()
			}
			$.ajax({
				url:"<?php echo $this->config->base_url().'order/change' ?>",
				type:"POST",
				data:data,
				success:function(msg){
					$("#shop_show").html(msg);
					shop_cart();
				}
			});
		}

		$(document).on("click", "#confirm", function(){
			$.ajax({
				url:"<?php echo $this->config->base_url().'order/confirm' ?>",
				type:"POST",
				success:function(msg){
					$("#shop_show").html(msg);
				}
			});
		});

		$(document).on("click", "#send", function(){
			$.ajax({
				url:"<?php echo $this->config->base_url().'order/send' ?>",
				type:"POST",
				success:function(msg){
					$("#shop_show").html(msg);
					shop_number();
				}
			});
		});

		function product_stats(){
			var title = $("#product_stats_title").val();

			var data = {
				title:title
			}

			$.ajax({
				url:"<?php echo $this->config->base_url().'admin_products/stats_show' ?>",
				type:"POST",
				data:data,
				success:function(msg){
					$("#product_stats_show").html(msg);
				}
			});
		}
	</script>
	<script type="text/javascript">
		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/plusone.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
	</script>
	<script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_EN/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}
		(document, 'script', 'facebook-jssdk'));
	</script>
</head>
<body>
	<!-- Begin Wrapper -->
	<div id="wrapper">