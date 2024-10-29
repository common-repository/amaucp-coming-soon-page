<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php amaucp_head(); ?> 
	
</head>
<body>
	
	<div class="ucp-container-full">
	
		<!-- 1 -->
		<div class="container">
			<div class="row col-eq">
					
					<!-- animation -->
					<div class="col-md-8">
						<div class="ucp-block">
							<div class="ucp-left-image">
								<img src="<?php echo esc_url(amaucp_get_theme_url() . '/images/bg-left.png'); ?>" alt="" />
							</div>
						</div>
					</div>
					<!-- animation ends -->
					
					<!-- subscribe -->
					<div class="col-md-4">
						<div class="bg">
							<div class="ucp-block">
								<div class="header-block">
									
									<div class="header-block-data">
										<h1 class="header-title"><?php echo wp_kses_post(amaucp_get_title()); ?></h1>
										<div class="header-description"><?php echo wp_kses_post(amaucp_get_description()); ?></div>	
									</div>
								
									
									<!-- SUBSCRIBE FORM -->
									<?php if (amaucp_get_data('subscribe','subscribe_show',1)) { ?>
										<div class="subscribe-block">
											<div class="subscribe-title"><?php echo (amaucp_get_data('subscribe','title')); ?></div>
											<form id="form-subscribe" class="form-subscribe" action="" method="post">
												<input class="email" name="email" placeholder="Input your e-mail here..." required="" type="text">
												<button type="submit" class="submit" value="Let me Notified"><i class="fa fa-arrow-circle-right"></i></button>
											</form>					
										</div>
									<?php } ?>
									<!-- SUBSCRIBE FORM ENDS -->
									<!-- SOCIAL MEDIA -->
									<?php if (amaucp_get_data('social_check','social_show',0)) { ?>	
										<div class="div-social">
											<?php amaucp_socialmedia(); ?>
										</div>
									<?php } ?>
									<!-- SOCIAL MEDIA ENDS -->
								</div>
							</div>
						</div>
					</div>
				
			</div>
		</div>
		<!-- subscribe ends -->
			
	</div>
	<?php amaucp_footer(); ?>
	
</body>
</html>