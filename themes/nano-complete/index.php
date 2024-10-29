<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php amaucp_head(); ?> 
	<link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
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
									
								</div>
							</div>
						</div>
					</div>
				
			</div>
		</div>
		<!-- subscribe ends -->

		
		
		<!-- 2 -->
		<?php 
			$data_about = get_option( 'amaucp_feature_about' ); 
			$txt = 'amaucp_feature_abouts_section';
			$status = amaucp_get_datax( $data_about , $txt , 'status' , 0 );
	
		?>
		<?php if ($status) { ?>
		<div class="container col-md-12">
			<div class="row section-about">	
				<div class="col-md-2"> 
				</div>
				<div class="col-md-8">
					<div class="ucp-block">
						
						<div class="text-center">
							<h2 class="h-section-title"><?php echo wp_kses_post(amaucp_get_datax( $data_about ,  $txt  , 'title' , 'About' )); ?></h2>
							<div class="h-section-tagline"><?php echo wp_kses_post(amaucp_get_datax( $data_about ,  $txt  , 'tagline' , 'About Tagline' )); ?></div>
							<div class="h-section-description">
								<?php echo wp_kses_post(amaucp_get_datax( $data_about ,  $txt  , 'description' , 'Description' )); ?>
							</div>
						</div>
					 </div>
				</div>
				<div class="col-md-2">
				</div>
			</div>
		</div>
		<?php } ?>
		<!-- 2 -->
		
		<!-- -->
		<?php 
			$data_service = get_option( 'amaucp_feature_service' ); 
			$txt = 'amaucp_feature_services_options_section';
			$status = amaucp_get_datax( $data_service , $txt , 'status' , 0 );
			 
		?>
		<?php if ( $status ) { ?> 
		<div class="container col-md-12">
			<div class="row section-service">	
				<?php 
					$txt = 'amaucp_feature_services_section';
					$data = amaucp_get_datay( $data_service , $txt , 0 );
				
					if ( $data ) {
						$iCount = 0;
						foreach ($data as $value) {
							$iCount++;
							if (($iCount%4)==1) {
									echo '<div class="col-md-12 col-sm-12"><div class="row">';
							}
				?>
							<div class="col-md-3">
								<div class="text-center">
									<div class="service-block">
										<div class="service-icon">
											<i class="fa <?php echo esc_attr($value['icon']); ?>"></i>
										</div>
										<div class="service-title">
											<?php echo wp_kses_post($value['title']); ?>
										</div>
										<div class="service-description">
											<?php echo wp_kses_post($value['description']); ?>
										</div>
									</div>
								</div>
							</div>
				<?php
							if (($iCount%4)==0) {
									echo '</div></div>';
							}
						}
						if (($iCount%4)!=0) {
							echo '</div></div>';
						}
					}
				?>
			</div>
		</div>
		<?php } ?>
		<!-- 2 -->
		
		<!-- 2 -->
		<?php 
			$data_team = get_option( 'amaucp_feature_team' ); 
			$txt = 'amaucp_feature_teams_options_section';
			$status = amaucp_get_datax( $data_team , $txt , 'status' , 0 );
		?>
		<?php if ($status) { ?>
		<div class="">
			<div class="container col-md-12 section-team-bg">
				<div class="row section-team">	
					
					<?php
						$txt = 'amaucp_feature_teams_section';
						$data = amaucp_get_datay( $data_team , $txt , 0 );
						if ($data) {
							$iCount = 0;
							foreach ($data as $value) {
								$iCount++;
								if (($iCount%3)==1) {
									echo '<div class="col-md-12"><div class="row">';
								}
								
					?>
						<div class="col-md-2">
							<?php
								$url = $value['media'];
								if ($url=='')
									$url = amaucp_get_theme_url() . '/images/placeholder-team.png';
							?>
							<img src="<?php echo esc_url($url); ?>" />
						</div>
						<div class="col-md-2">
							<div class="team-block">
								
								<div class="team-title">
									<?php echo wp_kses_post($value['title']); ?>
								</div>
								<div class="team-tagline">
									<?php echo wp_kses_post($value['tagline']); ?>
								</div>
								<div class="team-social">
									<?php
										$social_media = $value['social_media'];
										if ($social_media) {
									?>
									<ul>
										<?php 
											foreach ($social_media as $item) {
										?>
										<li><a href="<?php echo esc_url($item['social_url']); ?>" title="" target="_blank"><i class="fa <?php echo esc_attr($item['social_type']); ?>"></i></a></li>
										<?php
											}
										?>
									</ul>
									<div class="clearfix"></div>
									<?php } ?>
									
								</div>
								<div class="team-description">
									<?php echo wp_kses_post($value['description']); ?>
								</div>
							</div>
						</div>
				<?php 
							if (($iCount%3)==0) {
									echo '</div></div>';
							}
						}
						if (($iCount%3)!=0) {
							echo '</div></div>';
						}
					}
				?>
					
				</div>
			</div>
		</div>
		<?php  } ?>
		<!-- 2 -->
		
		<!-- 3 -->
		<?php 
			$txt = 'amaucp_feature_contacts_options_section';
			$data_contact = get_option( 'amaucp_feature_contact' ); 
			$status = amaucp_get_datax( $data_contact , $txt , 'contact_status' , 0 );
		?>
		<?php if ($status) { ?>
		<div class="container col-md-12">
			<div class="row">	
				<div class="col-md-2">
				</div>
				<div class="col-md-8">
					<div class="ucp-block">
						<div class="text-center">
							<h2 class="h-section-title"><?php echo wp_kses_post(amaucp_get_datax( $data_contact , $txt , 'contact_title' ,'Contact' )); ?></h2>
							<div class="h-section-tagline"><?php echo wp_kses_post(amaucp_get_datax( $data_contact , $txt , 'contact_tagline' ,'Contact Tagline' )); ?></div>
						</div>
					 </div>
				</div>
				<div class="col-md-2">
				</div>
			</div>
		</div>
		<!-- 3 -->
		
		
		<!-- 4 -->
		<div class="container col-md-12">
			<div class="row">
					
					<!-- animation -->
					<div class="col-md-6 ucp-side ucpbg-side-left">
						<div class="ucp-block">
							
							
						
						 </div>
					</div>
					<!-- animation ends -->
					
					<!-- subscribe -->
					<div class="col-md-6 ucp-side ucpbg-side-right">
						<div class="row">
						<div class="bg">
						<div class="col-md-6">
								 
								<div class="ucp-block">
									<!-- LIST CONTACT -->
									<?php
										$status = amaucp_get_datax( $data_contact , $txt , 'list_contact_status' , 0 );
										if ($status) {
									?>
											<h3 class="h3-contact"><?php echo wp_kses_post(amaucp_get_datax( $data_contact ,  $txt , 'list_contact_title' , 'Contact Information' )); ?></h3>
										
										<?php
											$txt2 = 'amaucp_feature_contacts_section';
											$list_contact = amaucp_get_datay( $data_contact , $txt2 ,0 );
											if ($list_contact) {
										?>
											<div class="div-contact">
												<ul>
													<?php 
														foreach ($list_contact as $value) {
													?>
													<li>
														<div class="tlabel"><i class="fa <?php echo esc_attr($value['contact_type']); ?>"></i></div>
														<div class="span"><span> <?php echo wp_kses_post($value['contact_text']); ?></span></div>
														<div class="clearfix"></div>
													</li>
													<?php
														}
													?>
												</ul>
												<div class="div-contact-divider"></div>
											</div>
									<?php
											}
										}
									?>
									<!-- LIST CONTACT -->
									
									<!-- SOCIAL MEDIA -->
									<?php if (amaucp_get_data('social_check','social_show',0)) { ?>
									<div class="div-social">
										<?php amaucp_socialmedia(); ?>
									</div>
									<?php } ?>
									<!-- SOCIAL MEDIA ENDS -->
									
								</div>
							
						</div>
						<div class="col-md-6">
								
								<div class="ucp-block">
									<h3 class="h3-contact"><?php echo wp_kses_post(amaucp_get_datax( $data_contact ,  $txt , 'contact_form_title' , 'Form Reply' )); ?></h3>
									<div>
										<form id="form-contact" action="" method="post">
											<div>
												<input class="name" name="name" placeholder="Input your name here..." required="" type="text">
											</div>
											<div>
												<input class="email" name="email" placeholder="Input your e-mail here..." required="" type="text">
											</div>
											<div>
												<textarea  name="message" placeholder="Input your message here..." required=""></textarea>
											</div>											
											<div>
												<button type="submit" class="submit" value="Let me Notified">Submit Now</button>
											</div>
										</form>
									</div>
								</div>
							
						</div>
						</div>
						</div>
					</div>
					
				
			</div>
		</div>
		<?php } ?>
		<!-- 4 -->
		
	</div>
	
	
	 <?php amaucp_footer(); ?>
	
</body>
</html>