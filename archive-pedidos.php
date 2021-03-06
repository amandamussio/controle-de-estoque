<?php get_header(); ?>


	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header>

		<div class="table-responsive">
			<table class="table">
			<thead>
			  <tr>
		          <th>ID</th>
		          <th>Produto</th>
		          <th>Cliente</th>
			  </tr>
			</thead>

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'pedidos');

				endwhile;
			?>

			</table>	
		</div>
			
		<?php  
			// Page navigation.
			echo paginate_links();

		else :
			// Se não houver posts exibe, not posts found
			get_template_part( 'template-parts/content', 'none' );

		endif;
	?>


<?php
get_footer();
