<?php

class block_edmo_funfacts_and_feedback_area_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;

        $itemsnumber = 3;
        if(isset($this->block->config->itemsnumber)){
            $itemsnumber = $this->block->config->itemsnumber;
        }

        $funItemsNumber = 4;
        if(isset($this->block->config->funItemsNumber)){
            $funItemsNumber = $this->block->config->funItemsNumber;
        }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Top Title
        $mform->addElement('text', 'config_top_title', get_string('config_top_title', 'theme_edmo'));
        $mform->setDefault('config_top_title', 'DISTANCE LEARNING');
        $mform->setType('config_top_title', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'Flexible Study at Your Own Pace, According to Your Own Needs');
        $mform->setType('config_title', PARAM_RAW);

        // Subtitle
        $mform->addElement('text', 'config_subtitle', get_string('config_subtitle', 'theme_edmo'));
        $mform->setDefault('config_subtitle', 'With the Edmo, you can study whenever and wherever you choose. We have students in over 175 countries and a global reputation as a pioneer in the field of flexible learning. Our teaching also means, if you travel often or need to relocate, you can continue to study wherever you go.');
        $mform->setType('config_subtitle', PARAM_RAW);

        // Bottom Content
        $mform->addElement('textarea', 'config_bottom_body', get_string('config_bottom_body', 'theme_edmo'));
        $mform->setDefault('config_bottom_body', 'Not a member yet?​');
        $mform->setType('config_bottom_body', PARAM_RAW);

        // Button Text
        $mform->addElement('text', 'config_button_text', get_string('config_button_text', 'theme_edmo'));
        $mform->setDefault('config_button_text', 'Register now');
        $mform->setType('config_button_text', PARAM_RAW);

        // Button Link
        $mform->addElement('text', 'config_button_link', get_string('config_button_link', 'theme_edmo'));
        $mform->setDefault('config_button_link', $CFG->wwwroot . '/');
        $mform->setType('config_button_link', PARAM_RAW);

        // Video Link
        $mform->addElement('text', 'config_video_link', get_string('edmo_youtube_url', 'theme_edmo'));
        $mform->setDefault('config_video_link', 'https://www.youtube.com/watch?v=PWvPbGWVRrU');
        $mform->setType('config_video_link', PARAM_RAW);

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

            $mform->addElement('text', 'config_item_text' . $i, get_string('config_text', 'theme_edmo', $i));
            $mform->setDefault('config_item_text' . $i, 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et mag na aliqua. Minim veniam, quis nostrud ullamco laboris nisi ut aliquip ex ea commodo conse quatt adipiscing dolore.');
            $mform->setType('config_item_text' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_img' . $i, 'User Image URL');
            $mform->setType('config_img' . $i, PARAM_TEXT);

            $mform->addElement('static', 'config_image_doc', '<b><a style="color: var(--mainColor)" href="https://docs.envytheme.com/docs/edmo-moodle-theme-documentation/faqs/how-to-get-the-image-url/" target="_blank">Doc link: How to make Image URL?</a></b>'); 
        }

        $mform->addElement('header', 'config_fun_heading', get_string('config_fun_heading', 'theme_edmo'));


        $mform->addElement('select', 'config_funItemsNumber', get_string('config_items', 'theme_edmo'), $itemsrange);
        $mform->setDefault('config_funItemsNumber', 4);

        for($i = 1; $i <= $funItemsNumber; $i++) {
            $mform->addElement('header', 'config_edmo_item' . $i , get_string('config_item', 'theme_edmo') . $i);

            $mform->addElement('text', 'config_funItemsNumber_title' . $i, get_string('config_title', 'theme_edmo', $i));
            $mform->setDefault('config_funItemsNumber_title' . $i, 'FINISHED SESSIONS');
            $mform->setType('config_funItemsNumber_title' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_funItemsNumber_number' . $i, get_string('config_number', 'theme_edmo', $i));
            $mform->setDefault('config_funItemsNumber_number' . $i, '1926');
            $mform->setType('config_funItemsNumber_number' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_funItemsNumber_suffix' . $i, get_string('config_number_suffix', 'theme_edmo', $i));
            $mform->setDefault('config_funItemsNumber_suffix' . $i, '');
            $mform->setType('config_funItemsNumber_suffix' . $i, PARAM_TEXT);
        }
     
        // Section Image header title according to language file.
        $mform->addElement('header', 'config_image_heading', get_string('config_image_heading', 'theme_edmo'));

        $mform->addElement('text', 'config_img', 'Video Image URL');
        $mform->setType('config_img', PARAM_TEXT);
            
        // Shape Images
        $mform->addElement('text', 'config_shape_img1', 'Shape Image 1 URL');
        $mform->setType('config_shape_img1', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img2', 'Shape Image 2 URL');
        $mform->setType('config_shape_img2', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img3', 'Shape Image 3 URL');
        $mform->setType('config_shape_img3', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img4', 'Shape Image 4 URL');
        $mform->setType('config_shape_img4', PARAM_TEXT);
        
        $mform->addElement('text', 'config_shape_img5', 'Shape Image 5 URL');
        $mform->setType('config_shape_img5', PARAM_TEXT);
        
        $mform->addElement('static', 'config_image_doc', '<b><a style="color: var(--mainColor)" href="https://docs.envytheme.com/docs/edmo-moodle-theme-documentation/faqs/how-to-get-the-image-url/" target="_blank">Doc link: How to make Image URL?</a></b>'); 
    }
}
