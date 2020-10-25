<?php

// XP Syndication Module.
// Written by LLaumgui (http://www.xperience-fr.net)
//
// Some code used adapted from backend.php (https://www.xoops.org/)
// and Lykos Syndication (http://www.lykoszine.co.uk)

$filename = '../cache/news.rss';      //File to read/write
$timespan = 30;                       //3 hours (if the file is more recent than this, it will not be updated)

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
        header('Content-Type: text/plain');

        $fd = fopen($filename, 'w+b');

        $temp = '<?xml version="1.0" encoding="' . _CHARSET . "\"?>\n";

        $temp .= "<rss version=\"0.92\">\n";

        $temp .= "  <channel>\n";

        $temp .= '       <title>' . $xoopsConfig['sitename'] . "</title>\n";

        $temp .= '       <link>' . XOOPS_URL . "/</link>\n";

        $temp .= '       <description>' . $xoopsConfig['slogan'] . "</description>\n";

        $temp .= "    <image>\n";

        $temp .= '       <title>' . $xoopsConfig['sitename'] . "</title>\n";

        $temp .= '       <url>' . XOOPS_URL . "/images/logo.gif</url>\n";

        $temp .= '       <link>' . XOOPS_URL . "/</link>\n";

        $temp .= '       <description>' . $xoopsConfig['slogan'] . "</description>\n";

        $temp .= "       <width>88</width>\n";

        $temp .= "       <height>31</height>\n";

        $temp .= "    </image>\n";

        $myts = MyTextSanitizer::getInstance();

        while ($myrow = $xoopsDB->fetchArray($result)) {
            $myrow = str_replace('é', '&eacute;', $myrow);

            $myrow = str_replace('è', '&egrave;', $myrow);

            $myrow = str_replace('&', '&amp;', $myrow);

            $myrow = str_replace('ç', '&ccedil;', $myrow);

            $temp .= "    <item>\n";

            $temp .= '       <title>' . htmlspecialchars($myrow['title'], ENT_QUOTES | ENT_HTML5) . "</title>\n";

            $temp .= '       <link>' . XOOPS_URL . '/modules/news/article.php?storyid=' . htmlspecialchars($myrow['storyid'], ENT_QUOTES | ENT_HTML5) . "</link>\n";

            $temp .= "    </item>\n";
        }

        $temp .= "  </channel>\n";

        $temp .= '</rss>';
    }

    echo $temp;

    fwrite($fd, $temp, mb_strlen($temp));

    fclose($fd);
}
