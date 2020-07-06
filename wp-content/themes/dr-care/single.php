<?php get_header() ?>
<?php the_post() ?>

<section class="hero-wrap hero-wrap-2" style="background-image: url(<?= get_the_post_thumbnail_url() ?>);" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<h1 class="mb-2 bread"><?php the_title() ?></h1>
				<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="<?= get_home_url(). '/blog' ?>">Blog <i class="ion-ios-arrow-forward"></i></a></span> <span><?= get_post_type() . ' ' ?><i class="ion-ios-arrow-forward"></i></span></p>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 ftco-animate">
				<h2 class="mb-3"><?php the_title() ?></h2>
				
				<?php the_content() ?>
				<?php 
				the_tags(
					'<div class="tag-widget post-tag-container mb-5 mt-5"><div class="tagcloud">', 
					' ',
					'</div></div>'
				) 
				?>

				<div class="about-author d-flex p-4 bg-light">
					<div class="bio mr-5">
						<?php $user_nickname = get_the_author_meta('nickname') ?>
						<img src="<?= esc_url(UPLOADS . "{$user_nickname}.jpg") ?>" alt="Image placeholder" class="img-fluid mb-4" width="200" height="200">
					</div>
					<div class="desc">
						<h3><?php the_author() ?></h3>
						<p><?php the_author_meta('user_description') ?></p>
					</div>
				</div>


				<div class="pt-5 mt-5">
					<?php comments_template() ?>
				</div>
			</div> <!-- .col-md-8 -->

			<div class="col-lg-4 sidebar ftco-animate">
				<?php get_sidebar() ?>
			</div><!-- END COL -->
		</div>
	</div>
</section>

<?php get_footer() ?>