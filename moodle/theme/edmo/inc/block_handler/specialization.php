<?php
/*
@edmoRef: @block_edmo/block.php
*/

defined('MOODLE_INTERNAL') || die();

// print_object($this);
$edmoBlockType = $this->instance->blockname;

$edmoCollectionFullwidthTop =  array(
    "edmo_banner_1",
    "edmo_partners",
    "edmo_features",
    "edmo_about_area",
    "edmo_course_filter",
    "edmo_funfacts_and_feedback_area",
    "edmo_info_area",
    "edmo_blog_area",
    "edmo_instructor_slider",
    "edmo_gallery",
    "edmo_newsletter",
    "edmo_instructor_area",
    "edmo_banner_2",
    "edmo_features_2",
    "edmo_feedback",
    "edmo_funfacts",
    "edmo_info_area_2",
    "edmo_contact_area",
    "edmo_event_area",
    "edmo_banner_3",
    "edmo_slogan_area",
    "edmo_video_area",
    "edmo_feedback_area",
    "edmo_banner_4",
    "edmo_categories",
    "edmo_banner_5",
    "edmo_about_area_two",
    "edmo_banner_6",
    "edmo_features_3",
    "edmo_overview_area",
);

$edmoCollectionAboveContent =  array(
    "edmo_contact_form",
    "edmo_course_desc",
);

$edmoCollectionBelowContent =  array(
    "edmo_course_rating",
    "edmo_more_courses",
    "edmo_course_instructor",
);

$edmoCollection = array_merge($edmoCollectionFullwidthTop, $edmoCollectionAboveContent, $edmoCollectionBelowContent);

if (empty($this->config)) {
    if(in_array($edmoBlockType, $edmoCollectionFullwidthTop)) {
        $this->instance->defaultregion = 'fullwidth-top';
        $this->instance->region = 'fullwidth-top';
        $DB->update_record('block_instances', $this->instance);
    }
    if(in_array($edmoBlockType, $edmoCollectionAboveContent)) {
        $this->instance->defaultregion = 'above-content';
        $this->instance->region = 'above-content';
        $DB->update_record('block_instances', $this->instance);
    }
    if(in_array($edmoBlockType, $edmoCollectionBelowContent)) {
        $this->instance->defaultregion = 'below-content';
        $this->instance->region = 'below-content';
        $DB->update_record('block_instances', $this->instance);
    }
}
