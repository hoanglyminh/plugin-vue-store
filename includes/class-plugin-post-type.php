<?php
class Plugin_Post_Type {
    
    public function init_action() {
        $this->register_post_type();
        $this->register_taxonomy();
    }

    private function register_post_type() {
        register_post_type(
            'products',
            array(
                'labels'          => array(
                    'name'          => __( 'Products' ),
                    'singular_name' => __( 'Product' )
                ),
                'public' => true,
                'has_archive' => true,
                'show_ui' => true,
                'supports' => array(
                    'title',
                    'editor',
                    'excerpt',
                    'custom-fields',
                    'thumbnail'
                ),
            )
        );
    }

    private function register_taxonomy() {
        register_taxonomy(
            'groups',
            'products',
            array(
                'hierarchical' => true,
                'label' => 'Groups',
                'query_var' => true,
                'rewrite' => true,
                'slug' => 'groups'
            )
        );
    }
}