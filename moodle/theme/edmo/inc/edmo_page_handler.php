<?php
/*
@edmoRef: @
*/

defined('MOODLE_INTERNAL') || die();
include_once($CFG->dirroot . '/course/lib.php');

class edmoPageHandler {
  public function edmoGetPageTitle() {
    global $PAGE, $COURSE, $DB, $CFG;

    $edmoReturn = $PAGE->heading;

    if(
      $DB->record_exists('course', array('id' => $COURSE->id))
      && $COURSE->format == 'site'
      && $PAGE->cm
      && $PAGE->cm->name !== NULL
    ){
      $edmoReturn = $PAGE->cm->name;
    } elseif($PAGE->pagetype == 'blog-index') {
      $edmoReturn = get_string("blog", "blog");
    }

    return $edmoReturn;
  }
}
