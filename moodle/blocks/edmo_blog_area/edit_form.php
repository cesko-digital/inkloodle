<?php

class block_edmo_blog_area_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;

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
        $mform->setDefault('config_top_title', 'NEWS AND BLOGS');
        $mform->setType('config_top_title', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'Our Latest Publications');
        $mform->setType('config_title', PARAM_RAW);

        // Subtitle
        $mform->addElement('text', 'config_subtitle', get_string('config_subtitle', 'theme_edmo'));
        $mform->setDefault('config_subtitle', 'We always give extra care to our students skills improvements and feel excited to share our latest research and learnings!');
        $mform->setType('config_subtitle', PARAM_RAW);

        // Bottom Content
        $mform->addElement('textarea', 'config_bottom_body', get_string('config_bottom_body', 'theme_edmo'));
        $mform->setDefault('config_bottom_body', 'Get into details now?​​');
        $mform->setType('config_bottom_body', PARAM_RAW);

        // Button Text
        $mform->addElement('text', 'config_button_text', get_string('config_button_text', 'theme_edmo'));
        $mform->setDefault('config_button_text', 'View all posts');
        $mform->setType('config_button_text', PARAM_RAW);

        // Button Link
        $mform->addElement('text', 'config_button_link', get_string('config_button_link', 'theme_edmo'));
        $mform->setDefault('config_button_link', $CFG->wwwroot . '/blog');
        $mform->setType('config_button_link', PARAM_RAW);

        if (!empty($this->block->config) && is_object($this->block->config)) {
            $data = $this->block->config;
        } else {
            $data = new stdClass();
            $data->slidesnumber = 0;
        }

        $searchareas = \core_search\manager::get_search_areas_list(true);
        $areanames = array();
        foreach ($searchareas as $areaid => $searcharea) {
            $areanames[$areaid] = $searcharea->get_visible_name();
        }

        $bloglisting = new blog_listing();

        $entries = $bloglisting->get_entries();
        $entrieslist = array();

        foreach ($entries as $entryid => $entry) {
          $entrieslist[$entry->id] = $entry->subject;
        }

        $options = array(
            'multiple' => true,
        );
        $mform->addElement('autocomplete', 'config_posts', get_string('posts'), $entrieslist, $options);
    }
}
