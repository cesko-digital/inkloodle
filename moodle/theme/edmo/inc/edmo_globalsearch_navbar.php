<?php
defined('MOODLE_INTERNAL') || die();

$edmo_globalsearch_navbar = '';

$placeholder      = get_config('theme_edmo', 'search_placeholder');

if (\core_search\manager::is_global_search_enabled() === false) {
    $placeholder = get_string('globalsearchdisabled', 'search');
}

$url = new moodle_url('/search/index.php');

$edmo_globalsearch_navbar .= html_writer::start_tag('form', array('class' => 'search-box','action' => $url->out()));
$edmo_globalsearch_navbar .= html_writer::start_tag('fieldset');

// Input.
$inputoptions = array('id' => 'searchform_search', 'name' => 'q', 'class' => 'input-search', 'placeholder' => $placeholder, 'type' => 'text', 'size' => '15');
$edmo_globalsearch_navbar .= html_writer::empty_tag('input', $inputoptions);

// Context id.
if ($this->page->context && $this->page->context->contextlevel !== CONTEXT_SYSTEM) {
    $edmo_globalsearch_navbar .= html_writer::empty_tag('input', ['type' => 'hidden', 'name' => 'context', 'value' => $this->page->context->id]);
}
// Search button.
$edmo_globalsearch_navbar .= '<button type="submit"><i class="flaticon-search"></i></button>';
$edmo_globalsearch_navbar .= html_writer::end_tag('fieldset');
$edmo_globalsearch_navbar .= html_writer::end_tag('form');
