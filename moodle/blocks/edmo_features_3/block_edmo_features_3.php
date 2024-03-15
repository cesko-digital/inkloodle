<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');
class block_edmo_features_3 extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_features_3');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->bottom_body = 'If you want more?';
            $this->config->button_text = 'View More Courses';
            $this->config->button_link = $CFG->wwwroot . '/course';

            $this->config->features_title1 = 'Web Development';
            $this->config->features_content1 = 'Lorem ipsum dolor sit amet, consecteur adipiscing elit, sed do eiusmod tempor.';
            $this->config->features_btn_title1 = 'Start Now!';
            $this->config->btn_link1 = $CFG->wwwroot . '/course';
        }
    }

    public function get_content() {
        global $CFG, $DB;

        $this->content         =  new stdClass;

        $features_3_number = 1;
        if(isset($this->config->features_3_number)){
            $features_3_number = $this->config->features_3_number;
        }

        if(!empty($this->config->bottom_body)){$this->content->bottom_body = $this->config->bottom_body;} else {$this->content->bottom_body = '';}

        if(!empty($this->config->button_text)){$this->content->button_text = $this->config->button_text;} else {$this->content->button_text = '';}

        if(!empty($this->config->button_link)){$this->content->button_link = $this->config->button_link;} else {$this->content->button_link = '';}
       
        $text = '';
        $text .= '
        <!-- Start Boxes Area -->
        <section class="boxes-area boxes-style-two bg-f5f7fa">
            <div class="container">
                <div class="row">';
                    for($i = 1; $i <= $features_3_number; $i++) {
                        $features_title         = 'features_3_title' . $i;
                        $img                    = 'features_3_img' . $i;
                        $features_content       = 'features_3_content' . $i;
                        $features_btn_title     = 'features_3_btn_title' . $i;
                        $btn_link               = 'btn_link' . $i;

                        if(isset($this->config->$features_title)) { $features_title = $this->config->$features_title; }else{ $features_title = ''; }

                        if(isset($this->config->$features_content)) { $features_content = $this->config->$features_content; }else{ $features_content = ''; }

                        if(isset($this->config->$img)) { $img = $this->config->$img; }else{ $img = ''; }

                        if(isset($this->config->$features_btn_title)) { $features_btn_title = $this->config->$features_btn_title; }else{ $features_btn_title = ''; }

                        if(isset($this->config->$btn_link)) { $btn_link = $this->config->$btn_link; }else{ $btn_link = ''; }

                        if($i == 3):
                            $grid_class = 'col-lg-4 col-sm-6 col-md-6';
                        else:
                            $grid_class = 'col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-md-3 offset-sm-3';
                        endif;
                        $text .= '
                        <div class="'.$grid_class.'">
                            <div class="single-box-item">';
                                if($img): $text .= '
                                    <div class="image">
                                        <img src="'.edmo_block_image_process($img).'" alt="'.$features_title.'">
                                    </div>';
                                endif;
                                $text .= '
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
                </div>';
                if($this->content->bottom_body || $this->content->button_text):
                    $text .= '
                    <div class="boxes-info">
                        <p>'.$this->content->bottom_body.'';
                        if(!empty($this->content->button_text) && !empty($this->content->button_link)){
                            $text .= '
                            <a href="'.$this->content->button_link.'">'.$this->content->button_text.'</a>';
                        }
                        $text .= '.</p>
                    </div';
                endif; $text .= '
            </div>
        </section>
        <!-- End Boxes Area -->';

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