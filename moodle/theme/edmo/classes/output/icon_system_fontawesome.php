<?php
namespace theme_edmo\output;

use renderer_base;
use pix_icon;

defined('MOODLE_INTERNAL') || die();

class icon_system_fontawesome extends \core\output\icon_system_fontawesome {
    public function get_core_icon_map() {
        $iconmap = parent::get_core_icon_map();

        $overrides = Array(
        'core:t/messages'       => "bx bx-message-square",
        'core:t/message'        => "bx bx-message-square",
        'core:i/notifications'  => "bx bx-bell",
        'core:i/dashboard'      => "bx bxs-dashboard",
        'core:i/scheduled'      => "bx bx-calendar-alt",
        'core:a/add_file'       => 'bx bx-file',
        'core:b/document-new'   => 'bx bx-file',
        'core:e/new_document'   => 'bx bx-file',
        'theme:fp/add_file'     => 'bx bx-file',
        'core:i/privatefiles'   => 'bx bx-file',
        'core:t/preferences'    => 'bx bx-cog',
        );

        $merged = array_merge($iconmap, $overrides);

        return $merged;
    }

}
