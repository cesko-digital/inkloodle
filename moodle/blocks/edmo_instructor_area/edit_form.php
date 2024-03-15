<?php

class block_edmo_instructor_area_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edmoFontList = include($CFG->dirroot . '/theme/edmo/inc/font_handler/edmo_font_select.php');

        $itemNumber = 6;
        if(isset($this->block->config->itemNumber)){
            $itemNumber = $this->block->config->itemNumber;
        }

        $style = 1;
        if(isset($this->block->config->style)){
            $style = $this->block->config->style;
        }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        $mform->addElement('select', 'config_style', get_string('config_style', 'theme_edmo'), array(1 => 'Style 1', 2 => 'Style 2',));
        $mform->setDefault('config_style', 1);

        // Top Title
        $mform->addElement('text', 'config_top_title', get_string('config_top_title', 'theme_edmo'));
        $mform->setDefault('config_top_title', 'INSTRUCTOR');
        $mform->setType('config_top_title', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'Course Advisor​');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_body', get_string('config_body', 'theme_edmo'), 'wrap="virtual" rows="6" cols="50"');
        $mform->setDefault('config_body', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $mform->setType('config_body', PARAM_RAW);

        $range = array(
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

        $mform->addElement('select', 'config_itemNumber', get_string('config_items', 'theme_edmo'), $range);
        $mform->setDefault('config_itemNumber', 6);

        for($i = 1; $i <= $itemNumber; $i++) {
            $mform->addElement('header', 'config_edmo_item' . $i , get_string('config_item', 'theme_edmo') . $i);

            $mform->addElement('text', 'config_instructor_name' . $i, get_string('config_instructor_name', 'block_edmo_instructor_area', $i));
            $mform->setDefault('config_instructor_name' . $i, 'William James');
            $mform->setType('config_instructor_name' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_instructor_designation' . $i, get_string('config_instructor_designation', 'block_edmo_instructor_area', $i));
            $mform->setDefault('config_instructor_designation' . $i, 'William James');
            $mform->setType('config_instructor_designation' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_instructor_img' . $i, get_string('config_instructor_img', 'block_edmo_instructor_area', $i));
            $mform->setType('config_instructor_img' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_instructor_content' . $i, get_string('config_body', 'theme_edmo', $i));
            $mform->setDefault('config_instructor_content' . $i, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dol aliqua.');
            $mform->setType('config_instructor_content' . $i, PARAM_TEXT);

            // Social Icon 1
            $select = $mform->addElement('select', 'config_social_1_icon' . $i, get_string('config_icon', 'theme_edmo', $i), $edmoFontList, array('class'=>'edmo_icon_class'));
            $mform->setDefault('config_social_1_icon'.$i, 'bx bxl-facebook');

            $mform->addElement('text', 'config_social_1_link' . $i, get_string('config_social_link', 'block_edmo_instructor_area', $i));
            $mform->setDefault('config_social_1_link' . $i, '#');
            $mform->setType('config_social_1_link' . $i, PARAM_TEXT);

            // Social Icon 2
            $select = $mform->addElement('select', 'config_social_2_icon' . $i, get_string('config_icon', 'theme_edmo', $i), $edmoFontList, array('class'=>'edmo_icon_class'));
            $mform->setDefault('config_social_2_icon'.$i, 'bx bxl-twitter');

            $mform->addElement('text', 'config_social_2_link' . $i, get_string('config_social_link', 'block_edmo_instructor_area', $i));
            $mform->setDefault('config_social_2_link' . $i, '#');
            $mform->setType('config_social_2_link' . $i, PARAM_TEXT);

            // Social Icon 3
            $select = $mform->addElement('select', 'config_social_3_icon' . $i, get_string('config_icon', 'theme_edmo', $i), $edmoFontList, array('class'=>'edmo_icon_class'));
            $mform->setDefault('config_social_3_icon'.$i, 'bx bxl-instagram');

            $mform->addElement('text', 'config_social_3_link' . $i, get_string('config_social_link', 'block_edmo_instructor_area', $i));
            $mform->setDefault('config_social_3_link' . $i, '#');
            $mform->setType('config_social_3_link' . $i, PARAM_TEXT);

            // Social Icon 4
            $select = $mform->addElement('select', 'config_social_4_icon' . $i, get_string('config_icon', 'theme_edmo', $i), $edmoFontList, array('class'=>'edmo_icon_class'));
            $mform->setDefault('config_social_4_icon'.$i, 'bx bxl-linkedin');

            $mform->addElement('text', 'config_social_4_link' . $i, get_string('config_social_link', 'block_edmo_instructor_area', $i));
            $mform->setDefault('config_social_4_link' . $i, '#');
            $mform->setType('config_social_4_link' . $i, PARAM_TEXT);

            // Social Icon 5
            $select = $mform->addElement('select', 'config_social_5_icon' . $i, get_string('config_icon', 'theme_edmo', $i), $edmoFontList, array('class'=>'edmo_icon_class'));
            $mform->setDefault('config_social_5_icon'.$i, '');

            $mform->addElement('text', 'config_social_5_link' . $i, get_string('config_social_link', 'block_edmo_instructor_area', $i));
            $mform->setDefault('config_social_5_link' . $i, '');
            $mform->setType('config_social_5_link' . $i, PARAM_TEXT);
        }
    }
}
