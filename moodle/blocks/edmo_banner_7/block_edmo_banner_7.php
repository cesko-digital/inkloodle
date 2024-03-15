<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');

class block_edmo_banner_7 extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_banner_7');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->title = 'Accredited Online Yoga Teacher Training';
            $this->config->body = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
            $this->config->btn = 'Join For Free';
            $this->config->btn_link = $CFG->wwwroot . '/course';
            $this->config->icon = 'flaticon-user';
            $this->config->bg = $CFG->wwwroot . '/theme/edmo/pix/main-banner3.jpg';
            $this->config->bg_shape = $CFG->wwwroot . '/theme/edmo/pix/yoga-banner.png';
            $this->config->shape_img1 = $CFG->wwwroot . '/theme/edmo/pix/top-img.png';
            $this->config->shape_img2 = $CFG->wwwroot . '/theme/edmo/pix/banner-shape2.png';
            $this->config->shape_img3 = $CFG->wwwroot . '/theme/edmo/pix/banner-shape3.png';
            
        }
    }

    public function get_content() {
        global $CFG, $DB, $COURSE, $USER, $PAGE;

        if ($this->content !== null) {
            return $this->content;
        }
        $this->content  =  new stdClass;
        
        $title = !empty($this->config->title) ? $this->config->title : '';


        if(!empty($this->config->body)){$this->content->body = $this->config->body;} else {$this->content->body = '';}
        if(!empty($this->config->btn)){$this->content->btn = $this->config->btn;} else {$this->content->btn = '';}
        if(!empty($this->config->btn_link)){$this->content->btn_link = $this->config->btn_link;} else {$this->content->btn_link = '';}
        if(!empty($this->config->icon)){$this->content->icon = $this->config->icon;} else {$this->content->icon = '';}

        $url = new moodle_url('/search/index.php');

        $shape_img1 = 'shape_img1';
        if(isset($this->config->$shape_img1) && !empty($this->config->$shape_img1)){$this->content->$shape_img1 = $this->config->$shape_img1;}else{$this->content->$shape_img1 = '';}
        
        $shape_img2 = 'shape_img2';
        if(isset($this->config->$shape_img2) && !empty($this->config->$shape_img2)){$this->content->$shape_img2 = $this->config->$shape_img2;}else{$this->content->$shape_img2 = '';}
        
        $shape_img3 = 'shape_img3';
        if(isset($this->config->$shape_img3) && !empty($this->config->$shape_img3)){$this->content->$shape_img3 = $this->config->$shape_img3;}else{$this->content->$shape_img3 = '';}

        $icon_shape = 'icon_shape';
        if(isset($this->config->$icon_shape) && !empty($this->config->$icon_shape)){$this->content->$icon_shape = $this->config->$icon_shape;}else{$this->content->$icon_shape = '';}

        $fs = get_file_storage();
        $files = $fs->get_area_files($this->context->id, 'block_edmo_banner_7', 'content');

        $text = '';
        $text .= '
        <!-- Start Main Banner Area -->';
        if($files):
            foreach ($files as $file) {
                $filename = $file->get_filename();
                if ($filename <> '.') {
                    $url = moodle_url::make_pluginfile_url($file->get_contextid(), $file->get_component(), $file->get_filearea(), null, $file->get_filepath(), $filename);
                    $text .= '
                    <div class="banner-wrapper jarallax" data-jarallax="{"speed": 0.3}" style="background-image:url('. $url.');">';
                }
            }
        else:
            $text .= '<div class="banner-wrapper jarallax" data-jarallax="{"speed": 0.3}">';
        endif;
        $text .= '
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="banner-wrapper-text">
                            <h1>'.$this->content->title.'</h1>
                            <p>'.$this->content->body.'</p>';
                            if($this->content->btn):
                                $text .= '
                                <a href="'.$this->content->btn_link.'" class="default-btn"><i class="'.$this->content->icon.'"></i>'.$this->content->btn.'<span></span></a>';
                            endif;
                            $text .= '
                        </div>
                    </div>
                </div>
            </div>';

            if($this->content->shape_img1):
                $shape_img1 = $this->content->shape_img1;
                $text .= '
                <div class="banner-shape11" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'"></div>';
            endif;

            if($this->content->shape_img2):
                $shape_img2 = $this->content->shape_img2;
                $text .= '
                <div class="banner-shape12" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img2).'" alt="'.$this->content->title.'"></div>';
            endif;

            if($this->content->shape_img3):
                $shape_img3 = $this->content->shape_img3;
                $text .= '
                <div class="banner-shape13" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img3).'" alt="'.$this->content->title.'"></div>';
            endif;
            $text .= '
        </div>
        <!-- End Main Banner Area -->

        <!-- Start Boxes Area -->
        <div class="boxes-area bg-f5f7fa">
            <div class="container">
                <div class="row justify-content-center">';
                    for($i = 1; $i <= $featuresnumber; $i++) {
                        $title      = 'features_title' . $i;
                        $icon       = 'icon' . $i;
                        $content    = 'features_content' . $i;
                        $link_title = 'features_link_title' . $i;
                        $link       = 'features_link' . $i;
                        
                        if(isset($this->config->$title)) { $title = $this->config->$title; }else{ $title = ''; }
                        if(isset($this->config->$content)) { $content = $this->config->$content; }else{ $content = ''; }
                        if(isset($this->config->$icon)) { $icon = $this->config->$icon; }else{ $icon = ''; }
                        if(isset($this->config->$link_title)) { $link_title = $this->config->$link_title; }else{ $link_title = ''; }
                        if(isset($this->config->$link)) { $link = $this->config->$link; }else{ $link = ''; }
                        $text .= '
                        <div class="col-lg-4 col-sm-6 col-md-6">
                            <div class="single-box-item">
                                <div class="icon">
                                    <i class="'.$icon.'"></i>';
                                    if($this->content->icon_shape):
                                        $icon_shape = $this->content->icon_shape;
                                        $text .= '
                                        <img src="'.edmo_block_image_process($icon_shape).'" alt="'.$title.'">';
                                    endif;
                                    $text .= '
                                </div>
                                <h3>'.$title.'</h3>
                                <p>'.$content.'</p>';
                                if($link_title):
                                    $text .= '
                                    <a href="'.$link.'" class="link-btn">'.$link_title.'</a>';
                                endif;
                                $text .= '
                            </div>
                        </div>';
                    } $text .= '
                </div>
            </div>
        </div>
        <!-- End Boxes Area -->
        ';
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