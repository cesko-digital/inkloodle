<?php

class block_edmo_funfacts_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;
        $edmoFontList = include($CFG->dirroot . '/theme/edmo/inc/font_handler/edmo_font_select.php');

        $funfactsnumber = 4;
        if(isset($this->block->config->funfactsnumber)){
            $funfactsnumber = $this->block->config->funfactsnumber;
        }

        $funfactsstyle = 1;
        if(isset($this->block->config->funfactsstyle)){
            $funfactsstyle = $this->block->config->funfactsstyle;
        }

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Class
        $mform->addElement('text', 'config_class', get_string('config_class', 'theme_edmo'));
        $mform->setDefault('config_class', '');
        $mform->setType('config_class', PARAM_RAW);

        $funfactsrange = array(
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

        $mform->addElement('select', 'config_funfactsstyle', get_string('config_style', 'theme_edmo'), array(1 => 'Style 1', 2 => 'Style 2', 3 => 'Style 3'));
        $mform->setDefault('config_funfactsstyle', 1);

        $mform->addElement('select', 'config_funfactsnumber', get_string('config_items', 'theme_edmo'), $funfactsrange);
        $mform->setDefault('config_funfactsnumber', 4);

        for($i = 1; $i <= $funfactsnumber; $i++) {
            $mform->addElement('header', 'config_edmo_item' . $i , get_string('config_item', 'theme_edmo') . $i);

            $mform->addElement('text', 'config_funfacts_title' . $i, get_string('config_title', 'theme_edmo', $i));
            $mform->setDefault('config_funfacts_title' . $i, 'FINISHED SESSIONS');
            $mform->setType('config_funfacts_title' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_funfacts_number' . $i, get_string('config_number', 'theme_edmo', $i));
            $mform->setDefault('config_funfacts_number' . $i, '1926');
            $mform->setType('config_funfacts_number' . $i, PARAM_TEXT);

            $mform->addElement('text', 'config_funfacts_prefix' . $i, get_string('config_number_prefix', 'theme_edmo', $i));
            $mform->setType('config_funfacts_prefix' . $i, PARAM_TEXT);

            // $select = $mform->addElement('select', 'config_icon' . $i, get_string('config_icon', 'theme_edmo'), $edmoFontList, array('class'=>'edmo_icon_class'));

        } 
        
        // Section Image header title according to language file.
        $mform->addElement('header', 'config_image_heading', get_string('config_image_heading', 'theme_edmo'));

        // Shape Images
        $mform->addElement('text', 'config_icon_shape', 'Icon Shape URL(for Style 3)');
            $mform->setType('config_icon_shape', PARAM_TEXT);
    }
}
