<?php
/*-------------------------------------------------------
		  ** Portfolio Page  Options
--------------------------------------------------------*/

CSF::createSection($prefix, array(
  'parent' => 'custom_post_type_settings',
  'id'     => 'case_study_archive_settings',
  'title'  => esc_html__('Case Study Options', 'adking-core'),
  'icon'   => 'fa fa-folder-open',
  'fields' => array(
    // A Subheading
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Case Study archive', 'adking-core'),
    ),
    array(
      'id'      => 'top_filter_casestudy_archive',
      'type'    => 'switcher',
      'title'   => esc_html__('Top Filter With Title', 'adking-core'),
      'label'   => 'Do you want activate it ?',
      'default' => true
    ),
    array(
      'id'         => 'top_filter_casestudy_archive_title',
      'type'       => 'text',
      'title'      => esc_html__('Top Filter Title', 'adking-core'),
      'default'    => 'Aligning financial processes with growth strategy helps organizations scale efficiently while maintaining control and compliance.',
      'dependency' => array('top_filter_casestudy_archive', '==', 'true'),

    ),
    array(
      'id'    => 'breadcrumb_cpt_case_heading',
      'type'  => 'text',
      'title' => esc_html__('Breadcrumb Heading', 'adking-core'),
    ),
    array(
      'id'      => 'case_study_posts_per_page',
      'type'    => 'number',
      'title'   => esc_html__('People Archive Post Limit', 'adking-core'),
      'default' => 9,
    ),

  ),

));
