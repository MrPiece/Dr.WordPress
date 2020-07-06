<?php get_header() ?>

<section class="hero-wrap hero-wrap-2" style="background-image: url(<?= the_post_thumbnail_url() ?>);" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <h1 class="mb-2 bread">Qualified Doctors</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Doctor <i class="ion-ios-arrow-forward"></i></span></p>
      </div>
    </div>
  </div>
</section>


<section class="ftco-section">
  <div class="container">
    <?php get_template_part('template-parts/doctors') ?>
  </div>
</section>

<?php get_footer() ?>