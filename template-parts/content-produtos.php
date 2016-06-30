<tbody>
    <tr>
      <td><?php the_ID(); ?></td>
      <td><?php the_title(); ?></td>
      <td><?php echo get_post_meta(get_the_ID(), 'meta_descricao_produto', true); ?></td>
      <td><?php echo get_post_meta(get_the_ID(), 'meta_preco_produto', true); ?></td>
    </tr>
</tbody>
