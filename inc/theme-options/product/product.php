<?php
if (class_exists('CSF')) {

  /*-----------------------------------
	    PAGE METABOX SECTION
	------------------------------------*/
  CSF::createMetabox("EGNS_PRODUCT_META_ID", array(
    'id'              => 'product_meta_option',
    'title'           => esc_html__('Product Video', 'adking-core'),
    'post_type'       => 'product',
    'context'         => 'normal',
    'priority'        => 'high',
    'show_restore'    => true,
    'enqueue_webfont' => true,
    'async_webfont'   => false,
    'output_css'      => false,
    'nav'             => 'normal',
    'theme'           => 'dark',
  ));


  /*-----------------------------------
		REQUIRE META FILES
	------------------------------------*/

  CSF::createSection("EGNS_PRODUCT_META_ID", array(
    'parent' => 'product_meta_option',
    'title'  => esc_html__('General', 'adking-core'),
    'fields' => array(
      array(
        'id'      => 'product_video',
        'type'    => 'upload',
        'title'   => 'Upload Video',
        'library' => 'video',

      ),

    )
  ));
}
