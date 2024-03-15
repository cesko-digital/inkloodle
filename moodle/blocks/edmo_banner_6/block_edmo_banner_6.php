<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');

class block_edmo_banner_6 extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_banner_6');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->title = 'Build Development Skills With Edmo Any Time, Anywhere';
            $this->config->body = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
            $this->config->btn = 'Join For Free';
            $this->config->icon = 'flaticon-user';
            $this->config->class = '';
            $this->config->btn_link = $CFG->wwwroot . '/login/index.php';
        }
    }

    public function get_content() {
        global $CFG, $DB, $COURSE, $USER, $PAGE;
        require_once($CFG->libdir . '/filelib.php');

        if ($this->content !== null) {
            return $this->content;
        }
        $this->content  =  new stdClass;

        if(!empty($this->config->class)){$this->content->class = $this->config->class;} else {$this->content->class = '';}
        if(!empty($this->config->title)){$this->content->title = $this->config->title;} else {$this->content->title = '';}
        if(!empty($this->config->body)){$this->content->body = $this->config->body;} else {$this->content->body = '';}
        if(!empty($this->config->btn)){$this->content->btn = $this->config->btn;} else {$this->content->btn = '';}
        if(!empty($this->config->btn_link)){$this->content->btn_link = $this->config->btn_link;} else {$this->content->btn_link = '';}
        if(!empty($this->config->icon)){$this->content->icon = $this->config->icon;} else {$this->content->icon = '';}

        $shape_img1 = 'shape_img1';
        if(isset($this->config->$shape_img1) && !empty($this->config->$shape_img1)){$this->content->$shape_img1 = $this->config->$shape_img1;}else{$this->content->$shape_img1 = '';}

        $fs = get_file_storage();
        $files = $fs->get_area_files($this->context->id, 'block_edmo_banner_6', 'content');

        $text = '';
        $text .= '
        <!-- Start Main Banner Area -->
        <div class="hero-banner-area '.$this->content->class.'">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="hero-banner-content">
                            <h1>'.$this->content->title.'</h1>
                            <p>'.$this->content->body.'</p>';
                            if(!empty($this->content->btn) && !empty($this->content->btn_link)){
                                $text .= '
                                <a href="'.$this->content->btn_link.'" class="default-btn"><i class="'.$this->content->icon.'"></i>'.$this->content->btn.'<span></span></a>';
                            }
                            $text .= '
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="hero-banner-image">';
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
            </div>';

            if($this->content->shape_img1):
                $shape_img1 = $this->content->shape_img1;
                $text .= '
                <div class="banner-shape19"><img src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'"></div>
                <div class="divider"></div>';
            endif;
            $text .= '
        </div>
        <!-- End Main Banner Area -->';
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