<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dr.care
 */

// if ( ! is_active_sidebar( 'sidebar-1' ) ) {
// 	return;
// }
?>

<aside id="secondary" class="widget-area">
	<div class="sidebar-box">
		<?php get_search_form() ?>
	</div>

	<?php 
	$categories = get_terms(['taxonomy' => 'category']);
	if (! empty($categories) ): ?>
		<div class="sidebar-box ftco-animate">
			<h3>Categories</h3>

			<ul class="categories">
				<?php foreach($categories as $category): if ($category->slug != 'uncategorized'):  ?>
					<li><a href="<?= get_category_link($category) ?>"><?= $category->name ?> <span>(<?= $category->count ?>)</span></a></li>
				<?php endif; endforeach ?>
			</ul>
		</div>
	<?php endif ?>

	<div class="sidebar-box ftco-animate">
		<h3>Popular Articles</h3>
		<?php 
		$args = [
			'numberposts' => 3,
			'orderby' => 'comment_count',
			'post_type'   => 'post',
			'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
		];
		$posts = get_posts($args);

		foreach ($posts as $post): setup_postdata($post) ?>
			<div class="block-21 mb-4 d-flex">
				<a class="blog-img mr-4" href="<?php the_permalink() ?>" style="background-image: url(<?= get_the_post_thumbnail_url() ?>);"></a>
				<div class="text">
					<h3 class="heading"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
					<div class="meta">
						<div><a href="<?= get_month_link( get_the_date('Y'), get_the_date('m') ) ?>"><span class="icon-calendar"></span><?= ' ' . get_the_date() ?></a></div>
						<div><span class="icon-person"></span><?php the_author() ?></div>
						<div><a href="<?php comments_link() ?>"><span class="icon-chat"></span><?= ' ' . get_comments_number($post->ID) ?></a></div>
					</div>
				</div>
			</div>
		<?php endforeach; wp_reset_postdata(); ?>
	</div>

	<div class="sidebar-box ftco-animate">
		<h3>Tag Cloud</h3>
		<ul class="tagcloud m-0 p-0">
			<?php $tags = get_tags();
			foreach ($tags as $tag): ?>
				<a href="/tag/<?= $tag->slug ?>" class="tag-cloud-link"><?= $tag->name ?></a>
			<?php endforeach ?>
		</ul>
	</div>

	<div class="sidebar-box ftco-animate">
		<h3>Archives</h3>
		<?php 
		$args = array(
			'type'            => 'monthly',
			'limit'						=> 4,
			'format'          => 'html', 
			'show_post_count' => true,
			'echo'            => 1,
			'post_type'       => 'post',
		);
		?>
		<ul class="categories">
			<?php $archives = wp_get_archives( $args ); ?>
		</ul>
	</div>
</aside>
