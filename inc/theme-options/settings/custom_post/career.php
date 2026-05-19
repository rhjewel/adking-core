<?php
/*-------------------------------------------------------
		  ** Project Page  Options
--------------------------------------------------------*/

CSF::createSection($prefix, array(
  'parent' => 'custom_post_type_settings',
  'id'     => 'product_archive_settings',
  'title'  => esc_html__('Product Options', 'adking-core'),
  'icon'   => 'fa fa-briefcase',
  'fields' => array(
    // A Subheading
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Product Details Quote', 'adking-core'),
    ),
    array(
      'id'         => 'product_quote_title',
      'type'       => 'text',
      'title'      => esc_html__('Quote Heading', 'adking-core'),
    ),
    array(
      'id'       => 'product_qoute_whatapp',
      'type'     => 'link',
      'title'    => esc_html__('WhatsApp Label & link', 'adking-core'),
      'default'  => array(
        'url'    => '#',
        'text'   => 'WhatsApp',
        'target' => '_blank'
      ),
    ),
    array(
      'id'       => 'product_qoute_inquiry',
      'type'     => 'link',
      'title'    => esc_html__('Inquiry Label & link', 'adking-core'),
      'default'  => array(
        'url'    => '#',
        'text'   => 'Direct Inquiry',
        'target' => '_blank'
      ),
    ),


    array(
      'id'         => 'breadcrumb_cpt_creer_heading',
      'type'       => 'text',
      'title'      => esc_html__('Breadcrumb Heading', 'adking-core'),
    ),
    array(
      'id'      => 'career_posts_per_page',
      'type'    => 'number',
      'title'   => esc_html__('Posts per page', 'adking-core'),
      'default' => 9,
    ),

  ),



));
