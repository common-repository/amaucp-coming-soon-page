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
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="block-top"></div>
				<div class="block-logo">
				<?php 
					$logo = amaucp_get_logo(); 
					if ($logo) {
				?>
					<img src="<?php echo esc_url($logo); ?>" alt="" />
				<?php
					}
				?>
				</div>
				<div class="block-box">
					<div class="row">
						
						<div class="col-md-2">
							
							
							<div class="section-countdown-padding">
								<div class="section_countdown">
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
						
						<div class="col-md-10">
							<!-- HEADER -->
							<div class="header-block">
								
									<div class="text-center">
										<h1 class="head-title"><?php echo wp_kses_post(amaucp_get_title()); ?></h1>
										<div class="head-description"><?php echo wp_kses_post(amaucp_get_description()); ?></div>
									</div>
									
									<?php 
										// get biodata data
										$data = get_option( 'amaucp_themequotes_bio' ); 										
										$phone = amaucp_get_datax($data,'quote_bio_section','phone','08123224232');
										$email = amaucp_get_datax($data,'quote_bio_section','email','myemail@wpamanuke.com');
										$company_name = amaucp_get_datax($data,'quote_bio_section','company_name','WPAmaNuke');
										$company_url = amaucp_get_datax($data,'quote_bio_section','company_url','');
										
									?>
									<?php if ( $phone || $email || $company_name) { ?>
										<ul class="ul-company">
											<?php if ($phone) { ?>
												<li><span><i>P:</i></span> <i><?php echo esc_attr($phone); ?></i></li>
											<?php } ?>
											<?php if ($email) { ?>
											<li><span><i>E:</i></span> <i><a title="" href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></i></li>
											<?php } ?>
											<?php if ($company_name) { ?>
											<li><span><i>W:</i></span> <i><a title="" href="<?php echo esc_url($company_url); ?>"><?php echo $company_name; ?></a></i></li>
											<?php } ?>
										</ul>
										<div class="clearfix"></div>	
									<?php } ?>
									<div class="blue-line"></div>
								
							</div>
							<!-- HEADER ENDS-->
							
							<!-- SUBSCRIBE FORM -->
							<?php if (amaucp_get_data('subscribe','subscribe_show',1)) { ?>
							<div class="section-subscribe">
									<div class="row">
										<div class="col-md-12">
											
											<div class="subscribe-block">
												<div class="row">
													
													<div class="col-md-12">
														<div class="subscribe-div">
														<p><?php echo (amaucp_get_data('subscribe','title')); ?></p>
														</div>
													</div>
													<div class="col-md-12">
														<div class="subscribe-div">
														<?php amaucp_show_subscribe_form(); ?>
														</div>
													</div>
												</div>
											</div>
										</div>							
									</div>
							</div>
							<?php } ?>
							<!-- SUBSCRIBE FORM ENDS -->
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
	
	
	
	
	<!-- SOCIAL MEDIA -->
	<?php if (amaucp_get_data('social_check','social_show',0)) { ?>
    <div class="section-main-social">
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
	
	</div></div>

    <?php amaucp_footer(); ?>
  </body>
</html>