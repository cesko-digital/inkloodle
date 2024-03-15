<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');

class block_edmo_contact_area extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_contact_area');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->top_title = 'FREE TRIAL';
            $this->config->title = 'Request For A Free Trial';
            $this->config->contact_from_code = '<form action="../../local/contact/index.php" method="post">
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
            <button name="submit" type="submit">Submit Now</button>
        </form>';
            
        }
    }

    public function get_content() {
        global $CFG, $DB, $COURSE, $USER, $PAGE;
        require_once($CFG->libdir . '/filelib.php');

        if ($this->content !== null) {
            return $this->content;
        }
        $this->content  =  new stdClass;$featuresnumber = 4;
        if(isset($this->config->featuresnumber)){
            $featuresnumber = $this->config->featuresnumber;
        }

        if(!empty($this->config->class)){$this->content->class = $this->config->class;} else {$this->content->class = '';}

        if(!empty($this->config->top_title)){$this->content->top_title = $this->config->top_title;} else {$this->content->top_title = '';}

        if(!empty($this->config->title)){$this->content->title = $this->config->title;} else {$this->content->title = '';}
       
        if(!empty($this->config->contact_from_code)){$this->content->contact_from_code = $this->config->contact_from_code;} else {$this->content->contact_from_code = '';}

        $fs     = get_file_storage();
        $files  = $fs->get_area_files($this->context->id, 'block_edmo_contact_area', 'content');

        $text = '';
        $text .= '
            <!-- Start Free Trial Area -->
            <div class="free-trial-area ptb-100 bg-fffaf3 '.$this->content->class.'">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="free-trial-image text-center">';
                                if($files):
                                    foreach ($files as $file) {
                                        $filename = $file->get_filename();
                                        if ($filename <> '.') {
                                            $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), null, $file->get_filepath(), $filename);
                                            $text .= '
                                            <img src="'. $url.'" alt="'. $filename.'">';
                                        }
                                    }
                                endif;
                                $text .= '
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="free-trial-form">
                                <span class="sub-title">'.$this->content->top_title.'</span>
                                <h2>'.$this->content->title.'</h2>
                                '.$this->content->contact_from_code.'
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Free Trial Area -->';
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