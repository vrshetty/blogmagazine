<?php
/**
 * Custom Control for Icons Controls
 * @package dineshghimire
 * @subpackage Dglib
 * @since 1.0.0
 *
 */
if ( !class_exists( 'Dglib_Customize_Icons_Control' )):

	class Dglib_Customize_Icons_Control extends WP_Customize_Control {

		public $type = 'icons';
		
		public function enqueue(){

			wp_enqueue_style( 'font-awesome', dglib_directory_uri('assets/library/font-awesome/css/font-awesome.min.css'), array(), '4.7.0' );
			wp_enqueue_style( 'dg-customizer-icons-control-css',  dglib_directory_uri('assets/parts/controls/css/dg-customizer-icons-control.min.css'), array(), '1.0.0' );
			wp_enqueue_script('dg-customizer-icons-control-js', dglib_directory_uri('assets/parts/controls/js/dg-customizer-icons-control.min.js'), array('jquery'), '1.0.0', false );

		}

		public function render_content() {
			$value = $this->value();
			?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <span class="dg-customize-icons">
                    <span class="dg-icon-preview">
                        <?php if( !empty( $value ) ) { echo '<i class="fa '. esc_attr( $value ) .'"></i>'; } ?>
                    </span>
                    <span class="dg-icon-toggle">
                        <?php echo ( empty( $value ) ? esc_html__('Add Icon','blogmagazine'): esc_html__('Change Icon','blogmagazine') ); ?>
                        <span class="dashicons dashicons-arrow-down"></span>
                    </span>
                    <span class="dg-icons-list-wrapper hidden">
                        <input class="icon-search" type="text" placeholder="<?php esc_attr_e('Search Icon','blogmagazine'); ?>">
	                    <?php
	                    $fa_icon_list_array = dglib_fa_iconslist();
	                    foreach ( $fa_icon_list_array as $single_icon ) {
		                    if( $value == $single_icon ) {
			                    echo '<span class="dg-single-icon selected"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
		                    }else{
			                    echo '<span class="dg-single-icon"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
		                    }
	                    }
	                    ?>
                    </span>
                    <input type="hidden" class="dg-icon-value" value="" <?php $this->link(); ?>>
                </span>
            </label>
			<?php
		}

	}

endif;