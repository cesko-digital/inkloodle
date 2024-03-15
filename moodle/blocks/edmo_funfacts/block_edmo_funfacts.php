<?php
global $CFG;
class block_edmo_funfacts extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_funfacts');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->funfactsstyle = 1;
            $this->config->funfacts_title1 = 'FINISHED SESSIONS';
            $this->config->funfacts_number1 = '1926';
            $this->config->funfacts_prefix1 = '';
            $this->config->funfacts_title2 = 'ENROLLED LEARNERS';
            $this->config->funfacts_number2 = '3279';
            $this->config->funfacts_prefix2 = '';
            $this->config->funfacts_title3 = 'ONLINE INSTRUCTORS';
            $this->config->funfacts_number3 = '250';
            $this->config->funfacts_prefix3 = '';
            $this->config->funfacts_title4 = 'SATISFACTION RATE';
            $this->config->funfacts_number4 = '100';
            $this->config->funfacts_prefix4 = '%';
            $this->config->class = '';
        }
    }

    public function get_content() {
        global $CFG, $DB;

        $this->content         =  new stdClass;
        if(!empty($this->config->class)){$this->content->class = $this->config->class;} else {$this->content->class = '';}

        $funfactsnumber = 4;
        if(isset($this->config->funfactsnumber)){
            $funfactsnumber = $this->config->funfactsnumber;
        }

        $funfactsstyle = 1;
        if(isset($this->config->funfactsstyle)){
            $funfactsstyle = $this->config->funfactsstyle;
        }

        $icon_shape = 'icon_shape';
        if(isset($this->config->$icon_shape) && !empty($this->config->$icon_shape)){$this->content->$icon_shape = $this->config->$icon_shape;}else{$this->content->$icon_shape = '';}

        $text = '';
        if($funfactsstyle == 3):
            $text .= '
            <!-- Start Funfacts Area -->
            <div class="funfacts-area-two'. $this->content->class .'">
                <div class="container">
                    <div class="row">';
                        for($i = 1; $i <= $funfactsnumber; $i++) {
                            $funfacts_title = 'funfacts_title' . $i;
                            $funfacts_number = 'funfacts_number' . $i;
                            $funfacts_prefix = 'funfacts_prefix' . $i;

                            if(isset($this->config->$funfacts_title)) {
                                $funfacts_title = $this->config->$funfacts_title;
                                
                            }else{
                                $funfacts_title = '';
                            }
                            if(isset($this->config->$funfacts_number)) {
                                $funfacts_number = $this->config->$funfacts_number;
                            }else{
                                $funfacts_number = '';
                            }
                            if(isset($this->config->$funfacts_prefix)) {
                                $funfacts_prefix = $this->config->$funfacts_prefix;
                            }else{
                                $funfacts_prefix = '';                                
                            }

                            $text .= '
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="single-funfacts">';
                                    if($this->content->icon_shape):
                                        $icon_shape = $this->content->icon_shape;
                                        $text .= '
                                        <img src="'.edmo_block_image_process($icon_shape).'" alt="'.$funfacts_title.'">';
                                    endif;
                                    $text .= '
                                    <h3><span class="odometer" data-count="'.$funfacts_number.'">00</span>'.$funfacts_prefix.'</h3>
                                    <p>'.$funfacts_title.'</p>
                                </div>
                            </div>';
                        } $text .= '
                    </div>
                </div>
            </div>
            <!-- End Funfacts Area -->';
       elseif($funfactsstyle == 2):
            $text .= '
            <!-- Start Funfacts Area -->
            <div class="funfacts-area bg-f5f7fa '. $this->content->class .'">
                <div class="container">
                    <div class="row">';
                        for($i = 1; $i <= $funfactsnumber; $i++) {
                            $funfacts_title = 'funfacts_title' . $i;
                            $funfacts_number = 'funfacts_number' . $i;
                            $funfacts_prefix = 'funfacts_prefix' . $i;

                            if(isset($this->config->$funfacts_title)) {
                                $funfacts_title = $this->config->$funfacts_title;
                                
                            }else{
                                $funfacts_title = '';
                            }
                            if(isset($this->config->$funfacts_number)) {
                                $funfacts_number = $this->config->$funfacts_number;
                            }else{
                                $funfacts_number = '';
                            }
                            if(isset($this->config->$funfacts_prefix)) {
                                $funfacts_prefix = $this->config->$funfacts_prefix;
                            }else{
                                $funfacts_prefix = '';                                
                            }

                            $text .= '
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="single-funfacts-item">
                                    <h3><span class="odometer" data-count="'.$funfacts_number.'">00</span>'.$funfacts_prefix.'</h3>
                                    <p>'.$funfacts_title.'</p>
                                </div>
                            </div>';
                        } $text .= '
                    </div>
                </div>
            </div>

            <div class="funfacts-area bg-color ">
                <div class="funfacts-inner">
                    <div class="container">
                        <div class="row">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Funfacts Area -->';
       else:
            $text .= '
            <!-- Start Funfacts Area -->
            <div class="funfacts-area bg-fffaf3 '. $this->content->class .'">
                <div class="container">
                    <div class="row">';
                        for($i = 1; $i <= $funfactsnumber; $i++) {
                            $funfacts_title = 'funfacts_title' . $i;
                            $funfacts_number = 'funfacts_number' . $i;
                            $funfacts_prefix = 'funfacts_prefix' . $i;

                            if(isset($this->config->$funfacts_title)) {
                                $funfacts_title = $this->config->$funfacts_title;
                                
                            }else{
                                $funfacts_title = '';
                            }
                            if(isset($this->config->$funfacts_number)) {
                                $funfacts_number = $this->config->$funfacts_number;
                            }else{
                                $funfacts_number = '';
                            }
                            if(isset($this->config->$funfacts_prefix)) {
                                $funfacts_prefix = $this->config->$funfacts_prefix;
                            }else{
                                $funfacts_prefix = '';                                
                            }

                            $text .= '
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="single-funfacts-item">
                                    <h3><span class="odometer" data-count="'.$funfacts_number.'">00</span>'.$funfacts_prefix.'</h3>
                                    <p>'.$funfacts_title.'</p>
                                </div>
                            </div>';
                        } $text .= '
                    </div>
                </div>
            </div>
            <!-- End Funfacts Area -->

            <div class="funfacts-area bg-color ">
                <div class="funfacts-inner">
                    <div class="container">
                        <div class="row">
                        </div>
                    </div>
                </div>
            </div>';
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