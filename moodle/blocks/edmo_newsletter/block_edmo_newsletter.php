<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');
class block_edmo_newsletter extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_newsletter');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->top_title = 'GO AT YOUR OWN PACE';
            $this->config->title = 'Subscribe To Our Newsletter';
            $this->config->body = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
            $this->config->placeholder = 'Enter your email address';
            $this->config->btn = 'Subscribe Now';
            $this->config->action_url = '';
        }
    }

    public function get_content() {
        global $CFG, $DB, $COURSE, $USER, $PAGE;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content         =  new stdClass;

        if(!empty($this->config->top_title)){$this->content->top_title = $this->config->top_title;} else {$this->content->top_title = '';}
        
        if(!empty($this->config->title)){$this->content->title = $this->config->title;} else {$this->content->title = '';}

        if(!empty($this->config->body)){$this->content->body = $this->config->body;} else {$this->content->body = '';}

        if(!empty($this->config->placeholder)){$this->content->placeholder = $this->config->placeholder;} else {$this->content->placeholder = '';}

        if(!empty($this->config->btn)){$this->content->btn = $this->config->btn;} else {$this->content->btn = '';}

        if(!empty($this->config->action_url)){$this->content->action_url = $this->config->action_url;} else {$this->content->action_url = '';}

        $shape_img1 = 'shape_img1';
        if(isset($this->config->$shape_img1) && !empty($this->config->$shape_img1)){ $this->content->$shape_img1 = $this->config->$shape_img1; }else{ $this->content->$shape_img1 = ''; }

        $shape_img2 = 'shape_img2';
        if(isset($this->config->$shape_img2) && !empty($this->config->$shape_img2)){ $this->content->$shape_img2 = $this->config->$shape_img2; }else{ $this->content->$shape_img2 = ''; }

        $shape_img3 = 'shape_img3';
        if(isset($this->config->$shape_img3) && !empty($this->config->$shape_img3)){ $this->content->$shape_img3 = $this->config->$shape_img3; }else{ $this->content->$shape_img3 = ''; }

        $shape_img4 = 'shape_img4';
        if(isset($this->config->$shape_img4) && !empty($this->config->$shape_img4)){ $this->content->$shape_img4 = $this->config->$shape_img4; }else{ $this->content->$shape_img4 = ''; }
        $text = '';
        $text .= '
        <!-- Start Subscribe Area -->
        <div class="subscribe-area bg-f9f9f9 ptb-100">
            <div class="container">
                <div class="subscribe-content">
                    <span class="sub-title">'. $this->content->top_title .'</span>
                    <h2>'. $this->content->title .'</h2>
                    <p>'. $this->content->body .'</p>';

                    if($this->content->action_url):
                        $text .= '
                        <form action="'.$this->content->action_url.'" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="newsletter-form validate" target="_blank">
                            <input type="text" value="" name="EMAIL" class="email input-newsletter" id="mce-EMAIL" placeholder="'.format_text($this->content->placeholder, FORMAT_HTML, array('filter' => true)).'" required>
                            <button type="submit" name="subscribe" id="mc-embedded-subscribe" class="button default-btn"><i class="flaticon-user"></i>'.format_text($this->content->btn, FORMAT_HTML, array('filter' => true)).'<span></span></button>
                        </form>';
                        endif;
                        $text .= '
                </div>
            </div>';
            if($this->content->shape_img1):
                $shape_img1 = $this->content->shape_img1;
                $text .= '                    
                <div class="shape4"><img src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'"></div>';
            endif;

            if($this->content->shape_img2):
                $shape_img2 = $this->content->shape_img2;
                $text .= '                    
                <div class="shape13"><img src="'.edmo_block_image_process($shape_img2).'" alt="'.$this->content->title.'"></div>';
            endif;

            if($this->content->shape_img3):
                $shape_img3 = $this->content->shape_img3;
                $text .= '                    
                <div class="shape14"><img src="'.edmo_block_image_process($shape_img3).'" alt="'.$this->content->title.'"></div>';
            endif;

            if($this->content->shape_img4):
                $shape_img4 = $this->content->shape_img4;
                $text .= '                    
                <div class="shape15"><img src="'.edmo_block_image_process($shape_img4).'" alt="'.$this->content->title.'"></div>';
            endif;
            $text .= '
        </div>
        <!-- End Subscribe Area -->';
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