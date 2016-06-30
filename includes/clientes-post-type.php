<?php 

	// Register Custom Post Type Clientes
	function clientes() {

		$labels = array(
			'name'                  => _x( 'Clientes', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Cliente', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Clientes', 'text_domain' ),
			'name_admin_bar'        => __( 'Clientes', 'text_domain' ),
			'archives'              => __( 'Arquivo de Clientes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'Todos os Clientes', 'text_domain' ),
			'add_new_item'          => __( 'Add Novo Cliente', 'text_domain' ),
			'add_new'               => __( 'Add Cliente', 'text_domain' ),
			'new_item'              => __( 'Novo Cliente', 'text_domain' ),
			'edit_item'             => __( 'Editar', 'text_domain' ),
			'update_item'           => __( 'Atualizar', 'text_domain' ),
			'view_item'             => __( 'Visualizar', 'text_domain' ),
			'search_items'          => __( 'Procurar', 'text_domain' ),
			'not_found'             => __( 'Não encontrado', 'text_domain' ),
			'not_found_in_trash'    => __( 'Não encontrado', 'text_domain' ),
			'featured_image'        => __( 'Imagem Destacada', 'text_domain' ),
			'set_featured_image'    => __( 'Mudar Imagem Destacada', 'text_domain' ),
			'remove_featured_image' => __( 'Remover Imagem Destacada', 'text_domain' ),
			'use_featured_image'    => __( 'Usar Imagem Destacada', 'text_domain' ),
			'insert_into_item'      => __( 'inserir em Cliente', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
			'items_list'            => __( 'Items list', 'text_domain' ),
			'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		);
		$args = array(
			'label'                 => __( 'Cliente', 'text_domain' ),
			'description'           => __( 'Cadastro Clientes', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'thumbnail'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_icon'				=> 'dashicons-id',
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'clientes', $args );

	}
	add_action( 'init', 'clientes', 0 );

	//Add campos personalizados no custom post type clientes
	function add_meta_box_clientes() {
		add_meta_box( 'info-cliente', 'Informações do Cliente', 'fields_cliente', 'clientes', 'normal', 'default');
	}
	
	//inputa HTML na tela do Post type
	function fields_cliente($post){
		$emailCliente 	 = get_post_meta($post->ID,'meta_email_cliente',true);
		$telefoneCliente = get_post_meta($post->ID,'meta_telefone_cliente',true);

		//função wp de segurança do form
		wp_nonce_field('save_infos_cliente', 'clientes_wpnonce');

		echo '<div>';
		echo '<label for="email_cliente"> Email: </label>';
		echo '</div>';
		echo '<div>';
		echo '<input type="email" name="email_cliente" id="email_cliente" value="'. esc_attr($emailCliente) .'">';
		echo '</div>';
		echo '<div>';
		echo '<label for="telefone_cliente"> Telefone: </label>';
		echo '</div>';
		echo '<div>';
		echo '<input type="text" name="telefone_cliente" id="telefone_cliente" value="'. esc_attr($telefoneCliente) .'">';
		echo '</div>';

	}
	add_action('add_meta_boxes', 'add_meta_box_clientes');

	function save_fields_clientes($postId) {
	    if (!isset($_POST['clientes_wpnonce']))
	        return $postId;
	 
	    if (!wp_verify_nonce($_POST['clientes_wpnonce'], 'save_infos_cliente'))
	        return $postId;
	 
	    if ('clientes' != $_POST['post_type'])
	        return $postId;
	 
	    if (!current_user_can('edit_post', $postId))
	        return $postId;
	 
	    $emailCliente    = sanitize_text_field($_POST['email_cliente']);
	    $telefoneCliente = sanitize_text_field($_POST['telefone_cliente']);

	    update_post_meta($postId, 'meta_email_cliente', $emailCliente);
	    update_post_meta($postId, 'meta_telefone_cliente', $telefoneCliente);
	}

	add_action( 'save_post', 'save_fields_clientes');
