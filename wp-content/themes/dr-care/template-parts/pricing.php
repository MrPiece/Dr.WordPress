<section class="ftco-section bg-light">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-2">
      <div class="col-md-8 text-center heading-section ftco-animate">
        <span class="subheading">Pricing</span>
        <h2 class="mb-4">Our Pricing</h2>
        <p>Separated they live in. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country</p>
      </div>
    </div>
    <div class="row">
      <?php 
      $posts = get_posts([
        'numberposts' => 4,
        'category'    => null,
        'post_type'   => 'subscription',
        'suppress_filters' => true,
      ]);

      $sortedPosts = [];
      foreach ($posts as $post) {
        setup_postdata($post);

        $sortedPosts[get_field('price')] = $post;

        wp_reset_postdata();
      }
      ksort($sortedPosts);

      foreach ($sortedPosts as $post): setup_postdata($post);
      ?>
      <div class="col-md-3 ftco-animate">
        <div class="pricing-entry pb-5 text-center">
          <div>
            <h3 class="mb-4"><?php the_title() ?></h3>
            <?php $s = get_field('sessions_count') > 1 ? 's' : '' ?>
            <p><span class="price">$<?php the_field('price') ?></span> <span class="per"> for <?php the_field('sessions_count') ?> session<?= $s ?></span></p>
          </div>
          <ul>
            <?php 
            $services = get_the_terms($post->ID, 'subscription-service');
            foreach ($services as $service): ?>
              <li title="<?= $service->description ?>"><?= $service->name ?></li>
            <?php endforeach ?>

            <?php for ($i = count($services); $i < 5; $i++): ?>
              <li><br></li>
            <?php endfor ?>
          </ul>
          <p class="button text-center"><a href="#" class="btn btn-primary px-4 py-3">Get Offer</a></p>
        </div>
      </div>
      <?php endforeach;
      wp_reset_postdata() ?>
    </div>
  </div>
</section>