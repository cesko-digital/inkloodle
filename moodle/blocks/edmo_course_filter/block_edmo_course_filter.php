<?php
require_once($CFG->dirroot. '/course/renderer.php');
require_once($CFG->dirroot . '/theme/edmo/inc/course_handler/edmo_course_handler.php');
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');
global $CFG;
class block_edmo_course_filter extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_course_filter');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->style = 1;
            $this->config->top_title = 'LEARN AT YOUR OWN PACE';
            $this->config->title = 'Edmo Popular Courses';
            $this->config->subtitle = 'Explore all of our courses and pick your suitable ones to enroll and start learning with us! We ensure that you will never regret it!';
            $this->config->bottom_body = 'Enjoy the top notch learning methods and achieve next level skills! You are the creator of your own career & we will guide you through that.';
            $this->config->button_text = 'View All Courses';
            $this->config->button_link = $CFG->wwwroot . '/course';
            $this->config->student_title = 'Students';

            $this->config->btn = 'View All Courses';
            $this->config->btn_link = $CFG->wwwroot . '/course';
            $this->config->icon = 'flaticon-user';
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
        if(!empty($this->config->subtitle)){$this->content->subtitle = $this->config->subtitle;} else {$this->content->subtitle = '';}
        if(!empty($this->config->button_text)){$this->content->button_text = $this->config->button_text;} else {$this->content->button_text = '';}
        if(!empty($this->config->button_link)){$this->content->button_link = $this->config->button_link;} else {$this->content->button_link = '';}
        if(!empty($this->config->student_title)){$this->content->student_title = $this->config->student_title;} else {$this->content->student_title = '';}
        if(!empty($this->config->bottom_body)){$this->content->bottom_body = $this->config->bottom_body;} else {$this->content->bottom_body = '';}

        if(!empty($this->config->btn)){$this->content->btn = $this->config->btn;} else {$this->content->btn = '';}
        if(!empty($this->config->btn_link)){$this->content->btn_link = $this->config->btn_link;} else {$this->content->btn_link = '';}
        if(!empty($this->config->icon)){$this->content->icon = $this->config->icon;} else {$this->content->icon = '';}

        $style = 1;
        if(isset($this->config->style)){
            $style = $this->config->style;
        }

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

        $shape_img = 'shape_img';
        if(isset($this->config->$shape_img) && !empty($this->config->$shape_img)){$this->content->$shape_img = $this->config->$shape_img;}else{$this->content->$shape_img = '';}
        $text = '';

        if($style == 6):
            $text .= '
            <!-- Start Courses Area -->
            <section class="courses-area ptb-100">
                <div class="container">
                    <div class="section-title">
                        <span class="sub-title">'.$this->content->top_title.'</span>
                        <h2>'.$this->content->title.'</h2>
                        <p>'.$this->content->subtitle.'</p>
                    </div>
                    <div class="courses-slides owl-carousel owl-theme">';
                        if(!empty($this->config->courses)){
                            $chelper = new coursecat_helper();
                            $total_courses = count($coursesArr);
                            foreach ($courses as $course) {
                                if ($DB->record_exists('course', array('id' => $course->id))) {
                                    $edmoCourseHandler = new edmoCourseHandler();
                                    $edmoCourse = $edmoCourseHandler->edmoGetCourseDetails($course->id);
                                    $edmoCourseDescription = strip_tags($edmoCourseHandler->edmoGetCourseDescription($course->id, 99999999999999));
                                    $edmoCourseDescription = substr($edmoCourseDescription, 0, 101);                                 
                                    $text .= '
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
                                    </div>';
                                }
                            }                        
                        }
                        $text .= '
                    </div>';
                    if($this->content->bottom_body || $this->content->button_text):
                        $text .= '
                        <div class="courses-info">
                            <p>'.$this->content->bottom_body.'';
                            if(!empty($this->content->button_text) && !empty($this->content->button_link)){
                                $text .= '
                                <a href="'.$this->content->button_link.'">'.$this->content->button_text.'</a>';
                            }
                            $text .= '.</p>
                        </div';
                    endif; $text .= '
                </div>
            </div>
            <!-- End Courses Area -->';
        elseif($style == 3):
            $text .= '
            <!-- Start Courses Area -->
            <div class="courses-area pt-100 pb-70">
                <div class="container">
                    <div class="section-title">
                        <span class="sub-title">'.$this->content->top_title.'</span>
                        <h2>'.$this->content->title.'</h2>
                        <p>'.$this->content->subtitle.'</p>
                    </div>
                    <div class="row justify-content-center">';
                        if(!empty($this->config->courses)){
                            $chelper = new coursecat_helper();
                            $total_courses = count($coursesArr);
                            foreach ($courses as $course) {
                                if ($DB->record_exists('course', array('id' => $course->id))) {
                                    $edmoCourseHandler = new edmoCourseHandler();
                                    $edmoCourse = $edmoCourseHandler->edmoGetCourseDetails($course->id);
                                    $edmoCourseDescription = strip_tags($edmoCourseHandler->edmoGetCourseDescription($course->id, 99999999999999));
                                    $edmoCourseDescription = substr($edmoCourseDescription, 0, 101);                               
                                    $text .= '
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-courses-box bg-color">
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

                        if($this->content->bottom_body || $this->content->btn || $this->content->button_text):
                            $text .= '
                            <div class="col-lg-12 col-md-12">
                                <div class="courses-info">';
                                    if(!empty($this->content->btn) && !empty($this->content->btn_link)){
                                        $text .= '
                                        <a href="'.$this->content->btn_link.'" class="default-btn"><i class="'.$this->content->icon.'"></i>'.$this->content->btn.'<span></span></a>';
                                    }
                                    $text .= '
                                    <p>'.$this->content->bottom_body.'';
                                    if(!empty($this->content->button_text) && !empty($this->content->button_link)){
                                        $text .= '
                                        <a href="'.$this->content->button_link.'">'.$this->content->button_text.'</a>';
                                    }
                                    $text .= '.</p>
                                </div>
                            </div>';
                        endif;
                        $text .= '
                    </div>
                </div>';
                if($this->content->shape_img):
                    $shape_img = $this->content->shape_img;
                    $text .= '
                    <div class="shape16"><img src="'.edmo_block_image_process($shape_img).'" alt="'.$this->content->title.'"></div>';
                endif;
                $text .= '
            </div>
            <!-- End Courses Area -->';
        elseif($style == 5):
            $text .= '
            <!-- Start Courses Area -->
            <div class="courses-area bg-f5f7fa pt-100 pb-70">
                <div class="container">
                    <div class="section-title">
                        <span class="sub-title">'.$this->content->top_title.'</span>
                        <h2>'.$this->content->title.'</h2>
                        <p>'.$this->content->subtitle.'</p>
                    </div>
                    <div class="row">';
                        if(!empty($this->config->courses)){
                            $chelper = new coursecat_helper();
                            $total_courses = count($coursesArr);
                            foreach ($courses as $course) {
                                if ($DB->record_exists('course', array('id' => $course->id))) {
                                    $edmoCourseHandler = new edmoCourseHandler();
                                    $edmoCourse = $edmoCourseHandler->edmoGetCourseDetails($course->id);
                                    $edmoCourseDescription = strip_tags($edmoCourseHandler->edmoGetCourseDescription($course->id, 99999999999999));
                                    $edmoCourseDescription = substr($edmoCourseDescription, 0, 101);                                    
                                    $text .= '
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-courses-item-box">
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
                                                <h3><a href="'. $edmoCourse->url .'">'.$edmoCourse->fullName.'</a></h3>
                                                <div class="rating">
                                                    <span>'. $edmoCourse->edmoRender->updatedDate .'</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }                        
                        }
                        if(!empty($this->content->btn) || !empty($this->content->btn_link || $this->content->button_text)){
                            $text .= '
                            <div class="col-lg-12 col-md-12">
                                <div class="courses-info">';
                                    if(!empty($this->content->btn) && !empty($this->content->btn_link)){
                                        $text .= '
                                        <a href="'.$this->content->btn_link.'" class="default-btn"><i class="'.$this->content->icon.'"></i>'.$this->content->btn.'<span></span></a>';
                                    }
                                    $text .= '
                                    <p>'.$this->content->bottom_body.'';
                                    if(!empty($this->content->button_text) && !empty($this->content->button_link)){
                                        $text .= '
                                        <a href="'.$this->content->button_link.'">'.$this->content->button_text.'</a>';
                                    }
                                    $text .= '.</p>
                                </div>
                            </div>';
                        }
                        $text .= '
                    </div>
                </div>';
                if($this->content->shape_img):
                    $shape_img = $this->content->shape_img;
                    $text .= '
                    <div class="shape16"><img src="'.edmo_block_image_process($shape_img).'" alt="'.$this->content->title.'"></div>';
                endif;
                $text .= '
            </div>
            <!-- End Courses Area -->';
        elseif($style == 4):
            $text .= '
            <!-- Start Courses Area -->
            <div class="courses-area ptb-100 bg-f5f7fa">
                <div class="container">
                    <div class="section-title">
                        <span class="sub-title">'.$this->content->top_title.'</span>
                        <h2>'.$this->content->title.'</h2>
                        <p>'.$this->content->subtitle.'</p>
                    </div>
                    <div class="row">';
                        if(!empty($this->config->courses)){
                            $chelper = new coursecat_helper();
                            $total_courses = count($coursesArr);
                            foreach ($courses as $course) {
                                if ($DB->record_exists('course', array('id' => $course->id))) {
                                    $edmoCourseHandler = new edmoCourseHandler();
                                    $edmoCourse = $edmoCourseHandler->edmoGetCourseDetails($course->id);
                                    $edmoCourseDescription = strip_tags($edmoCourseHandler->edmoGetCourseDescription($course->id, 99999999999999));
                                    $edmoCourseDescription = substr($edmoCourseDescription, 0, 101);                                  
                                    $text .= '
                                    <div class="col-lg-6 col-md-12">
                                        <div class="single-courses-item">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="courses-image">
                                                        '.$edmoCourse->edmoRender->coverImage.'
                                                        <a href="'.$edmoCourse->url.'" class="link-btn"></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-8">
                                                    <div class="courses-content">';
                                                        if($edmoCourse->course_price) {
                                                            $text .= '
                                                            <div class="price">
                                                                <span class="new-price">'.get_config('theme_edmo', 'site_currency') .''.$edmoCourse->course_price.'</span>
                                                            </div>';
                                                        }else{
                                                            $text .= '
                                                            <div class="price">
                                                                <span class="new-price">'.get_string('course_free', 'theme_edmo').'</span>
                                                            </div>';
                                                        } $text .= '

                                                        <h3><a href="'. $edmoCourse->url .'">'.$edmoCourse->fullName.'</a></h3>
                                                        <ul class="courses-content-footer d-flex justify-content-between align-items-center">
                                                            <li><i class=flaticon-calendar></i> '. $edmoCourse->edmoRender->updatedDate .'</li>
                                                            <li><i class=flaticon-people></i> '.$edmoCourse->enrolments.' '.$this->content->student_title.'</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }                        
                        }

                        if($this->content->bottom_body || $this->content->btn || $this->content->button_text):
                            $text .= '
                            <div class="col-lg-12 col-md-12">
                                <div class="courses-info">';
                                    if(!empty($this->content->btn) && !empty($this->content->btn_link)){
                                        $text .= '
                                        <a href="'.$this->content->btn_link.'" class="default-btn"><i class="'.$this->content->icon.'"></i>'.$this->content->btn.'<span></span></a>';
                                    }
                                    $text .= '
                                    <p>'.$this->content->bottom_body.'';
                                    if(!empty($this->content->button_text) && !empty($this->content->button_link)){
                                        $text .= '
                                        <a href="'.$this->content->button_link.'">'.$this->content->button_text.'</a>';
                                    }
                                    $text .= '.</p>
                                </div>
                            </div>';
                        endif;
                        $text .= '
                    </div>
                </div>';
                if($this->content->shape_img):
                    $shape_img = $this->content->shape_img;
                    $text .= '
                    <div class="shape16"><img src="'.edmo_block_image_process($shape_img).'" alt="'.$this->content->title.'"></div>';
                endif;
                $text .= '
            </div>
            <!-- End Courses Area -->';
        elseif($style == 7):
            $text .= '
            <!-- Start Courses Area -->
            <section class="courses-area ptb-100">
                <div class="container">
                    <div class="section-title">
                        <span class="sub-title">'.$this->content->top_title.'</span>
                        <h2>'.$this->content->title.'</h2>
                        <p>'.$this->content->subtitle.'</p>
                    </div>
                    <div class="row">';
                        if(!empty($this->config->courses)){
                            $chelper = new coursecat_helper();
                            $total_courses = count($coursesArr);
                            foreach ($courses as $course) {
                                if ($DB->record_exists('course', array('id' => $course->id))) {
                                    $edmoCourseHandler = new edmoCourseHandler();
                                    $edmoCourse = $edmoCourseHandler->edmoGetCourseDetails($course->id);
                                    $edmoCourseDescription = strip_tags($edmoCourseHandler->edmoGetCourseDescription($course->id, 99999999999999));
                                    $edmoCourseDescription = substr($edmoCourseDescription, 0, 101);                                   
                                    $text .= '
                                    <div class="col-lg-6 col-md-12">
                                        <div class="single-courses-item without-box-shadow">
                                            <div class="row align-items-center">
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="courses-image">
                                                        '.$edmoCourse->edmoRender->coverImage.'
                                                        <a href="'.$edmoCourse->url.'" class="link-btn"></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-8">
                                                    <div class="courses-content">';
                                                        if($edmoCourse->course_price) {
                                                            $text .= '
                                                            <div class="price">
                                                                <span class="new-price">'.get_config('theme_edmo', 'site_currency') .''.$edmoCourse->course_price.'</span>
                                                            </div>';
                                                        }else{
                                                            $text .= '
                                                            <div class="price">
                                                                <span class="new-price">'.get_string('course_free', 'theme_edmo').'</span>
                                                            </div>';
                                                        } $text .= '

                                                        <h3><a href="'. $edmoCourse->url .'">'.$edmoCourse->fullName.'</a></h3>
                                                        <ul class="courses-content-footer d-flex justify-content-between align-items-center">
                                                            <li><i class=flaticon-calendar></i> '. $edmoCourse->edmoRender->updatedDate .'</li>
                                                            <li><i class=flaticon-people></i> '.$edmoCourse->enrolments.' '.$this->content->student_title.'</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }                        
                        }

                        if($this->content->bottom_body || $this->content->btn || $this->content->button_text):
                            $text .= '
                            <div class="col-lg-12 col-md-12">
                                <div class="courses-info">';
                                    if(!empty($this->content->btn) && !empty($this->content->btn_link)){
                                        $text .= '
                                        <a href="'.$this->content->btn_link.'" class="default-btn"><i class="'.$this->content->icon.'"></i>'.$this->content->btn.'<span></span></a>';
                                    }
                                    $text .= '
                                    <p>'.$this->content->bottom_body.'';
                                    if(!empty($this->content->button_text) && !empty($this->content->button_link)){
                                        $text .= '
                                        <a href="'.$this->content->button_link.'">'.$this->content->button_text.'</a>';
                                    }
                                    $text .=' .</p>
                                </div>
                            </div>';
                        endif;
                        $text .= '
                    </div>
                </div>';
                if($this->content->shape_img):
                    $shape_img = $this->content->shape_img;
                    $text .= '
                    <div class="shape16"><img src="'.edmo_block_image_process($shape_img).'" alt="'.$this->content->title.'"></div>';
                endif;
                $text .= '
            </section>
            <!-- End Courses Area -->';
        elseif($style == 2):
            $text .= '
            <!-- Start Courses Area -->
            <div class="courses-area pt-100 pb-70">
                <div class="container">
                    <div class="section-title">
                        <span class="sub-title">'.$this->content->top_title.'</span>
                        <h2>'.$this->content->title.'</h2>
                        <p>'.$this->content->subtitle.'</p>
                    </div>
                    <div class="row justify-content-center">';
                        if(!empty($this->config->courses)){
                            $chelper = new coursecat_helper();
                            $total_courses = count($coursesArr);
                            foreach ($courses as $course) {
                                if ($DB->record_exists('course', array('id' => $course->id))) {
                                    $edmoCourseHandler = new edmoCourseHandler();
                                    $edmoCourse = $edmoCourseHandler->edmoGetCourseDetails($course->id);
                                    $wordsArray = explode(' ', strip_tags($edmoCourseHandler->edmoGetCourseDescription($course->id, 99999999999999)));
                                    $first20Words = array_slice($wordsArray, 0, 20);
                                    $edmoCourseDescription = implode(' ', $first20Words);                                
                                    $text .= '
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-courses-box without-boxshadow">
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

                        <div class="col-lg-12 col-md-12">
                            <div class="courses-info">';
                                if(!empty($this->content->btn) && !empty($this->content->btn_link)){
                                    $text .= '
                                    <a href="'.$this->content->btn_link.'" class="default-btn"><i class="'.$this->content->icon.'"></i>'.$this->content->btn.'<span></span></a>';
                                }
                                $text .= '
                                <p>'.$this->content->bottom_body.'';
                                if(!empty($this->content->button_text) && !empty($this->content->button_link)){
                                    $text .= '
                                    <a href="'.$this->content->button_link.'">'.$this->content->button_text.'</a>';
                                }
                                $text .= '.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Courses Area -->';
        else:
            $text .= '
            <!-- Start Courses Area -->
            <div class="courses-area ptb-100">
                <div class="container">
                    <div class="section-title">
                        <span class="sub-title">'.$this->content->top_title.'</span>
                        <h2>'.$this->content->title.'</h2>
                        <p>'.$this->content->subtitle.'</p>
                    </div>
                    <div class="row justify-content-center">';
                        if(!empty($this->config->courses)){
                            $chelper = new coursecat_helper();
                            $total_courses = count($coursesArr);
                            foreach ($courses as $course) {
                                if ($DB->record_exists('course', array('id' => $course->id))) {
                                    $edmoCourseHandler = new edmoCourseHandler();
                                    $edmoCourse = $edmoCourseHandler->edmoGetCourseDetails($course->id);
                                    $wordsArray = explode(' ', strip_tags($edmoCourseHandler->edmoGetCourseDescription($course->id, 99999999999999)));
                                    $first20Words = array_slice($wordsArray, 0, 20);
                                    $edmoCourseDescription = implode(' ', $first20Words);                                 
                                    $text .= '
                                    <div class="col-lg-4 col-md-6">
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

                        <div class="col-lg-12 col-md-12">
                            <div class="courses-info">
                                <p>'.$this->content->bottom_body.'';
                                if(!empty($this->content->button_text) && !empty($this->content->button_link)){
                                    $text .= '
                                    <a href="'.$this->content->button_link.'">'.$this->content->button_text.'</a>';
                                }
                                $text .= '.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Courses Area -->';
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