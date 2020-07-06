<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dr.care
 */

get_header();
?>

<main id="primary" class="site-main">
<?php if ( have_posts() ): ?>
<!-- header -->
  <section class="hero-wrap hero-wrap-2 page-header" style="background-image: url(<?php $rand = mt_rand(1, 3); echo UPLOADS . "bg_{$rand}.jpg" ?>);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <h1 class="mb-2 bread page-title"><?= get_the_archive_title() ?></h1>
          <p class="breadcrumbs">
            <?php  ?>
            <span class="mr-2"><a href="<?= get_home_url() ?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Blog <i class="ion-ios-arrow-forward"></i></span>
          </p>
        </div>
      </div>
    </div>
  </section>
  
  <section class="ftco-section bg-light">
    <div class="container">
      <div class="row">
        <?php while( have_posts() ): the_post() ?>
        <div class="col-md-4 ftco-animate">
          <div class="blog-entry">
            <a href="<?php the_permalink() ?>" class="block-20" style="background-image: url(<?= get_the_post_thumbnail_url() ?>);">
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
                  <a class="mr-2"><?php the_author() ?></a>
                  <a href="<?php comments_link() ?>" class="meta-chat"><span class="icon-chat"></span><?= get_comments_number( get_the_ID() ) ?></a>
                </p>
              </div>
            </div>
          </div>
        </div>
        <?php endwhile ?>
      </div>
      
      <?php 
      $pagination = get_the_posts_pagination();
      $pagination = str_replace( '</a>', '</a></li>', str_replace('<a', '<li><a', $pagination) );
      $pagination = str_replace( '</span>', '</span></li>', str_replace('<span', '<li><span', $pagination) );
      $pagination = str_replace('Next', '<i class="ion-ios-arrow-forward"></i>', $pagination);
      $pagination = str_replace('Previous', '<i class="ion-ios-arrow-back"></i>', $pagination);

      echo $pagination;
      ?>
    </div>
  </section>
<?php 
else:
  get_template_part( 'template-parts/content', 'none' );
endif;
?>

</main><!-- #main -->

<?php
get_footer();