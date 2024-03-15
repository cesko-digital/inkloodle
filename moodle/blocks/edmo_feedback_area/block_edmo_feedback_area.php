<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');
class block_edmo_feedback_area extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_feedback_area');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->top_title = 'Testimonials';
            $this->config->title = 'What People Say About Edmo';
            $this->config->body = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
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
        }
    }

    public function get_content() {
        global $CFG, $PAGE;

        require_once($CFG->libdir . '/filelib.php');

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content         =  new stdClass;

        if(!empty($this->config->title)){$this->content->title = $this->config->title;} else {$this->content->title = '';}
        if(!empty($this->config->top_title)){$this->content->top_title = $this->config->top_title;} else {$this->content->top_title = '';}
        if(!empty($this->config->body)){$this->content->body = $this->config->body;} else {$this->content->body = '';}
        

        $shape_img1 = 'shape_img1';
        if(isset($this->config->$shape_img1) && !empty($this->config->$shape_img1)){$this->content->$shape_img1 = $this->config->$shape_img1;}else{$this->content->$shape_img1 = '';}
        
        $shape_img2 = 'shape_img2';
        if(isset($this->config->$shape_img2) && !empty($this->config->$shape_img2)){$this->content->$shape_img2 = $this->config->$shape_img2;}else{$this->content->$shape_img2 = '';}

        $shape_img3 = 'shape_img3';
        if(isset($this->config->$shape_img3) && !empty($this->config->$shape_img3)){$this->content->$shape_img3 = $this->config->$shape_img3;}else{$this->content->$shape_img3 = '';}

        if (!empty($this->config) && is_object($this->config)) {
            $data = $this->config;
            $data->itemsnumber = is_numeric($data->itemsnumber) ? (int)$data->itemsnumber : 3;
        } else {
            $data = new stdClass();
            $data->itemsnumber = '3';
        }

        $text = '';
        $text .= '
        <!-- Start Testimonials Area -->
        <div class="testimonials-area ptb-100">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">'.$this->content->top_title.'</span>
                    <h2>'.$this->content->title.'</h2>
                    <p>'.$this->content->body.'</p>
                </div>
                    <div class="testimonials-slides owl-carousel owl-theme">';
                    if ($data->itemsnumber > 0) {
                        $fs = get_file_storage();
                        for ($i = 1; $i <= $data->itemsnumber; $i++) {
                            $image = 'img' . $i;
                            $item_title = 'item_title' . $i;
                            $item_subtitle = 'item_subtitle' . $i;
                            $item_text = 'item_text' . $i;
                            $text .= '
                            <div class="single-testimonials-item">';
                                if(isset($data->$image)){
                                    $image = $data->$image;
                                    $text .= '
                                    <img class="client-img" src="' . edmo_block_image_process($image).'" alt="'.$data->$item_title.'">';
                                } 
                                $text .= '';
                                if(isset($data->$item_text)){
                                    $text .= '
                                    <p>'.format_text($data->$item_text, FORMAT_HTML, array('filter' => true)).'</p>';
                                }

                                if(isset($data->$item_title)){
                                    $text .= '
                                    <h3>'.format_text($data->$item_title, FORMAT_HTML, array('filter' => true)).'</h3>';
                                }
                                if(isset($data->$item_subtitle)){
                                    $text .= '
                                    <span>'.format_text($data->$item_subtitle, FORMAT_HTML, array('filter' => true)).'</span>';
                                }
                                $text .= '
                                <div class="shape-img">';
                                    if($this->content->shape_img1):
                                        $shape_img1 = $this->content->shape_img1;
                                        $text .= '
                                        <img class="shape-1" src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'">';
                                    endif;

                                    if($this->content->shape_img2):
                                        $shape_img2 = $this->content->shape_img2;
                                        $text .= '
                                        <img class="shape-2" src="'.edmo_block_image_process($shape_img2).'" alt="'.$this->content->title.'">';
                                    endif;

                                    if($this->content->shape_img3):
                                        $shape_img3 = $this->content->shape_img3;
                                        $text .= '
                                        <img class="shape-3" src="'.edmo_block_image_process($shape_img3).'" alt="'.$this->content->title.'">';
                                    endif;
                                    $text .= '
                                </div>
                            </div>';
                        }
                    }
                    $text .= '
                </div>
            </div>
        </div>
        <!-- End Testimonials Area -->';        

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