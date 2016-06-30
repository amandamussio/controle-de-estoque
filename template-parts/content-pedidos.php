<tbody>
    <tr>
      <td><?php the_ID(); ?></td>
      <td><?php echo get_the_title(get_post_meta(get_the_ID(), 'meta_produto_id', true)); ?></td>
      <td><?php echo get_the_title(get_post_meta(get_the_ID(), 'meta_cliente_id', true)); ?></td>
    </tr>
</tbody>
