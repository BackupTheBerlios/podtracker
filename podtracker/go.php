<?php
/*
PHP Podtracker - Die Podcast und RSS Statistik von Paul Harth.
Copyright (C) 2005 by PHP Sitetracker
PHP Sitetracker are:
Stefan Giehl & Paul Harth
http://www.phpsitetracker.de

Support: http://www.phpsitetracker.de/support
Project: http://podtracker.berlios.de

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

include("config/count_config.php");

if (isset($web)) {
$urlgo = $webfiles."/".$web;
$urllog = $web;
$cat = "web";
}

if (isset($feed)) {
$urlgo = $feedfiles."/".$feed;
$urllog = $feed;
$cat = "feed";
}

if (isset($player)) {
$urlgo = $playerfiles."/".$player;
$urllog = $player;
$cat = "player";
}

if (isset($rss)) {
$urlgo = $rssfiles."/".$rss;
$urllog = $rss;
$cat = "rss";
}

mysql_connect ("$dbhost", "$dbuser", "$dbpasswd");
$sql = "INSERT into $table (url, time, host, ip, ref, os, cat) VALUES('$urllog', NOW(), '$HTTP_HOST', '$REMOTE_ADDR', '$HTTP_REFERER', '$os', '$cat')";
mysql_db_query("$db","$sql");
header("Location: $urlgo");

