FROM moodlehq/moodle-php-apache:8.2

COPY moodle/ /var/www/html/
COPY config/config.prod.php /var/www/html/config.php
