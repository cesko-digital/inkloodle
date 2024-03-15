<?php

class block_edmo_about_area_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edmoFontList = include($CFG->dirroot . '/theme/edmo/inc/font_handler/edmo_font_select.php');

        $featuresnumber = 4;
        if(isset($this->block->config->featuresnumber)){
            $featuresnumber = $this->block->config->featuresnumber;
        }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        $mform->addElement('select', 'config_style', get_string('config_style', 'theme_edmo'), array(1 => 'Style 1', 2 => 'Style 2'));
        $mform->setDefault('config_style', 1);

        // Section Class
        $mform->addElement('text', 'config_class', get_string('config_class', 'theme_edmo'));
        $mform->setType('config_class', PARAM_RAW);
        
        // Top Title
        $mform->addElement('text', 'config_top_title', get_string('config_top_title', 'theme_edmo'));
        $mform->setDefault('config_top_title', 'ONLINE LEARNING');
        $mform->setType('config_top_title', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'Develop Your Skills, Learn Something New, and Grow Your Skills From Anywhere in the World!');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_body', get_string('config_body', 'theme_edmo'));
        $mform->setDefault('config_body', 'We understand better that online-based learning can make a significant change to reach students from all over the world! Giving options to learn better always can offer the best outcomes!');
        $mform->setType('config_body', PARAM_RAW);

        // Button Text
        $mform->addElement('text', 'config_btn', get_string('config_btn', 'block_edmo_about_area'));
        $mform->setDefault('config_btn', 'View All Courses');
        $mform->setType('config_btn', PARAM_RAW);

        // Button Link
        $mform->addElement('text', 'config_btn_link', get_string('config_btn_link', 'block_edmo_about_area'));
        $mform->setDefault('config_btn_link', $CFG->wwwroot . '/course');
        $mform->setType('config_btn_link', PARAM_RAW);

        // Button Icon
        $select = $mform->addElement('select', 'config_icon', get_string('config_icon', 'theme_edmo'), $edmoFontList, array('class'=>'edmo_icon_class'));
        $mform->setDefault('config_icon', 'flaticon-user');

        $featuresrange = array(
            1 => '1',
            2 => '2',
            3 => '3',
            4 => '4',
            5 => '5',
            6 => '6',
            7 => '7',
            8 => '8',
            9 => '9',
            10 => '10',
            11 => '11',
            12 => '12',
            13 => '13',
            14 => '14',
            15 => '15',
            16 => '16',
            17 => '17',
            18 => '18',
            19 => '19',
            20 => '20',
            21 => '21',
            22 => '22',
            23 => '23',
            24 => '24',
            25 => '25',
            26 => '26',
            27 => '27',
            28 => '28',
            29 => '29',
            30 => '30',
        );

        $mform->addElement('select', 'config_featuresnumber', get_string('config_items', 'theme_edmo'), $featuresrange);
        $mform->setDefault('config_featuresnumber', 4);

        for($i = 1; $i <= $featuresnumber; $i++) {
            $mform->addElement('header', 'config_edmo_item' . $i , get_string('config_item', 'theme_edmo') . $i);

            $mform->addElement('text', 'config_features_title' . $i, get_string('config_title', 'theme_edmo', $i));
            $mform->setDefault('config_features_title' . $i, 'Expert Trainers');
            $mform->setType('config_features_title' . $i, PARAM_TEXT);

            $select = $mform->addElement('select', 'config_icon' . $i, get_string('config_icon', 'theme_edmo'), $edmoFontList, array('class'=>'edmo_icon_class'));
            $mform->setDefault('config_icon' . $i, 'flaticon-experience');
        }

        // Section Image header title according to language file.
        $mform->addElement('header', 'config_image_heading', get_string('config_image_heading', 'theme_edmo'));

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

        // Section Image header title according to language file.
        $mform->addElement('header', 'config_image_heading', get_string('config_image_heading', 'theme_edmo'));

        // Images
        $mform->addElement('filemanager', 'config_image', get_string('config_image', 'block_edmo_about_area'), null,  array('subdirs' => 0, 'maxbytes' => 10485760, 'areamaxbytes' => 10485760, 'maxfiles' => 4, 'accepted_types' => array('.png', '.jpg', '.gif') ));

    }

    function set_data($defaults)
    {
        // Begin Image Processing
        if (empty($entry->id)) {
            $entry = new stdClass;
            $entry->id = null;
        }
        $draftitemid = file_get_submitted_draft_itemid('config_image');
        file_prepare_draft_area($draftitemid, $this->block->context->id, 'block_edmo_about_area', 'content', 0,
            array('subdirs' => true));
        $entry->attachments = $draftitemid;
        parent::set_data($defaults);
        if ($data = parent::get_data()) {
            file_save_draft_area_files($data->config_image, $this->block->context->id, 'block_edmo_about_area', 'content', 0,
                array('subdirs' => true));
        }
        // END Image Processing
    }
}
