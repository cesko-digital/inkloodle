<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');

class block_edmo_about_area extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_about_area');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->top_title = 'Education for everyone';
            $this->config->title = 'Develop Your Skills, Learn Something New, and Grow Your Skills From Anywhere in the World!';
            $this->config->body = 'We understand better that online-based learning can make a significant change to reach students from all over the world! Giving options to learn better always can offer the best outcomes!';
            $this->config->btn = 'View All Courses';
            $this->config->icon = 'flaticon-user';
            $this->config->btn_link = $CFG->wwwroot . '/course';
            $this->config->featuresnumber = 4;

            $this->config->features_title1 = 'Expert Trainers';
            $this->config->icon1 = 'flaticon-experience';

            $this->config->features_title2 = 'Lifetime Access';
            $this->config->icon2 = 'flaticon-time-left';

            $this->config->features_title3 = 'Remote Learning';
            $this->config->icon3 = 'flaticon-tutorials';

            $this->config->features_title4 = 'Self Development';
            $this->config->icon4 = 'flaticon-self-growth';
            $this->config->style = 1;
            $this->config->class = '';
        }
    }

    public function get_content() {
        global $CFG, $DB, $COURSE, $USER, $PAGE;
        require_once($CFG->libdir . '/filelib.php');

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content         =  new stdClass;

        $style = 1;
        if(isset($this->config->style)){
            $style = $this->config->style;
        }
        $featuresnumber = 4;
        if(isset($this->config->featuresnumber)){
            $featuresnumber = $this->config->featuresnumber;
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
        $files = $fs->get_area_files($this->context->id, 'block_edmo_about_area', 'content');

        $text = '';
        if($style == 1):
            $text .= '
            <!-- Start About Area -->
            <div class="about-area bg-fef8ef ptb-100  '.$this->content->class.'">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12">';
                        if($files):
                            $text .= '
                            <div class="about-image">
                                <div class="row">';
                                    $i = 1;
                                    foreach ($files as $file) {
                                        $filename = $file->get_filename();
                                        if ($filename <> '.') {
                                            $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), null, $file->get_filepath(), $filename);
                                            $text .= '

                                            <div class="col-lg-6 col-sm-6 col-md-6 col-6">';
                                                if( $i == 1):
                                                    $text .= '<div class="image wow fadeInLeft">';
                                                elseif($i == 2):
                                                    $text .= '<div class="image wow fadeInDown">';
                                                elseif($i == 3):
                                                    $text .= '<div class="image wow fadeInUp">';
                                                elseif($i == 4):
                                                    $text .= '<div class="image wow fadeInRight">';
                                                else:
                                                    $text .= '<div class="image wow fadeInLeft">';
                                                endif;
                                                    $text .= '
                                                    <img src="'. $url.'" alt="'. $filename.'">
                                                </div>
                                            </div>';
                                        }
                                        $i++;
                                    }
                                    $text .= '
                                </div>
                            </div>';
                        endif;
                        $text .= '
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="about-content">
                                <span class="sub-title">'.$this->content->top_title.'</span>
                                <h2>'.$this->content->title.'</h2>
                                <p>'.$this->content->body.'</p>

                                <ul class="features-list">';
                                    for($i = 1; $i <= $featuresnumber; $i++) {
                                        $features_title         = 'features_title' . $i;
                                        $icon                   = 'icon' . $i;
                                        if(isset($this->config->$features_title)) { $features_title = $this->config->$features_title; }else{ $features_title = ''; }
                                        if(isset($this->config->$icon)) { $icon = $this->config->$icon; }else{ $icon = ''; }
                                        $text .= '
                                        <li><span><i class="'.$icon.'"></i> '.$features_title.'</span></li>';
                                    } $text .= '
                                </ul>';

                                if(!empty($this->content->btn) && !empty($this->content->btn_link)){
                                    $text .= '
                                    <a href="'.$this->content->btn_link.'" class="default-btn"><i class="flaticon-user"></i>'.$this->content->btn.'<span></span></a>';
                                }
                                $text .= '
                            </div>
                        </div>
                    </div>
                </div>';
                
                if($this->content->shape_img1):
                    $shape_img1 = $this->content->shape_img1;
                    $text .= '
                    <div class="shape1" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'"></div>';
                endif;

                if($this->content->shape_img2):
                    $shape_img2 = $this->content->shape_img2;
                    $text .= '
                    <div class="shape2" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img2).'" alt="'.$this->content->title.'"></div>';
                endif;

                if($this->content->shape_img3):
                    $shape_img3 = $this->content->shape_img3;
                    $text .= '
                    <div class="shape3" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img3).'" alt="'.$this->content->title.'"></div>';
                endif;

                if($this->content->shape_img4):
                    $shape_img4 = $this->content->shape_img4;
                    $text .= '
                    <div class="shape4" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img4).'" alt="'.$this->content->title.'"></div>';
                endif;
                $text .= '
            </div>
            <!-- End About Area -->';
        elseif($style == 2):
            $text .= '
            <!-- Start About Area -->
            <div class="about-area ptb-100  '.$this->content->class.'">
                <div class="container">
                    <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">';
                        if($files):
                            $text .= '
                            <div class="about-image text-center">';
                                $i = 1;
                                foreach ($files as $file) {
                                    $filename = $file->get_filename();
                                    if ($filename <> '.') {
                                        $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), null, $file->get_filepath(), $filename);
                                        $text .= '
                                        <img src="'. $url.'" alt="'. $filename.'">';
                                    }
                                    $i++;
                                }
                                $text .= '
                            </div>';
                        endif;
                        $text .= '
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="about-content">
                                <span class="sub-title">'.$this->content->top_title.'</span>
                                <h2>'.$this->content->title.'</h2>
                                <p>'.$this->content->body.'</p>

                                <ul class="features-list">';
                                    for($i = 1; $i <= $featuresnumber; $i++) {
                                        $features_title         = 'features_title' . $i;
                                        $icon                   = 'icon' . $i;
                                        if(isset($this->config->$features_title)) { $features_title = $this->config->$features_title; }else{ $features_title = ''; }
                                        if(isset($this->config->$icon)) { $icon = $this->config->$icon; }else{ $icon = ''; }
                                        $text .= '
                                        <li><span><i class="'.$icon.'"></i> '.$features_title.'</span></li>';
                                    } $text .= '
                                </ul>';

                                if(!empty($this->content->btn) && !empty($this->content->btn_link)){
                                    $text .= '
                                    <a href="'.$this->content->btn_link.'" class="default-btn"><i class="flaticon-user"></i>'.$this->content->btn.'<span></span></a>';
                                }
                                $text .= '
                            </div>
                        </div>
                    </div>
                </div>';
                
                if($this->content->shape_img1):
                    $shape_img1 = $this->content->shape_img1;
                    $text .= '
                    <div class="shape1" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'"></div>';
                endif;

                if($this->content->shape_img2):
                    $shape_img2 = $this->content->shape_img2;
                    $text .= '
                    <div class="shape2" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img2).'" alt="'.$this->content->title.'"></div>';
                endif;

                if($this->content->shape_img3):
                    $shape_img3 = $this->content->shape_img3;
                    $text .= '
                    <div class="shape3" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img3).'" alt="'.$this->content->title.'"></div>';
                endif;

                if($this->content->shape_img4):
                    $shape_img4 = $this->content->shape_img4;
                    $text .= '
                    <div class="shape4" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img4).'" alt="'.$this->content->title.'"></div>';
                endif;
                $text .= '
            </div>
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