<?php
/*-------------------------------------------------------
		  ** Custom Post Type  Options
--------------------------------------------------------*/

CSF::createSection($prefix, array(
  'id'    => 'custom_post_type_settings',
  'title' => esc_html__('Custom Post Types', 'adking-core'),
  'icon'  => 'fa fa-file-alt'
));

require_once EGNS_CORE_INC . '/theme-options/settings/custom_post/product.php';
require_once EGNS_CORE_INC . '/theme-options/settings/custom_post/case-study.php';
