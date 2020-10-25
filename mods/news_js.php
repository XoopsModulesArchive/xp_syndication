<?php

// XP Syndication Module.
// Written by LLaumgui (http://www.xperience-fr.net)
//
// Some code used adapted from backend.php (https://www.xoops.org/)
// and Lykos Syndication (http://www.lykoszine.co.uk)

$filename = '../cache/news.js';      //File to read/write
$timespan = 300;                   //3 hours (if the file is more recent than this, it will not be updated)

include '../../../mainfile.php';

$fd = fopen($filename, 'rb');
if ($fd and (time() - filemtime($filename) < $timespan)) {
    $contents = fread($fd, filesize($filename));

    echo $contents;

    fclose($fd);
} else {
    fclose($fd);

    $sql = 'SELECT storyid, title FROM ' . $xoopsDB->prefix('stories') . ' WHERE published>0 AND published<' . time() . ' ORDER BY published DESC';

    $result = $xoopsDB->query($sql, 10, 0);

    if (!$result) {
        echo 'An error occured';
    } else {
        $fd = fopen($filename, 'w+b');

        while ($myrow = $xoopsDB->fetchArray($result)) {
            $myrow = str_replace("'", '&#8217;', $myrow);

            $temp .= "document.write('<li> <span class=\"rss_body\"><A HREF=\"" . $xoopsConfig['xoops_url'] . '/modules/news/article.php?storyid=' . $myrow['storyid'] . '" target="_blank">';

            $temp .= $myrow['title'] . "</a></span><br>');\n";
        }

        $t = date('j/m/Y - G:i', time() - 3600);       //For time diff

        $temp .= "document.write('<div class=\"rss_footer\"> $t</div>');";
    }

    echo $temp;

    fwrite($fd, $temp, mb_strlen($temp));

    fclose($fd);
}
