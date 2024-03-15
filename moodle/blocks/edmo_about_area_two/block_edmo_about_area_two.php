<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');

class block_edmo_about_area_two extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_about_area_two');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->top_title = 'DISTANCE LEARNING';
            $this->config->title = 'Build Your Skills Online, Anytime';
            $this->config->body = '<p>Want to learn and earn PDUs or CEUs on your schedule — anytime, anywhere? Or, pick up a new skill quickly like, project team leadership or agile? Browse our most popular online courses.</p>';
            $this->config->class = '';
            $this->config->btn = 'View All Courses';
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
        if(!empty($this->config->top_title)){$this->content->top_title = $this->config->top_title;} else {$this->content->top_title = '';}
        if(!empty($this->config->body)){$this->content->body = $this->config->body;} else {$this->content->body = '';}
        if(!empty($this->config->btn)){$this->content->btn = $this->config->btn;} else {$this->content->btn = '';}
        if(!empty($this->config->btn_link)){$this->content->btn_link = $this->config->btn_link;} else {$this->content->btn_link = '';}

        $shape_img1 = 'shape_img1';
        if(isset($this->config->$shape_img1) && !empty($this->config->$shape_img1)){$this->content->$shape_img1 = $this->config->$shape_img1;}else{$this->content->$shape_img1 = '';}
        
        $shape_img2 = 'shape_img2';
        if(isset($this->config->$shape_img2) && !empty($this->config->$shape_img2)){$this->content->$shape_img2 = $this->config->$shape_img2;}else{$this->content->$shape_img2 = '';}

        $shape_img3 = 'shape_img3';
        if(isset($this->config->$shape_img3) && !empty($this->config->$shape_img3)){$this->content->$shape_img3 = $this->config->$shape_img3;}else{$this->content->$shape_img3 = '';}

        $shape_img4 = 'shape_img4';
        if(isset($this->config->$shape_img4) && !empty($this->config->$shape_img4)){$this->content->$shape_img4 = $this->config->$shape_img4;}else{$this->content->$shape_img4 = '';}

        $shape_img5 = 'shape_img5';
        if(isset($this->config->$shape_img5) && !empty($this->config->$shape_img5)){$this->content->$shape_img5 = $this->config->$shape_img5;}else{$this->content->$shape_img5 = '';}

        $shape_img6 = 'shape_img6';
        if(isset($this->config->$shape_img6) && !empty($this->config->$shape_img6)){$this->content->$shape_img6 = $this->config->$shape_img6;}else{$this->content->$shape_img6 = '';}

        $shape_img7 = 'shape_img7';
        if(isset($this->config->$shape_img7) && !empty($this->config->$shape_img7)){$this->content->$shape_img7 = $this->config->$shape_img7;}else{$this->content->$shape_img7 = '';}

        $shape_img8 = 'shape_img8';
        if(isset($this->config->$shape_img8) && !empty($this->config->$shape_img8)){$this->content->$shape_img8 = $this->config->$shape_img8;}else{$this->content->$shape_img8 = '';}

        $shape_img9 = 'shape_img9';
        if(isset($this->config->$shape_img9) && !empty($this->config->$shape_img9)){$this->content->$shape_img9 = $this->config->$shape_img9;}else{$this->content->$shape_img9 = '';}

        $fs = get_file_storage();
        $files = $fs->get_area_files($this->context->id, 'block_edmo_about_area_two', 'content');

        $text = '';
        $text .= '
        <!-- Start About Area -->
        <div class="about-area-three ptb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-12">
                        <div class="about-content-box">
                            <span class="sub-title">'.$this->content->top_title.'</span>
                            <h2>'.$this->content->title.'</h2>
                            '.$this->content->body.'';

                            if($this->content->btn_link):
                                $text .='
                                <a href="'.$this->content->btn_link.'" class="default-btn"><i class="flaticon-user"></i>'.$this->content->btn.'<span></span></a>';
                            endif;
                            $text .='
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="about-img">
                            <div class="image">';
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
                            </div>';

                            if($this->content->shape_img1):
                                $shape_img1 = $this->content->shape_img1;
                                $text .= '
                                <div class="shape17"><img src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'"></div>';
                            endif;

                            if($this->content->shape_img2):
                                $shape_img2 = $this->content->shape_img2;
                                $text .= '
                                <div class="shape18"><img src="'.edmo_block_image_process($shape_img2).'" alt="'.$this->content->title.'"></div>';
                            endif;

                            if($this->content->shape_img3):
                                $shape_img3 = $this->content->shape_img3;
                                $text .= '
                                <div class="shape19"><img src="'.edmo_block_image_process($shape_img3).'" alt="'.$this->content->title.'"></div>';
                            endif;

                            if($this->content->shape_img4):
                                $shape_img4 = $this->content->shape_img4;
                                $text .= '
                                <div class="shape20"><img src="'.edmo_block_image_process($shape_img4).'" alt="'.$this->content->title.'"></div>';
                            endif;

                            if($this->content->shape_img5):
                                $shape_img5 = $this->content->shape_img5;
                                $text .= '
                                <div class="shape21"><img src="'.edmo_block_image_process($shape_img5).'" alt="'.$this->content->title.'"></div>';
                            endif;

                            if($this->content->shape_img6):
                                $shape_img6 = $this->content->shape_img6;
                                $text .= '
                                <div class="shape22"><img src="'.edmo_block_image_process($shape_img6).'" alt="'.$this->content->title.'"></div>';
                            endif;

                            if($this->content->shape_img7):
                                $shape_img7 = $this->content->shape_img7;
                                $text .= '
                                <div class="shape23"><img src="'.edmo_block_image_process($shape_img7).'" alt="'.$this->content->title.'"></div>';
                            endif;
                            $text .= '
                        </div>
                    </div>
                </div>
            </div>';
            if($this->content->shape_img8):
                $shape_img8 = $this->content->shape_img8;
                $text .= '
                <div class="shape3"><img src="'.edmo_block_image_process($shape_img8).'" alt="'.$this->content->title.'"></div>';
            endif;
            if($this->content->shape_img9):
                $shape_img9 = $this->content->shape_img9;
                $text .= '
                <div class="shape4"><img src="'.edmo_block_image_process($shape_img9).'" alt="'.$this->content->title.'"></div>';
            endif;
            $text .= '
        </div>
        <!-- End About Area -->';

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