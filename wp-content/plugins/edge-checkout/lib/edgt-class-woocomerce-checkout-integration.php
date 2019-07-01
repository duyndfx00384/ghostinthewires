<?php
if(!defined('ABSPATH')) exit;

/**
 * Class EdgeWoocommerceCheckoutIntegration
 */
class EdgeWoocommerceCheckoutIntegration {
    /**
     * @var instance of current class
     */
    private static $instance;
    private $post_types;


    /**
     * Private constructor because of singletone pattern. It sets all necessary properties
     */
    public function __construct() {

		add_filter( 'woocommerce_product_class', array( $this, 'product_class' ), 10, 4 );
		add_filter( 'woocommerce_cart_item_class', array( $this, 'checkout_item_classes' ), 10, 4 );
        add_filter( 'woocommerce_data_stores', array($this, 'data_store_integration'), 10, 1 );
        add_filter( 'woocommerce_product_type_query', array($this, 'data_store_post_type_override'), 10, 2 );
        add_filter( 'woocommerce_order_type_to_group', array($this, 'data_store_post_type_to_order_type_group'), 10, 1 );
        add_filter( 'woocommerce_cart_item_permalink', array($this, 'add_link_on_title_for_custom_product_in_cart'), 10, 3 );
    }
    /**
     * Must override magic method because of singletone
     */
    private function __clone() {}

    /**
     * Must override magic method because of singletone
     */
    private function __wakeup() {}

    /**
     * @return EdgeWoocommerceCheckoutIntegration
     */
    public static function getInstance() {
        if(self::$instance === null) {
            return new self();
        }

        return self::$instance;
    }

    /* Get required elements from post types */

    public function supported_post_types( ) {

        return apply_filters('edgt_woocommerce_checkout_integration_post_types', array());
    }

    /* Functions for filters */

	public function product_class( $classname, $product_type, $post_type, $product_id ) {
		$post_types = $this->supported_post_types();

		if ( in_array($post_type, $post_types) ) {
			$classname = 'WC_Product_'. ucfirst(str_replace('-','_',$post_type));
		}

		return $classname;
	}

    public function data_store_integration($data_stores) {
        $custom_data_stores = array();
        $post_types  = $this->supported_post_types();
        foreach ($post_types as $post_type) {
            $custom_data_stores[$post_type] = 'WC_' . ucfirst(str_replace('-','_',$post_type)) . '_Data_Store_CPT';
        }
        return array_merge($data_stores, $custom_data_stores);
    }

    public function checkout_item_classes( $classes, $cart_item, $cart_item_key  ) {

        $classes .= ' edgt-product-type-' . get_post_type($cart_item['product_id']);

        return $classes;
    }

    public function data_store_post_type_override($classname, $product_id) {
        $supported_types = $this->supported_post_types();
        foreach($supported_types as $supported_type) {
            if($supported_type == get_post_type($product_id)) {
                return $supported_type;
            }
        }
        return false;
    }

    public function data_store_post_type_to_order_type_group ($order_groups) {
        $supported_types = $this->supported_post_types();
        foreach($supported_types as $supported_type) {
            $type = str_replace('-','_', $supported_type);
            $order_groups[$type] =  $type . '_lines';
        }
        return $order_groups;
    }

    function add_link_on_title_for_custom_product_in_cart( $product_get_permalink_cart_item, $cart_item, $cart_item_key) {
        $supported_types = $this->supported_post_types();
        foreach($supported_types as $supported_type) {
            if (get_post_type($cart_item['product_id']) == $supported_type) {
                return get_the_permalink($cart_item['product_id']);
            }
        }
        return $product_get_permalink_cart_item;
    }
}

add_action( 'plugins_loaded', array( 'EdgeWoocommerceCheckoutIntegration', 'getInstance' ) );