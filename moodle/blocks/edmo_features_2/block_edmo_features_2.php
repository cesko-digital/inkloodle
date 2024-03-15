<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');
class block_edmo_features_2 extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_features_2');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->top_title = 'WELCOME TO EDMO';
            $this->config->title = 'Our Language Courses';
            $this->config->body = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

            $this->config->features_title1 = 'Chinese';
            $this->config->features_content1 = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.';
            $this->config->features_btn_title1 = 'View More';
            $this->config->btn_link1 = $CFG->wwwroot . '/course';
        }
    }

    public function get_content() {
        global $CFG, $DB;

        $this->content         =  new stdClass;

        $features_2_number = 1;
        if(isset($this->config->features_2_number)){
            $features_2_number = $this->config->features_2_number;
        }

        if(!empty($this->config->top_title)){$this->content->top_title = $this->config->top_title;} else {$this->content->top_title = '';}
        if(!empty($this->config->title)){$this->content->title = $this->config->title;} else {$this->content->title = '';}
        if(isset($this->config->body) && !empty($this->config->body)){$this->content->body = $this->config->body;}else{$this->content->body = '';}
       
        $text = '';
        $text .= '
        <!-- Start Language Courses Area -->
        <section class="courses-area pt-100 pb-70 bg-f5f7fa">
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
                    for($i = 1; $i <= $features_2_number; $i++) {
                        $features_title         = 'features_2_title' . $i;
                        $img                    = 'features_2_img' . $i;
                        $features_content       = 'features_2_content' . $i;
                        $features_btn_title     = 'features_2_btn_title' . $i;
                        $btn_link               = 'btn_link' . $i;

                        if(isset($this->config->$features_title)) { $features_title = $this->config->$features_title; }else{ $features_title = ''; }

                        if(isset($this->config->$features_content)) { $features_content = $this->config->$features_content; }else{ $features_content = ''; }

                        if(isset($this->config->$img)) { $img = $this->config->$img; }else{ $img = ''; }

                        if(isset($this->config->$features_btn_title)) { $features_btn_title = $this->config->$features_btn_title; }else{ $features_btn_title = ''; }

                        if(isset($this->config->$btn_link)) { $btn_link = $this->config->$btn_link; }else{ $btn_link = ''; }

                        if($i == 3):
                            $grid_class = 'col-lg-4 col-md-6 col-sm-6';
                        else:
                            $grid_class = 'col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-md-3 offset-sm-3';
                        endif;
                        $text .= '
                        <div class="'.$grid_class.'">
                            <div class="single-language-courses-box">';
                                if($img): $text .= '
                                    <img src="'.edmo_block_image_process($img).'" alt="'.$features_title.'">';
                                endif;
                                $text .= '
                                <h3>'.$features_title.'</h3>
                                <p>'.$features_content.'</p>';
                                
                                if(!empty($features_btn_title) && !empty($btn_link)){
                                    $text .= '
                                    <a href="'.$btn_link.'" class="default-btn"><i class="flaticon-right"></i>'.$features_btn_title.'<span></span></a>';
                                }
                                $text .= '
                            </div>
                        </div>';
                    } $text .= '
                </div>
            </div>
        </section>
        <!-- End Language Courses Area -->';

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