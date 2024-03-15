<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');

class block_edmo_event_area extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_event_area');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->top_title = 'EVENTS';
            $this->config->title = 'Our Upcoming Events';
            $this->config->body = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
            $this->config->itemsnumber = 3;

            $this->config->items_title1     = 'Global Conference on Business Management';
            $this->config->items_date1      = 'Wed, 20 May, 2023';
            $this->config->items_location1  = 'Vancover, Canada';

            $this->config->items_title2     = 'International Conference on Teacher Education';
            $this->config->items_date2      = 'Tue, 19 May, 2023';
            $this->config->items_location2  = 'Sydney, Australia';

            $this->config->items_title3     = 'International Conference on Special Needs Education';
            $this->config->items_date3      = 'Mon, 18 May, 2023';
            $this->config->items_location3  = 'Istanbul, Turkey';
            
        }
    }

    public function get_content() {
        global $CFG, $DB, $COURSE, $USER, $PAGE;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content         =  new stdClass;

        $itemsnumber = 3;
        if(isset($this->config->itemsnumber)){
            $itemsnumber = $this->config->itemsnumber;
        }

        if(!empty($this->config->top_title)){$this->content->top_title = $this->config->top_title;} else {$this->content->top_title = '';}

        if(!empty($this->config->title)){$this->content->title = $this->config->title;} else {$this->content->title = '';}

        if(!empty($this->config->body)){$this->content->body = $this->config->body;} else {$this->content->body = '';}

        $text = '';
        $text .= '
        <!-- Start Events Area -->
        <div class="events-area pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">'.$this->content->top_title.'</span>
                    <h2>'.$this->content->title.'</h2>
                    <p>'.$this->content->body.'</p>
                </div>
                <div class="row justify-content-center">';
                    for($i = 1; $i <= $itemsnumber; $i++) {
                        $items_title    = 'items_title' . $i;
                        $items_date     = 'items_date' . $i;
                        $items_location = 'items_location' . $i;
                        $img            = 'img' . $i;
                        $items_link     = 'items_link' . $i;

                        if(isset($this->config->$items_title)) { $items_title = $this->config->$items_title; }else{ $items_title = ''; }

                        if(isset($this->config->$items_link)) { $items_link = $this->config->$items_link; }else{ $items_link = ''; }

                        if(isset($this->config->$items_date)) { $items_date = $this->config->$items_date; }else{ $items_date = ''; }

                        if(isset($this->config->$items_location)) { $items_location = $this->config->$items_location; }else{ $items_location = ''; }

                        if(isset($this->config->$img)) { $img = $this->config->$img; }else{ $img = ''; }

                        $text .= '
                        <div class="col-lg-4 col-sm-6 col-md-6">
                            <div class="single-events-box">
                                <div class="image">';
                                    if($img):
                                        $text .= '
                                        <a href="'.$items_link.'" class="d-block">
                                            <img src="'.$img.'" alt="'.$items_title.'">
                                        </a>';
                                    endif;
                                    $text .= '
                                    <span class="date">'.$items_date.'</span>
                                </div>
                                <div class="content">
                                    <h3><a href="'.$items_link.'">'.$items_title.'</a></h3>
                                    <span class="location"><i class="bx bx-map"></i>'.$items_location.'</i></span>
                                </div>
                            </div>
                        </div>';
                    } $text .= '
                </div>
            </div>
        </div>
        <!-- End Events Area -->';
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