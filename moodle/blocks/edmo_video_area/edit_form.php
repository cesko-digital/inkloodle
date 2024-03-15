<?php

class block_edmo_video_area_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edmoFontList = include($CFG->dirroot . '/theme/edmo/inc/font_handler/edmo_font_select.php');

        $style = 1;
        if(isset($this->block->config->style)){
            $style = $this->block->config->style;
        }
        
        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        $mform->addElement('select', 'config_style', get_string('config_style', 'theme_edmo'), array(1 => 'Style 1', 2 => 'Style 2'));
         $mform->setDefault('config_style', 1);
         
        // Section Class
        $mform->addElement('text', 'config_class', get_string('config_class', 'theme_edmo'));
        $mform->setType('config_class', PARAM_RAW);

        // YouTube
        $mform->addElement('text', 'config_video', 'YouTube Video Link');
        $mform->setDefault('config_video', 'https://www.youtube.com/watch?v=PWvPbGWVRrU');
        $mform->setType('config_video', PARAM_RAW);

        // Top Title
        $mform->addElement('text', 'config_top_title', 'Top Title');
        $mform->setDefault('config_top_title', 'DISTANCE LEARNING');
        $mform->setType('config_top_title', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'Build Your Project Management Skills Online, Anytime');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_body', get_string('config_body', 'theme_edmo'));
        $mform->setDefault('config_body', 'Want to learn and earn PDUs or CEUs on your schedule — anytime, anywhere? Or, pick up a new skill quickly like, project team leadership or agile? Browse our most popular online courses.');
        $mform->setType('config_body', PARAM_RAW);

        // Button Text
        $mform->addElement('text', 'config_btn', get_string('config_btn', 'block_edmo_banner_3'));
        $mform->setDefault('config_btn', 'Explore Learning');
        $mform->setType('config_btn', PARAM_RAW);

        // Button Link
        $mform->addElement('text', 'config_btn_link', get_string('config_btn_link', 'block_edmo_banner_3'));
        $mform->setDefault('config_btn_link', $CFG->wwwroot . '/login/index.php');
        $mform->setType('config_btn_link', PARAM_RAW);

        // Section Image header title according to language file.
        $mform->addElement('header', 'config_image_heading', get_string('config_image_heading', 'theme_edmo'));

        // Images
        $mform->addElement('filemanager', 'config_image', 'Section Image', null,  array('subdirs' => 0, 'maxbytes' => 10485760, 'areamaxbytes' => 10485760, 'maxfiles' => 1, 'accepted_types' => array('.png', '.jpg', '.gif') ));

        $mform->addElement('static', 'config_image_doc', '<b><a style="color: var(--mainColor)" href="https://docs.envytheme.com/docs/edmo-moodle-theme-documentation/faqs/how-to-get-the-image-url/" target="_blank">Doc link: How to make Image URL?</a></b>'); 

        // Shape Images
        $mform->addElement('text', 'config_shape_img1', 'Shape Image 1 URL');
        $mform->setType('config_shape_img1', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img2', 'Shape Image 2 URL');
        $mform->setType('config_shape_img2', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img3', 'Shape Image 3 URL');
        $mform->setType('config_shape_img3', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img4', 'Shape Image 4 URL');
        $mform->setType('config_shape_img4', PARAM_TEXT);
    }

    function set_data($defaults)
    {
        // Begin Image Processing
        if (empty($entry->id)) {
            $entry = new stdClass;
            $entry->id = null;
        }
        $draftitemid = file_get_submitted_draft_itemid('config_image');
        file_prepare_draft_area($draftitemid, $this->block->context->id, 'block_edmo_video_area', 'content', 0,
            array('subdirs' => true));
        $entry->attachments = $draftitemid;
        parent::set_data($defaults);
        if ($data = parent::get_data()) {
            file_save_draft_area_files($data->config_image, $this->block->context->id, 'block_edmo_video_area', 'content', 0,
                array('subdirs' => true));
        }
        // END Image Processing
    }
}
