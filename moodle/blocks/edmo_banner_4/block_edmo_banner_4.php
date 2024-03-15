<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');

class block_edmo_banner_4 extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_banner_4');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->title = 'Build Skills With Experts Any Time, Anywhere';
            $this->config->body = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
            $this->config->btn = 'Search Now';
            $this->config->search_placeholder = 'What do you want to learn?';
            $this->config->link_title = 'Popular:';
            $this->config->links = '<li><a href="#">Development</a></li>';
            $this->config->icon = 'flaticon-search';
            $this->config->class = '';

            $this->config->features_title1 = '10,000 Online Courses';
            $this->config->icon1 = 'flaticon-brain-process';
            $this->config->features_content1 = 'Lorem ipsum dolor sit amet consectets.';

            $this->config->features_title2 = 'Experts Teachers';
            $this->config->icon2 = 'flaticon-people';
            $this->config->features_content2 = 'Lorem ipsum dolor sit amet consectets.';

            $this->config->features_title3 = 'Lifetime Accesss';
            $this->config->icon3 = 'flaticon-world';
            $this->config->features_content3 = 'Lorem ipsum dolor sit amet consectets.';
        }
    }

    public function get_content() {
        global $CFG, $DB, $COURSE, $USER, $PAGE;
        require_once($CFG->libdir . '/filelib.php');

        if ($this->content !== null) {
            return $this->content;
        }
        $this->content  =  new stdClass;
        $featuresnumber = 3;
        if(isset($this->config->featuresnumber)){
            $featuresnumber = $this->config->featuresnumber;
        }

        if(!empty($this->config->class)){$this->content->class = $this->config->class;} else {$this->content->class = '';}
        if(!empty($this->config->title)){$this->content->title = $this->config->title;} else {$this->content->title = '';}
        if(!empty($this->config->body)){$this->content->body = $this->config->body;} else {$this->content->body = '';}
        if(!empty($this->config->btn)){$this->content->btn = $this->config->btn;} else {$this->content->btn = '';}
        if(!empty($this->config->icon)){$this->content->icon = $this->config->icon;} else {$this->content->icon = '';}
        if(!empty($this->config->search_placeholder)){$this->content->search_placeholder = $this->config->search_placeholder;} else {$this->content->search_placeholder = '';}
        if(!empty($this->config->link_title)){$this->content->link_title = $this->config->link_title;} else {$this->content->link_title = '';}
        if(!empty($this->config->links)){$this->content->links = $this->config->links;} else {$this->content->links = '';}

        if (\core_search\manager::is_global_search_enabled() === false) {
            $this->content->search_placeholder = '';
        }else{
            if(isset($this->config->search_placeholder) && !empty($this->config->search_placeholder)){
                $this->content->search_placeholder = $this->config->search_placeholder;
            }else{
                $this->content->search_placeholder = '';
            }
        }

        $url = new moodle_url('/search/index.php');

        $shape_img1 = 'shape_img1';
        if(isset($this->config->$shape_img1) && !empty($this->config->$shape_img1)){$this->content->$shape_img1 = $this->config->$shape_img1;}else{$this->content->$shape_img1 = '';}
        
        $shape_img2 = 'shape_img2';
        if(isset($this->config->$shape_img2) && !empty($this->config->$shape_img2)){$this->content->$shape_img2 = $this->config->$shape_img2;}else{$this->content->$shape_img2 = '';}
        
        $shape_img3 = 'shape_img3';
        if(isset($this->config->$shape_img3) && !empty($this->config->$shape_img3)){$this->content->$shape_img3 = $this->config->$shape_img3;}else{$this->content->$shape_img3 = '';}

        $fs = get_file_storage();
        $files = $fs->get_area_files($this->context->id, 'block_edmo_banner_4', 'content');

        $text = '';
        $text .= '
        <!-- Start Main Banner Area -->
        <div class="banner-wrapper-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="banner-wrapper-content">
                            <h1>'.$this->content->title.'</h1>
                            <p>'.$this->content->body.'</p>';

                            if($this->content->search_placeholder):
                                $text .= '
                                <form class="search-box" action="'.$url->out().'">
                                    <label><i class="'.$this->content->icon.'"></i></label>
                                    <input type="text" class="input-search" name="q" placeholder="'.$this->content->search_placeholder.'">
                                    <button type="submit">'.$this->content->btn.'</button>
                                </form>';
                            endif;

                            if($this->content->link_title):
                                $text .='
                                <ul class="popular-search-list">
                                    <li><span>'.$this->content->link_title.'</span></li>
                                    '.$this->content->links.'
                                </ul>';
                            endif;
                            $text .='
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="banner-wrapper-image">';
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
                                <div class="banner-shape8" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'"></div>';
                            endif;

                            if($this->content->shape_img2):
                                $shape_img2 = $this->content->shape_img2;
                                $text .= '
                                <div class="banner-shape9" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img2).'" alt="'.$this->content->title.'"></div>';
                            endif;

                            if($this->content->shape_img3):
                                $shape_img3 = $this->content->shape_img3;
                                $text .= '
                                <div class="banner-shape10" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img3).'" alt="'.$this->content->title.'"></div>';
                            endif;
                            $text .= '
                        </div>
                    </div>
                </div>

                <div class="banner-inner-area">
                    <div class="row justify-content-center">';
                        for($i = 1; $i <= $featuresnumber; $i++) {
                            $features_title         = 'features_title' . $i;
                            $icon                   = 'icon' . $i;
                            $features_content       = 'features_content' . $i;

                            if(isset($this->config->$features_title)) { $features_title = $this->config->$features_title; }else{ $features_title = ''; }

                            if(isset($this->config->$features_content)) { $features_content = $this->config->$features_content; }else{ $features_content = ''; }

                            if(isset($this->config->$icon)) { $icon = $this->config->$icon; }else{ $icon = ''; }
                            $text .= '
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="single-banner-box">
                                    <div class="icon">
                                        <i class="'.$icon.'"></i>
                                    </div>
                                    <h3>'.$features_title.'</h3>
                                    <p>'.$features_content.'</p>
                                </div>
                            </div>';
                        } $text .= '
                    </div>
                </div>
            </div>
            <div class="divider"></div>
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