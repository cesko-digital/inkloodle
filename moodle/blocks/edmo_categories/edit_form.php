<?php
require_once($CFG->dirroot . '/theme/edmo/inc/course_handler/edmo_course_handler.php');

class block_edmo_categories_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edmoFontList = include($CFG->dirroot . '/theme/edmo/inc/font_handler/edmo_font_select.php');
        $edmoCourseHandler = new edmoCourseHandler();
        $edmoCourseCategories = $edmoCourseHandler->edmoListCategories();

        // $style = 1;
        // if(isset($this->block->config->style)){
        //     $style = $this->block->config->style;
        // }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // $mform->addElement('select', 'config_style', get_string('config_style', 'theme_edmo'), array(1 => 'Style 1', 2 => 'Style 2',));
        // $mform->setDefault('config_style', 1);
        
        // Top Title
        $mform->addElement('text', 'config_top_title', 'Top Title');
        $mform->setDefault('config_top_title', 'CATEGORIES');
        $mform->setType('config_top_title', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'Top categories');
        $mform->setType('config_title', PARAM_RAW);

        // Subtitle
        $mform->addElement('text', 'config_subtitle', get_string('config_subtitle', 'theme_edmo'));
        $mform->setDefault('config_subtitle', 'Explore all of our courses and pick your suitable ones to enroll and start learning with us!');
        $mform->setType('config_subtitle', PARAM_RAW);

        // Button Text
        $mform->addElement('text', 'config_button_text', get_string('config_button_text', 'theme_edmo'));
        $mform->setDefault('config_button_text', 'View All Categories');
        $mform->setType('config_button_text', PARAM_RAW);

        // Button Link
        $mform->addElement('text', 'config_button_link', get_string('config_button_link', 'theme_edmo'));
        $mform->setDefault('config_button_link', $CFG->wwwroot . '/course');
        $mform->setType('config_button_link', PARAM_RAW);

        // Courses Text
        $mform->addElement('text', 'config_courses', 'Total Courses Title');
        $mform->setDefault('config_courses', $CFG->wwwroot . '/course');
        $mform->setType('config_courses', PARAM_RAW);

        $items = 8;
        if(isset($this->block->config->items)){
            $items = $this->block->config->items;
        }

        $items_range = array(
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
        $items_max = 30;

        $mform->addElement('select', 'config_items', get_string('config_items', 'theme_edmo'), $items_range);
        $mform->setDefault('config_items', 8);

        for($i = 1; $i <= $items; $i++) {
            $mform->addElement('header', 'config_edmo_item' . $i , get_string('config_item', 'theme_edmo') .' '. $i);

            $options = array(
                'multiple' => false,
            );
            $mform->addElement('autocomplete', 'config_category' . $i, get_string('category'), $edmoCourseCategories, $options);

            $select = $mform->addElement('text', 'config_bg_img' . $i, 'Background Image URL' . $i);
            $mform->setType('config_bg_img' . $i, PARAM_RAW);
        }
    }
}
