<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');
class block_edmo_feedback extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_feedback');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->itemsnumber = '3';
            $this->config->item_title1 = 'Ali Tufan';
            $this->config->item_subtitle1 = 'TV Model';
            $this->config->item_text1 = 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et mag na aliqua. Minim veniam, quis nostrud ullamco laboris nisi ut aliquip ex ea commodo conse quatt adipiscing dolore.';
            $this->config->item_title2 = 'Allien Zampa';
            $this->config->item_subtitle2 = 'Developer';
            $this->config->item_text2 = 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et mag na aliqua. Minim veniam, quis nostrud ullamco laboris nisi ut aliquip ex ea commodo conse quatt adipiscing dolore.';
            $this->config->item_title3 = 'Ramos Leo';
            $this->config->item_subtitle3 = 'Designer';
            $this->config->item_text3 = 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et mag na aliqua. Minim veniam, quis nostrud ullamco laboris nisi ut aliquip ex ea commodo conse quatt adipiscing dolore.';
            $this->config->style = 1;
        }
    }

    public function get_content() {
        global $CFG, $PAGE;

        require_once($CFG->libdir . '/filelib.php');

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content         =  new stdClass;

        $style = 1;
        if(isset($this->config->style)){
            $style = $this->config->style;
        }

        $bg_img = 'bg_img';
        if(isset($this->config->$bg_img) && !empty($this->config->$bg_img)){$this->content->$bg_img = $this->config->$bg_img;
        }else{ $this->content->$bg_img = '';}

        $shape1 = 'shape1';
        if(isset($this->config->$shape1) && !empty($this->config->$shape1)){$this->content->$shape1 = $this->config->$shape1;
        }else{ $this->content->$shape1 = '';}

        $shape2 = 'shape2';
        if(isset($this->config->$shape2) && !empty($this->config->$shape2)){$this->content->$shape2 = $this->config->$shape2;
        }else{ $this->content->$shape2 = '';}

        $shape3 = 'shape3';
        if(isset($this->config->$shape3) && !empty($this->config->$shape3)){$this->content->$shape3 = $this->config->$shape3;
        }else{ $this->content->$shape3 = '';}

        $shape4 = 'shape4';
        if(isset($this->config->$shape4) && !empty($this->config->$shape4)){$this->content->$shape4 = $this->config->$shape4;
        }else{ $this->content->$shape4 = '';}

        if (!empty($this->config) && is_object($this->config)) {
            $data = $this->config;
            $data->itemsnumber = is_numeric($data->itemsnumber) ? (int)$data->itemsnumber : 3;
        } else {
            $data = new stdClass();
            $data->itemsnumber = '3';
        }

        $text = '';
        if($style == 2): 
            $text .= '
            <!-- Start Feedback Area -->
            <div class="feedback-area bg-fffaf3 ptb-100">
                <div class="container">
                    <div class="feedback-slides-two owl-carousel owl-theme">';
                        if ($data->itemsnumber > 0) {
                            $fs = get_file_storage();
                            for ($i = 1; $i <= $data->itemsnumber; $i++) {
                                $image = 'img' . $i;
                                $item_title = 'item_title' . $i;
                                $item_subtitle = 'item_subtitle' . $i;
                                $item_text = 'item_text' . $i;
                                $text .= '
                                <div class="single-feedback-box">';
                                    if(isset($data->$item_text)){
                                        $text .= '
                                        <p>'.format_text($data->$item_text, FORMAT_HTML, array('filter' => true)).'</p>';
                                    }
                                    $text .= '
                                    <div class="client-info d-flex align-items-center">';
                                        if(isset($data->$image)){
                                            $image = $data->$image;
                                            $text .= '
                                            <img src="' . edmo_block_image_process($image) . '" class="rounded-circle" alt="'.format_text($data->$item_title, FORMAT_HTML, array('filter' => true)).'">';
                                        } 
                                        $text .= '
                                        <div class="title">';
                                            if(isset($data->$item_title)){
                                                $text .= '
                                                <h3>'.format_text($data->$item_title, FORMAT_HTML, array('filter' => true)).'</h3>';
                                            }
                                            if(isset($data->$item_subtitle)){
                                                $text .= '
                                                <span>'.format_text($data->$item_subtitle, FORMAT_HTML, array('filter' => true)).'</span>';
                                            }
                                            $text .= '
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                        $text .= '
                    </div>
                </div>
                <div class="divider2"></div>
                <div class="divider3"></div>';

                if($this->content->shape1):
                    $shape1 = $this->content->shape1;
                    $text .= '
                    <div class="shape2"><img src="'.edmo_block_image_process($shape1).'" alt="Shape Image"></div>';
                endif;

                if($this->content->shape2):
                    $shape2 = $this->content->shape2;
                    $text .= '
                    <div class="shape3"><img src="'.edmo_block_image_process($shape2).'" alt="Shape Image"></div>';
                endif;

                if($this->content->shape3):
                    $shape3 = $this->content->shape3;
                    $text .= '
                    <div class="shape4"><img src="'.edmo_block_image_process($shape3).'" alt="Shape Image"></div>';
                endif;

                if($this->content->shape4):
                    $shape4 = $this->content->shape4;
                    $text .= '
                    <div class="shape9"><img src="'.edmo_block_image_process($shape4).'" alt="Shape Image"></div>';
                endif;
                $text .= '
            </div>
            <!-- End Feedback Area -->'; 
        else:
            $text .= '
            <!-- Start Feedback Area -->
            <div class="feedback-with-bg-image ptb-100 jarallax" data-jarallax="{"speed": 0.3}" style="background-image:url('.edmo_block_image_process($this->content->$bg_img).');">
                <div class="container">
                    <div class="feedback-slides feedback-slides-style-two owl-theme owl-carousel">';
                        if ($data->itemsnumber > 0) {
                            $fs = get_file_storage();
                            for ($i = 1; $i <= $data->itemsnumber; $i++) {
                                $image = 'img' . $i;
                                $item_title = 'item_title' . $i;
                                $item_subtitle = 'item_subtitle' . $i;
                                $item_text = 'item_text' . $i;
                                $text .= '
                                <div class="single-feedback-item-box">';
                                    if(isset($data->$item_text)){
                                        $text .= '
                                        <p>'.format_text($data->$item_text, FORMAT_HTML, array('filter' => true)).'</p>';
                                    }
                                    $text .= '
                                    <div class="client-info d-flex align-items-center">';
                                        if(isset($data->$image)){
                                            $image = $data->$image;
                                            $text .= '
                                            <img src="' . edmo_block_image_process($image) . '" alt="'.format_text($data->$item_title, FORMAT_HTML, array('filter' => true)).'">';
                                        } 
                                        $text .= '
                                        <div class="title">';
                                            if(isset($data->$item_title)){
                                                $text .= '
                                                <h3>'.format_text($data->$item_title, FORMAT_HTML, array('filter' => true)).'</h3>';
                                            }
                                            if(isset($data->$item_subtitle)){
                                                $text .= '
                                                <span>'.format_text($data->$item_subtitle, FORMAT_HTML, array('filter' => true)).'</span>';
                                            }
                                            $text .= '
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                        $text .= '
                    </div>
                </div>
            </div>
            <!-- End Feedback Area -->'; 
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