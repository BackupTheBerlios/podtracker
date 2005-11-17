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
$link = mysql_connect ("$dbhost", "$dbuser", "$dbpasswd");


if($sortby == "") {
    $sql = "SELECT COUNT(id) AS whole FROM $table WHERE time LIKE '%$year-%'";
    $year = date("Y");
    $query = mysql_db_query ("$db","$sql");
    while ($row = mysql_fetch_array ($query)) {
        $whole = $row[whole];
	    }
    $sql = "SELECT MONTH(time) AS time, COUNT(ID) AS hits FROM $table WHERE time LIKE '$year%' GROUP BY time";
    $query = mysql_db_query ("$db","$sql");
//	echo "<graph bgcolor='ffffff'  caption='Übersicht der geloggten Monate' subCaption='' yaxisminvalue='0' yaxisname='Aufrufe' xaxisname='Monate'  showgridbg='0' showcanvas='0' hovercapbg='FFFFDD' hovercapborder='CECE00' numdivlines='0' >";
	echo "<graph bgcolor='ffffff'  caption='Übersicht der geloggten Monate' yaxisminvalue='0' showgridbg='1' showcanvas='0' hovercapbg='FFFFDD' hovercapborder='CECE00' numdivlines='$hits' >";
    while ($row = mysql_fetch_array ($query)) {
        $hits = $row[hits];
        $time = $row[time];
        $keytime = patch($time);
		$clr = word2color($time);
		$clr = color_mkwebsafe($clr);
	    echo "<set name='$keytime/$year' value='$hits' color='$clr' link='stats.php?sortby=day&year=$year&month=$keytime' />";
	    }
    echo "</graph>";
}

// Sort by Day
if($sortby == "day") {
        $sql = "SELECT COUNT(id) AS whole FROM $table WHERE time LIKE '%$year-$month%'";
        $query = mysql_db_query ("$db","$sql");
        while ($row = mysql_fetch_array ($query)) {
                $whole = $row[whole];
        }
        $sql = "SELECT DAYOFMONTH(time) AS time, COUNT(ID) AS hits FROM $table WHERE time LIKE '$year-$month%' GROUP BY time";
        $query = mysql_db_query ("$db","$sql");
	echo "<graph bgcolor='ffffff'  caption='Übersicht der geloggten Monate' subCaption='' yaxisminvalue='0' yaxisname='Aufrufe' xaxisname='Monate'  showgridbg='0' showcanvas='0' hovercapbg='FFFFDD' hovercapborder='CECE00' numdivlines='0' >";
    while ($row = mysql_fetch_array ($query)) {
        $hits = $row[hits];
        $time = $row[time];
        $keytime = patch($time);
		$clr = word2color($time);
		$clr = color_mkwebsafe($clr);
	    echo "<set name='$keytime $month' value='$hits' color='$clr' />";
 //               echo "$keytime/$month/$year&nbsp;</td><td>\n";
    }
echo "</graph>";
}


if ($sortby == "files") {
$sql = "SELECT COUNT(id) AS whole FROM $table LIMIT 0,50";
$year = date("Y");
$query = mysql_db_query ("$db","$sql");
while ($row = mysql_fetch_array ($query)) {
    $whole = $row[whole];
	}
$sql = "SELECT url, COUNT(ID) AS hits FROM $table GROUP BY url ORDER BY hits DESC LIMIT 0,50";
$query = mysql_db_query ("$db","$sql");
//echo "<graph bgcolor='ffffff'  caption='Übersicht der aufgerufenen Dateien' subCaption='' yaxisminvalue='0' yaxisname='Aufrufe' xaxisname='Dateinamen'  showgridbg='0' showcanvas='0' hovercapbg='FFFFDD' hovercapborder='CECE00' numdivlines='0' >";
echo "<graph bgcolor='ffffff'  caption='Übersicht der aufgerufenen Dateien' yaxisminvalue='0' showgridbg='1' showcanvas='0' hovercapbg='FFFFDD' hovercapborder='CECE00' numdivlines='$hits' >";
while ($row = mysql_fetch_array ($query)) {
    $url = $row[url];
    $hits = $row[hits];

	$clr = word2color($url);
	$clr = color_mkwebsafe($clr);
    echo "<set name='$url' value='$hits' color='$clr' link='$url' />";
    }
echo "</graph>";
}

if ($sortby == "referer") {
    $sql = "SELECT COUNT(id) AS whole FROM $table";
    $year = date("Y");
    $query = mysql_db_query ("$db","$sql");
    while ($row = mysql_fetch_array ($query)) {
        $whole = $row[whole];
    }
    $sql = "SELECT ref, COUNT(ID) AS hits FROM $table GROUP BY ref ORDER BY hits DESC";
    $query = mysql_db_query ("$db","$sql");
echo "<graph bgcolor='ffffff'  caption='Übersicht der aufgerufenen Dateien' yaxisminvalue='0' showgridbg='1' showcanvas='0' hovercapbg='FFFFDD' hovercapborder='CECE00' numdivlines='$hits' >";
    while ($row = mysql_fetch_array ($query)) {
        $hits = $row[hits];
        $ref = $row[ref];
        if($ref == "") {
          $reftext = "Keine Herkunft erkennbar";
		  }
	$clr = word2color($url);
	$clr = color_mkwebsafe($clr);
    echo "<set name='$ref' value='$hits' color='$clr' link='stats.php?sortby=referer&ref=$ref' />";
    }
    echo "</graph>";
}
