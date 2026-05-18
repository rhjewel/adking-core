<?php
if (class_exists('CSF')) {

  /*-----------------------------------
	    PAGE METABOX SECTION
	------------------------------------*/
  CSF::createMetabox("EGNS_PEOPLE_META_ID", array(
    'id'              => 'people_meta_option',
    'title'           => esc_html__('People Informations', 'adking-core'),
    'post_type'       => 'people',
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

  CSF::createSection("EGNS_PEOPLE_META_ID", array(
    'parent' => 'people_meta_option',
    'title'  => esc_html__('General', 'adking-core'),
    'fields' => array(
      array(
        'id'    => 'secondary_thumbnail',
        'type'  => 'media',
        'class' => 'egns_mda',
        'title' => __('Secondary Featured Image', 'adking-core'),
        'desc'  => __('This image only show in details page banner.', 'adking-core'),
      ),
      array(
        'id'      => 'people_designation',
        'type'    => 'text',
        'title'   => __('Designation', 'adking-core'),
        'default' => 'CEO & Chief Consultant',
      ),
      array(
        'id'     => 'people_info_list',
        'type'   => 'repeater',
        'title'  => __('Social List', 'adking-core'),
        'fields' => array(
          array(
            'id'      => 'social_icon',
            'type'    => 'icon',
            'title'   => __('Icon', 'adking-core'),
            'default' => 'fa fa-heart',
          ),
          array(
            'id'      => 'social_icon_link',
            'type'    => 'text',
            'title'   => __('Link', 'adking-core'),
            'default' => '#',
          ),
        ),
        'default'   => array(
          array(
            'social_icon'      => 'fa-brands fa-linkedin-in',
            'social_icon_link' => 'https://www.linkedin.com/',
          ),

        )
      ),
    )
  ));
}
