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
		<div class="container col-md-12">
			<div class="row  col-eq">
					
					<!-- animation -->
					<div class="col-md-6 ucp-side ucpbg-side-left">
						<div class="ucp-block">
							 <div class="align-center text-center ucp-align-center">
									<?php 
										$data = get_option( 'amaucp_feature_quote' ); 
										$status = amaucp_get_datax( $data , 'amaucp_feature_quotes_section' , 'status' , 0 );
									?>
									<?php if ( $status ) { ?>
									<div id="typed-strings">
										
										<?php
											$quotes = amaucp_get_datax( $data , 'amaucp_feature_quotes_section' , 'quotes_list' );
																					
											if ( $quotes ) {
												foreach ( $quotes as $quote ) {
										?>
												<div class="slider-item"><?php echo wp_kses_post($quote); ?></div>
										<?php
												}
											};
										?>
									</div>
									<?php } ?>
							 </div>
						 </div>
					</div>
					<!-- animation ends -->
					
					<!-- subscribe -->
					<div class="col-md-6 ucp-side ucpbg-side-right">
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
									<!-- SUBSCRIBE FORM ENDS -->
									<div>
										<!-- SOCIAL MEDIA -->
										<?php if (amaucp_get_data('social_check','social_show',0)) { ?>
											<div class="pull-left">
												<div class="div-social">
													<?php amaucp_socialmedia(); ?>
												</div>
											</div>
											<div class="clearfix"></div>
										<?php } ?>
										<!-- SOCIAL MEDIA ENDS -->
									</div>
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