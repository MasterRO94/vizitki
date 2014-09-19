For Hosting

config.php -
            change define PATH to your domain name
            change define DB to your mysql server host
            change define USER to your db user name
            change define PASS to your user password
            change define ADMIN_EMAIL to your email

routes.php -
            uncomment line "$url = $_SERVER['REQUEST_URI'];"
            delete line "$url = str_replace('/vizitki', '', $_SERVER['REQUEST_URI']);"


views/js/editor.js -
            change src attr of img from 'http://localhost/vizitki/views/images/templates/' to 'domain.name/views/images/templates' for all matches (8 matches)
