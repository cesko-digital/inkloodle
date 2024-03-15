<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');

class block_edmo_video_area extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_video_area');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->video = 'https://www.youtube.com/watch?v=PWvPbGWVRrU';
            $this->config->top_title = 'DISTANCE LEARNING';
            $this->config->title = 'Build Your Project Management Skills Online, Anytime';
            $this->config->body = 'Want to learn and earn PDUs or CEUs on your schedule — anytime, anywhere? Or, pick up a new skill quickly like, project team leadership or agile? Browse our most popular online courses.';
            $this->config->class = '';
            $this->config->btn = 'Explore Learning';
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
        if(!empty($this->config->video)){$this->content->video = $this->config->video;} else {$this->content->video = '';}
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

        $style = 1;
        if(isset($this->config->style)){
            $style = $this->config->style;
        }

        $fs = get_file_storage();
        $files = $fs->get_area_files($this->context->id, 'block_edmo_video_area', 'content');

        $text = '';
        if($style == 2):
            $text .= '
            <!-- Start About Area -->
            <section class="about-area-two pb-100 '.$this->content->class.'">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-12">
                            <div class="about-content-box">
                                <span class="sub-title">'.$this->content->top_title.'</span>
                                <h2>'.$this->content->title.'</h2>
                                '.$this->content->body.'';

                                if($this->content->btn_link):
                                    $text .='
                                    <a href="'.$this->content->btn_link.'" class="link-btn">'.$this->content->btn.'</a>';
                                endif;
                                $text .='
                            </div>
                        </div>
            
                        <div class="col-lg-7 col-md-12">
                            <div class="about-video-box">
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
                                if($this->content->video):
                                    $text .='
                                    <a href="'.$this->content->video.'" class="video-btn popup-youtube"><i class="flaticon-play"></i></a>';
                                endif;

                                if($this->content->shape_img1):
                                    $shape_img1 = $this->content->shape_img1;
                                    $text .= '
                                    <div class="shape10" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'"></div>';
                                endif;
                                $text .= '
                            </div>
                        </div>
                    </div>
                </div>';

                if($this->content->shape_img2):
                    $shape_img2 = $this->content->shape_img2;
                    $text .= '
                    <div class="shape3" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img2).'" alt="'.$this->content->title.'"></div>';
                endif;

                if($this->content->shape_img3):
                    $shape_img3 = $this->content->shape_img3;
                    $text .= '
                    <div class="shape4" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img3).'" alt="'.$this->content->title.'"></div>';
                endif;

                if($this->content->shape_img4):
                    $shape_img4 = $this->content->shape_img4;
                    $text .= '
                    <div class="shape2" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img4).'" alt="'.$this->content->title.'"></div>';
                endif;
                $text .= '
            </section>
            <!-- End About Area -->';
        else:
            $text .= '
            <!-- Start About Area -->
            <section class="about-area-two bg-fffaf3 pt-70 pb-100 '.$this->content->class.'">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-12">
                            <div class="about-content-box">
                                <span class="sub-title">'.$this->content->top_title.'</span>
                                <h2>'.$this->content->title.'</h2>
                                '.$this->content->body.'';

                                if($this->content->btn_link):
                                    $text .='
                                    <a href="'.$this->content->btn_link.'" class="link-btn">'.$this->content->btn.'</a>';
                                endif;
                                $text .='
                            </div>
                        </div>
            
                        <div class="col-lg-7 col-md-12">
                            <div class="about-video-box">
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
                                if($this->content->video):
                                    $text .='
                                    <a href="'.$this->content->video.'" class="video-btn popup-youtube"><i class="flaticon-play"></i></a>';
                                endif;

                                if($this->content->shape_img1):
                                    $shape_img1 = $this->content->shape_img1;
                                    $text .= '
                                    <div class="shape10" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'"></div>';
                                endif;
                                $text .= '
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="divider1"></div>';

                if($this->content->shape_img2):
                    $shape_img2 = $this->content->shape_img2;
                    $text .= '
                    <div class="shape3" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img2).'" alt="'.$this->content->title.'"></div>';
                endif;

                if($this->content->shape_img3):
                    $shape_img3 = $this->content->shape_img3;
                    $text .= '
                    <div class="shape4" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img3).'" alt="'.$this->content->title.'"></div>';
                endif;

                if($this->content->shape_img4):
                    $shape_img4 = $this->content->shape_img4;
                    $text .= '
                    <div class="shape2" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img4).'" alt="'.$this->content->title.'"></div>';
                endif;
                $text .= '
            </section>
            <!-- End About Area -->';
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