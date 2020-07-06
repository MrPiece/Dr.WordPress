<?php get_header() ?>
    
    <section class="home-slider owl-carousel">
			<?php 
			$posts = get_posts( array(
				'numberposts' => -1,
				'orderby'     => 'date',
				'order'       => 'DESC',
				'post_type'   => 'carousel-slide',
				'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
			) );

			remove_filter( 'the_excerpt', 'wpautop' );

			
			foreach( $posts as $post ): setup_postdata($post);
				if ( wp_get_post_terms($post->ID, 'carousel')[0]->slug == 'front-page-carousel' ): ?>
					<div class="slider-item" style="background-image:url('<?php the_post_thumbnail_url('carousel-slide') ?>');">
						<div class="overlay"></div>
						<div class="container">
							<div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
							<div class="col-md-6 text ftco-animate">
								<?php preg_match('/^(([^\s]+\s){2})(.+)/', get_the_title($post), $title); ?>
								<h1 class="mb-4"><?= $title[1] ?><span><?= $title[3] ?></span></h1>
								<h3 class="subheading"><?php the_excerpt() ?></h3>
								<p><a href="#" class="btn btn-secondary px-4 py-3 mt-3">View our works</a></p>
							</div>
						</div>
						</div>
					</div>
			<?php endif;
			endforeach;
			wp_reset_postdata(); // сброс
			add_filter( 'the_excerpt', 'wpautop' );
			?>
    </section>

    <section class="ftco-services ftco-no-pb">
			<div class="container">
				<div class="row no-gutters">
          <div class="col-md-3 d-flex services align-self-stretch p-4 ftco-animate">
            <div class="media block-6 d-block text-center">
              <div class="icon d-flex justify-content-center align-items-center">
            		<span class="flaticon-doctor"></span>
              </div>
              <div class="media-body p-2 mt-3">
                <h3 class="heading">Qualitfied Doctors</h3>
                <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex services align-self-stretch p-4 ftco-animate">
            <div class="media block-6 d-block text-center">
              <div class="icon d-flex justify-content-center align-items-center">
            		<span class="flaticon-ambulance"></span>
              </div>
              <div class="media-body p-2 mt-3">
                <h3 class="heading">Emergency Care</h3>
                <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
              </div>
            </div>    
          </div>
          <div class="col-md-3 d-flex services align-self-stretch p-4 ftco-animate">
            <div class="media block-6 d-block text-center">
              <div class="icon d-flex justify-content-center align-items-center">
            		<span class="flaticon-stethoscope"></span>
              </div>
              <div class="media-body p-2 mt-3">
                <h3 class="heading">Outdoor Checkup</h3>
                <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex services align-self-stretch p-4 ftco-animate">
            <div class="media block-6 d-block text-center">
              <div class="icon d-flex justify-content-center align-items-center">
            		<span class="flaticon-24-hours"></span>
              </div>
              <div class="media-body p-2 mt-3">
                <h3 class="heading">24 Hours Service</h3>
                <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
              </div>
            </div>      
          </div>
        </div>
			</div>
		</section>
		
		<?php get_template_part('template-parts/about-start') ?>

    <?php get_template_part('template-parts/department'); ?>
		
		<section class="ftco-section ftco-no-pt">
			<div class="container">
				<div class="row justify-content-center mb-5 pb-2">
          <div class="col-md-8 text-center heading-section ftco-animate">
          	<span class="subheading">Doctors</span>
            <h2 class="mb-4">Our Qualified Doctors</h2>
            <p>Separated they live in. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country</p>
          </div>
        </div>	

				<?php get_template_part('template-parts/doctors') ?>
			</div>
		</section>

    <?php get_template_part('template-parts/about-end') ?>

    <?php get_template_part('template-parts/pricing') ?>

		<section class="ftco-section bg-light">
			<div class="container">
				<div class="row justify-content-center mb-5 pb-2">
          <div class="col-md-8 text-center heading-section ftco-animate">
          	<span class="subheading">Blog</span>
            <h2 class="mb-4">Recent Blog</h2>
            <p>Separated they live in. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country</p>
          </div>
        </div>
				<div class="row">
				<?php 
				$posts = get_posts([
					'numberposts' => 3,
					'category'    => 0,
					'orderby'     => 'date',
					'order'       => 'DESC',
					'post_type'   => 'post',
					'suppress_filters' => true,
				]);

				foreach ($posts as $post): setup_postdata($post);
				?>
          <div class="col-md-4 ftco-animate">
            <div class="blog-entry">
              <a href="<?php the_permalink() ?>" class="block-20" style="background-image: url(<?= the_post_thumbnail_url() ?>);">
								<div class="meta-date text-center p-2">
									<?php 
									$dateArray = explode( ' ', str_replace( ',', '', get_the_date() ) );
									$day = $dateArray[1];
									$month = $dateArray[0];
									$year = $dateArray[2];
									?>
                  <span class="day"><?= $day ?></span>
                  <span class="mos"><?= $month ?></span>
                  <span class="yr"><?= $year ?></span>
                </div>
              </a>
              <div class="text bg-white p-4">
                <h3 class="heading"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                <p><?php the_excerpt() ?></p>
                <div class="d-flex align-items-center mt-4">
	                <p class="mb-0"><a href="<?php the_permalink() ?>" class="btn btn-primary">Read More <span class="ion-ios-arrow-round-forward"></span></a></p>
	                <p class="ml-auto mb-0">
										<a href="#" class="mr-2"><?php the_author(); ?></a>
	                	<a href="#" class="meta-chat"><span class="icon-chat"></span><?= get_comments_number($post->ID) ?></a>
	                </p>
                </div>
              </div>
            </div>
					</div>
				<?php 
				endforeach; 
				wp_reset_postdata();
				?>
        </div>
			</div>
    </section>
    
<?php get_footer() ?>