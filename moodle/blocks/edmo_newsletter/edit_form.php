<?php

class block_edmo_newsletter_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        $newsletter_style = 1;
        if(isset($this->block->config->newsletter_style)){
            $newsletter_style = $this->block->config->newsletter_style;
        }

        // Top Title
        $mform->addElement('text', 'config_top_title', get_string('config_top_title', 'theme_edmo'));
        $mform->setDefault('config_top_title', 'GO AT YOUR OWN PACE');
        $mform->setType('config_top_title', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'Subscribe To Our Newsletter');
        $mform->setType('config_title', PARAM_RAW);

        // Content
        $mform->addElement('textarea', 'config_body', get_string('config_body', 'theme_edmo'));
        $mform->setDefault('config_body', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $mform->setType('config_body', PARAM_RAW);

        // Action URL
        $mform->addElement('text', 'config_action_url', get_string('config_action_url', 'block_edmo_newsletter'));
        $mform->setType('config_action_url', PARAM_RAW);

        $mform->addElement('static', 'config_newsletter_doc', '<b><a style="color: var(--mainColor)" href="https://docs.envytheme.com/docs/edmo-moodle-theme-documentation/faqs/get-mailchimp-newsletter-form-action-url/" target="_blank">Doc link: Get MailChimp Newsletter Form Action URL</a></b>'); 

        // Placeholder Text
        $mform->addElement('text', 'config_placeholder', get_string('config_placeholder', 'block_edmo_newsletter'));
        $mform->setDefault('config_placeholder', 'Enter your email address');
        $mform->setType('config_placeholder', PARAM_RAW);

        // Button Text
        $mform->addElement('text', 'config_btn', get_string('config_btn', 'block_edmo_newsletter'));
        $mform->setDefault('config_btn', 'Subscribe Now');
        $mform->setType('config_btn', PARAM_RAW);

        // Section Image header title according to language file.
        $mform->addElement('header', 'config_image_heading', get_string('config_image_heading', 'theme_edmo'));

        $mform->addElement('static', 'config_image_doc', '<b><a style="color: var(--mainColor)" href="https://docs.envytheme.com/docs/edmo-moodle-theme-documentation/faqs/how-to-get-the-image-url/" target="_blank">Doc link: How to make Image URL?</a></b>'); 
            
        // Shape Image
        $mform->addElement('text', 'config_shape_img1', 'Shape Image 1 URL');
        $mform->setType('config_shape_img1', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img2', 'Shape Image 2 URL');
        $mform->setType('config_shape_img2', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img3', 'Shape Image 3 URL');
        $mform->setType('config_shape_img3', PARAM_TEXT);

        $mform->addElement('text', 'config_shape_img4', 'Shape Image 4 URL');
        $mform->setType('config_shape_img4', PARAM_TEXT);
    }
}
