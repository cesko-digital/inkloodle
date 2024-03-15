<?php

class block_edmo_contact_area_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        global $CFG;

        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Section Class
        $mform->addElement('text', 'config_class', get_string('config_class', 'theme_edmo'));
        $mform->setType('config_class', PARAM_RAW);
        
        // Top Title
        $mform->addElement('text', 'config_top_title', get_string('config_top_title', 'theme_edmo'));
        $mform->setDefault('config_top_title', 'FREE TRIAL');
        $mform->setType('config_top_title', PARAM_RAW);

        // Title
        $mform->addElement('text', 'config_title', get_string('config_title', 'theme_edmo'));
        $mform->setDefault('config_title', 'Request For A Free Trial');
        $mform->setType('config_title', PARAM_RAW);

        $mform->addElement('textarea', 'config_contact_from_code', get_string('config_contact_from_code', 'theme_edmo'), 'wrap="virtual" rows="6" cols="50"');
        $mform->setDefault('config_contact_from_code', '<form action="../../local/contact/index.php" method="post">
        <div class="form-group">
            <input type="text" name="name" id="name" class="form-control" placeholder="Your Name *" required>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Your Email *" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phone" placeholder="Your Phone *" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="subject" placeholder="Your Subject *" required>
        </div>
            
        <input type="hidden" id="sesskey" name="sesskey" value="">
        <script>document.getElementById("sesskey").value = M.cfg.sesskey;</script>
        <button type="submit">Submit Now</button>
    </form>');


        $mform->addElement('static', 'config_contact_doc', '<b><a style="color: var(--mainColor)" href="https://moodle.org/plugins/local_contact" target="_blank">Please make sure this plugin is installed.</a></b>'); 

        // Images
        $mform->addElement('filemanager', 'config_image', 'Section Image', null,  array('subdirs' => 0, 'maxbytes' => 10485760, 'areamaxbytes' => 10485760, 'maxfiles' => 1, 'accepted_types' => array('.png', '.jpg', '.gif') ));

    }

    function set_data($defaults)
    {
        // Begin Image Processing
        if (empty($entry->id)) {
            $entry = new stdClass;
            $entry->id = null;
        }
        $draftitemid = file_get_submitted_draft_itemid('config_image');
        file_prepare_draft_area($draftitemid, $this->block->context->id, 'block_edmo_contact_area', 'content', 0,
            array('subdirs' => true));
        $entry->attachments = $draftitemid;
        parent::set_data($defaults);
        if ($data = parent::get_data()) {
            file_save_draft_area_files($data->config_image, $this->block->context->id, 'block_edmo_contact_area', 'content', 0,
                array('subdirs' => true));
        }
        // END Image Processing
    }
}
