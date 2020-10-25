<?php

// XP Syndication Module.
// Written by LLaumgui (http://www.xperience-fr.net)
//
// Some code used adapted from backend.php (https://www.xoops.org/)
// and Lykos Syndication (http://www.lykoszine.co.uk)

$filename = '../cache/ipboard.js';      //File to read/write
$timespan = 300;                   //3 hours (if the file is more recent than this, it will not be updated)

include '../../../mainfile.php';

$fd = fopen($filename, 'rb');
if ($fd and (time() - filemtime($filename) < $timespan)) {
    $contents = fread($fd, filesize($filename));

    echo $contents;

    fclose($fd);
} else {
    fclose($fd);

    $sql = 'SELECT t.tid, t.title, t.start_date, t.last_post, t.views, t.posts, t.forum_id, p.author_name, p.author_id, f.name
   FROM ' . $xoopsDB->prefix('ipb_topics') . ' t, ' . $xoopsDB->prefix('ipb_forums') . ' f, ' . $xoopsDB->prefix('ipb_posts') . " p
   
   WHERE (f.id=t.forum_id)
				AND (f.read_perms='*') 						
				AND (t.last_post=p.post_date)
				AND (t.tid=p.topic_id)
   
   
   ORDER BY last_post DESC";

    $result = $xoopsDB->query($sql, 10, 0);

    if (!$result) {
        echo 'An error occured';
    } else {
        $fd = fopen($filename, 'w+b');

        while ($myrow = $xoopsDB->fetchArray($result)) {
            $myrow = str_replace("'", '&#8217;', $myrow);

            $temp .= "document.write('<li> <span class=\"rss_body\"><A HREF=\"" . XOOPS_URL . '/modules/ipboard/index.php?act=ST&f=' . $myrow['forum_id'] . '&t=' . $myrow['tid'] . '" target="_blank">';

            $temp .= $myrow['title'] . "</a></span><br>');\n";
        }

        $t = date('j/m/Y - G:i', time() - $timespan);       //For time diff

        $temp .= "document.write('<div class=\"rss_footer\"> $t</div>');";
    }

    echo $temp;

    fwrite($fd, $temp, mb_strlen($temp));

    fclose($fd);
}
