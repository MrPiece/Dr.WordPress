<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?= get_option('blogname') ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php wp_head() ?>
  </head>
  <body>
    <nav class="navbar py-4 navbar-expand-lg ftco_navbar navbar-light bg-light flex-row">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-3 px-md-0">
    			<div class="col-lg-2 pr-4 align-items-center">
						<?php preg_match('/^([^\.]+.)(.+)/', get_option('blogname'), $brand); ?>
		    		<a class="navbar-brand" href="<?= get_home_url() ?>"><?= $brand[1] ?><span><?= $brand[2] ?></span></a>
	    		</div>
	    		<div class="col-lg-10 d-none d-md-block">
		    		<div class="row d-flex">
			    		<div class="col-md-4 pr-4 d-flex topper align-items-center">
			    			<div class="icon bg-white mr-2 d-flex justify-content-center align-items-center"><span class="icon-map"></span></div>
						    <span class="text">Address: <?= get_custom('clinic_address') ?></span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon bg-white mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">Email: <?= get_option('admin_email') ?></span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon bg-white mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">Phone: <?= get_custom('phone_number') ?></span>
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
    </nav>
	  <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container d-flex align-items-center">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
	      <p class="button-custom order-lg-last mb-0"><a href="/appointment" class="btn btn-secondary py-2 px-3">Make An Appointment</a></p>
	      <div class="collapse navbar-collapse" id="ftco-nav">
					<?php 
					wp_nav_menu( [
						'menu_class'      => 'navbar-nav mr-auto', 
						'container'       => false,
						'theme_location'  => 'header_menu',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'echo'            => true,
					] );
					?>
	      </div>
	    </div>
	  </nav>
		<!-- END nav -->