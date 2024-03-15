<?php

class block_edmo_event_area_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edmoFontList = include($CFG->dirroot . '/theme/edmo/inc/font_handler/edmo_font_select.php');

        $itemsnumber = 3;
        if(isset($this->block->config->itemsnumber)){
            $itemsnumber = $this->block->config->itemsnumber;
        }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Top Title
        $mform->addElement('text', 'config_top_title', get_string('config_top_title', 'theme_edmo'));
        $mform->setDefault('config_top_title', 'EVENTS');
        $mform->setType('config_top_title', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'Our Upcoming Events');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_body', get_string('config_body', 'theme_edmo'));
        $mform->setDefault('config_body', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $mform->setType('config_body', PARAM_RAW);

        $itemsrange = array(
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

        $mform->addElement('select', 'config_itemsnumber', get_string('config_items', 'theme_edmo'), $itemsrange);
        $mform->setDefault('config_itemsnumber', 3);

        for($i = 1; $i <= $itemsnumber; $i++) {
            $mform->addElement('header', 'config_edmo_item' . $i , get_string('config_item', 'theme_edmo') . $i);

            $mform->addElement('text', 'config_items_title' . $i, get_string('config_title', 'theme_edmo', $i));
            $mform->setDefault('config_items_title' . $i, 'Global Conference on Business Management');
            $mform->setType('config_items_title' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_items_link' . $i, get_string('config_link', 'theme_edmo', $i));
            $mform->setDefault('config_items_link' . $i, '#');
            $mform->setType('config_items_link' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_img' . $i, get_string('config_img', 'theme_edmo', $i));
            $mform->setType('config_img' . $i, PARAM_TEXT);
            $mform->addElement('static', 'config_image_doc', '<b><a style="color: var(--mainColor)" href="https://docs.envytheme.com/docs/edmo-moodle-theme-documentation/faqs/how-to-get-the-image-url/" target="_blank">Doc link: How to make Image URL?</a></b>'); 

            $mform->addElement('text', 'config_items_date' . $i, get_string('config_date', 'theme_edmo', $i));
            $mform->setDefault('config_items_date' . $i, 'Wed, 20 May, 2023');
            $mform->setType('config_items_date' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_items_location' . $i, get_string('config_location', 'theme_edmo', $i));
            $mform->setDefault('config_items_location' . $i, 'Vancover, Canada');
            $mform->setType('config_items_location' . $i, PARAM_TEXT);
        }
    }
}
