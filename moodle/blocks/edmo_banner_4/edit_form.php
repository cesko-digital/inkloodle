<?php

class block_edmo_banner_4_edit_form extends block_edit_form {

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

        // Search Placeholder Text
        $mform->addElement('text', 'config_search_placeholder', 'Search Placeholder Text');
        $mform->setDefault('config_search_placeholder', 'What do you want to learn today?');
        $mform->setType('config_search_placeholder', PARAM_RAW);

        // Search Icon
        $select = $mform->addElement('select', 'config_icon', 'Search Icon', $edmoFontList, array('class'=>'edmo_icon_class'));
        $mform->setDefault('config_icon', 'flaticon-search');

        // Button Text
        $mform->addElement('text', 'config_btn', 'Search Button Text');
        $mform->setDefault('config_btn', 'Search Now');
        $mform->setType('config_btn', PARAM_RAW);

        // Links Title Text
        $mform->addElement('text', 'config_link_title', 'Links Title');
        $mform->setDefault('config_link_title', 'Popular:');
        $mform->setType('config_link_title', PARAM_RAW);

        // Links Area
        $mform->addElement('textarea', 'config_links', 'Links');
        $mform->setDefault('config_links', '<li><span>Popular:</span></li>');
        $mform->setType('config_links', PARAM_RAW);

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
            $mform->setDefault('config_features_title' . $i, '10,000 Online Courses');
            $mform->setType('config_features_title' . $i, PARAM_TEXT);

            $select = $mform->addElement('select', 'config_icon' . $i, get_string('config_icon', 'theme_edmo'), $edmoFontList, array('class'=>'edmo_icon_class'));
            $mform->setDefault('config_icon' . $i, 'flaticon-brain-process');

            $mform->addElement('text', 'config_features_content' . $i, get_string('config_body', 'theme_edmo', $i));
            $mform->setDefault('config_features_content' . $i, 'Learning top skills can bring an extra-ordinary outcome in a career.');
            $mform->setType('config_features_content' . $i, PARAM_TEXT);
        }


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
    }

    function set_data($defaults)
    {
        // Begin Image Processing
        if (empty($entry->id)) {
            $entry = new stdClass;
            $entry->id = null;
        }
        $draftitemid = file_get_submitted_draft_itemid('config_image');
        file_prepare_draft_area($draftitemid, $this->block->context->id, 'block_edmo_banner_4', 'content', 0,
            array('subdirs' => true));
        $entry->attachments = $draftitemid;
        parent::set_data($defaults);
        if ($data = parent::get_data()) {
            file_save_draft_area_files($data->config_image, $this->block->context->id, 'block_edmo_banner_4', 'content', 0,
                array('subdirs' => true));
        }
        // END Image Processing
    }
}
