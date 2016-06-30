<tbody>
	<tr>
		  <td>
		  	<?php 
		  		if(has_post_thumbnail()) :
		  			the_post_thumbnail('thumb-cliente', array('class' => 'img-circle')); 
		  		else: 	
		  	?>
		  		<img src="<?php bloginfo('template_url'); ?>/assets/images/anonimo.jpg" class="img-circle">
		  	<?php endif; ?>
		  </td>
		  <td><?php the_ID(); ?></td>
		  <td><?php the_title(); ?></td>
		  <td><?php echo get_post_meta(get_the_ID(), 'meta_email_cliente', true); ?></td>
		  <td><?php echo get_post_meta(get_the_ID(), 'meta_telefone_cliente', true); ?></td>
	</tr>
</tbody>
