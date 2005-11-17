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
        $sql = "SELECT COUNT(id) AS whole FROM $table WHERE time LIKE '%$year-$month%'";
        $query = mysql_db_query ("$db","$sql");
        while ($row = mysql_fetch_array ($query)) {
                $whole = $row[whole];
        }
        $sql = "SELECT DAYOFMONTH(time) AS time, COUNT(ID) AS hits FROM $table WHERE time LIKE '$year-$month%' GROUP BY time";
        $query = mysql_db_query ("$db","$sql");
        echo "&Uuml;bersicht der geloggten Tage aus ".$month.".".$year."<br />";
        echo "<font size='2'><a href='stats.php'>back</a><br />\n";
        echo "<table cellpadding='0' cellspacing='0'>";
    while ($row = mysql_fetch_array ($query)) {
            $hits = $row[hits];
                $stats = get_pt($hits, $whole);
                $time = $row[time];
            $keytime = patch($time);
                echo "<tr><td nowrap align='right'>\n";
                echo "$keytime/$month/$year&nbsp;</td><td>\n";
                echo show_pt($stats, $hits);
                echo "</td></tr>\n";
    }
echo "</table>";