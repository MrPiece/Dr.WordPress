		<footer class="ftco-footer ftco-bg-dark ftco-section">
			<div class="container">
				<div class="row mb-5">
					<div class="col-md">
						<div class="ftco-footer-widget mb-5">
							<h2 class="ftco-heading-2 logo">Dr.<span>care</span></h2>
							<p><?= get_option('blogdescription') ?></p>
						</div>
						<div class="ftco-footer-widget mb-5">
							<h2 class="ftco-heading-2">Have a Questions?</h2>
							<div class="block-23 mb-3">
								<ul>
									<li><span class="icon icon-map-marker"></span><span class="text"><?= get_custom('clinic_address') ?></span></li>
									<li><a href="#"><span class="icon icon-phone"></span><span class="text"><?= get_custom('phone_number') ?></span></a></li>
									<li><a href="#"><span class="icon icon-envelope"></span><span class="text"><?= get_option('admin_email') ?></span></a></li>
								</ul>
							</div>

							<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
								<li class="ftco-animate"><a href="<?= get_custom('organization_twitter_link') ?>"><span class="icon-twitter"></span></a></li>
								<li class="ftco-animate"><a href="<?= get_custom('organization_facebook_link') ?>"><span class="icon-facebook"></span></a></li>
								<li class="ftco-animate"><a href="<?= get_custom('organization_instagram_link') ?>"><span class="icon-instagram"></span></a></li>
							</ul>
						</div>
					</div>
					<div class="col-md">
						<div class="ftco-footer-widget mb-5 ml-md-4">
							<h2 class="ftco-heading-2">Links</h2>
							<ul class="list-unstyled">
								<li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Home</a></li>
								<li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>About</a></li>
								<li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Services</a></li>
								<li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Deparments</a></li>
								<li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Contact</a></li>
							</ul>
						</div>
						<div class="ftco-footer-widget mb-5 ml-md-4">
							<h2 class="ftco-heading-2">Services</h2>
							<ul class="list-unstyled">
								<li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Neurolgy</a></li>
								<li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Dentist</a></li>
								<li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Ophthalmology</a></li>
								<li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Cardiology</a></li>
								<li><a href="#"><span class="ion-ios-arrow-round-forward mr-2"></span>Surgery</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md">
						<div class="ftco-footer-widget mb-5">
							<h2 class="ftco-heading-2">Recent Blog</h2>
							<?php
							$posts = get_posts([
								'numberposts' => 3,
								'category'    => 0,
								'orderby'     => 'date',
								'order'       => 'DESC',
								'post_type'   => 'post',
								'suppress_filters' => true,
							]);

							foreach ($posts as $post): setup_postdata($post) ?>
								<div class="block-21 mb-4 d-flex">
									<a class="blog-img mr-4" href="<?php the_permalink() ?>" style="background-image: url(<?= the_post_thumbnail_url() ?>);"></a>
									<div class="text">
										<h3 class="heading"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
										<div class="meta">
											<?php 
											$dateArray = explode( ' ', str_replace( ',', '', get_the_date() ) );
											$day = $dateArray[1];
											$month = substr($dateArray[0], 0, 3);
											$year = $dateArray[2];
											?>
											<div><a href="<?= get_month_link( $year, date( 'm', strtotime($month) ) ) ?>"><span class="icon-calendar"></span><?= " " . $month . " " . $day . ", " . $year ?></a></div>
											<div><a href="#"><span class="icon-person"></span><?php the_author() ?></a></div>
											<div><a href="#"><span class="icon-chat"></span><?= get_comments_number($post->ID) ?></a></div>
										</div>
									</div>
								</div>
							<?php endforeach; wp_reset_postdata() ?>
						</div>
					</div>
					<div class="col-md">
						<div class="ftco-footer-widget mb-5">
							<h2 class="ftco-heading-2">Opening Hours</h2>
							<h3 class="open-hours pl-4"><span class="ion-ios-time mr-3"></span><?= get_custom('working_hours') ?></h3>
						</div>
						<div class="ftco-footer-widget mb-5">
							<h2 class="ftco-heading-2">Subscribe Us!</h2>
							<form action="#" class="subscribe-form">
								<div class="form-group">
									<input type="text" class="form-control mb-2 text-center" placeholder="Enter email address">
									<input type="submit" value="Subscribe" class="form-control submit px-3">
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 text-center">

						<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
		Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
		<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
					</div>
				</div>
			</div>
		</footer>



		<!-- loader -->
		<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

		<?php wp_footer(); ?>
  </body>
</html>
