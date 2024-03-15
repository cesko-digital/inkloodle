<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');
class block_edmo_features extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_features');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->top_title = 'EDUCATION FOR EVERYONE';
            $this->config->title = 'The World’s Leading Distance Learning Provider';
            $this->config->body = 'Flexible easy to access learning opportunities can bring a significant change in how individuals prefer to learn! The Edmo can offer you to enjoy the beauty of eLearning!';

            $this->config->features_title1 = 'Learn the Latest Top Skills';
            $this->config->icon1 = 'flaticon-brain-process';
            $this->config->features_content1 = 'Learning top skills can bring an extra-ordinary outcome in a career.';
            $this->config->features_btn_title1 = 'Start Now!';
            $this->config->btn_link1 = $CFG->wwwroot . '/course';

            $this->config->features_title2 = 'Learn in Your Own Pace';
            $this->config->icon2 = 'flaticon-computer';
            $this->config->features_content2 = 'Everyone prefers to enjoy learning at their own pace & that gives a great result.';
            $this->config->features_btn_title2 = 'Start Now!';
            $this->config->btn_link2 = $CFG->wwwroot . '/course';

            $this->config->features_title3 = 'Learn From Industry Experts';
            $this->config->icon3 = 'flaticon-shield-1';
            $this->config->features_content3 = 'Experienced teachers can assist in learning faster with their best approaches!';
            $this->config->features_btn_title3 = 'Start Now!';
            $this->config->btn_link3 = $CFG->wwwroot . '/course';

            $this->config->features_title4 = 'Enjoy Learning From Anywhere';
            $this->config->icon4 = 'flaticon-brain-process';
            $this->config->features_content4 = 'We are delighted to give you options to enjoy learning from anywhere in the world.';
            $this->config->features_btn_title4 = 'Start Now!';
            $this->config->btn_link4 = $CFG->wwwroot . '/course';
            $this->config->style = 1;
        }
    }

    public function get_content() {
        global $CFG, $DB;

        $this->content         =  new stdClass;

        $featuresnumber = 4;
        if(isset($this->config->featuresnumber)){
            $featuresnumber = $this->config->featuresnumber;
        }
        
        $style = 1;
        if(isset($this->config->style)){
            $style = $this->config->style;
        }

        if(!empty($this->config->top_title)){$this->content->top_title = $this->config->top_title;} else {$this->content->top_title = '';}
        if(!empty($this->config->title)){$this->content->title = $this->config->title;} else {$this->content->title = '';}
        if(isset($this->config->body) && !empty($this->config->body)){$this->content->body = $this->config->body;}else{$this->content->body = '';}
       
        $text = '';
        if($style == 2):
            $text .= '
            <!-- Start Features Area -->
            <div class="features-area pt-100 pb-70">
                <div class="container">';
                    if($this->content->top_title || $this->content->title || $this->content->body){
                        $text .= '
                        <div class="section-title">
                            <span class="sub-title">'.$this->content->top_title.'</span>
                            <h2>'.$this->content->title.'​</h2>
                            <p>'.$this->content->body.'</p>
                        </div>';
                    }  $text .= '
                    <div class="row justify-content-center">';
                        for($i = 1; $i <= $featuresnumber; $i++) {
                            $features_title         = 'features_title' . $i;
                            $icon                   = 'icon' . $i;
                            $features_content       = 'features_content' . $i;
                            $features_btn_title     = 'features_btn_title' . $i;
                            $btn_link               = 'btn_link' . $i;

                            if(isset($this->config->$features_title)) { $features_title = $this->config->$features_title; }else{ $features_title = ''; }

                            if(isset($this->config->$features_content)) { $features_content = $this->config->$features_content; }else{ $features_content = ''; }

                            if(isset($this->config->$icon)) { $icon = $this->config->$icon; }else{ $icon = ''; }

                            if(isset($this->config->$features_btn_title)) { $features_btn_title = $this->config->$features_btn_title; }else{ $features_btn_title = ''; }

                            if(isset($this->config->$btn_link)) { $btn_link = $this->config->$btn_link; }else{ $btn_link = ''; }

                            $grid_class = 'col-lg-4 col-sm-6 col-md-6';

                            $text .= '
                        
                            <div class="'.$grid_class.'">
                                <div class="single-features-box without-padding">
                                    <div class="icon">
                                        <i class="'.$icon.'"></i>
                                    </div>
                                    <h3>'.$features_title.'</h3>
                                    <p>'.$features_content.'</p>';
                                    
                                    if(!empty($features_btn_title) && !empty($btn_link)){
                                        $text .= '
                                        <a href="'.$btn_link.'" class="link-btn">'.$features_btn_title.'</a>';
                                    }
                                    $text .= '
                                </div>
                            </div>';
                        } $text .= '
                    </div>
                </div>
            </div>
            <!-- End Features Area -->';
        else:
        $text .= '
            <!-- Start Features Area -->
            <div class="features-area pt-100 pb-70">
                <div class="container">';
                    if($this->content->top_title || $this->content->title || $this->content->body){
                        $text .= '
                        <div class="section-title">
                            <span class="sub-title">'.$this->content->top_title.'</span>
                            <h2>'.$this->content->title.'​</h2>
                            <p>'.$this->content->body.'</p>
                        </div>';
                    }  $text .= '
                    <div class="row">';
                        for($i = 1; $i <= $featuresnumber; $i++) {
                            $features_title         = 'features_title' . $i;
                            $icon                   = 'icon' . $i;
                            $features_content       = 'features_content' . $i;
                            $features_btn_title     = 'features_btn_title' . $i;
                            $btn_link               = 'btn_link' . $i;

                            if(isset($this->config->$features_title)) { $features_title = $this->config->$features_title; }else{ $features_title = ''; }

                            if(isset($this->config->$features_content)) { $features_content = $this->config->$features_content; }else{ $features_content = ''; }

                            if(isset($this->config->$icon)) { $icon = $this->config->$icon; }else{ $icon = ''; }

                            if(isset($this->config->$features_btn_title)) { $features_btn_title = $this->config->$features_btn_title; }else{ $features_btn_title = ''; }

                            if(isset($this->config->$btn_link)) { $btn_link = $this->config->$btn_link; }else{ $btn_link = ''; }

                            $grid_class = 'col-lg-3 col-sm-6 col-md-6';

                            $text .= '
                        
                            <div class="'.$grid_class.'">
                                <div class="single-features-box">
                                    <div class="icon">
                                        <i class="'.$icon.'"></i>
                                    </div>
                                    <h3>'.$features_title.'</h3>
                                    <p>'.$features_content.'</p>';
                                    
                                    if(!empty($features_btn_title) && !empty($btn_link)){
                                        $text .= '
                                        <a href="'.$btn_link.'" class="link-btn">'.$features_btn_title.'</a>';
                                    }
                                    $text .= '
                                </div>
                            </div>';
                        } $text .= '
                        
                    </div>
                </div>
            </div>
            <!-- End Features Area -->';
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