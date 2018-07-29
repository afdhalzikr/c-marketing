<?php
/**
 * The template for displaying search form
 *
 * @package Theme Palace
 * @subpackage Flat Commerce
 * @since Flat Commerce 0.1
 */
?>

<?php $options 	= flat_commerce_get_theme_options(); // Get options ?>
<span class="search-icon"><i class="genericon genericon-search"></i></span>
<form role="search"  method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input id="search" type="search" class="search-field" placeholder="<?php echo esc_attr( $options[ 'search_text' ] ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'flat-commerce' ); ?>">
		<button type="submit"><span class="search-icon"><i class="genericon genericon-search"></i></span></button>
</form>
