<?php
global $CFG;
require_once($CFG->dirroot. '/course/renderer.php');
require_once($CFG->dirroot . '/theme/edmo/inc/course_handler/edmo_course_handler.php');
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');
class block_edmo_banner_1 extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_banner_1');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->title = 'The World’s Leading Distance Learning Provider';
            $this->config->body = 'Flexible easy to access learning opportunities can bring a significant change in how individuals prefer to learn! The Edmo can offer you to enjoy the beauty of eLearning!';
            $this->config->btn = 'Join For Free';
            $this->config->btn_link = $CFG->wwwroot . '/course';
            $this->config->btn_icon = 'flaticon-user';
            $this->config->student_title = 'Students';
        }
    }

    public function get_content() {
        global $CFG, $DB;

        if ($this->content !== null) {
          return $this->content;
        }

        $this->content         =  new stdClass;

        /**
         * Banner Content
         */
        if(!empty($this->config->title)){$this->content->title = $this->config->title;} else {$this->content->title = '';}

        if(isset($this->config->body) && !empty($this->config->body)){$this->content->body = $this->config->body;}else{$this->content->body = '';}

        if(isset($this->config->btn) && !empty($this->config->btn)){$this->content->btn = $this->config->btn;}else{ $this->content->btn = '';}
        
        if(!empty($this->config->btn_link)){$this->content->btn_link = $this->config->btn_link;} else {$this->content->btn_link = '';}

        if(!empty($this->config->btn_icon)){$this->content->btn_icon = $this->config->btn_icon;} else {$this->content->btn_icon = '';}

        // Course
        if(!empty($this->config->student_title)){$this->content->student_title = $this->config->student_title;} else {$this->content->student_title = '';}

        $categories = array();
        if(!empty($this->config->courses)){
            $coursesArr = $this->config->courses;
            $courses = new stdClass();
            foreach ($coursesArr as $key => $course) {
                $courseObj = new stdClass();
                $courseObj->id = $course;
                $courseRecord = $DB->get_record('course', array('id' => $courseObj->id), 'category');
                $courseCategory = $DB->get_record('course_categories',array('id' => $courseRecord->category));
                $courseCategory = core_course_category::get($courseCategory->id);
                $courseObj->category = $courseCategory->id;
                $courseObj->category_name = $courseCategory->get_formatted_name();
                $courses->$course = $courseObj;
            }
            $categories = array();
            foreach ($courses as $key => $course) {
                $categories[$course->category] = $course->category_name;
            }
            $categories = array_unique($categories);
        }

        // Shape Images
        $shape_image_count = 3;
        for($i = 1; $i <= $shape_image_count; $i++) {
            $shape_img = 'shape_img' .$i;
            if(isset($this->config->$shape_img) && !empty($this->config->$shape_img)){
                $this->content->$shape_img = $this->config->$shape_img;
            }else{
                $this->content->$shape_img = '';
            }
        }

        // Background Image
        $bg_img = 'bg_img';
        if(isset($this->config->$bg_img) && !empty($this->config->$bg_img)){
            $this->content->$bg_img = $this->config->$bg_img;
        }else{
            $this->content->$bg_img = '';
        }
        
        $text = '';
        $text .= '
        <!-- Start Main Banner Area -->
        <div class="main-banner" style="background-image:url('.edmo_block_image_process($this->content->$bg_img).');">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="main-banner-content">
                            <h1>'.$this->content->title.'</h1>
                            <p>'.$this->content->body.'</p>';

                            if(!empty($this->content->btn) && !empty($this->content->btn_link)){
                                $text .= '
                                <a href="'.$this->content->btn_link.'" class="default-btn"><i class="'.$this->content->btn_icon.'"></i>'.$this->content->btn.'<span></span></a>';
                            }
                            $text .= '
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="main-banner-courses-list">
                            <div class="row">';
                            if(!empty($this->config->courses)){
                                $chelper = new coursecat_helper();
                                $total_courses = count($coursesArr);
                        
                                if($total_courses < 2) {
                                $col_class = 'col-md-12';
                                } else if($total_courses == 2) {
                                $col_class = 'col-md-6';
                                } else if($total_courses == 3) {
                                $col_class = 'col-md-4';
                                } else  {
                                $col_class = 'col-xl-3 col-lg-4 col-sm-6 col-md-6';
                                }
                                
                                foreach ($courses as $course) {
                                    if ($DB->record_exists('course', array('id' => $course->id))) {
                                        $edmoCourseHandler = new edmoCourseHandler();
                                        $edmoCourse = $edmoCourseHandler->edmoGetCourseDetails($course->id);
                              
                                        $wordsArray = explode(' ', strip_tags($edmoCourseHandler->edmoGetCourseDescription($course->id, 99999999999999)));
                                        $first20Words = array_slice($wordsArray, 0, 20);
                                        $edmoCourseDescription = implode(' ', $first20Words);
                                        $text .= '
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-courses-box">
                                                <div class="courses-image">
                                                    <a href="'.$edmoCourse->url.'" class="d-block image">
                                                        '.$edmoCourse->edmoRender->coverImage.'
                                                    </a>';
                                                    if($edmoCourse->course_price) {
                                                        $text .= '
                                                        <div class="price shadow">
                                                            <span class="new-price">'.get_config('theme_edmo', 'site_currency') .''.$edmoCourse->course_price.'</span>
                                                        </div>';
                                                    }else{
                                                        $text .= '
                                                        <div class="price shadow">
                                                            <span class="new-price">'.get_string('course_free', 'theme_edmo').'</span>
                                                        </div>';
                                                    } $text .= '
                                                </div>
                                                <div class="courses-content">
                                                    <div class="course-author d-flex align-items-center">
                                                        <span>'.$edmoCourse->categoryName.'</span>
                                                    </div>
                                                    
                                                    <h3><a href="'. $edmoCourse->url .'">'.$edmoCourse->fullName.'</a></h3>
                                                    <div class="course-desc">
                                                        <p>
                                                            '.$edmoCourseDescription.'
                                                        </p>
                                                    </div>
                                                    <ul class="courses-box-footer d-flex justify-content-between align-items-center">
                                                        <li><i class=flaticon-calendar></i> '. $edmoCourse->edmoRender->updatedDate .'</li>
                                                        <li><i class=flaticon-people></i> '.$edmoCourse->enrolments.' '.$this->content->student_title.'</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                }                        
                            }
                            $text .= '
                            </div>';

                            if($this->content->shape_img1):
                                $shape_img1 = $this->content->shape_img1;
                                $text .= '                    
                                <div class="banner-shape1" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img1).'" alt="'.$this->content->title.'"></div>
                                ';
                            endif;
                            if($this->content->shape_img2):
                                $shape_img2 = $this->content->shape_img2;
                                $text .= '                    
                                <div class="banner-shape2" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img2).'" alt="'.$this->content->title.'"></div>
                                ';
                            endif;
                            if($this->content->shape_img3):
                                $shape_img3 = $this->content->shape_img3;
                                $text .= '                    
                                <div class="banner-shape3" data-speed="0.06" data-revert="true"><img src="'.edmo_block_image_process($shape_img3).'" alt="'.$this->content->title.'"></div>';
                            endif;
                            $text .= '
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Banner Area -->';

        $this->content         =  new stdClass;
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