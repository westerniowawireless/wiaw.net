<?php

/*
 * This class creates a custom textarea control to be used in the "advanced" settings of the theme.
 * This will allow users to add their custom css & sripts right from the customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
  class Shoestrap_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';
    
    public function render_content() { ?>
      <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
      </label>
    <?php }
  }
}

/*
 * This class creates a custom control. This control is called "label"
 * and is used to display additional help between between the other controls
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
  class Shoestrap_Customize_Label_Control extends WP_Customize_Control {
    public $type = 'label';
    
    public function render_content() { ?>
      <span class="customize-control-helptext"><?php echo esc_html( $this->label ); ?></span><hr style="background: #666; height: 1px" />
    <?php }
  }
}
