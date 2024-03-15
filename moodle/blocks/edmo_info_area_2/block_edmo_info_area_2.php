<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');

class block_edmo_info_area_2 extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_info_area_2');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->top_title = 'INFORMATION';
            $this->config->title = 'How To Apply?';
            $this->config->featuresnumber = 4;

            $this->config->features_title1 = 'Select Suitable Course';
            $this->config->features_content1 = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.';
            $this->config->features_icon1 = 'flaticon-checkmark';

            $this->config->features_title2 = 'Student Information';
            $this->config->features_content2 = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.';
            $this->config->features_icon2 = 'flaticon-webinar';

            $this->config->features_title3 = 'Payment Information';
            $this->config->features_content3 = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.';
            $this->config->features_icon3 = 'flaticon-credit-card-1';

            $this->config->features_title4 = 'Register Now';
            $this->config->features_content4 = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.';
            $this->config->features_icon4 = 'flaticon-verify';
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

        $fs = get_file_storage();
        $files = $fs->get_area_files($this->context->id, 'block_edmo_info_area_2', 'content');

        $text = '';
        $text .= '
            <!-- Start Information Area -->
            <div class="information-area ptb-100 '.$this->content->class.'"">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="information-content">
                                <span class="sub-title">'.$this->content->top_title.'</span>
                                <h2>'.$this->content->title.'</h2>
                                    <ul class="apply-details">';
                                        for($i = 1; $i <= $featuresnumber; $i++) {
                                            $features_title         = 'features_title' . $i;
                                            $features_content         = 'features_content' . $i;
                                            $features_icon                   = 'features_icon' . $i;
                                            if(isset($this->config->$features_title)) { $features_title = $this->config->$features_title; }else{ $features_title = ''; }
                                            if(isset($this->config->$features_content)) { $features_content = $this->config->$features_content; }else{ $features_content = ''; }
                                            if(isset($this->config->$features_icon)) { $features_icon = $this->config->$features_icon; }else{ $features_icon = ''; }
                                            $text .= '
                                            <li>';
                                                if($features_icon):
                                                    $text .= '
                                                    <div class="icon">
                                                        <i class="'.$features_icon.'"></i>
                                                    </div>';
                                                endif;
                                                $text .= '
                                                <h3>'.$features_title.'</h3>
                                                <p>'.$features_content.'</p>
                                            </li>
                                            
                                            ';
                                        } $text .= '
                                    </ul>';
                                    $text .= '
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="information-image text-center">';
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
                    </div>
                </div>
            </div>
            <!-- End Information Area -->';
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