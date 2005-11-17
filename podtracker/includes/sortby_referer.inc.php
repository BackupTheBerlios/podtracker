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
if(isset($ref)) {
    $sql = "SELECT COUNT(id) AS whole FROM $table WHERE ref='$ref'";
    $year = date("Y");
    $query = mysql_db_query ("$db","$sql");
    while ($row = mysql_fetch_array ($query)) {
        $whole = $row[whole];
    }
    $sql = "SELECT url, COUNT(ID) AS hits FROM $table WHERE ref='$ref' GROUP BY url ORDER BY hits DESC";
    $query = mysql_db_query ("$db","$sql");
    echo "Alle Dateien welche über <a href=\"".$ref."\" target=\"_blank\">".$ref."</a> aufgerufen wurden.<br /><br />";
    echo "<table cellpadding='0' cellspacing='0'>";
    while ($row = mysql_fetch_array ($query)) {
        $hits = $row[hits];
               $stats = get_pt($hits, $whole);
                $ref = $row[url];
                if($ref == "") {
                        $ref = "No referer";
                } else {
                        $ref = "<a href='$ref'>$ref</a>";
                }
            echo "<tr><td nowrap>$ref&nbsp;</td><td>\n";
                echo show_pt($stats, $hits);
                echo "</td></tr>\n";
    }
    echo "</table>";
}
else {
    $sql = "SELECT COUNT(id) AS whole FROM $table";
    $year = date("Y");
    $query = mysql_db_query ("$db","$sql");
    while ($row = mysql_fetch_array ($query)) {
        $whole = $row[whole];
    }
    $sql = "SELECT ref, COUNT(ID) AS hits FROM $table GROUP BY ref ORDER BY hits DESC";
    $query = mysql_db_query ("$db","$sql");
    echo "<table cellpadding='0' cellspacing='0'>";
    while ($row = mysql_fetch_array ($query)) {
        $hits = $row[hits];
               $stats = get_pt($hits, $whole);
                $ref = $row[ref];
                if($ref == "") {
                        $ref = "<a href='stats.php?sortby=referer&ref=$ref'>Keine Herkunft erkennbar</a>";
                } else {
                        $ref = "<a href='stats.php?sortby=referer&ref=$ref'>$ref</a>";
                }
            echo "<tr><td nowrap>$ref&nbsp;</td><td>\n";
                echo show_pt($stats, $hits);
                echo "</td></tr>\n";
    }
    echo "</table>";
}