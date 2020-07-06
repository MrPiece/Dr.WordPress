<?php get_header() ?>

<section class="hero-wrap hero-wrap-2" style="background-image: url(<?= the_post_thumbnail_url() ?>);" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <h1 class="mb-2 bread">Contact Us</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact <i class="ion-ios-arrow-forward"></i></span></p>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-no-pt ftco-no-pb contact-section">
  <div class="container">
    <div class="row d-flex align-items-stretch no-gutters">
      <div class="col-md-6 p-4 p-md-5 order-md-last bg-light">
        <?= do_shortcode('[contact-form-7 id="126" title="Contact Page form"]'); ?>
      </div>
      <div class="col-md-6 d-flex align-items-stretch">
        <div id="map"></div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section contact-section">
  <div class="container">
    <div class="row d-flex mb-5 contact-info">
      <div class="col-md-12 mb-4">
        <h2 class="h4">Contact Information</h2>
      </div>
      <div class="w-100"></div>
      <div class="col-md-3 d-flex">
        <div class="bg-light d-flex align-self-stretch box p-4">
          <p><span>Address: </span> <?= get_custom('clinic_address') ?></p>
        </div>
      </div>
      <div class="col-md-3 d-flex">
        <div class="bg-light d-flex align-self-stretch box p-4">
          <p><span>Phone: </span><?= get_custom('phone_number') ?></p>
        </div>
      </div>
      <div class="col-md-3 d-flex">
        <div class="bg-light d-flex align-self-stretch box p-4">
          <p><span>Email: </span><?= get_option('admin_email') ?></p>
        </div>
      </div>
      <div class="col-md-3 d-flex">
        <div class="bg-light d-flex align-self-stretch box p-4">
          <p><span>Website:</span> <a href="<?= get_option('siteurl') ?>"><?= get_option('siteurl') ?></a></p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer() ?>