<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');
class block_edmo_funfacts_and_feedback_area extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_funfacts_and_feedback_area');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->top_title = 'DISTANCE LEARNING';
            $this->config->title = 'Flexible Study at Your Own Pace, According to Your Own Needs';
            $this->config->subtitle = 'With the Edmo, you can study whenever and wherever you choose. We have students in over 175 countries and a global reputation as a pioneer in the field of flexible learning. Our teaching also means, if you travel often or need to relocate, you can continue to study wherever you go.';
            $this->config->bottom_body = 'Not a member yet?';
            $this->config->button_text = 'Register now';
            $this->config->button_link = $CFG->wwwroot . '/login/index.php';
            $this->config->itemsnumber = '3';
            $this->config->video_link = 'https://www.youtube.com/watch?v=PWvPbGWVRrU';

            $this->config->item_title1 = 'Ali Tufan';
            $this->config->item_subtitle1 = 'TV Model';
            $this->config->item_text1 = 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et mag na aliqua. Minim veniam, quis nostrud ullamco laboris nisi ut aliquip ex ea commodo conse quatt adipiscing dolore.';

            $this->config->item_title2 = 'Allien Zampa';
            $this->config->item_subtitle2 = 'Developer';
            $this->config->item_text2 = 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et mag na aliqua. Minim veniam, quis nostrud ullamco laboris nisi ut aliquip ex ea commodo conse quatt adipiscing dolore.';

            $this->config->item_title3 = 'Ramos Leo';
            $this->config->item_subtitle3 = 'Designer';
            $this->config->item_text3 = 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et mag na aliqua. Minim veniam, quis nostrud ullamco laboris nisi ut aliquip ex ea commodo conse quatt adipiscing dolore.';

            $this->config->funItemsNumber           = '4';
            $this->config->funItemsNumber_title1    = 'FINISHED SESSIONS';
            $this->config->funItemsNumber_number1   = '1926';
            $this->config->funItemsNumber_title2    = 'ENROLLED LEARNERS';
            $this->config->funItemsNumber_number2   = '3279';
            $this->config->funItemsNumber_title3    = 'Online Instructors';
            $this->config->funItemsNumber_number3   = '250';
            $this->config->funItemsNumber_title4    = 'Satisfaction Rate';
            $this->config->funItemsNumber_number4   = '100';
            $this->config->funItemsNumber_suffix4   = '%';
        }
    }

    public function get_content() {
        global $CFG, $PAGE;

        require_once($CFG->libdir . '/filelib.php');

        if ($this->content !== null) {
            return $this->content;
        }
        $this->content         =  new stdClass;

        if(!empty($this->config->top_title)){$this->content->top_title = $this->config->top_title;} else {$this->content->top_title = '';}
        if(!empty($this->config->title)){$this->content->title = $this->config->title;} else {$this->content->title = '';}
        if(!empty($this->config->subtitle)){$this->content->subtitle = $this->config->subtitle;} else {$this->content->subtitle = '';}
        if(!empty($this->config->button_text)){$this->content->button_text = $this->config->button_text;} else {$this->content->button_text = '';}
        if(!empty($this->config->bottom_body)){$this->content->bottom_body = $this->config->bottom_body;} else {$this->content->bottom_body = '';}
        if(!empty($this->config->button_link)){$this->content->button_link = $this->config->button_link;} else {$this->content->button_link = '';}
        if(!empty($this->config->video_link)){$this->content->video_link = $this->config->video_link;} else {$this->content->video_link = '';}

        $img = 'img';
        if(isset($this->config->$img) && !empty($this->config->$img)){$this->content->$img = $this->config->$img;}else{$this->content->$img = '';}
        $shape_img1 = 'shape_img1';
        if(isset($this->config->$shape_img1) && !empty($this->config->$shape_img1)){$this->content->$shape_img1 = $this->config->$shape_img1;}else{$this->content->$shape_img1 = '';}
        $shape_img2 = 'shape_img2';
        if(isset($this->config->$shape_img2) && !empty($this->config->$shape_img2)){$this->content->$shape_img2 = $this->config->$shape_img2;}else{$this->content->$shape_img2 = '';}
        $shape_img3 = 'shape_img3';
        if(isset($this->config->$shape_img3) && !empty($this->config->$shape_img3)){$this->content->$shape_img3 = $this->config->$shape_img3;}else{$this->content->$shape_img3 = '';}
        $shape_img4 = 'shape_img4';
        if(isset($this->config->$shape_img4) && !empty($this->config->$shape_img4)){$this->content->$shape_img4 = $this->config->$shape_img4;}else{$this->content->$shape_img4 = '';}
        $shape_img5 = 'shape_img5';
        if(isset($this->config->$shape_img5) && !empty($this->config->$shape_img5)){$this->content->$shape_img5 = $this->config->$shape_img5;}else{$this->content->$shape_img5 = '';}

        if (!empty($this->config) && is_object($this->config)) {
            $data = $this->config;
            $data->itemsnumber = is_numeric($data->itemsnumber) ? (int)$data->itemsnumber : 3;
        } else {
            $data = new stdClass();
            $data->itemsnumber = '3';
        }

        if (!empty($this->config) && is_object($this->config)) {
            $data = $this->config;
            $data->funItemsNumber = is_numeric($data->funItemsNumber) ? (int)$data->funItemsNumber : 3;
        } else {
            $data = new stdClass();
            $data->funItemsNumber = '4';
        }

        $text = '';
        $text .= '
        <!-- Start Funfacts And Feedback Area -->
        <div class="funfacts-and-feedback-area ptb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="feedback-content">
                            <span class="sub-title">'.$this->content->top_title.'</span>
                            <h2>'.$this->content->title.'</h2>
                            <p>'.$this->content->subtitle.'</p>

                            <div class="feedback-slides owl-carousel owl-theme">';
                                if ($data->itemsnumber > 0) {
                                    $fs = get_file_storage();
                                    for ($i = 1; $i <= $data->itemsnumber; $i++) {
                                        $image = 'img' . $i;
                                        $item_title = 'item_title' . $i;
                                        $item_subtitle = 'item_subtitle' . $i;
                                        $item_text = 'item_text' . $i;
                                        $text .= '
                                        <div class="single-feedback-item">';
                                            if(isset($data->$item_text)){
                                                $text .= '
                                                <p>'.$data->$item_text.'</p>';
                                            }
                                            $text .= '
                                            <div class="client-info d-flex align-items-center">';
                                                if(isset($data->$image)){
                                                    $image = $data->$image;
                                                    $text .= '
                                                    <img src="' . edmo_block_image_process($image) . '" class="rounded-circle" alt="'.$data->$item_title.'">';
                                                } 
                                                $text .= '
                                                
                                                <div class="title">';
                                                    if(isset($data->$item_title)){
                                                        $text .= '
                                                        <h3>'.$data->$item_title.'</h3>';
                                                    }
                                                    if(isset($data->$item_subtitle)){
                                                        $text .= '
                                                        <span>'.$data->$item_subtitle.'</span>';
                                                    }
                                                    $text .= '
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                }
                                $text .= '
                            </div>
                            <div class="feedback-info">
                                <p>'.$this->content->bottom_body .'​  ';
                                if(!empty($this->content->button_text) && !empty($this->content->button_link)){
                                    $text .= '
                                     <a href="'.$this->content->button_link.'"> '.$this->content->button_text.'</a>';
                                }
                                $text .= '
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="funfacts-list">
                            <div class="row">';
                                if ($data->funItemsNumber > 0) {
                                    $fs = get_file_storage();
                                    for ($i = 1; $i <= $data->funItemsNumber; $i++) {
                                        $funItemsNumber_title = 'funItemsNumber_title' . $i;
                                        $funItemsNumber_number = 'funItemsNumber_number' . $i;
                                        $funItemsNumber_suffix = 'funItemsNumber_suffix' . $i;
                                        if(isset($data->$funItemsNumber_number)){ 
                                            $funItemsNumber_number = $data->$funItemsNumber_number;
                                        }else{
                                            $funItemsNumber_number = '';
                                        }

                                        $text .= '
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="single-funfacts-box">
                                                <h3><span class="odometer" data-count="'.$funItemsNumber_number.'">00</span>';if(isset($data->$funItemsNumber_suffix)){ $text .= ''.$data->$funItemsNumber_suffix.'';}$text .= '</h3>
                                                <p>';if(isset($data->$funItemsNumber_title)){ $text .= ''.$data->$funItemsNumber_title.'';}$text .= '</p>
                                            </div>
                                        </div>';
                                    }
                                }
                                $text .= '
                            </div>
                        </div>
                    </div>';
            
                    if($this->content->img):
                        $img = $this->content->img;
                        $text .= '
                        <div class="col-lg-12 col-md-12">
                            <div class="video-box">
                                <div class="image">
                                    <img src="'.edmo_block_image_process($img).'" class="shadow" alt="'.$this->content->title.'">
                                </div>
                                <a href="'.$this->content->video_link.'" class="video-btn popup-youtube"><i class="flaticon-play"></i></a>';
            
                                if($this->content->shape_img5):
                                    $shape_img5 = $this->content->shape_img5;
                                    $text .= '
                                    <div class="shape10" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img5).'" alt="'.$this->content->title.'"></div>';
                                endif;
                                $text .= '
                            </div>
                        </div>';
                    endif;
                    $text .= '
                </div>
            </div>';
            
            if($this->content->shape_img1):
                $shape_img1 = $this->content->shape_img1;
                $text .= '
                <div class="shape2" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'"></div>';
            endif;

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
                <div class="shape9" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img4).'" alt="'.$this->content->title.'"></div>';
            endif;
            $text .= '
        </div>
        <!-- End Funfacts And Feedback Area -->';     

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