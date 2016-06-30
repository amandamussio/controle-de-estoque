<?php 

	// Register Custom Post Type
	function pedidos() {

		$labels = array(
			'name'                  => _x( 'Pedidos', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Pedido', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Pedidos', 'text_domain' ),
			'name_admin_bar'        => __( 'Pedidos', 'text_domain' ),
			'archives'              => __( 'Todos os Pedidos', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'Todos os Pedidos', 'text_domain' ),
			'add_new_item'          => __( 'Add Novo Pedido', 'text_domain' ),
			'add_new'               => __( 'Add Novo', 'text_domain' ),
			'new_item'              => __( 'Novo Pedido', 'text_domain' ),
			'edit_item'             => __( 'Editar', 'text_domain' ),
			'update_item'           => __( 'Atualizar', 'text_domain' ),
			'view_item'             => __( 'Visualizar', 'text_domain' ),
			'search_items'          => __( 'Procurar', 'text_domain' ),
			'not_found'             => __( 'Não Encontrado', 'text_domain' ),
			'not_found_in_trash'    => __( 'Não Encontrado', 'text_domain' ),
			'featured_image'        => __( 'Imagem Destacada', 'text_domain' ),
			'set_featured_image'    => __( 'Mudar Imagem Destacada', 'text_domain' ),
			'remove_featured_image' => __( 'Remover Imagem Destacada', 'text_domain' ),
			'use_featured_image'    => __( 'Usar como Imagem Destacada', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
			'items_list'            => __( 'Items list', 'text_domain' ),
			'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		);
		$args = array(
			'label'                 => __( 'Pedido', 'text_domain' ),
			'description'           => __( 'Pedidos', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_icon'				=> 'dashicons-cart',
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'pedidos', $args );

	}
	add_action( 'init', 'pedidos', 0 );

	//Add campos personalizados no custom post type pedidos
	function add_meta_box_pedidos() {
		add_meta_box( 'info-pedido', 'Informações do Pedido', 'fields_pedido', 'pedidos', 'normal', 'default');
	}

	function fields_pedido($post) {
	    $idProduto = get_post_meta( $post->ID, 'meta_produto_id', true );
	    $idCliente = get_post_meta( $post->ID, 'meta_cliente_id', true );

	    wp_nonce_field( 'save_infos_pedido', 'pedidos_wpnonce' );

    	echo '<div>';
	    echo '<label for="produto_id">Produto:</label>';
	    echo '</div>';
	    echo '<div>';
	    echo '<td><select name="produto_id" id="produto_id">';
	    echo '</div>';

	    $args = array(
	    	'post_type' => 'produtos',
		    'showposts' => '-1',
	    );

		$the_query = new WP_Query( $args );

		while ($the_query->have_posts()) {
		    $the_query->the_post();
		    $postId = get_the_ID();
		    $postTitle = get_the_title();
		    $selected = ($postId == $idProduto) ? ' selected="selected"' : '';
		    echo '<option value="'.$postId.'"'.$selected.'>'.$postTitle.'</option>';
		}

		wp_reset_query();

	    echo '</select>';
	    echo '</div>';
    	echo '<div>';
	    echo '<label for="cliente_id"> Cliente: </label>';
	    echo '</div>';
	    echo '<div>';
	    echo '<select name="cliente_id" id="cliente_id">';
	    echo '</div>';

		$args = array(
	    	'post_type' => 'clientes',
		    'showposts' => '-1',
	    );

		$the_query = new WP_Query( $args );

		while ($the_query->have_posts()) {
		    $the_query->the_post();
		    $postId = get_the_ID();
		    $postTitle = get_the_title();
		    $selected = ($postId == $idCliente) ? ' selected="selected"' : '';
		    echo '<option value="'.$postId.'"'.$selected.'>'.$postTitle.'</option>';
		}

		wp_reset_query();

	    echo '</select>';
	    echo '</div>';	    
	}
	add_action('add_meta_boxes', 'add_meta_box_pedidos');

	function save_fields_pedidos($postId) {
	    if (!isset($_POST['pedidos_wpnonce']))
	        return $postId;
	 
	    if (!wp_verify_nonce($_POST['pedidos_wpnonce'], 'save_infos_pedido'))
	        return $postId;
	 
	    if ('pedidos' != $_POST['post_type'])
	        return $postId;
	 
	    if (!current_user_can('edit_post', $postId))
	        return $postId;
	 
	    $idProduto = sanitize_text_field($_POST['produto_id']);
	    $idCliente = sanitize_text_field($_POST['cliente_id']);

	    update_post_meta($postId, 'meta_produto_id', $idProduto);
	    update_post_meta($postId, 'meta_cliente_id', $idCliente);
	}
	add_action( 'save_post', 'save_fields_pedidos');