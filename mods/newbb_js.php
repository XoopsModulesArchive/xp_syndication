<?php

// XP Syndication Module.
// Written by LLaumgui (http://www.xperience-fr.net)
//
// Some code used adapted from backend.php (https://www.xoops.org/)
// and Lykos Syndication (http://www.lykoszine.co.uk)

$filename = '../cache/newbb.js';      //File to read/write
$timespan = 300;                   //3 hours (if the file is more recent than this, it will not be updated)

include '../../../mainfile.php';

$fd = fopen($filename, 'rb');
if ($fd and (time() - filemtime($filename) < $timespan)) {
    $contents = fread($fd, filesize($filename));

    echo $contents;

    fclose($fd);
} else {
    fclose($fd);

    $sql = 'SELECT t.topic_id, t.topic_title, t.topic_time, t.topic_views, t.topic_replies, t.forum_id, f.forum_name
   FROM ' . $xoopsDB->prefix('bb_topics') . ' t, ' . $xoopsDB->prefix('bb_forums') . ' f
   
   WHERE (f.forum_id=t.forum_id) AND (f.forum_type <> 1)
   
   
   ORDER BY topic_time DESC';

    $result = $xoopsDB->query($sql, 10, 0);

    if (!$result) {
        echo 'An error occured';
    } else {
        $fd = fopen($filename, 'w+b');

        while ($myrow = $xoopsDB->fetchArray($result)) {
            $myrow = str_replace("'", '&#8217;', $myrow);

            $temp .= "document.write('<li><span class=\"rss_body\"><A HREF=\"" . XOOPS_URL . '/modules/newbb/viewtopic.php?topic_id=' . $myrow['topic_id'] . '&forum=' . $myrow['forum_id'] . '" target="_blank">';

            $temp .= $myrow['topic_title'] . "</a></span><br>');\n";
        }

        $t = date('j/m/Y - G:i', time() - $timespan);       //For time diff

        $temp .= "document.write('<div class=\"rss_footer\"> $t</div>');";
    }

    echo $temp;

    fwrite($fd, $temp, mb_strlen($temp));

    fclose($fd);
}
