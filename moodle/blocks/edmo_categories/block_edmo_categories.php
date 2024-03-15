<?php
global $CFG;
require_once($CFG->dirroot . '/theme/edmo/inc/course_handler/edmo_course_handler.php');
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');
class block_edmo_categories extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_categories');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $edmoCourseHandler = new edmoCourseHandler();
            $edmoCategories = $edmoCourseHandler->edmoGetExampleCategoriesIds(8);
            $this->config = new \stdClass();
            // $this->config->style = 1;
            $this->config->top_title = 'CATEGORIES';
            $this->config->title = 'Top categories';
            $this->config->subtitle = 'Explore all of our courses and pick your suitable ones to enroll and start learning with us!';
            $this->config->courses = 'Courses';
            $this->config->button_text = 'View All Categories';
            $this->config->button_link = $CFG->wwwroot . '/course';
        }
    }

    public function get_content() {
        global $CFG, $USER, $DB, $OUTPUT;

        if ($this->content !== null) {
            return $this->content;
        }

        if (isset($this->config->items)) {
            $data = $this->config;
            $data->items = is_numeric($data->items) ? (int)$data->items : 8;
        } else {
            $data = new stdClass();
            $data->items = '0';
        }

        $this->content         =  new stdClass;
        
        if(!empty($this->config->top_title)){$this->content->top_title = $this->config->top_title;} else {$this->content->top_title = '';}
        
        if(!empty($this->config->title)){$this->content->title = $this->config->title;} else {$this->content->title = '';}
        
        if(!empty($this->config->subtitle)){$this->content->subtitle = $this->config->subtitle;} else {$this->content->subtitle = '';}
        
        if(!empty($this->config->courses)){$this->content->courses = $this->config->courses;} else {$this->content->courses = '';}
        
        if(!empty($this->config->button_text)){$this->content->button_text = $this->config->button_text;} else {$this->content->button_text = '';}
        
        if(!empty($this->config->button_link)){$this->content->button_link = $this->config->button_link;} else {$this->content->button_link = '';}

        // $style = 1;
        // if(isset($this->config->style)){
        //     $style = $this->config->style;
        // }

        $text = '';
        $text .= '
        <!-- Start Categories Area -->
        <div class="categories-area ptb-100">
            <div class="container">
                <div class="section-title">
                    <span class="sub-title">'. $this->content->top_title .'</span>
                    <h2>'. $this->content->title .'</h2>
                    <p>'.$this->content->subtitle.'</p>
                </div>
                <div class="row">';
                    $topcategory = core_course_category::top();
                    
                    if ($data->items > 0) {
                        for ($i = 1; $i <= $data->items; $i++) {
                            $bg_img = 'bg_img' . $i;
                            $categoryID = 'category' . $i;
                            $category = $DB->get_record('course_categories',array('id' => $data->$categoryID));
                            if ($DB->record_exists('course_categories', array('id' => $data->$categoryID))) {
                                $chelper = new coursecat_helper();
                                $categoryID = $category->id;
                                $category = core_course_category::get($categoryID);
                                $categoryname = $category->get_formatted_name();
                                $children_courses = $category->get_courses();
                                if($children_courses >= 1){
                                    $countNoOfCourses = count($children_courses);
                                } else {
                                    $countNoOfCourses = '';
                                }
                                $text .= '
                                <div class="col-lg-3 col-sm-6 col-md-6">
                                    <div class="single-categories-box">';
                                        if(isset($data->$bg_img)){
                                            $bg_img = $data->$bg_img;
                                            $text .= '
                                            <img src="' . edmo_block_image_process($bg_img).'" alt="'.$categoryname.'">';
                                        } 
                                        $text .='
                                        <div class="content">
                                            <h3>'.$categoryname.'</h3>
                                            <span>'.$countNoOfCourses.' '.$this->config->courses.'</span>
                                        </div>
                                        <a href="'.$CFG->wwwroot .'/course/index.php?categoryid='.$categoryID.'" class="link-btn"></a>
                                    </div>
                                </div>';
                            }
                        }
                    }

                    if(!empty($this->content->button_text) && !empty($this->content->button_link)){
                        $text .= '
                        <div class="col-lg-12 col-sm-12 col-md-12">
                            <div class="categories-btn-box">
                                <a href="'.$this->content->button_link.'" class="default-btn"><i class="flaticon-user"></i>'.$this->content->button_text.'<span></span></a>
                            </div>
                        </div>';
                    }
                    $text .= '
                </div>
            </div>
        </div>
        <!-- Start Categories Area -->';
        $this->content->footer = '';
        $this->content->text   = $text;

        return $this->content;
    }

    function instance_allow_config() {
        return true;
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