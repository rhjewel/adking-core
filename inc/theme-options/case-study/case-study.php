<?php
if (class_exists('CSF')) {

  /*-----------------------------------
	    PAGE METABOX SECTION
	------------------------------------*/
  CSF::createMetabox("EGNS_CASESTUDY_META_ID", array(
    'id'              => 'casestudy_meta_option',
    'title'           => esc_html__('Case Study Informations', 'adking-core'),
    'post_type'       => 'case-study',
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

  CSF::createSection("EGNS_CASESTUDY_META_ID", array(
    'parent' => 'casestudy_meta_option',
    'title'  => esc_html__('General', 'adking-core'),
    'fields' => array(
      array(
        'id'     => 'case_information_list',
        'type'   => 'repeater',
        'title'  => 'Information List',
        'fields' => array(
          array(
            'id'      => 'info_list_label',
            'type'    => 'text',
            'title'   => 'Label',
            'default' => 'Category-',
          ),
          array(
            'id'      => 'info_list_value',
            'type'    => 'text',
            'title'   => 'Value',
            'default' => 'Financial advisory',
          ),
        ),
        'default'   => array(
          array(
            'info_list_label' => 'Category-',
            'info_list_value' => 'Financial advisory',
          ),
          array(
            'info_list_label' => 'Clients-',
            'info_list_value' => 'Daniel Scoot',
          ),
          array(
            'info_list_label' => 'Location-',
            'info_list_value' => 'Menchester, UK',
          ),
          array(
            'info_list_label' => 'Date-',
            'info_list_value' => 'Daniel Scoo29/03/2026',
          ),
        )
      ),
      array(
        'id'     => 'case_data_list',
        'type'   => 'repeater',
        'title'  => 'Data List',
        'fields' => array(
          array(
            'id'      => 'data_list_label',
            'type'    => 'text',
            'title'   => 'Label',
            'default' => 'Download Docs',
          ),
          array(
            'id'      => 'data_list_value',
            'type'    => 'media',
            'title'   => 'Value',
          ),
        ),
        'default'   => array(
          array(
            'info_list_label' => 'Download Pdf',
            'info_list_value' => '',
          ),
          array(
            'info_list_label' => 'Download Docs',
            'info_list_value' => '',
          ),
        )
      ),
      array(
        'id'     => 'case_study_note',
        'type'   => 'textarea',
        'title'  => 'Note',
        'default' => '<strong>Increased Brand Awareness: </strong> Following the rebrand, Brightwave reported a 60% increase in brand recognition and media mentions.',
      ),
      array(
        'id'     => 'case_study_metrics_list',
        'type'   => 'repeater',
        'title'  => 'Metrics List',
        'fields' => array(
          array(
            'id'      => 'case_study_metrics_list_label',
            'type'    => 'text',
            'title'   => 'Label',
            'default' => 'Revenue Boost',
          ),
          array(
            'id'      => 'case_study_metrics_list_value',
            'type'    => 'text',
            'title'   => 'Value',
            'default' => '27',
          ),
          array(
            'id'      => 'case_study_metrics_list_suffix',
            'type'    => 'text',
            'title'   => 'Suffix',
            'default' => '%',
          ),
        ),
        'default'   => array(
          array(
            'case_study_metrics_list_label' => 'Revenue Boost',
            'case_study_metrics_list_value' => '27',
            'case_study_metrics_list_suffix' => '%',
          ),
          array(
            'case_study_metrics_list_label' => 'Months Upgrade',
            'case_study_metrics_list_value' => '2.5',
            'case_study_metrics_list_suffix' => 'M',
          ),
        )
      ),
    )
  ));
}
