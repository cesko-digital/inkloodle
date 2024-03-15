<?php
global $CFG;
require_once($CFG->dirroot .'/blog/lib.php');
require_once($CFG->dirroot .'/blog/locallib.php');
require_once($CFG->dirroot . '/theme/edmo/inc/block_handler/get-content.php');
class block_edmo_blog_area extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_edmo_blog_area');
    }

    // Declare second
    public function specialization()
    {
        global $CFG, $DB;
        include($CFG->dirroot . '/theme/edmo/inc/block_handler/specialization.php');
        if (empty($this->config)) {
            $this->config = new \stdClass();
            $this->config->style = 1;
            $this->config->top_title = 'NEWS AND BLOGS';
            $this->config->title = 'Our Latest Publications';
            $this->config->subtitle = 'We always give extra care to our students skills improvements and feel excited to share our latest research and learnings!';
            $this->config->bottom_body = 'Get into details now?';
            $this->config->button_text = 'View all posts';
            $this->config->button_link = $CFG->wwwroot . '/blog/index.php';
        }
    }

    public function get_content() {
        global $CFG, $PAGE;

        if ($this->content !== null) {
            return $this->content;
        }
        $this->content         =  new stdClass;
        if(!empty($this->config->top_title)){$this->content->top_title = $this->config->top_title;} else {$this->content->top_title = '';}
        if(!empty($this->config->title)){$this->content->title = $this->config->title;} else {$this->content->title = '';}
        if(!empty($this->config->subtitle)){$this->content->subtitle = $this->config->subtitle;} else {$this->content->subtitle = '';}
        if(!empty($this->config->bottom_body)){$this->content->bottom_body = $this->config->bottom_body;} else {$this->content->bottom_body = '';}
        if(!empty($this->config->button_text)){$this->content->button_text = $this->config->button_text;} else {$this->content->button_text = '';}
        if(!empty($this->config->button_link)){$this->content->button_link = $this->config->button_link;} else {$this->content->button_link = '';}

        if(!empty($this->config->posts)){$this->content->posts = $this->config->posts;} else { $this->content->posts = '';}

        $url = new moodle_url('/blog/index.php');

        global $CFG;
        $bloglisting = new blog_listing();

        $entries = $bloglisting->get_entries();
        
        $entrieslist = array();
        $viewblogurl = new moodle_url('/blog/index.php');

        $style = 1;
        if(isset($this->config->style)){
            $style = $this->config->style;
        }

        $text = '';
        if($style == 2):
            $text .= '
            <!-- Start Blog Area -->
            <div class="blog-area ptb-100">
                <div class="container">
                    <div class="section-title">
                        <span class="sub-title">'.$this->content->top_title.'</span>
                        <h2>'.$this->content->title.'</h2>
                        <p>'.$this->content->subtitle.'</p>
                    </div>
                    <div class="row">';
                        if($this->content->posts):
                            $i = 1;
                            foreach ($entries as $entryid => $entry) {
                                $viewblogurl->param('entryid', $entryid);
                                $entrylink = html_writer::link($viewblogurl, shorten_text($entry->subject));
                                $entrieslist[] = $entrylink;
                
                                $blogentry = new blog_entry($entryid);
                                $blogattachments = $blogentry->get_attachments();

                                $module = $entry->module;
                                $short_summary = $entry->summary;
                                $short_summary = strip_tags( $short_summary);
                                $short_summary = implode(' ', array_slice(str_word_count($short_summary,1), 0, 15));

                                if(in_array($entry->id, $this->content->posts)):
                                    if($i == 1):
                                        $text .= '
                                        <div class="col-lg-8 col-md-12">
                                            <div class="single-blog-post-item">
                                                <div class="post-image">
                                                    <a href="'.$viewblogurl.'" class="d-block">
                                                        <img src="'.$blogattachments[0]->url.'" alt="'.$entry->subject.'">
                                                    </a>
                                                </div>
                                                <div class="post-content">
                                                    <div class="category">'.$module.'</div>
                                                    <h3><a href="'.$viewblogurl.'">'.$entry->subject.'</a></h3>
                                                    <ul class="post-content-footer d-flex align-items-center">
                                                        <li><i class="flaticon-user"></i><a href="'.$viewblogurl.'">'.$entry->firstname.' '.$entry->lastname.'</a></li>
                                                        <li><i class="flaticon-calendar"></i>'. userdate($entry->created, '%d %B %Y', 0) .'</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>';
                                    endif;
                                    $i++;
                                endif;
                            }
                        endif;
                        $text .= '
                        <div class="col-lg-4 col-md-12">
                            <div class="blog-post-list">
                                <div class="row">';
                                    if($this->content->posts):
                                        $i = 1;
                                        foreach ($entries as $entryid => $entry) {
                                            $viewblogurl->param('entryid', $entryid);
                                            $entrylink = html_writer::link($viewblogurl, shorten_text($entry->subject));
                                            $entrieslist[] = $entrylink;
                            
                                            $blogentry = new blog_entry($entryid);
                                            $blogattachments = $blogentry->get_attachments();

                                            $module = $entry->module;
                                            $short_summary = $entry->summary;
                                            $short_summary = strip_tags( $short_summary);
                                            $short_summary = implode(' ', array_slice(str_word_count($short_summary,1), 0, 15));

                                            if(in_array($entry->id, $this->content->posts)):
                                                if($i != 1):
                                                    $text .= '
                                                    <div class="single-blog-post-item">
                                                        <div class="post-image">
                                                            <a href="'.$viewblogurl.'" class="d-block">
                                                                <img src="'.$blogattachments[0]->url.'" alt="'.$entry->subject.'">
                                                            </a>
                                                        </div>
                                                        <div class="post-content">
                                                            <h3><a href="'.$viewblogurl.'">'.$entry->subject.'</a></h3>
                                                        </div>
                                                    </div>';
                                                endif;
                                                $i++;
                                            endif;
                                        }
                                    endif;
                                    $text .= '
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="blog-post-info">
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
            <!-- End Blog Area -->';
        else:
            $text .= '
            <!-- Start Blog Area -->
            <div class="blog-area ptb-100">
                <div class="container">
                    <div class="section-title">
                        <span class="sub-title">'.$this->content->top_title.'</span>
                        <h2>'.$this->content->title.'</h2>
                        <p>'.$this->content->subtitle.'</p>
                    </div>
                    <div class="row justify-content-center">';
                        if($this->content->posts):
                            foreach ($entries as $entryid => $entry) {
                                $viewblogurl->param('entryid', $entryid);
                                $entrylink = html_writer::link($viewblogurl, shorten_text($entry->subject));
                                $entrieslist[] = $entrylink;
                
                                $blogentry = new blog_entry($entryid);
                                $blogattachments = $blogentry->get_attachments();

                                $module = $entry->module;
                                $short_summary = $entry->summary;
                                $short_summary = strip_tags( $short_summary);
                                $short_summary = implode(' ', array_slice(str_word_count($short_summary,1), 0, 15));

                                if(in_array($entry->id, $this->content->posts)):
                                    $text .= '
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-blog-post">
                                            <div class="post-image">
                                                <a href="'.$viewblogurl.'" class="d-block">
                                                    <img src="'.$blogattachments[0]->url.'" alt="'.$entry->subject.'">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <div class="category">'.$module.'</div>
                                                <h3><a href="'.$viewblogurl.'">'.$entry->subject.'</a></h3>
                                                <ul class="post-content-footer d-flex justify-content-between align-items-center">
                                                    <li><i class="flaticon-user"></i><a href="'.$viewblogurl.'">'.$entry->firstname.' '.$entry->lastname.'</a></li>
                                                    <li><i class="flaticon-calendar"></i>'. userdate($entry->created, '%d %B %Y', 0) .'</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>';
                                endif;
                            }
                        endif;
                        $text .= '

                        <div class="col-lg-12 col-md-12">
                            <div class="blog-post-info">
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
            <!-- End Blog Area -->';
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