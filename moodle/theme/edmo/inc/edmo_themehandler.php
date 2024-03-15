<?php
/*
@edmoRef: @theme_edmo/layout
*/

defined('MOODLE_INTERNAL') || die();
global $USER, $CFG, $SESSION, $OUTPUT, $COURSE, $DB;

include($CFG->dirroot . '/theme/edmo/inc/edmo_globalsearch_navbar.php');
require_once($CFG->dirroot. '/theme/edmo/inc/edmo_page_handler.php');

// Add block button in editing mode.
$addblockbutton = $OUTPUT->addblockbutton();

$edmoPageHandler = new edmoPageHandler();
$pageheading = $edmoPageHandler->edmoGetPageTitle();

if (is_siteadmin()) {$user_status = 'role-supreme';} else {$user_status = 'role-standard';}
$secondarynavigation = false;
$overflow = '';
if ($PAGE->has_secondary_navigation()) {
    $tablistnav = $PAGE->has_tablist_secondary_navigation();
    $moremenu = new \core\navigation\output\more_menu($PAGE->secondarynav, 'nav-tabs', true, $tablistnav);
    $secondarynavigation = $moremenu->export_for_template($OUTPUT);
    $overflowdata = $PAGE->secondarynav->get_overflow_menu_data();
    if (!is_null($overflowdata)) {
        $overflow = $overflowdata->export_for_template($OUTPUT);
    }
}

$primary = new core\navigation\output\primary($PAGE);
$renderer = $PAGE->get_renderer('core');
$primarymenu = $primary->export_for_template($renderer);
$buildregionmainsettings = !$PAGE->include_region_main_settings_in_header_actions()  && !$PAGE->has_secondary_navigation();
// If the settings menu will be included in the header then don't add it here.
$regionmainsettingsmenu = $buildregionmainsettings ? $OUTPUT->region_main_settings_menu() : false;

$header = $PAGE->activityheader;
$headercontent = $header->export_for_template($renderer);

$login_url  = get_login_url();
$isloggedin = isloggedin();

$edmoUserBodyClass = 'edmo_body_class';
$extraclasses = array(
    'edmo_no_hero',
    $user_status,
    $edmoUserBodyClass
);

$blockshtml = $OUTPUT->blocks('side-pre');
$leftblocks = $OUTPUT->blocks('left');
/* Deprecate these variables soon; copied & renamed immediately below */
$hasblocks = strpos($blockshtml, 'data-block=') !== false;
$hasleftblocks = strpos($leftblocks, 'data-block=') !== false;
/* End: Deprecate these variables soon; copied & renamed immediately below */
$sidebar_left = strpos($leftblocks, 'data-block=') !== false;
$sidebar_right = strpos($blockshtml, 'data-block=') !== false;
$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();
if($isloggedin){
    $edmoProfileIconUsername = $USER->firstname . ' '. $USER->lastname;
}else{
    $edmoProfileIconUsername = '';
}

$blocks_fullwidth_top = $OUTPUT->blocks('fullwidth-top');
$blocks_fullwidth_bottom = $OUTPUT->blocks('fullwidth-bottom');
$blocks_above_content = $OUTPUT->blocks('above-content');
$blocks_below_content = $OUTPUT->blocks('below-content');

$userProfileFromCourseParticipants = strpos($_SERVER['REQUEST_URI'], "user/view.php") !== false && isset($_GET["course"]);
$courseSectionPage = strpos($_SERVER['REQUEST_URI'], "course/view.php") !== false && isset($_GET["section"]);

if ((strpos($_SERVER['REQUEST_URI'], "user/index.php") !== false || strpos($_SERVER['REQUEST_URI'], "course/edit.php") !== false || strpos($_SERVER['REQUEST_URI'], "course/completion.php") !== false || strpos($_SERVER['REQUEST_URI'], "course/admin.php") !== false || $courseSectionPage) || $userProfileFromCourseParticipants){
  $sidebar_left = false;
  $sidebar_right = false;
  $blocks_above_content = false;
  $blocks_below_content = false;
  $blocks_fullwidth_top = false;
  $blocks_fullwidth_bottom = false;
}

$favicon = $OUTPUT->get_theme_image_favicon(null, 100);
if($favicon) {
    $favicon = $OUTPUT->get_theme_image_favicon(null, 100);
}else{
    $favicon = $CFG->wwwroot . '/theme/edmo/pix/favicon.ico';
}

if (get_config('theme_edmo', 'logo_visibility') == 1) {
    $logo_visibility = false;
} else {
    $logo_visibility = true;
}

/**
 * Main Logo
 */
$logo_image_width  = preg_replace("/[^0-9]/", "", get_config('theme_edmo', 'logo_image_width'));
$logo_image_height = preg_replace("/[^0-9]/", "", get_config('theme_edmo', 'logo_image_height'));

$logo_styles = '';
if ($logo_image_width) {
    $logo_styles .= 'width:' . $logo_image_width . 'px;max-width:none!important;';
}
if ($logo_image_height) {
    $logo_styles .= 'height:' . $logo_image_height . 'px;max-height:none!important;';
}
$main_logo = $OUTPUT->get_theme_image_main_logo(null, 100);
if($main_logo) {
    $main_logo = $OUTPUT->get_theme_image_main_logo(null, 100);
}else{
    $main_logo = false;
}

/**
 * Mobile Logo
 */
$mobile_logo_width  = preg_replace("/[^0-9]/", "", get_config('theme_edmo', 'mobile_logo_width'));
$mobile_logo_height = preg_replace("/[^0-9]/", "", get_config('theme_edmo', 'mobile_logo_height'));

$mobile_logo_styles = '';
if ($mobile_logo_width) {
    $mobile_logo_styles .= 'width:' . $mobile_logo_width . 'px;max-width:none!important;';
}
if ($mobile_logo_height) {
    $mobile_logo_styles .= 'height:' . $mobile_logo_height . 'px;max-height:none!important;';
}
$mobile_logo = $OUTPUT->get_theme_image_mobile_logo(null, 100);
if($mobile_logo) {
    $mobile_logo = $OUTPUT->get_theme_image_mobile_logo(null, 100);
}else{
    $mobile_logo = false;
}

/**
 * Footer Logo
 */
if (get_config('theme_edmo', 'footer_logo_visibility') == 1) {
    $footer_logo_visibility = false;
} else {
    $footer_logo_visibility = true;
}
$footer_logo_width  = preg_replace("/[^0-9]/", "", get_config('theme_edmo', 'footer_logo_width'));
$footer_logo_height = preg_replace("/[^0-9]/", "", get_config('theme_edmo', 'footer_logo_height'));

$footer_logo_styles = '';
if ($footer_logo_width) {
    $footer_logo_styles .= 'width:' . $footer_logo_width . 'px;max-width:none!important;';
}
if ($footer_logo_height) {
    $footer_logo_styles .= 'height:' . $footer_logo_height . 'px;max-height:none!important;';
}
$main_footer_logo = $OUTPUT->get_theme_image_main_footer_logo(null, 100);
if($main_footer_logo) {
    $main_footer_logo = $OUTPUT->get_theme_image_main_footer_logo(null, 100);
}else{
    $main_footer_logo = false;
}

/**
 * Header
 */

$header_search      = get_config('theme_edmo', 'header_search');
$header_btn_text    = get_config('theme_edmo', 'header_btn_text');
$header_btn_url     = get_config('theme_edmo', 'header_btn_url');
$header_btn_icon    = get_config('theme_edmo', 'header_btn_icon_edmo_icon_class');

$social_target = get_config('theme_edmo', 'social_target');
if($social_target == 1) {
  $social_target_href = 'target="_blank"';
} else {
  $social_target_href = 'target="_self"';
}

/**
 * Footer
 */
$footer_copyright      = get_config('theme_edmo', 'footer_copyright');
$banner_shape_image = $OUTPUT->get_theme_image_banner_shape_image(null, 100);
if($banner_shape_image) {
    $banner_shape_image = $OUTPUT->get_theme_image_banner_shape_image(null, 100);
}else{
    $banner_shape_image = false;
}

$back_to_top = get_config('theme_edmo', 'back_to_top');
$dashboard_left_side = get_config('theme_edmo', 'dashboard_left_side');

$hide_global_banner    = get_config('theme_edmo', 'hide_global_banner');

// Footer col classes & visibility
$footer_column_count = 0;
$footer_column_1 = false;
$footer_column_2 = false;
$footer_column_3 = false;
$footer_column_4 = false;
$footer_column_5 = false;
if(get_config('theme_edmo', 'footer_col_1_body')){
    $footer_column_count++;
    $footer_column_1 = true;
}
if(get_config('theme_edmo', 'footer_col_2_title') || get_config('theme_edmo', 'footer_col_2_body')){
    $footer_column_count++;
    $footer_column_2 = true;
}
if(get_config('theme_edmo', 'footer_col_3_title') || get_config('theme_edmo', 'footer_col_3_body')){
    $footer_column_count++;
    $footer_column_3 = true;
}
if(get_config('theme_edmo', 'footer_col_4_title') || get_config('theme_edmo', 'footer_col_4_body')){
    $footer_column_count++;
    $footer_column_4 = true;
}
if(get_config('theme_edmo', 'footer_col_5_title') || get_config('theme_edmo', 'footer_col_5_body')){
    $footer_column_count++;
    $footer_column_5 = true;
}
if($footer_column_count == 4) {
    $footer_col_1_class = "col-lg-4 col-md-6 col-sm-6";
    $footer_col_2_class = "col-lg-2 col-md-6 col-sm-6";
    $footer_col_3_class = "col-lg-2 col-md-6 col-sm-6";
    $footer_col_4_class = "col-lg-4 col-md-6 col-sm-6";
    $footer_col_5_class = "";
} elseif($footer_column_count == 3) {
    $footer_col_1_class = "col-sm-12 col-md-4 col-md-4 col-lg-4";
    $footer_col_2_class = "col-sm-12 col-md-4 col-md-4 col-lg-4";
    $footer_col_3_class = "col-sm-12 col-md-4 col-md-4 col-lg-4";
    $footer_col_4_class = "";
    $footer_col_5_class = "";
} elseif($footer_column_count == 2) {
    $footer_col_1_class = "col-sm-6 col-md-6 col-md-6 col-lg-6";
    $footer_col_2_class = "col-sm-6 col-md-6 col-md-6 col-lg-6";
    $footer_col_3_class = "";
    $footer_col_4_class = "";
    $footer_col_5_class = "";
} elseif($footer_column_count == 1) {
    $footer_col_1_class = "col-sm-12 col-md-6 offset-md-3 text-center";
    $footer_col_2_class = "";
    $footer_col_3_class = "";
    $footer_col_4_class = "";
    $footer_col_5_class = "";
} else {
    $footer_col_1_class = "col-lg-3 col-md-6 col-sm-12";
    $footer_col_2_class = "col-lg-2 col-md-6 col-sm-6";
    $footer_col_3_class = "col-lg-2 col-md-3 col-sm-6";
    $footer_col_4_class = "col-lg-2 col-md-3 col-sm-6";
    $footer_col_5_class = "col-lg-3 col-md-6 col-sm-6";
}