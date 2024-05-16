<?php

class LMH_Vue_Store {

	protected $loader;
	protected $plugin_name;
	protected $version;

	public function __construct($plugin_name, $version) {
		if ( empty($version) ) {
			$this->version = '1.0.0';
		} else {
			$this->version = $version;
		}

		if( empty($plugin_name) ){ 
			$this->plugin_name = 'lmh-plugin-name';
		} else {
			$this->plugin_name = $plugin_name;
		}

		$this->load_dependencies();
		$this->set_locale();
		$this->set_post_type();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	private function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-plugin-loader.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-plugin-i18n.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-plugin-post-type.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-plugin-admin.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-plugin-public.php';

		$this->loader = new Plugin_Loader();

	}

	private function set_post_type() {
		$plugin_post_type = new Plugin_Post_Type();
		$this->loader->add_action("init", $plugin_post_type, "init_action" );
	}

	private function set_locale() {
		$plugin_i18n = new Plugin_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	private function define_admin_hooks() {
		$plugin_admin = new Plugin_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
	}

	private function define_public_hooks() {
		$plugin_public = new Plugin_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}
