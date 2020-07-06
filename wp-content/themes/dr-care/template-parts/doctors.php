<div class="row">
<?php 
$users = get_users(['role' => 'doctor']);
foreach($users as $user):
  $user_nickname = get_the_author_meta('nickname', $user->ID);
  $user_description = get_the_author_meta('user_description', $user->ID);
?>
  <div class="col-md-6 col-lg-3 ftco-animate">
    <div class="staff">
      <div class="img-wrap d-flex align-items-stretch">
        <div class="img align-self-stretch" style="background-image: url('<?= esc_url(UPLOADS . "{$user_nickname}.jpg") ?>');"></div>
      </div>
      <div class="text pt-3 text-center">
        <h3><?= $user->display_name ?></h3>
        <span class="position mb-2">Neurologist</span>
        <div class="faded">
          <p><?= $user_description ?></p>
          <ul class="ftco-social text-center">
            <li class="ftco-animate"><a href="<?php the_field('twitter_link', "user_{$user->ID}") ?>"><span class="icon-twitter"></span></a></li>
            <li class="ftco-animate"><a href="<?php the_field('facebook_link', "user_{$user->ID}") ?>"><span class="icon-facebook"></span></a></li>
            <li class="ftco-animate"><a href="<?php the_field('google_plus_link', "user_{$user->ID}") ?>"><span class="icon-google-plus"></span></a></li>
            <li class="ftco-animate"><a href="<?php the_field('instagram_link', "user_{$user->ID}") ?>"><span class="icon-instagram"></span></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>
</div>