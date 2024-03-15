<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');
class block_edmo_partners extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_partners');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
        }
    }

    public function get_content() {
        global $CFG, $DB;
        require_once($CFG->libdir . '/filelib.php');

        if ($this->content !== null) {
          return $this->content;
        }
        
        $this->content         =  new stdClass;

        if(isset($this->config->class) && !empty($this->config->class)){
            $this->content->class = $this->config->class;
        }else{
            $this->content->class = 'ptb-100';
        }

        $text = '';
        $text .= '
        <div class="partner-area '.$this->content->class.'">
            <div class="container">
                <div class="row align-items-center">';
                    $fs = get_file_storage();
                    $files = $fs->get_area_files($this->context->id, 'block_edmo_partners', 'content');
                    foreach ($files as $file) {
                        $filename = $file->get_filename();
                        if ($filename <> '.') {
                            $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), null, $file->get_filepath(), $filename);
                            $text .= '
                            <div class="col-lg-2 col-6 col-sm-3 col-md-3">
                                <div class="single-partner-item">
                                    <img src="'. $url.'" alt="'. $filename.'">
                                </div>
                            </div>
                            ';
                        }
                    }
                    $text .= '
                </div>
            </div>
        </div>';

        $this->content->footer = '';
        $this->content->text   = $text;

        return $this->content;
    }

    /**
     * The block can be used repeatedly in a page.
     */
    function instance_allow_multiple() {
        return true;
    }

    /**
     * Enables global configuration of the block in settings.php.
     *
     * @return bool True if the global configuration is enabled.
     */
    function has_config() {
        return true;
    }

    /**
     * Sets the applicable formats for the block.
     *
     * @return string[] Array of pages and permissions.
     */
    function applicable_formats() {
        return array(
            'all' => true,
            'my' => false,
            'admin' => false,
            'course-view' => true,
            'course' => true,
        );
    }

}