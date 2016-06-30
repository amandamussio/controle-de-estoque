<?php 

	// Register Custom Post Type
	function produtos() {

		$labels = array(
			'name'                  => _x( 'Produtos', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Produto', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Produtos', 'text_domain' ),
			'name_admin_bar'        => __( 'Produtos', 'text_domain' ),
			'archives'              => __( 'Todos os Produtos', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'Todos os Produtos', 'text_domain' ),
			'add_new_item'          => __( 'Add Novo Produto', 'text_domain' ),
			'add_new'               => __( 'Add Novo', 'text_domain' ),
			'new_item'              => __( 'Novo Produto', 'text_domain' ),
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
			'label'                 => __( 'Produto', 'text_domain' ),
			'description'           => __( 'Produtos', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_icon'				=> 'dashicons-image-filter',
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'produtos', $args );

	}
	add_action( 'init', 'produtos', 0 ); 

	//Add campos personalizados no custom post type produtos
	function add_meta_box_produtos() {
		add_meta_box( 'info-produtos', 'Informações do Produto', 'fields_produto', 'produtos', 'normal', 'default');
	}

	function fields_produto($post) {
	    $precoProduto 	  = get_post_meta( $post->ID, 'meta_preco_produto', true);
	    $descricaoProduto = get_post_meta( $post->ID, 'meta_descricao_produto', true);

	    wp_nonce_field( 'save_infos_produto', 'produtos_wpnonce' );

	    echo '<div>';
		echo '<label for="email_cliente"> Preço: </label>';
		echo '</div>';
		echo '<div>';
		echo '<input type="text" name="preco_produto" id="preco_produto" value="'. esc_attr($precoProduto) .'">';
		echo '</div>';
		echo '<div>';
		echo '<label for="descricao_produto"> Descrição: </label>';
		echo '</div>';
		echo '<div>';
		echo '<textarea cols="100" rows="6" name="descricao_produto" id="descricao_produto" maxlength="150">'. esc_attr($descricaoProduto) .'</textarea>';
		echo '</div>';    
	}
	add_action('add_meta_boxes', 'add_meta_box_produtos');

	function save_fields_produtos($postId) {
	    if (!isset($_POST['produtos_wpnonce']))
	        return $postId;
	 
	    if (!wp_verify_nonce($_POST['produtos_wpnonce'], 'save_infos_produto'))
	        return $postId;
	 
	    if ('produtos' != $_POST['post_type'])
	        return $postId;
	 
	    if (!current_user_can('edit_post', $postId))
	        return $postId;
	 
	    $precoProduto     = sanitize_text_field($_POST['preco_produto']);
	    $descricaoProduto = sanitize_text_field($_POST['descricao_produto']);

	    update_post_meta($postId, 'meta_preco_produto', $precoProduto);
	    update_post_meta($postId, 'meta_descricao_produto', $descricaoProduto);
	}
	add_action( 'save_post', 'save_fields_produtos');