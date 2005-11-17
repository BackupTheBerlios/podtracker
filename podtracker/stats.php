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
?>

<head>
<title>PHP PodTracker</title>
<style>
body 	   {font-family:arial,arial; color:black; font-size:12px;background-color:#ffffff;}
.normal    {font-family:arial,arial; color:black; font-size:12px;}
TD         {font-family:arial,arial; color:black; font-size:12px;}
pre        {font-family:arial,arial; color:black; font-size:12px;}
A:link     {color:blue; text-decoration: none; font-style: bold; }
A:active   {color:red; text-decoration: none; font-style: bold; }
A:visited  {color:blue; text-decoration: none; font-style: bold; }
</style>
</head>
<body>
<table align='center' bgcolor='#a9a9a9' cellpadding='0' cellspacing='0' border='0'>
<tr>
<td align='right' bgcolor='#ffffff' nowrap>
<b> . : P O D T R A C K E R</a>
</td>
<tr>
<td>
<table bgcolor='#ffffff' width=600 cellpadding='4' cellspacing='1' border='0'>
<tr>
<td bgcolor='#eeeeee'>
<div style="float:left;width:296px;"><font color='crimson'>
<a href='<? echo "$PHP_SELF"; ?>'>Requests</a> |
<a href='<? echo "$PHP_SELF?sortby=files"; ?>'>Top 50 Files</a> |
<a href='<? echo "$PHP_SELF?sortby=referer"; ?>'>Referer</a> |
<a href='<? echo "$PHP_SELF?sortby=os"; ?>'>OS</a>
</font></div>
<div style="float:left;text-align:right;width:296px;"><font color='crimson'>
<a href='<? echo "$PHP_SELF?sortby=web"; ?>'>WEB</a> |
<a href='<? echo "$PHP_SELF?sortby=feed"; ?>'>FEED</a> |
<a href='<? echo "$PHP_SELF?sortby=player"; ?>'>PLAYER</a> |
<a href='<? echo "$PHP_SELF?sortby=rss"; ?>'>RSS</a>
</font></div>
</td>
</tr>
<tr>
<td nowrap>
<br>

<?
include("config/count_config.php");
$link = mysql_connect ("$dbhost", "$dbuser", "$dbpasswd");


//Sort by year
if($sortby == "") {
include("includes/sortby_start.inc.php");
}

// Sort by Day
if($sortby == "day") {
include("includes/sortby_day.inc.php");
}

// last 10 visitors
// Coming next

// Sort by Files
if($sortby == "files") {
include("includes/sortby_files.inc.php");
}

// Sort by Referer
if($sortby == "referer") {
include("includes/sortby_referer.inc.php");
}

// Sort by OS
if($sortby == "os") {
include("includes/sortby_os.inc.php");
}

// Sort by WEB
if($sortby == "web") {
include("includes/sortby_web.inc.php");
}

// Sort by FEED
if($sortby == "feed") {
include("includes/sortby_feed.inc.php");
}

// Sort by PLAYER
if($sortby == "player") {
include("includes/sortby_player.inc.php");
}

// Sort by RSS
if($sortby == "rss") {
include("includes/sortby_rss.inc.php");
}
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>

