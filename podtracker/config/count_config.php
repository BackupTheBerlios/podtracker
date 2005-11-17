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

$dbhost = ""; // DB Server
$dbuser = ""; // DB User
$dbpasswd = ""; // DB Passwort
$db = ""; // DB Name
$table = "ptracker"; // DB Tabellenname

//Mediaverzeichnisse
$webfiles = "/demo/media";
$feedfiles = "/demo/media";
$playerfiles = "/demo/media";
$rssfiles = "/demo/media";

function patch($time) {
    $laenge = strlen($time);
    strval($laenge);
    if($laenge == "1") {
        $keytime = "0$time";
    } else {
        $keytime = $time;
    }
    return "$keytime";
}

function get_pt($hits, $whole) {
$stats = $hits*100/$whole;
    return $stats = round($stats);
}

function show_pt($stats, $hits) {
        $gstats = 100 - $stats;
        $output = "<img src='gfx/line.gif' height='10' width='1'><img src='gfx/blau.gif' height='10' width='$stats'><img src='gfx/grau.gif' height='10' width='$gstats'><img src='gfx/line.gif' height='10' width='1'> <b>$hits</b> ($stats %)</font>";
        return "$output";
}

function word2color($wrd){
if (strlen($w)==0) return substr('00000' . dechex(mt_rand(0, 0xffffff)), -6);
while (strlen($w)<6) $w.=$w;
$minbrightness=1;  // range from 0 to 15, if this is 0 then for ex. black is allowed
$max_brightness=14; // range from 0 to 15, if this is 15 then for ex. white is allowed
$plus_red=0;    // set one of these to set the probability of one of these colors higher
$plus_green=0;
$plus_blue=0;
for ($i=0; $i<6; $i++) {
   #$r.= '">';// this is a depug mode, to see the color written
   $plus=0;
   if ($plus_red<>0 and $i==0) $plus=$plus_red;
   if ($plus_green<>0 and $i==2) $plus=$plus_green;
   if ($plus_blue<>0 and $i==4) $plus=$plus_blue;
   $c=$w[round(strlen($w)/6*$i)];
   $dec=ord($c)%($max_brightness+$plus-$minbrightness) +$minbrightness+$plus;
   if ($dec>$max_brightness-$minbrightness) $dec=$max_brightness-$minbrightness;
   $r.= strtoupper( dechex($dec) );
}
return $r;
}

function color_mkwebsafe ( $in )
{
   // put values into an easy-to-use array
   $vals['r'] = hexdec( substr($in, 0, 2) );
   $vals['g'] = hexdec( substr($in, 2, 2) );
   $vals['b'] = hexdec( substr($in, 4, 2) );

   // loop through
   foreach( $vals as $val )
   {
       // convert value
       $val = ( round($val/51) * 51 );
       // convert to HEX
       $out .= str_pad(dechex($val), 2, '0', STR_PAD_LEFT);
   }

   return $out;
}

