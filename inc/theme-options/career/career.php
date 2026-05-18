<?php

/*-----------------------------------------
	CONTROL CORE CLASSES FOR AVOID ERRORS
------------------------------------------*/
if (class_exists('CSF')) {

  /*-----------------------------------
	    PAGE METABOX SECTION
	------------------------------------*/
  CSF::createMetabox(
    "EGNS_CAREER_META_ID",
    array(
      'id'              => 'career_meta_option',
      'title'           => esc_html__('Job Informations', 'adking-core'),
      'post_type'       => 'career',
      'context'         => 'normal',
      'priority'        => 'high',
      'show_restore'    => true,
      'enqueue_webfont' => true,
      'async_webfont'   => false,
      'output_css'      => false,
      'nav'             => 'normal',
      'theme'           => 'dark',
    )
  );


  /*-----------------------------------
		REQUIRE META FILES
	------------------------------------*/

  CSF::createSection(
    "EGNS_CAREER_META_ID",
    array(
      'parent' => 'career_meta_option',
      'fields' => array(
        array(
          'type'    => 'subheading',
          'content' => esc_html__('Job Details', 'adking-core'),
        ),
        array(
          'id'       => 'job_posted_date',
          'type'     => 'date',
          'settings' => array(
            'dateFormat' => 'dd M, yy',
          ),
          'title' => esc_html__('Job Posted Date', 'adking-core'),
        ),
        array(
          'id'       => 'job_deadline_date',
          'type'     => 'date',
          'settings' => array(
            'dateFormat' => 'dd M, yy',
          ),
          'title' => esc_html__('Deadline Date', 'adking-core'),
        ),
        array(
          'id'      => 'job_location',
          'type'    => 'radio',
          'inline'  => true,
          'title'   => esc_html__('Location', 'adking-core'),
          'options' => array(
            'Onsite' => 'Onsite',
            'Remote' => 'Remote',
            'Hybrid' => 'Hybrid',
          ),
          'default' => 'Onsite'
        ),
        array(
          'id'      => 'job_type',
          'type'    => 'checkbox',
          'inline'  => true,
          'title'   => esc_html__('Job Types', 'adking-core'),
          'options' => array(
            'Full-time'  => 'Full-time',
            'Part-time'  => 'Part-time',
            'Contract'   => 'Contract',
            'Internship' => 'Internship',
            'Seasonal'   => 'Seasonal',
          ),
          'default' => 'Full-time'
        ),
        array(
          'id'      => 'job_experience',
          'type'    => 'text',
          'title'   => esc_html__('Experience', 'adking-core'),
          'default' => '1-3 Years',
        ),
        array(
          'id'      => 'job_vacancy',
          'type'    => 'text',
          'title'   => esc_html__('Vacancy', 'adking-core'),
          'default' => '02',
        ),
        array(
          'id'      => 'job_salary',
          'type'    => 'text',
          'title'   => esc_html__('Salary Range', 'adking-core'),
          'default' => '$90K - $170K<span class="year">( Annualy)</span>',
        ),
        array(
          'type'    => 'subheading',
          'content' => esc_html__('Right Side Content', 'adking-core'),
        ),
        array(
          'id'      => 'apply_heading',
          'type'    => 'text',
          'title'   => esc_html__('Heading', 'adking-core'),
          'default' => 'Ready to grow your career with us?',
        ),
        array(
          'id'      => 'apply_now_lbl',
          'type'    => 'text',
          'title'   => esc_html__('Button label', 'adking-core'),
          'default' => 'Apply Now',
        ),
        array(
          'id'      => 'apply_desc',
          'type'    => 'textarea',
          'class'   => 'egns_desc',
          'title'   => esc_html__('Short Description', 'adking-core'),
          'default' => 'We’re ready to meet with you & opptimistic you will doing great well!',
        ),
        array(
          'id'      => 'apply_note',
          'type'    => 'textarea',
          'class'   => 'egns_desc',
          'title'   => esc_html__('Short Note', 'adking-core'),
          'default' => wp_kses_post('<strong>Note: </strong>By applying, you will agree our <a href="#">privacy-policy & terms conditions.</a>.'),
        ),
        array(
          'id'      => 'career_apply_form_shortcode',
          'type'    => 'text',
          'title'   => esc_html__('Form Shortcode', 'adking-core'),
          'default' => '[contact-form-7 title="Adking Career Form"]',
        ),

      )
    )
  );
}
