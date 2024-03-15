<?php

class block_edmo_feedback_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;

        $itemsnumber = 3;
        if(isset($this->block->config->itemsnumber)){
            $itemsnumber = $this->block->config->itemsnumber;
        }

        $style = 1;
        if(isset($this->block->config->style)){
            $style = $this->block->config->style;
        }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        $mform->addElement('select', 'config_style', get_string('config_style', 'theme_edmo'), array(1 => 'Style 1', 2 => 'Style 2'));
         $mform->setDefault('config_style', 1);
         $mform->setType('config_style', PARAM_RAW);

        $mform->addElement('static', 'config_image_doc', '<b><a style="color: var(--mainColor)" href="https://docs.envytheme.com/docs/edmo-moodle-theme-documentation/faqs/how-to-get-the-image-url/" target="_blank">Doc link: How to make Image URL?</a></b>'); 

        // Background Image
        $mform->addElement('text', 'config_bg_img', 'Background Image URL(for Style 1)');
        $mform->setType('config_bg_img', PARAM_RAW);

        // Shape Image 1
        $mform->addElement('text', 'config_shape1', 'Shape Image 1 URL(for Style 2)');
        $mform->setType('config_shape1', PARAM_RAW);

        // Shape Image 2
        $mform->addElement('text', 'config_shape2', 'Shape Image 2 URL(for Style 2)');
        $mform->setType('config_shape2', PARAM_RAW);

        // Shape Image 3
        $mform->addElement('text', 'config_shape3', 'Shape Image 3 URL(for Style 2)');
        $mform->setType('config_shape3', PARAM_RAW);

        // Shape Image 4
        $mform->addElement('text', 'config_shape4', 'Shape Image 4 URL(for Style 2)');
        $mform->setType('config_shape4', PARAM_RAW);

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
            31 => '31',
            32 => '32',
            33 => '33',
            34 => '34',
            35 => '35',
            36 => '36',
            37 => '37',
            38 => '38',
            39 => '39',
            40 => '40',
            41 => '41',
            42 => '42',
            43 => '43',
            44 => '44',
            45 => '45',
            46 => '46',
            47 => '47',
            48 => '48',
            49 => '49',
            50 => '50',
        );
        
        $mform->addElement('select', 'config_itemsnumber', get_string('config_items', 'theme_edmo'), $itemsrange);
        $mform->setDefault('config_itemsnumber', 3);

        for($i = 1; $i <= $itemsnumber; $i++) {
            $mform->addElement('header', 'config_edmo_item' . $i , get_string('config_item', 'theme_edmo') . $i);

            $mform->addElement('text', 'config_item_title' . $i, get_string('config_title', 'theme_edmo', $i));
            $mform->setDefault('config_item_title' . $i, 'Jasica Lora');
            $mform->setType('config_item_title' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_item_subtitle' . $i, get_string('config_subtitle', 'theme_edmo', $i));
            $mform->setDefault('config_item_subtitle' . $i, 'TV Model');
            $mform->setType('config_item_subtitle' . $i, PARAM_TEXT);

            $mform->addElement('textarea', 'config_item_text' . $i, get_string('config_text', 'theme_edmo', $i));
            $mform->setDefault('config_item_text' . $i, 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et mag na aliqua. Minim veniam, quis nostrud ullamco laboris nisi ut aliquip ex ea commodo conse quatt adipiscing dolore.');
            $mform->setType('config_item_text' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_img' . $i, 'User Image URL');
            $mform->setType('config_img' . $i, PARAM_TEXT);
        }
    }
}
