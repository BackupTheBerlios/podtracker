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
    $sql = "SELECT COUNT(id) AS whole FROM $table WHERE time LIKE '%$year-%'";
    $year = date("Y");
    $query = mysql_db_query ("$db","$sql");
    while ($row = mysql_fetch_array ($query)) {
        $whole = $row[whole];
    }
    $sql = "SELECT MONTH(time) AS time, COUNT(ID) AS hits FROM $table WHERE time LIKE '$year%' GROUP BY time";
    $query = mysql_db_query ("$db","$sql");
    echo "&Uuml;bersicht der bereits geloggten Monate<br /><br />";
    echo "<table cellpadding='0' cellspacing='0'>";
    while ($row = mysql_fetch_array ($query)) {
        $hits = $row[hits];
               $stats = get_pt($hits, $whole);
        $time = $row[time];
        $keytime = patch($time);
            echo "<tr><td nowrap align='right'>\n";
                echo "<a href='$PHP_SELF?sortby=day&year=$year&month=$keytime'>$keytime/$year</a>&nbsp;</td><td>\n";
                echo show_pt($stats, $hits);
                echo "</td></tr>\n";
    }
    echo "</table>";
echo '<br /><br />
<CENTER>
<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="565" HEIGHT="420" id="FC2Line" ALIGN="center">
<PARAM NAME=movie VALUE="./gfx/FC2Line.swf?dataUrl=xmldata.php?sortby=">
<PARAM NAME=quality VALUE=high>
<PARAM NAME=bgcolor VALUE=#FFFFFF>
<EMBED src="./gfx/FC2Line.swf?dataUrl=xmldata.php?sortby=" quality=high bgcolor=#FFFFFF WIDTH="565" HEIGHT="420" NAME="FC2Line" ALIGN="center" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
</OBJECT>
</CENTER>';