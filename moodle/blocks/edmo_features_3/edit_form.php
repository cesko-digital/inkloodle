<?php

class block_edmo_features_3_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edmoFontList = include($CFG->dirroot . '/theme/edmo/inc/font_handler/edmo_font_select.php');

        $features_3_number = 1;
        if(isset($this->block->config->features_3_number)){
            $features_3_number = $this->block->config->features_3_number;
        }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Bottom Content
        $mform->addElement('textarea', 'config_bottom_body', get_string('config_bottom_body', 'theme_edmo'));
        $mform->setDefault('config_bottom_body', 'If you want more?');
        $mform->setType('config_bottom_body', PARAM_RAW);

        // Button Text
        $mform->addElement('text', 'config_button_text', get_string('config_button_text', 'theme_edmo'));
        $mform->setDefault('config_button_text', 'View More Courses');
        $mform->setType('config_button_text', PARAM_RAW);

        // Button Link
        $mform->addElement('text', 'config_button_link', get_string('config_button_link', 'theme_edmo'));
        $mform->setDefault('config_button_link', $CFG->wwwroot . '/course');
        $mform->setType('config_button_link', PARAM_RAW);

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

        $mform->addElement('select', 'config_features_3_number', get_string('config_items', 'theme_edmo'), $featuresrange);
        $mform->setDefault('config_features_3_number', 1);

        for($i = 1; $i <= $features_3_number; $i++) {
            $mform->addElement('header', 'config_edmo_item' . $i , get_string('config_item', 'theme_edmo') . $i);

            $mform->addElement('text', 'config_features_3_img' . $i, get_string('config_img', 'theme_edmo', $i));
            $mform->setType('config_features_3_img' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_features_3_title' . $i, get_string('config_title', 'theme_edmo', $i));
            $mform->setDefault('config_features_3_title' . $i, 'Web Development');
            $mform->setType('config_features_3_title' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_features_3_content' . $i, get_string('config_body', 'theme_edmo', $i));
            $mform->setDefault('config_features_3_content' . $i, 'Lorem ipsum dolor sit amet, consecteur adipiscing elit, sed do eiusmod tempor.');
            $mform->setType('config_features_3_content' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_features_3_btn_title' . $i, get_string('config_button', 'theme_edmo', $i));
            $mform->setDefault('config_features_3_btn_title' . $i, 'Start Now!');
            $mform->setType('config_features_3_btn_title' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_btn_link' . $i, get_string('config_button_link', 'theme_edmo', $i));
            $mform->setDefault('config_btn_link' . $i, $CFG->wwwroot . '/course');
            $mform->setType('config_btn_link' . $i, PARAM_RAW);
        }
    }
}
