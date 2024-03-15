<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');

class block_edmo_overview_area extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_overview_area');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->top_title    = 'Overview Area';
            $this->config->title        = 'Feel Like You Are Attending Your Classes Physically!';
            $this->config->body         = 'Edmo training programs can bring you a super exciting experience of learning through online! You never face any negative experience while enjoying your classes virtually by sitting in your comfort zone. Our flexible learning initiatives will help you to learn better and quicker than the traditional ways of learning skills.';
            $this->config->btn          = 'Get Started Now';
            $this->config->icon         = 'flaticon-user';
            $this->config->class        = '';
            $this->config->btn_link     = $CFG->wwwroot . '/course';

            $this->config->bottom_top_title = 'Overview Area';
            $this->config->bottom_title     = 'Feel Like You Are Attending Your Classes Physically!';
            $this->config->bottom_body      = 'Edmo training programs can bring you a super exciting experience of learning through online! You never face any negative experience while enjoying your classes virtually by sitting in your comfort zone. Our flexible learning initiatives will help you to learn better and quicker than the traditional ways of learning skills.';
            $this->config->bottom_top_btn   = 'GET IT ON';
            $this->config->bottom_btn       = 'Google Play';
            $this->config->bottom_btn_link  = '#';

            $this->config->right_bottom_top_btn   = 'GET IT ON';
            $this->config->right_bottom_btn       = 'Apple Store';
            $this->config->right_bottom_btn_link  = '#';
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

        if(!empty($this->config->top_title)){$this->content->top_title = $this->config->top_title;} else {$this->content->top_title = '';}

        if(!empty($this->config->title)){$this->content->title = $this->config->title;} else {$this->content->title = '';}

        if(!empty($this->config->body)){$this->content->body = $this->config->body;} else {$this->content->body = '';}

        if(!empty($this->config->btn)){$this->content->btn = $this->config->btn;} else {$this->content->btn = '';}

        if(!empty($this->config->btn_link)){$this->content->btn_link = $this->config->btn_link;} else {$this->content->btn_link = '';}

        if(!empty($this->config->icon)){$this->content->icon = $this->config->icon;} else {$this->content->icon = '';}

        // Bottom Section
        if(!empty($this->config->bottom_top_title)){$this->content->bottom_top_title = $this->config->bottom_top_title;} else {$this->content->bottom_top_title = '';}

        if(!empty($this->config->bottom_title)){$this->content->bottom_title = $this->config->bottom_title;} else {$this->content->bottom_title = '';}

        if(!empty($this->config->bottom_body)){$this->content->bottom_body = $this->config->bottom_body;} else {$this->content->bottom_body = '';}

        if(!empty($this->config->bottom_top_btn)){$this->content->bottom_top_btn = $this->config->bottom_top_btn;} else {$this->content->bottom_top_btn = '';}
        if(!empty($this->config->bottom_btn)){$this->content->bottom_btn = $this->config->bottom_btn;} else {$this->content->bottom_btn = '';}
        if(!empty($this->config->bottom_btn_link)){$this->content->bottom_btn_link = $this->config->bottom_btn_link;} else {$this->content->bottom_btn_link = '';}
        if(!empty($this->config->right_bottom_top_btn)){$this->content->right_bottom_top_btn = $this->config->right_bottom_top_btn;} else {$this->content->right_bottom_top_btn = '';}
        if(!empty($this->config->right_bottom_btn)){$this->content->right_bottom_btn = $this->config->right_bottom_btn;} else {$this->content->right_bottom_btn = '';}
        if(!empty($this->config->right_bottom_btn_link)){$this->content->right_bottom_btn_link = $this->config->right_bottom_btn_link;} else {$this->content->right_bottom_btn_link = '';}

        $bottom_img_link = 'bottom_img_link';
        if(isset($this->config->$bottom_img_link) && !empty($this->config->$bottom_img_link)){$this->content->$bottom_img_link = $this->config->$bottom_img_link;}else{$this->content->$bottom_img_link = '';}

        $right_bottom_img_link = 'right_bottom_img_link';
        if(isset($this->config->$right_bottom_img_link) && !empty($this->config->$right_bottom_img_link)){$this->content->$right_bottom_img_link = $this->config->$right_bottom_img_link;}else{$this->content->$right_bottom_img_link = '';}
        
        $shape_img1 = 'shape_img1';
        if(isset($this->config->$shape_img1) && !empty($this->config->$shape_img1)){$this->content->$shape_img1 = $this->config->$shape_img1;}else{$this->content->$shape_img1 = '';}
        
        $shape_img2 = 'shape_img2';
        if(isset($this->config->$shape_img2) && !empty($this->config->$shape_img2)){$this->content->$shape_img2 = $this->config->$shape_img2;}else{$this->content->$shape_img2 = '';}

        $shape_img3 = 'shape_img3';
        if(isset($this->config->$shape_img3) && !empty($this->config->$shape_img3)){$this->content->$shape_img3 = $this->config->$shape_img3;}else{$this->content->$shape_img3 = '';}

        $shape_img4 = 'shape_img4';
        if(isset($this->config->$shape_img4) && !empty($this->config->$shape_img4)){$this->content->$shape_img4 = $this->config->$shape_img4;}else{$this->content->$shape_img4 = '';}

        $bottom_section_img_link = 'bottom_section_img_link';
        if(isset($this->config->$bottom_section_img_link) && !empty($this->config->$bottom_section_img_link)){$this->content->$bottom_section_img_link = $this->config->$bottom_section_img_link;}else{$this->content->$bottom_section_img_link = '';}

        $fs = get_file_storage();
        $files = $fs->get_area_files($this->context->id, 'block_edmo_overview_area', 'content');

        $text = '';
        $text .= '
        <section class="overview-area ptb-100 '.$this->content->class.'">
            <div class="container">
                <div class="overview-box">
                    <div class="overview-content">
                        <span class="sub-title">'.$this->content->top_title.'</span>
                        <h2>'.$this->content->title.'</h2>
                        <p>'.$this->content->body.'</p>';
                        if(!empty($this->content->btn) && !empty($this->content->btn_link)){
                            $text .= '
                            <a href="'.$this->content->btn_link.'" class="default-btn"><i class="'.$this->content->icon.'"></i>'.$this->content->btn.'<span></span></a>';
                        }
                        $text .= '
                    </div>
        
                    <div class="overview-image">';
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
        
                <div class="overview-box">
                    <div class="overview-image">';
                        if($this->content->bottom_section_img_link):
                            $bottom_section_img_link = $this->content->bottom_section_img_link;
                            $text .= '
                            <img src="'.edmo_block_image_process($bottom_section_img_link).'" alt="'.$this->content->title.'">';
                        endif;
                        $text .= '
                    </div>
        
                    <div class="overview-content">
                        <span class="sub-title">'.$this->content->bottom_top_title.'</span>
                        <h2>'.$this->content->bottom_title.'</h2>
                        <p>'.$this->content->bottom_body.'</p>
                        
                        <div class="btn-box">';
                            if($this->content->bottom_btn):
                                $text .= '
                                <a href="'.$this->content->bottom_btn_link.'" class="playstore-btn">';
                                    if($this->content->bottom_img_link):
                                        $bottom_img_link = $this->content->bottom_img_link;
                                        $text .= '
                                        <img src="'.edmo_block_image_process($bottom_img_link).'" alt="'.$this->content->title.'">';
                                    endif;
                                    $text .= '

                                    '.$this->content->bottom_top_btn.'
                                    <span>'.$this->content->bottom_btn.'</span>
                                </a>';
                            endif;

                            if($this->content->right_bottom_btn):
                                $text .= '
                                <a href="'.$this->content->bottom_btn_link.'" class="applestore-btn">';
                                    if($this->content->right_bottom_img_link):
                                        $right_bottom_img_link = $this->content->right_bottom_img_link;
                                        $text .= '
                                        <img src="'.edmo_block_image_process($right_bottom_img_link).'" alt="'.$this->content->title.'">';
                                    endif;
                                    $text .= '

                                    '.$this->content->right_bottom_top_btn.'
                                    <span>'.$this->content->right_bottom_btn.'</span>
                                </a>';
                            endif;
                            $text .= '
                        </div>
                    </div>
                </div>
            </div>
        
            ';
            if($this->content->shape_img1):
                $shape_img1 = $this->content->shape_img1;
                $text .= '
                <div class="shape2"><img src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'"></div>';
            endif;

            if($this->content->shape_img2):
                $shape_img2 = $this->content->shape_img2;
                $text .= '
                <div class="shape3"><img src="'.edmo_block_image_process($shape_img2).'" alt="'.$this->content->title.'"></div>';
            endif;

            if($this->content->shape_img3):
                $shape_img3 = $this->content->shape_img3;
                $text .= '
                <div class="shape4"><img src="'.edmo_block_image_process($shape_img3).'" alt="'.$this->content->title.'"></div>';
            endif;

            if($this->content->shape_img4):
                $shape_img4 = $this->content->shape_img4;
                $text .= '
                <div class="shape9"><img src="'.edmo_block_image_process($shape_img4).'" alt="'.$this->content->title.'"></div>';
            endif;
            $text .= '
        </section>';
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