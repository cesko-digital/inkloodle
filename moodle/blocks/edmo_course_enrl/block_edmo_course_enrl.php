<?php
global $CFG;
require_once($CFG->dirroot. '/theme/edmo/inc/course_handler/edmo_course_handler.php');

class block_edmo_course_enrl extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_course_enrl');
    }

    // Declare second
    public function specialization()
    {
        global $CFG;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');

        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->video_link = "https://www.youtube.com/watch?v=PWvPbGWVRrU";
            $this->config->title = "Course Preview";
            $this->config->price = "Price";
            $this->config->free = "Free";
            $this->config->items = 5;
            $this->config->item_title1  = 'Course Level';
            $this->config->item_icon1   = 'bx bx-sort-up';
            $this->config->item_value1  = 'Intermediate';
            $this->config->item_title2  = 'Duration';
            $this->config->item_icon2   = 'bx bx-time-five';
            $this->config->item_value2  = '7 weeks';
            $this->config->item_title3  = 'Certificate';
            $this->config->item_icon3   = 'bx bx-sun';
            $this->config->item_value3  = 'Yes';
            $this->config->item_title4  = 'Language';
            $this->config->item_icon4   = 'bx bx-globe';
            $this->config->item_value4  = 'English';
            $this->config->item_title5  = 'Access';
            $this->config->item_icon5   = 'bx bx-lock-alt';
            $this->config->item_value5  = 'Lifetime';
        }
    }

    public function get_content() {
        global $CFG, $DB, $COURSE, $USER, $PAGE;

        $edmoCourseHandler = new edmoCourseHandler();
        $edmoCourse = $edmoCourseHandler->edmoGetCourseDetails($COURSE->id);
        $edmoCurrentUserId = $USER->id;

        $context = context_course::instance($COURSE->id, MUST_EXIST);

        $edmoEnroled = get_string('course_enrolled', 'theme_edmo');
        $edmoEnroledText = get_string('course_enrolled_text', 'theme_edmo');

        if( function_exists('isguestuser')
          && !isguestuser()
          && isloggedin()
          && is_enrolled($context, $USER, '', true)
          && isset($edmoCourse->teachers[$edmoCurrentUserId])
          && ($edmoCurrentUserId == $edmoCourse->teachers[$edmoCurrentUserId]->userId)
          ){
            $edmoEnroled = get_string('course_enrolled_teacher', 'theme_edmo');
            $edmoEnroledText = get_string('course_enrolled_teacher_text', 'theme_edmo');
        }

        if ($this->content !== null) {
          return $this->content;
        }

        $this->content = new stdClass();

        $items = 5;
        if(isset($this->config->items)){
            $items = $this->config->items;
        }

        if(!empty($this->config->video_link)){$this->content->video_link = $this->config->video_link;}else{$this->content->video_link = '';}

        if(!empty($this->config->title)){$this->content->title = format_text($this->config->title, FORMAT_HTML, array('filter' => true));}else{$this->content->title = '';}

        if(!empty($this->config->price)){$this->content->price = format_text($this->config->price, FORMAT_HTML, array('filter' => true));}else{$this->content->price = '';}

        if(!empty($this->config->free)){$this->content->free = format_text($this->config->free, FORMAT_HTML, array('filter' => true));}else{$this->content->free = '';}

        $text = '';
        $text .= '
        <div class="course-details-sidebar">
            <div class="course-preview">
                '.$edmoCourse->edmoRender->coverImage.' ';
                
                if($this->content->video_link): 
                    $text .= '
                    <div class="videos-btn">
                        <a href="'.$this->content->video_link.'" class="video-btn popup-youtube">
                            <i class="bx bx-play"></i>
                        </a>
                    </div>';
                endif;
                $text .= '
            </div>
            <div class="sidebar-futcher">';
                if($this->content->price){
                    if (is_enrolled($context, $USER, '', true)) {
                        $text .='
                        <div class="sidebar-title d-flex justify-content-between">
                            <h2>'. $edmoEnroled .'</h2> 
                            <p>'. $edmoEnroledText .'</p>
                        </div>';
                    }elseif($edmoCourse->course_price) {
                        $text .='
                        <div class="sidebar-title d-flex justify-content-between">
                            <h2> ' . get_config('theme_edmo', 'site_currency') .'' . $edmoCourse->course_price .'</h2> 
                            <p>'.$this->content->price.'</p>
                        </div>';
                    }else{ $text .='
                        <div class="sidebar-title d-flex justify-content-between">
                            <h2>'.$this->content->free.'</h2> 
                            <p>'.$this->content->price.'</p>
                        </div>';
                    } 
                } $text .='
                <ul>';	
                    for ($i = 1; $i <=  $items; $i++) {
                        $item_title = 'item_title' . $i;
                        $item_value = 'item_value' . $i;
                        $item_icon = 'item_icon' . $i;

                        if(isset($this->config->$item_title)) { $item_title =  $this->config->$item_title; }else{ $item_title = ''; }
                        if(isset($this->config->$item_value)) { $item_value =  $this->config->$item_value; }else{ $item_value = ''; }
                        if(isset($this->config->$item_icon)) { $item_icon =  $this->config->$item_icon; }else{ $item_icon = ''; }

                    $text .='
                    <li>
                        <i class="'.format_text($item_icon, FORMAT_HTML, array('filter' => true)).'"></i>
                        '.format_text($item_title, FORMAT_HTML, array('filter' => true)).'
                        <span>'.format_text($item_value, FORMAT_HTML, array('filter' => true)).'</span>
                    </li>';
                    }
                    $text .='
                </ul>';

                if(!$edmoCourse->course_is_enrolled):
                    $text .='
                    <div class="cart-wish d-flex justify-content-between">
                        <a href="'. $edmoCourse->enrolmentLink .'" class="default-btn">
                        '. get_string('course_enrolment', 'theme_edmo') .'
                        </a>
                    </div>';
                endif;
                $text .='
            </div>
        </div>';

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