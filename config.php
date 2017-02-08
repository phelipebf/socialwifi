<?php

// Rename to config.php

// database host
#define('DB_HOST', 'localhost');
define('DB_HOST', '127.8.209.130');
// database port
define('DB_PORT', '3306');
// database name
define('DB_NAME', 'socialwifi');
// database user name
#define('DB_USER', 'root');
define('DB_USER', 'adminfRLgbfq');
// database password
#define('DB_PASS', '');
define('DB_PASS', 'cFgFLU93i68s');

// Facebook app id
// See README.md for details
define('APP_ID', '1363806173726766');

// Facebook app secret
define('APP_SECRET', '361e71a36f14350916ab46066bae2a40');

// ID of your Facebook page
// This is where people will be checking in
define('PAGE_ID', '1070986626316571');

// Name of your facebook page
// This is how your place will be called in this script
// e.g. "Log in at PAGE_NAME"
define('PAGE_NAME', 'Social Wifi');

// Facebook permissions scope
// Scope of permissions to retrieve on facebook authentication
// e.g. 'public_profile', 'friends_list', 'publish_actions', 'user_likes'
define('SCOPE', array('public_profile', 'publish_actions', 'user_likes'));

// The URL where this script lives
// This will typically a directory as the .htaccess
// rewrites all requests to index.php
// Example: https://example.xyz/wifi/
define('MY_URL', 'http://socialwifi-phelipebf.rhcloud.com/');

// How long the wifi session persists before if expires
// Set this in Minutes
define('SESSION_DURATION', 60 * 12);

// This is the access code you can hand out to
// people if they do not want to use Facebook.
// Note: case sensitive!
define('ACCESS_CODE', 'ACCESS_CODE');

// Don't forget to whitelist these domains on the gateway!
// URL pointing to an extended privacy policy
// Note that this script ships with a default privacy notice
// which may not be suitable for you
// If set to the empty string, then the link will not be rendered
define('EXTENDED_PRIVACY_URL', 'http://example.xyz/privacy/');

// URL pointing to an imprint as required in some jurisdictions
// If set to the empty string, then the link will not be rendered
define('IMPRINT_URL', 'http://example.xyz/imprint/');

// How long the session cookie is valid.
// You probably do not have to change this.
// In seconds
define('COOKIE_SESSION_DURATION', 3600 * 24);

// Where user is sent after login is done
define('PORTAL_URL', 'http://www.google.com');

// Display helpful message to the FB review people
define('FB_REVIEW', False);

// Where you host your copy of the code.
// If you did not modify anything, use the github
// below. Otherwise, the AGPL requires that you provide
// a download link for your modified sources (unless
// you're under some special circumstances, see the license).
define('CODE_URL', 'https://www.github.com/mhaas/fbwlan/')

?>
