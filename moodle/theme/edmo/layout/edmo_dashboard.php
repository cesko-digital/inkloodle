<?php
defined('MOODLE_INTERNAL') || die();
echo $OUTPUT->doctype();

include($CFG->dirroot . '/theme/edmo/inc/edmo_themehandler.php');

$bodyattributes = $OUTPUT->body_attributes();
include($CFG->dirroot . '/theme/edmo/inc/edmo_themehandler_context.php');

echo $OUTPUT->render_from_template('theme_edmo/edmo_dashboard', $templatecontext);