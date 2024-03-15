<?php

class block_edmo_features_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edmoFontList = include($CFG->dirroot . '/theme/edmo/inc/font_handler/edmo_font_select.php');

        $featuresnumber = 4;
        if(isset($this->block->config->featuresnumber)){
            $featuresnumber = $this->block->config->featuresnumber;
        }

        $style = 1;
        if(isset($this->block->config->style)){
            $style = $this->block->config->style;
        }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Top Title
        $mform->addElement('text', 'config_top_title', get_string('config_top_title', 'theme_edmo'));
        $mform->setDefault('config_top_title', 'EDUCATION FOR EVERYONE');
        $mform->setType('config_top_title', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'Affordable Online Courses and Learning Opportunities​');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_body', get_string('config_body', 'theme_edmo'), 'wrap="virtual" rows="6" cols="50"');
        $mform->setDefault('config_body', 'Finding your own space and utilize better learning options can result in faster than the traditional ways. Enjoy the beauty of eLearning!');
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

        $mform->addElement('select', 'config_style', get_string('config_style', 'theme_edmo'), array(1 => 'Style 1', 2 => 'Style 2'));
         $mform->setDefault('config_style', 1);

        $mform->addElement('select', 'config_featuresnumber', get_string('config_items', 'theme_edmo'), $featuresrange);
        $mform->setDefault('config_featuresnumber', 4);

        for($i = 1; $i <= $featuresnumber; $i++) {
            $mform->addElement('header', 'config_edmo_item' . $i , get_string('config_item', 'theme_edmo') . $i);

            $mform->addElement('text', 'config_features_title' . $i, get_string('config_title', 'theme_edmo', $i));
            $mform->setDefault('config_features_title' . $i, 'Learn the Latest Top Skills');
            $mform->setType('config_features_title' . $i, PARAM_TEXT);

            $select = $mform->addElement('select', 'config_icon' . $i, get_string('config_icon', 'theme_edmo'), $edmoFontList, array('class'=>'edmo_icon_class'));
            $mform->setDefault('config_icon' . $i, 'flaticon-brain-process');

            $mform->addElement('text', 'config_features_content' . $i, get_string('config_body', 'theme_edmo', $i));
            $mform->setDefault('config_features_content' . $i, 'Learning top skills can bring an extra-ordinary outcome in a career.');
            $mform->setType('config_features_content' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_features_btn_title' . $i, get_string('config_button', 'theme_edmo', $i));
            $mform->setDefault('config_features_btn_title' . $i, 'Start Now!');
            $mform->setType('config_features_btn_title' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_btn_link' . $i, get_string('config_button_link', 'theme_edmo', $i));
            $mform->setDefault('config_btn_link' . $i, $CFG->wwwroot . '/course');
            $mform->setType('config_btn_link' . $i, PARAM_RAW);
        }
    }
}
