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
							<div class="row">
								<!-- SOCIAL MEDIA -->
								<?php if (amaucp_get_data('social_check','social_show',0)) { ?>
									<div class="col-md-4">
									</div>
									<div class="col-md-8">
										<div class="pull-center">
											<div class="div-social">
												<?php amaucp_socialmedia(); ?>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
								<?php } ?>
								<!-- SOCIAL MEDIA ENDS -->
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
								
									<div class="countdown-timer">
										<div class="timer-unit">
											<div class="text-timer">{dn}</div>
											<div class="text">days</div>
												
											</div>
											<div class="timer-unit">
												<div class="text-timer">{hn}</div>
												<div class="text">hours</div>
												
											</div>
											<div class="timer-unit">
												<div class="text-timer">{mn}</div>
												<div class="text">minute</div>
												
											</div>
											<div class="timer-unit">
												<div class="text-timer">{sn}</div>
												<div class="text">second</div>
											</div>
											<div class="clearfix"></div>
											
											<div id="defaultCountdown">
											
										</div>
										
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
									
								</div>
							</div>
						</div>
					</div>
				
			</div>
		</div>
		<!-- subscribe ends -->
		
		
		<!-- 2 -->
		<?php 
			$data_about = get_option( 'amaucp_irsetheme' ); 
			$txt = 'amaucp_irsethemes_options_section';
			$status = amaucp_get_datax( $data_about , $txt , 'status' , 0 );
	
		?>
		<?php if ($status) { ?>
		<div class="container">
			<div class="row">	
				<div class="col-md-12">
					<div class="section-title"><div class="text-center"><h2>About Us</h2></div></div>
				</div>				
			</div>
			
				<?php
					$txt2 = 'amaucp_irsethemes_section';
					$data = amaucp_get_datay( $data_about , $txt2 , 0 );
					if ($data) {
						$iCount = 0;
						foreach ($data as $value) {
							$iCount++;
							if (($iCount%3)==1) {
								echo '<div class="row">';
							}
				?>
							<div class="col-md-4">
								<div class="block-about">
									<div class="block-img">
										<?php
												$url = $value['media'];
												if ($url=='')
													$url = amaucp_get_theme_url() . '/images/placeholder-team.png';
										?>
											<img src="<?php echo esc_url($url); ?>" />
									</div>
									<div class="block-title">
										<h3><?php echo wp_kses_post($value['title']); ?></h3>
									</div>
									<div class="block-description">
										<?php echo wp_kses_post($value['description']); ?>
									</div>		
								</div>
							</div>
				<?php
							if (( $iCount%3 ) == 0 ) {
								echo '</div>';
							}
						}
						if (( $iCount%3 ) != 0 ) {
							echo '</div>';
						}
					} 
				?>

		</div>
		<?php } ?>
		<!-- 2 -->
		
		
		
		
	
	</div>
	
	
	 <?php amaucp_footer(); ?>
	
</body>
</html>