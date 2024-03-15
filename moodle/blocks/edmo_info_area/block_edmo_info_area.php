<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');

class block_edmo_info_area extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_info_area');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->top_title = 'GET INSTANT ACCESS TO THE FREE';
            $this->config->title = 'Self Development Course';
            $this->config->body = 'Edmo Self Development Course can assist you in bringing the significant changes in personal understanding and reshaping the confidence to achieve the best from your career! We trust that learning should be enjoyable, and only that can make substantial changes to someone!';
            $this->config->btn = 'Start For Free';
            $this->config->icon = 'flaticon-user';
            $this->config->class = '';
            $this->config->btn_link = $CFG->wwwroot . '/course';
            $this->config->style = 1;
        }
    }

    public function get_content() {
        global $CFG, $DB, $COURSE, $USER, $PAGE;
        require_once($CFG->libdir . '/filelib.php');

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content  =  new stdClass;

        $style = 1;
        if(isset($this->config->style)){
            $style = $this->config->style;
        }

        if(!empty($this->config->class)){$this->content->class = $this->config->class;} else {$this->content->class = '';}

        if(!empty($this->config->top_title)){$this->content->top_title = $this->config->top_title;} else {$this->content->top_title = '';}

        if(!empty($this->config->title)){$this->content->title = $this->config->title;} else {$this->content->title = '';}

        if(!empty($this->config->body)){$this->content->body = $this->config->body;} else {$this->content->body = '';}

        if(!empty($this->config->btn)){$this->content->btn = $this->config->btn;} else {$this->content->btn = '';}

        if(!empty($this->config->btn_link)){$this->content->btn_link = $this->config->btn_link;} else {$this->content->btn_link = '';}

        if(!empty($this->config->icon)){$this->content->icon = $this->config->icon;} else {$this->content->icon = '';}

        $shape_img1 = 'shape_img1';
        if(isset($this->config->$shape_img1) && !empty($this->config->$shape_img1)){$this->content->$shape_img1 = $this->config->$shape_img1;}else{$this->content->$shape_img1 = '';}
        
        $shape_img2 = 'shape_img2';
        if(isset($this->config->$shape_img2) && !empty($this->config->$shape_img2)){$this->content->$shape_img2 = $this->config->$shape_img2;}else{$this->content->$shape_img2 = '';}

        $shape_img3 = 'shape_img3';
        if(isset($this->config->$shape_img3) && !empty($this->config->$shape_img3)){$this->content->$shape_img3 = $this->config->$shape_img3;}else{$this->content->$shape_img3 = '';}

        $shape_img4 = 'shape_img4';
        if(isset($this->config->$shape_img4) && !empty($this->config->$shape_img4)){$this->content->$shape_img4 = $this->config->$shape_img4;}else{$this->content->$shape_img4 = '';}

        $fs = get_file_storage();
        $files = $fs->get_area_files($this->context->id, 'block_edmo_info_area', 'content');

        $text = '';
        if($style == 1):
            $text .= '
            <!-- Start Get Instant Courses Area -->
            <div class="get-instant-courses-area '.$this->content->class.'">
                <div class="container">
                    <div class="get-instant-courses-inner-area">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-12">
                                <div class="get-instant-courses-content">
                                    <span class="sub-title">'.$this->content->top_title.'</span>
                                    <h2>'.$this->content->title.'</h2>
                                    <p>'.$this->content->body.'</p>';
                                    if(!empty($this->content->btn) && !empty($this->content->btn_link)){
                                        $text .= '
                                        <a href="'.$this->content->btn_link.'" class="default-btn"><i class="'.$this->content->icon.'"></i>'.$this->content->btn.'<span></span></a>';
                                    }
                                    $text .= '
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="get-instant-courses-image">';
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
                                    if($this->content->shape_img1):
                                        $shape_img1 = $this->content->shape_img1;
                                        $text .= '
                                        <div class="shape7"><img src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'"></div>';
                                    endif;

                                    if($this->content->shape_img2):
                                        $shape_img2 = $this->content->shape_img2;
                                        $text .= '
                                        <div class="shape6"><img src="'.edmo_block_image_process($shape_img2).'" alt="'.$this->content->title.'"></div>';
                                    endif;
                                    $text .= '
                                </div>
                            </div>
                        </div>';
                        if($this->content->shape_img3):
                            $shape_img3 = $this->content->shape_img3;
                            $text .= '
                            <div class="shape5"><img src="'.edmo_block_image_process($shape_img3).'" alt="'.$this->content->title.'"></div>';
                        endif;
                        $text .= '
                    </div>
                </div>
            </div>
            <!-- End Get Instant Courses Area -->';
        elseif($style == 2):
            $text .= '
            <!-- Start View All Courses Area -->
            <div class="view-all-courses-area bg-fef8ef '.$this->content->class.'">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="view-all-courses-content">

                                <span class="sub-title">'.$this->content->top_title.'</span>
                                <h2>'.$this->content->title.'</h2>
                                <p>'.$this->content->body.'</p>';
                                if(!empty($this->content->btn) && !empty($this->content->btn_link)){
                                    $text .= '
                                    <a href="'.$this->content->btn_link.'" class="default-btn"><i class="'.$this->content->icon.'"></i>'.$this->content->btn.'<span></span></a>';
                                }
                                $text .= '
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="view-all-courses-image">';
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
                    <div class="shape1"><img src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'"></div>';
                endif;

                if($this->content->shape_img2):
                    $shape_img2 = $this->content->shape_img2;
                    $text .= '
                    <div class="shape9"><img src="'.edmo_block_image_process($shape_img2).'" alt="'.$this->content->title.'"></div>';
                endif;
                $text .= '
            </div>
            <!-- End View All Courses Area -->';
        elseif($style == 3):
            $text .= '
            <!-- Start Premium Access Area -->
            <div class="premium-access-area ptb-100 '.$this->content->class.'">
                <div class="container">
                    <div class="premium-access-content">
                        <span class="sub-title">'.$this->content->top_title.'</span>
                        <h2>'.$this->content->title.'</h2>
                        <p>'.$this->content->body.'</p>';
                        if(!empty($this->content->btn) && !empty($this->content->btn_link)){
                            $text .= '
                            <a href="'.$this->content->btn_link.'" class="default-btn"><i class="'.$this->content->icon.'"></i>'.$this->content->btn.'<span></span></a>';
                        }
                        $text .= '
                    </div>
                </div>';

                
                if($this->content->shape_img1):
                    $shape_img1 = $this->content->shape_img1;
                    $text .= '
                    <div class="shape3"><img src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'"></div>';
                endif;

                if($this->content->shape_img2):
                    $shape_img2 = $this->content->shape_img2;
                    $text .= '
                    <div class="shape4"><img src="'.edmo_block_image_process($shape_img2).'" alt="'.$this->content->title.'"></div>';
                endif;

                if($this->content->shape_img3):
                    $shape_img3 = $this->content->shape_img3;
                    $text .= '
                    <div class="shape8"><img src="'.edmo_block_image_process($shape_img3).'" alt="'.$this->content->title.'"></div>';
                endif;
                $text .= '
            </div>
            <!-- End Premium Access Area -->';
        elseif($style == 4):
            $text .= '
            <!-- Start View All Courses Area -->
            <section class="view-all-courses-area-two ptb-70 bg-fef8ef  '.$this->content->class.'">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">
                            <div class="view-all-courses-content">
                                <span class="sub-title">'.$this->content->top_title.'</span>
                                <h2>'.$this->content->title.'</h2>
                                <p>'.$this->content->body.'</p>';
                                if(!empty($this->content->btn) && !empty($this->content->btn_link)){
                                    $text .= '
                                    <a href="'.$this->content->btn_link.'" class="default-btn"><i class="'.$this->content->icon.'"></i>'.$this->content->btn.'<span></span></a>';
                                }
                                $text .= '
                            </div>
                        </div>
            
                        <div class="col-lg-6 col-md-12">
                            <div class="view-all-courses-image">';
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
                                
                                if($this->content->shape_img1):
                                    $shape_img1 = $this->content->shape_img1;
                                    $text .= '
                                    <div class="shape11"><img src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'"></div>';
                                endif;
                
                                if($this->content->shape_img2):
                                    $shape_img2 = $this->content->shape_img2;
                                    $text .= '
                                    <div class="shape12"><img src="'.edmo_block_image_process($shape_img2).'" alt="'.$this->content->title.'"></div>';
                                endif;
                                $text .= '
                                ';
                                if($text){

                                }
                    
                                $text .='
                            </div>
                        </div>
                    </div>
                </div>';

                if($this->content->shape_img3):
                    $shape_img3 = $this->content->shape_img3;
                    $text .= '
                    <div class="shape1"><img src="'.edmo_block_image_process($shape_img3).'" alt="'.$this->content->title.'"></div>';
                endif;

                if($this->content->shape_img4):
                    $shape_img4 = $this->content->shape_img4;
                    $text .= '
                    <div class="shape9"><img src="'.edmo_block_image_process($shape_img4).'" alt="'.$this->content->title.'"></div>';
                endif;
                $text .= '
            </section>
            <!-- End View All Courses Area -->';
        endif;
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