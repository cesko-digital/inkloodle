<?php

class block_edmo_features_2_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edmoFontList = include($CFG->dirroot . '/theme/edmo/inc/font_handler/edmo_font_select.php');

        $features_2_number = 1;
        if(isset($this->block->config->features_2_number)){
            $features_2_number = $this->block->config->features_2_number;
        }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Top Title
        $mform->addElement('text', 'config_top_title', get_string('config_top_title', 'theme_edmo'));
        $mform->setDefault('config_top_title', 'WELCOME TO EDMO');
        $mform->setType('config_top_title', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'Our Language Courses​');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_body', get_string('config_body', 'theme_edmo'), 'wrap="virtual" rows="6" cols="50"');
        $mform->setDefault('config_body', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $mform->setType('config_body', PARAM_RAW);

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

        $mform->addElement('select', 'config_features_2_number', get_string('config_items', 'theme_edmo'), $featuresrange);
        $mform->setDefault('config_features_2_number', 1);

        for($i = 1; $i <= $features_2_number; $i++) {
            $mform->addElement('header', 'config_edmo_item' . $i , get_string('config_item', 'theme_edmo') . $i);

            $mform->addElement('text', 'config_features_2_img' . $i, get_string('config_img', 'theme_edmo', $i));
            $mform->setType('config_features_2_img' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_features_2_title' . $i, get_string('config_title', 'theme_edmo', $i));
            $mform->setDefault('config_features_2_title' . $i, 'Chinese');
            $mform->setType('config_features_2_title' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_features_2_content' . $i, get_string('config_body', 'theme_edmo', $i));
            $mform->setDefault('config_features_2_content' . $i, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.');
            $mform->setType('config_features_2_content' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_features_2_btn_title' . $i, get_string('config_button', 'theme_edmo', $i));
            $mform->setDefault('config_features_2_btn_title' . $i, 'View More');
            $mform->setType('config_features_2_btn_title' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_btn_link' . $i, get_string('config_button_link', 'theme_edmo', $i));
            $mform->setDefault('config_btn_link' . $i, $CFG->wwwroot . '/course');
            $mform->setType('config_btn_link' . $i, PARAM_RAW);
        }
    }
}
