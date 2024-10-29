<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php amaucp_head(); ?> 
  </head>

  <body>

  <div class="full-100"><div class="full-box">
	<!-- HEADER -->
	<div class="section-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="header-block">
						<div class="justify-div">
							<div class="text-center">
								<?php 
									$logo = amaucp_get_logo(); 
									if ($logo) {
								?>
								<img src="<?php echo esc_url($logo); ?>" alt="" />
								<?php
									}
								?>
								<h1 class="header-title"><?php echo wp_kses_post(amaucp_get_title()); ?></h1>
								<div class="header-description"><?php echo wp_kses_post(amaucp_get_description()); ?></div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- HEADER ENDS -->
	
	
	<!-- PROGRESSBAR -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="progress-block">
					<div class="justify-div">
						<div class="progress-bar">
							<div class="progress-bar-percent"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!-- PROGRESSBARENDS -->
    
	<!-- TIMER -->
	<div class="section-countdown">
		<div class="container">
		  <div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">
				<div class="countdown-block">
					<div id="defaultCountdown">
						<div class="timer_unit timer_first">
							<div class="timer_circle">
								<div class="text_timer">{dn}</div>
							</div>
							<div class="text">days</div>
						</div>
						<div class="timer_unit">
							<div class="timer_circle">
								<div class="text_timer">{hn}</div>
							</div>
							<div class="text">hour</div>
						</div>
						<div class="timer_unit">
							<div class="timer_circle">
								<div class="text_timer">{mn}</div>
							</div>
							<div class="text">minute</div>
						</div>
						<div class="timer_unit">
							<div class="timer_circle">
								<div class="text_timer">{sn}</div>
							</div>
							<div class="text">second</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div id="defaultCountdown2">
				</div>
			</div>
		  </div>
		</div>
	</div>
	<!-- TIMER ENDS -->
	
	<!-- SUBSCRIBE FORM -->
	<?php if (amaucp_get_data('subscribe','subscribe_show',1)) { ?>
	<div class="section-subscribe">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="subscribe-block">
						<div class="row">
							<div class="col-md-3">
								<div class="subscribe-div">
								<h2 class="subscribe-heading"><?php echo (amaucp_get_data('subscribe','title')); ?></h2>
								</div>
							</div>
							<div class="col-md-3">
								
							</div>
							<div class="col-md-6">
								<div class="subscribe-div">
								<?php amaucp_show_subscribe_form(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>							
			</div>
		</div>
	</div>
	<?php } ?>
    <!-- SUBSCRIBE FORM ENDS -->
	
	
	<!-- SOCIAL MEDIA -->
	<?php if (amaucp_get_data('social_check','social_show',0)) { ?>
    <div class="section-social">
		<div class="container">
		  <div class="row">
			<div class="col-md-12">
				<div class="social-block">
					<div class="pull-right">
						<div class="div-social">
							<?php amaucp_socialmedia(); ?>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		  </div> 
		</div>
	</div>
	<?php } ?>
	<!-- SOCIAL MEDIA ENDS -->
	
	<!-- BOTTOM -->
	<div class="section-bottom"> 	</div>
	<!-- BOTTOM ENDS -->
	</div></div>

    <?php amaucp_footer(); ?>
  </body>
</html>