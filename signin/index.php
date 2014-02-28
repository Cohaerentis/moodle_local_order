<?php

echo "<h1>ERROR - Moodle 2.x Plugin - Order</h1>";
echo "<p>If this text is shown is because any configuration is wrong:</p>";
echo "<ul>";
echo "<li>Apache mod_rewrite module is not enabled or installed</li>";
echo "<li>Apache AllowOverride does not allow FileInfo configuration</li>";
echo "<li>Apache Options does not allow FollowLinks option</li>";
echo "<li>.htaccess is not the name of the htaccess Apache configuration file</li>";
echo "<li>[moodle]/local/order/registry/index.php is not found or installed</li>";
echo "</ul>";

