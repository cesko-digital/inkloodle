<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');
class block_edmo_instructor_slider extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_instructor_slider');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->top_title = 'INSTRUCTOR';
            $this->config->title = 'Course Advisor';
            $this->config->body = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

            $this->config->instructor_name1 = 'William James';
            $this->config->instructor_designation1 = 'Project Management Expert';
            $this->config->instructor_content1 = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dol aliqua.';
        }
    }

    public function get_content() {
        global $CFG, $DB;

        $this->content         =  new stdClass;

        $slidernumber = 3;
        if(isset($this->config->slidernumber)){
            $slidernumber = $this->config->slidernumber;
        }

        if(!empty($this->config->top_title)){$this->content->top_title = $this->config->top_title;} else {$this->content->top_title = '';}
        if(!empty($this->config->title)){$this->content->title = $this->config->title;} else {$this->content->title = '';}
        if(isset($this->config->body) && !empty($this->config->body)){$this->content->body = $this->config->body;}else{$this->content->body = '';}
       
        $text = '';
        $text .= '
        <!-- Start Advisor Area -->
        <div class="advisor-area bg-f9f9f9 ptb-100">
            <div class="container">';
                if($this->content->top_title || $this->content->title || $this->content->body){
                    $text .= '
                    <div class="section-title">
                        <span class="sub-title">'.$this->content->top_title.'</span>
                        <h2>'.$this->content->title.'​</h2>
                        <p>'.$this->content->body.'</p>
                    </div>';
                }  $text .= '
                <div class="advisor-slides owl-carousel owl-theme">';
                    for($i = 1; $i <= $slidernumber; $i++) {
                        $instructor_name         = 'instructor_name' . $i;
                        $instructor_designation  = 'instructor_designation' . $i;
                        $instructor_img          = 'instructor_img' . $i;
                        $instructor_content      = 'instructor_content' . $i;
                        $social_1_icon      = 'social_1_icon' . $i;
                        $social_1_link      = 'social_1_link' . $i;
                        $social_2_icon      = 'social_2_icon' . $i;
                        $social_2_link      = 'social_2_link' . $i;
                        $social_3_icon      = 'social_3_icon' . $i;
                        $social_3_link      = 'social_3_link' . $i;
                        $social_4_icon      = 'social_4_icon' . $i;
                        $social_4_link      = 'social_4_link' . $i;
                        $social_5_icon      = 'social_5_icon' . $i;
                        $social_5_link      = 'social_5_link' . $i;

                        if(isset($this->config->$social_1_icon)) { $social_1_icon = $this->config->$social_1_icon; }else{ $social_1_icon = ''; }
                        if(isset($this->config->$social_1_link)) { $social_1_link = $this->config->$social_1_link; }else{ $social_1_link = ''; }

                        if(isset($this->config->$social_2_icon)) { $social_2_icon = $this->config->$social_2_icon; }else{ $social_2_icon = ''; }
                        if(isset($this->config->$social_2_link)) { $social_2_link = $this->config->$social_2_link; }else{ $social_2_link = ''; }

                        if(isset($this->config->$social_3_icon)) { $social_3_icon = $this->config->$social_3_icon; }else{ $social_3_icon = ''; }
                        if(isset($this->config->$social_3_link)) { $social_3_link = $this->config->$social_3_link; }else{ $social_3_link = ''; }

                        if(isset($this->config->$social_4_icon)) { $social_4_icon = $this->config->$social_4_icon; }else{ $social_4_icon = ''; }
                        if(isset($this->config->$social_4_link)) { $social_4_link = $this->config->$social_4_link; }else{ $social_4_link = ''; }

                        if(isset($this->config->$social_5_icon)) { $social_5_icon = $this->config->$social_5_icon; }else{ $social_5_icon = ''; }
                        if(isset($this->config->$social_5_link)) { $social_5_link = $this->config->$social_5_link; }else{ $social_5_link = ''; }


                        if(isset($this->config->$instructor_name)) { $instructor_name = $this->config->$instructor_name; }else{ $instructor_name = ''; }

                        if(isset($this->config->$instructor_designation)) { $instructor_designation = $this->config->$instructor_designation; }else{ $instructor_designation = ''; }

                        if(isset($this->config->$instructor_img)) { $instructor_img = $this->config->$instructor_img; }else{ $instructor_img = ''; }

                        if(isset($this->config->$instructor_content)) { $instructor_content = $this->config->$instructor_content; }else{ $instructor_content = ''; }
                        $text .= '
                        <div class="single-advisor-box">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-md-4">
                                    <div class="advisor-image">';
                                        if($instructor_img):
                                            $text .= '
                                            <img src="'.edmo_block_image_process($instructor_img).'" alt="'.$instructor_name.'">';
                                        endif;
                                        $text .= '
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="advisor-content">
                                        <h3>'.$instructor_name.'</h3>
                                        <span class="sub-title">'.$instructor_designation.'</span>
                                        <p>'.$instructor_content.'</p>
                                        
                                        <ul class="social-link">';
                                            if($social_1_icon):
                                                $text .= '
                                                <li><a href="'.$social_1_link.'" class="d-block" target="_blank"><i class="'.$social_1_icon.'"></i></a></li>';
                                            endif;

                                            if($social_2_icon):
                                                $text .= '
                                                <li><a href="'.$social_2_link.'" class="d-block" target="_blank"><i class="'.$social_2_icon.'"></i></a></li>';
                                            endif;

                                            if($social_3_icon):
                                                $text .= '
                                                <li><a href="'.$social_3_link.'" class="d-block" target="_blank"><i class="'.$social_3_icon.'"></i></a></li>';
                                            endif;

                                            if($social_4_icon):
                                                $text .= '
                                                <li><a href="'.$social_4_link.'" class="d-block" target="_blank"><i class="'.$social_4_icon.'"></i></a></li>';
                                            endif;

                                            if($social_5_icon):
                                                $text .= '
                                                <li><a href="'.$social_5_link.'" class="d-block" target="_blank"><i class="'.$social_5_icon.'"></i></a></li>';
                                            endif;
                                            $text .= '
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    } $text .= '
                </div>
            </div>
        </div>
        <!-- End Advisor Area -->';

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