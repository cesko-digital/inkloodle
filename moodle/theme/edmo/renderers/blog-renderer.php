<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Parent theme: boost
 *
 * @package   theme_edmo
 * @copyright EnvyTheme
 *
 */

defined('MOODLE_INTERNAL') || die();
global $CFG;

require_once($CFG->dirroot . "/blog/renderer.php");

/**
 * Blog renderer
 */
class theme_edmo_core_blog_renderer  extends core_blog_renderer  {

    /**
     * Renders a blog entry
     *
     * @param blog_entry $entry
     * @return string The table HTML
     */
    public function render_blog_entry(blog_entry $entry) {

        global $CFG;
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $syscontext = context_system::instance();

        $stredit = get_string('edit');
        $strdelete = get_string('delete');

        /**
         * Blog card
         */
        if ( strpos($actual_link, '/index.php?entryid') == false ):
            // Header.
            $mainclass = 'col-lg-4 col-md-6 ';
            if ($entry->renderable->unassociatedentry) {
                $mainclass .= 'draft';
            } else {
                $mainclass .= $entry->publishstate;
            }
            $o = $this->output->container_start($mainclass, 'b' . $entry->id);
                $o .= $this->output->container_start('single-blog-post-box', '' . $entry->id);

                    $o .= $this->output->container_start('post-image');
                        // Attachments.
                        $attachmentsoutputs = array();
                        if ($entry->renderable->attachments) {
                            foreach ($entry->renderable->attachments as $attachment) {
                                $o .= $this->render($attachment, false);
                            }
                        }
                    $o .= $this->output->container_end();

                    $o .= $this->output->container_start('post-content');

                        $o .= $this->output->container_start('tag-list');
                            // Links to tags.
                            $o .= $this->output->tag_list(core_tag_tag::get_item_tags('core', 'post', $entry->id));
                        $o .= $this->output->container_end();

                        $o .="<h3>";
                        // Title.
                        $titlelink = html_writer::link(new moodle_url('/blog/index.php', array('entryid' => $entry->id)), format_string($entry->subject));
                            $o .= $this->output->container($titlelink, 'title');
                        $o .="</h3>";

                        $o .="<ul class='post-content-footer d-flex justify-content-between align-items-center'>";
                            $o .="<li><i class='bx bx-info-circle'></i>";
                                // Post by.
                                $by = new stdClass();
                                $fullname = fullname($entry->renderable->user, has_capability('moodle/site:viewfullnames', $syscontext));
                                $userurlparams = array('id' => $entry->renderable->user->id, 'course' => $this->page->course->id);
                                $by->name = html_writer::link(new moodle_url('/user/view.php', $userurlparams), $fullname);

                                $by->date = userdate($entry->created);
                                $o .= $this->output->container(get_string('bynameondate', 'forum', $by), 'author');

                                // Adding external blog link.
                                if (!empty($entry->renderable->externalblogtext)) {
                                    $o .= $this->output->container($entry->renderable->externalblogtext, 'externalblog');
                                }

                            $o .="</li>";
                        $o .="</ul>";

                    $o .= $this->output->container_end();

                $o .= $this->output->container_end();
            $o .= $this->output->container_end();
        else: // Blog details
            // Header.
            $mainclass = 'col-lg-8 blog-details-area blog-details-desc public offset-lg-2 ';
            if ($entry->renderable->unassociatedentry) {
                $mainclass .= 'draft';
            } else {
                $mainclass .= $entry->publishstate;
            }
            $o = $this->output->container_start($mainclass, 'b' . $entry->id);
                $o .= $this->output->container_start('single-blog-post', '' . $entry->id);
                    $o .= $this->output->container_start('article-image');
                        // Attachments.
                        $attachmentsoutputs = array();
                        if ($entry->renderable->attachments) {
                            foreach ($entry->renderable->attachments as $attachment) {
                                $o .= $this->render($attachment, false);
                            }
                        }
                    $o .= $this->output->container_end();
                    $o .= $this->output->container_start('content');
                        $o .= $this->output->container_start('post-info');

                            // Post by.
                            $by = new stdClass();
                            $fullname = fullname($entry->renderable->user, has_capability('moodle/site:viewfullnames', $syscontext));
                            $userurlparams = array('id' => $entry->renderable->user->id, 'course' => $this->page->course->id);
                            $by->name = html_writer::link(new moodle_url('/user/view.php', $userurlparams), $fullname);

                            $by->date = userdate($entry->created);
                            $o .= $this->output->container(get_string('bynameondate', 'forum', $by), 'author');

                            // Adding external blog link.
                            if (!empty($entry->renderable->externalblogtext)) {
                                $o .= $this->output->container($entry->renderable->externalblogtext, 'externalblog');
                            }
                        $o .= $this->output->container_end();

                        // Commands.
                        $o .= $this->output->container_start('commands');
                            if ($entry->renderable->usercanedit) {

                                // External blog entries should not be edited.
                                if (empty($entry->uniquehash)) {
                                    $o .='<a class="btn btn-secondary" href="'.new moodle_url('/blog/edit.php', array('action' => 'edit', 'entryid' => $entry->id)).'">'.$stredit.'</a>';
                                }
                                $o .= '<a class="btn btn-secondary" href="'.new moodle_url('/blog/edit.php', array('action' => 'delete', 'entryid' => $entry->id)).'">'.$strdelete.'</a>';
                            }
                        $o .= $this->output->container_end();
                    $o .= $this->output->container_end();
                $o .= $this->output->container_end();

                $o .= $this->output->container_start('article-content');
                // Body.
                $o .= format_text($entry->summary, $entry->summaryformat, array('overflowdiv' => true));
                // Add associations.
                if (!empty($CFG->useblogassociations) && !empty($entry->renderable->blogassociations)) {

                    // First find and show the associated course.
                    $assocstr = '';
                    $coursesarray = array();
                    foreach ($entry->renderable->blogassociations as $assocrec) {
                        if ($assocrec->contextlevel == CONTEXT_COURSE) {
                            $coursesarray[] = $this->output->action_icon($assocrec->url, $assocrec->icon, null, array(), true);
                        }
                    }
                    if (!empty($coursesarray)) {
                        $assocstr .= get_string('associated', 'blog', get_string('course')) . ': ' . implode(', ', $coursesarray);
                    }

                    // Now show mod association.
                    $modulesarray = array();
                    foreach ($entry->renderable->blogassociations as $assocrec) {
                        if ($assocrec->contextlevel == CONTEXT_MODULE) {
                            $str = get_string('associated', 'blog', $assocrec->type) . ': ';
                            $str .= $this->output->action_icon($assocrec->url, $assocrec->icon, null, array(), true);
                            $modulesarray[] = $str;
                        }
                    }
                    if (!empty($modulesarray)) {
                        if (!empty($coursesarray)) {
                            $assocstr .= '<br/>';
                        }
                        $assocstr .= implode('<br/>', $modulesarray);
                    }

                    // Adding the asociations to the output.
                    $o .= $this->output->container($assocstr, 'tags');
                }
                if ($entry->renderable->unassociatedentry) {
                    $o .= $this->output->container(get_string('associationunviewable', 'blog'), 'noticebox');
                }         
                // Comments.
                if (!empty($entry->renderable->comment)) {
                    
                    global $DB, $CFG, $PAGE, $USER, $COURSE;

                    $cmt = new stdClass();
                    $cmt->context = context_user::instance($entry->userid);
                    $cmt->courseid = $PAGE->course->id;
                    $cmt->area = 'format_blog';
                    $cmt->itemid = $entry->id;
                    $cmt->notoggle  = true;
                    $cmt->showcount = $CFG->blogshowcommentscount;
                    $cmt->component = 'blog';
                    $cmt->autostart = true;
                    $cmt->displaycancel = false;
                    $edmo_comments = new comment($cmt);
                    $edmo_comments->set_view_permission(true);
                    $edmo_comments->set_fullwidth();

                    $o .= $edmo_comments->output(true);
                }
            $o .= $this->output->container_end();
            // Closing maincontent div.
            $o .= $this->output->container('', 'side options');
            $o .= $this->output->container_end();

        endif;
        return $o;
    }

    /**
     * Renders an entry attachment
     *
     * Print link for non-images and returns images as HTML
     *
     * @param blog_entry_attachment $attachment
     * @return string List of attachments depending on the $return input
     */
    public function render_blog_entry_attachment(blog_entry_attachment $attachment) {

        $syscontext = context_system::instance();

        // Image attachments don't get printed as links.
        $attrs = array('src' => $attachment->url, 'alt' => '');
        $o = html_writer::empty_tag('img', $attrs);
        $class = 'attachedimages';

        return $this->output->container($o, $class);
    }
}