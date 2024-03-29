<?php // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype = getenv("MOODLE_DOCKER_DBTYPE");
$CFG->dblibrary = "native";
$CFG->dbhost = getenv("MOODLE_DOCKER_DBHOST");
$CFG->dbname = getenv("MOODLE_DOCKER_DBNAME");
$CFG->dbuser = getenv("MOODLE_DOCKER_DBUSER");
$CFG->dbpass = getenv("MOODLE_DOCKER_DBPASS");
$CFG->prefix = "m_";
$CFG->dboptions = ["dbcollation" => getenv("MOODLE_DOCKER_DBCOLLATION")];

if (empty($_SERVER["HTTP_HOST"])) {
    $_SERVER["HTTP_HOST"] = "localhost";
}

$CFG->reverseproxy = true;
$CFG->sslproxy = 1;
$CFG->wwwroot = getenv("MOODLE_DOCKER_WEB_HOST");
$port = getenv("MOODLE_DOCKER_WEB_PORT");
if (!empty($port)) {
    // Extract port in case the format is bind_ip:port.
    $parts = explode(":", $port);
    $port = end($parts);
    if ((string) (int) $port === (string) $port) {
        // Only if it's int value.
        $CFG->wwwroot .= ":{$port}";
    }
}

$CFG->dataroot = "/var/www/moodledata";
$CFG->admin = "admin";
$CFG->directorypermissions = 0777;

// TODO: Configure SMTP
$CFG->smtphosts = "mailpit:1025";
$CFG->noreplyaddress = "noreply@example.com";

// Debug options - possible to be controlled by flag in future..
// $CFG->debug = (E_ALL | E_STRICT); // DEBUG_DEVELOPER
// $CFG->debugdisplay = 1;
// $CFG->debugstringids = 1; // Add strings=1 to url to get string ids.
// $CFG->perfdebug = 15;
// $CFG->debugpageinfo = 1;
// $CFG->allowthemechangeonurl = 1;
$CFG->passwordpolicy = 0;
$CFG->cronclionly = 0;
$CFG->pathtophp = "/usr/local/bin/php";

require_once __DIR__ . "/lib/setup.php";
