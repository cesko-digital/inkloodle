<?php
/*
* COURSE HANDLER
*/

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot. '/course/renderer.php');
include_once($CFG->dirroot . '/course/lib.php');

class edmoCourseHandler {
    public function edmoGetCourseDetails($courseId) {
        global $CFG, $COURSE, $USER, $DB, $SESSION, $SITE, $PAGE, $OUTPUT;


        $courseId = (int)$courseId;
        if ($DB->record_exists('course', array('id' => $courseId))) {
        // @edmoComm: Initiate
        $edmoCourse = new \stdClass();
        $chelper = new coursecat_helper();
        $courseContext = context_course::instance($courseId);

        $courseRecord = $DB->get_record('course', array('id' => $courseId));
        $courseElement = new core_course_list_element($courseRecord);

        /* @edmoBreak */
        $courseId = $courseRecord->id;
        $courseShortName = $courseRecord->shortname;
        $courseFullName = $courseRecord->fullname;
        $courseSummary = $chelper->get_course_formatted_summary($courseElement, array('noclean' => true, 'para' => false));
        $courseFormat = $courseRecord->format;
        $courseAnnouncements = $courseRecord->newsitems;
        $courseStartDate = $courseRecord->startdate;
        $courseEndDate = $courseRecord->enddate;
        $courseVisible = $courseRecord->visible;
        $courseCreated = $courseRecord->timecreated;
        $courseUpdated = $courseRecord->timemodified;
        $courseRequested = $courseRecord->requested;
        $courseEnrolmentCount = count_enrolled_users($courseContext);
        $course_is_enrolled = is_enrolled($courseContext, $USER->id, '', true);

        /* @edmoBreak */
        $categoryId = $courseRecord->category;

        try {
            $courseCategory = core_course_category::get($categoryId);
            $categoryName = $courseCategory->get_formatted_name();
            $categoryUrl = $CFG->wwwroot . '/course/index.php?categoryid='.$categoryId;
        } catch (Exception $e) {
            $courseCategory = "";
            $categoryName = "";
            $categoryUrl = "";
        }

        /* @edmoBreak */
        $enrolmentLink = $CFG->wwwroot . '/enrol/index.php?id=' . $courseId;
        $courseUrl = new moodle_url('/course/view.php', array('id' => $courseId));
        // @edmoComm: Start Payment
        $enrolInstances = enrol_get_instances($courseId, true);

        $course_price = '';
        $course_currency = '';
        foreach($enrolInstances as $singleenrolInstances){
        if($singleenrolInstances->enrol == 'paypal'){
            $course_price = $singleenrolInstances->cost;
            $course_currency = $singleenrolInstances->currency;
        }elseif($singleenrolInstances->enrol == 'fee'){
            $course_price = $singleenrolInstances->cost;
            $course_currency = $singleenrolInstances->currency;
        }else{
            $course_price = '';
            $course_currency = '';
        }
        }
        

        $edmoArrayOfCosts = array();
            $edmoCourseContacts = array();
            if ($courseElement->has_course_contacts()) {
                foreach ($courseElement->get_course_contacts() as $key => $courseContact) {
                $edmoCourseContacts[$key] = new \stdClass();
                $edmoCourseContacts[$key]->userId = $courseContact['user']->id;
                $edmoCourseContacts[$key]->username = $courseContact['user']->username;
                $edmoCourseContacts[$key]->name = $courseContact['user']->firstname . ' ' . $courseContact['user']->lastname;
                $edmoCourseContacts[$key]->role = $courseContact['role']->displayname;
                $edmoCourseContacts[$key]->profileUrl = new moodle_url('/user/view.php', array('id' => $courseContact['user']->id, 'course' => SITEID));
                }
            }


        // @edmoComm: Process first image
        $contentimages = $contentfiles = $CFG->wwwroot . '/theme/edmo/images/edmoBg.png';
        foreach ($courseElement->get_course_overviewfiles() as $file) {
            $isimage = $file->is_valid_image();
            $url = file_encode_url("{$CFG->wwwroot}/pluginfile.php",
                    '/'. $file->get_contextid(). '/'. $file->get_component(). '/'.
                    $file->get_filearea(). $file->get_filepath(). $file->get_filename(), !$isimage);
            if ($isimage) {
                $contentimages = $url;
            } else {
                $contentfiles = $CFG->wwwroot . '/theme/edmo/images/edmoBg.png';
            }
        }

        /* Map data */
        $edmoCourse->courseId = $courseId;
        $edmoCourse->enrolments = $courseEnrolmentCount;
        $edmoCourse->categoryId = $categoryId;
        $edmoCourse->categoryName = $categoryName;
        $edmoCourse->categoryUrl = $categoryUrl;
        $edmoCourse->shortName = $courseShortName;
        $edmoCourse->fullName = format_text($courseFullName, FORMAT_HTML, array('filter' => true));
        $edmoCourse->summary = $courseSummary;
        $edmoCourse->imageUrl = $contentimages;
        $edmoCourse->format = $courseFormat;
        $edmoCourse->announcements = $courseAnnouncements;
        $edmoCourse->startDate = userdate($courseStartDate, get_string('strftimedatefullshort', 'langconfig'));
        $edmoCourse->endDate = userdate($courseEndDate, get_string('strftimedatefullshort', 'langconfig'));
        $edmoCourse->visible = $courseVisible;
        $edmoCourse->created = userdate($courseCreated, get_string('strftimedatefullshort', 'langconfig'));
        $edmoCourse->updated = userdate($courseUpdated, get_string('strftimedatefullshort', 'langconfig'));
        $edmoCourse->requested = $courseRequested;
        $edmoCourse->enrolmentLink = $enrolmentLink;
        $edmoCourse->url = $courseUrl;
        $edmoCourse->teachers = $edmoCourseContacts;
        $edmoCourse->course_price = $course_price;
        $edmoCourse->course_currency = $course_currency;
        $edmoCourse->course_is_enrolled = $course_is_enrolled;

        /* Render object */
        $edmoRender = new \stdClass();
        $edmoRender->enrolmentIcon = '';
        $edmoRender->enrolmentIcon1 = '';
        $edmoRender->announcementsIcon     =     '';
        $edmoRender->announcementsIcon1     =     '';
        $edmoRender->updatedDate           =     '';
        $edmoRender->updatedDate         =     userdate($courseUpdated, get_string('strftimedatefullshort', 'langconfig'));
        $edmoRender->title             =     '<h3><a href="'. $edmoCourse->url .'">'. $edmoCourse->fullName .'</a></h3>';
        $edmoRender->coverImage        =     '<img class="img-whp" src="'. $contentimages .'" alt="'.$edmoCourse->fullName.'">';
        $edmoRender->ImageUrl = $contentimages;
        /* @edmoBreak */
        $edmoCourse->edmoRender = $edmoRender;
        return $edmoCourse;
        }
        return null;
    }

    public function edmoGetCourseDescription($courseId, $maxLength){
        global $CFG, $COURSE, $USER, $DB, $SESSION, $SITE, $PAGE, $OUTPUT;
    
        if ($DB->record_exists('course', array('id' => $courseId))) {
        $chelper = new coursecat_helper();
        $courseContext = context_course::instance($courseId);
    
        $courseRecord = $DB->get_record('course', array('id' => $courseId));
        $courseElement = new core_course_list_element($courseRecord);
    
        if ($courseElement->has_summary()) {
            $courseSummary = $chelper->get_course_formatted_summary($courseElement, array('noclean' => false, 'para' => false));
            if($maxLength != null) {
            if (strlen($courseSummary) > $maxLength) {
                $courseSummary = wordwrap($courseSummary, $maxLength);
                $courseSummary = substr($courseSummary, 0, strpos($courseSummary, "\n")) . '...';
            }
            }
            return $courseSummary;
        }
    
        }
        return null;
    }

    public function edmoListCategories(){
        global $DB, $CFG;
        $topcategory = core_course_category::top();
        $topcategorykids = $topcategory->get_children();
        $areanames = array();
        foreach ($topcategorykids as $areaid => $topcategorykids) {
            $areanames[$areaid] = $topcategorykids->get_formatted_name();
            foreach($topcategorykids->get_children() as $k=>$child){
                $areanames[$k] = $child->get_formatted_name();
            }
        }
        return $areanames;
    }

    public function edmoGetCategoryDetails($categoryId){
        global $CFG, $COURSE, $USER, $DB, $SESSION, $SITE, $PAGE, $OUTPUT;
    
        if ($DB->record_exists('course_categories', array('id' => $categoryId))) {
    
        $categoryRecord = $DB->get_record('course_categories', array('id' => $categoryId));
    
        $chelper = new coursecat_helper();
        $categoryObject = core_course_category::get($categoryId);
    
        $edmoCategory = new \stdClass();
    
        $categoryId = $categoryRecord->id;
        $categoryName = format_text($categoryRecord->name, FORMAT_HTML, array('filter' => true));
        $categoryDescription = $chelper->get_category_formatted_description($categoryObject);
    
        $categorySummary = format_string($categoryRecord->description, $striplinks = true,$options = null);
        $isVisible = $categoryRecord->visible;
        $categoryUrl = $CFG->wwwroot . '/course/index.php?categoryid=' . $categoryId;
        $categoryCourses = $categoryObject->get_courses();
        $categoryCoursesCount = count($categoryCourses);
    
        $categoryGetSubcategories = [];
        $categorySubcategories = [];
        if (!$chelper->get_categories_display_option('nodisplay')) {
            $categoryGetSubcategories = $categoryObject->get_children($chelper->get_categories_display_options());
        }
        foreach($categoryGetSubcategories as $k=>$edmoSubcategory) {
            $edmoSubcat = new \stdClass();
            $edmoSubcat->id = $edmoSubcategory->id;
            $edmoSubcat->name = $edmoSubcategory->name;
            $edmoSubcat->description = $edmoSubcategory->description;
            $edmoSubcat->depth = $edmoSubcategory->depth;
            $edmoSubcat->coursecount = $edmoSubcategory->coursecount;
            $categorySubcategories[$edmoSubcategory->id] = $edmoSubcat;
        }
    
        $categorySubcategoriesCount = count($categorySubcategories);
    
        /* Do image */
        $outputimage = '';
        //edmoComm: Fetching the image manually added to the coursecat description via the editor.
        $description = $chelper->get_category_formatted_description($categoryObject);
        $src = "";
        if ($description) {
            $dom = new DOMDocument();
            $dom->loadHTML($description);
            $xpath = new DOMXPath($dom);
            $src = $xpath->evaluate("string(//img/@src)");
        }
        if ($src && $description){
            $outputimage = $src;
        } else {
            foreach($categoryCourses as $child_course) {
            if ($child_course === reset($categoryCourses)) {
                foreach ($child_course->get_course_overviewfiles() as $file) {
                    if ($file->is_valid_image()) {
                        $imagepath = '/' . $file->get_contextid() . '/' . $file->get_component() . '/' . $file->get_filearea() . $file->get_filepath() . $file->get_filename();
                        $imageurl = file_encode_url($CFG->wwwroot . '/pluginfile.php', $imagepath, false);
                        $outputimage  =  $imageurl;
                        // Use the first image found.
                        break;
                    }
                }
            }
            }
        }
    
        /* Map data */
        $edmoCategory->categoryId = $categoryId;
        $edmoCategory->categoryName = $categoryName;
        $edmoCategory->categoryDescription = $categoryDescription;
        $edmoCategory->categorySummary = $categorySummary;
        $edmoCategory->isVisible = $isVisible;
        $edmoCategory->categoryUrl = $categoryUrl;
        $edmoCategory->coverImage = $outputimage;
        $edmoCategory->ImageUrl = $outputimage;
        $edmoCategory->courses = $categoryCourses;
        $edmoCategory->coursesCount = $categoryCoursesCount;
        $edmoCategory->subcategories = $categorySubcategories;
        $edmoCategory->subcategoriesCount = $categorySubcategoriesCount;
        return $edmoCategory;
    
        }
    }

    public function edmoGetExampleCategories($maxNum) {
        global $CFG, $DB;
    
        $edmoCategories = $DB->get_records('course_categories', array(), $sort='', $fields='*', $limitfrom=0, $limitnum=$maxNum);
    
        $edmoReturn = array();
        foreach ($edmoCategories as $edmoCategory) {
        $edmoReturn[] = $this->edmoGetCategoryDetails($edmoCategory->id);
        }
        return $edmoReturn;
    }

    public function edmoGetExampleCategoriesIds($maxNum) {
        global $CFG, $DB;
    
        $edmoCategories = $this->edmoGetExampleCategories($maxNum);
    
        $edmoReturn = array();
        foreach ($edmoCategories as $key => $edmoCategory) {
        $edmoReturn[] = $edmoCategory->categoryId;
        }
        return $edmoReturn;
    }
}
