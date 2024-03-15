<?php

class block_edmo_banner_5_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edmoFontList = include($CFG->dirroot . '/theme/edmo/inc/font_handler/edmo_font_select.php');
        
        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Section Class
        $mform->addElement('text', 'config_class', get_string('config_class', 'theme_edmo'));
        $mform->setType('config_class', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'Build Skills With Experts Any Time, Anywhere');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_body', get_string('config_body', 'theme_edmo'));
        $mform->setDefault('config_body', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $mform->setType('config_body', PARAM_RAW);

        // Button Text
        $mform->addElement('text', 'config_btn', 'Button Text');
        $mform->setDefault('config_btn', 'View All Courses');
        $mform->setType('config_btn', PARAM_RAW);

        // Button Icon
        $select = $mform->addElement('select', 'config_icon', 'Button Icon', $edmoFontList, array('class'=>'edmo_icon_class'));
        $mform->setDefault('config_icon', 'flaticon-user');

        // Button Link
        $mform->addElement('text', 'config_btn_link', 'Button Link');
        $mform->setDefault('config_btn_link', $CFG->wwwroot . '/login/index.php');
        $mform->setType('config_btn_link', PARAM_RAW);

        $featuresnumber = 3;
        if(isset($this->block->config->featuresnumber)){
            $featuresnumber = $this->block->config->featuresnumber;
        }

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
        $mform->setDefault('config_featuresnumber', 3);

        for($i = 1; $i <= $featuresnumber; $i++) {
            $mform->addElement('header', 'config_edmo_item' . $i , get_string('config_item', 'theme_edmo') . $i);

            $mform->addElement('text', 'config_features_title' . $i, get_string('config_title', 'theme_edmo', $i));
            $mform->setDefault('config_features_title' . $i, 'Learn the Latest Skills');
            $mform->setType('config_features_title' . $i, PARAM_TEXT);

            $select = $mform->addElement('select', 'config_icon' . $i, get_string('config_icon', 'theme_edmo'), $edmoFontList, array('class'=>'edmo_icon_class'));
            $mform->setDefault('config_icon' . $i, 'flaticon-brain-process');

            $mform->addElement('text', 'config_features_content' . $i, get_string('config_body', 'theme_edmo', $i));
            $mform->setDefault('config_features_content' . $i, 'Learning top skills can bring an extra-ordinary outcome in a career.');
            $mform->setType('config_features_content' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_features_link_title' . $i, 'Link Title ' . $i);
            $mform->setDefault('config_features_link_title' . $i, 'Start Now!');
            $mform->setType('config_features_link_title' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_features_link' . $i, 'Link URL ' . $i);
            $mform->setDefault('config_features_link', $CFG->wwwroot . '/login/index.php');
            $mform->setType('config_features_link' . $i, PARAM_TEXT);
        }

        // Section Image header title according to language file.
        $mform->addElement('header', 'config_image_heading', get_string('config_image_heading', 'theme_edmo'));

        // Images
        $mform->addElement('filemanager', 'config_image', 'Section Background Image', null,  array('subdirs' => 0, 'maxbytes' => 10485760, 'areamaxbytes' => 10485760, 'maxfiles' => 1, 'accepted_types' => array('.png', '.jpg', '.gif') ));

        $mform->addElement('static', 'config_image_doc', '<b><a style="color: var(--mainColor)" href="https://docs.envytheme.com/docs/edmo-moodle-theme-documentation/faqs/how-to-get-the-image-url/" target="_blank">Doc link: How to make Image URL?</a></b>'); 

        // Shape Images
        $mform->addElement('text', 'config_icon_shape', 'Icon Shape URL');
        $mform->setType('config_icon_shape', PARAM_TEXT);
        
        $mform->addElement('text', 'config_shape_img1', 'Shape Image 1 URL');
        $mform->setType('config_shape_img1', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img2', 'Shape Image 2 URL');
        $mform->setType('config_shape_img2', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img3', 'Shape Image 3 URL');
        $mform->setType('config_shape_img3', PARAM_TEXT);
    }

    function set_data($defaults)
    {
        // Begin Image Processing
        if (empty($entry->id)) {
            $entry = new stdClass;
            $entry->id = null;
        }
        $draftitemid = file_get_submitted_draft_itemid('config_image');
        file_prepare_draft_area($draftitemid, $this->block->context->id, 'block_edmo_banner_5', 'content', 0,
            array('subdirs' => true));
        $entry->attachments = $draftitemid;
        parent::set_data($defaults);
        if ($data = parent::get_data()) {
            file_save_draft_area_files($data->config_image, $this->block->context->id, 'block_edmo_banner_5', 'content', 0,
                array('subdirs' => true));
        }
        // END Image Processing
    }
}
