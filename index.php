<?php
// XP Syndication Module.
// Written by LLaumgui (http://www.xperience-fr.net)
//
// Some code used adapted from backend.php (https://www.xoops.org/)
// and Lykos Syndication (http://www.lykoszine.co.uk)

include 'header.php';

if ('xp_syndication' == $xoopsConfig['startpage']) {
    $xoopsOption['show_rblock'] = 1;

    require XOOPS_ROOT_PATH . '/header.php';

    make_cblock();
} else {
    $xoopsOption['show_rblock'] = 0;

    require XOOPS_ROOT_PATH . '/header.php';
}

$myts = MyTextSanitizer::getInstance();

OpenTable();

$sql = 'SELECT * FROM ' . $xoopsDB->prefix('modules') . " WHERE isactive='1' ORDER BY weight ASC";
$result = $xoopsDB->query($sql);

echo "<h1 style='text-align:left;'>" . _SYND . '</h1>';
echo '<table>';
while ($myrow = $xoopsDB->fetchArray($result)) {
    if ('news' == $myrow['dirname']) {
        1 == $actmods['news'];

        echo "<table width='500' border='0' align='center'>";

        echo "<tr>
      <td height='100' colspan='2'> 
      <div align='center'>
      <h2>" . _NEWS . "</h2>
      </div></td>
	  </tr><tr><td width='133'><table width='100%' border='1'>
	  <tr><td><script src='" . XOOPS_URL . "/modules/xp_syndication/mods/news_js.php'></script></td></tr>
      </table></td>";

        echo "<td width='241'>";

        echo "<b>JavaScript: </b><br><textarea name='' cols='30' rows=''>&lt;script src=&quot;" . XOOPS_URL . '/modules/xp_syndication/mods/news_js.php&quot;&gt;&lt;/script&gt;</textarea><br><br>';

        echo "<b>RSS: </b><br><textarea name='' cols='30' rows=''>" . XOOPS_URL . '/modules/xp_syndication/mods/news_rss.php&nbsp;</textarea><br> ';

        echo '</td>';

        echo '</tr>';

        echo '</table>';

        echo "</br><hr width='250'>";
    }

    if ('mylinks' == $myrow['dirname']) {
        1 == $actmods['mylinks'];

        echo "<table width='500' border='0' align='center'>";

        echo "<tr>
      <td height='100' colspan='2'> 
      <div align='center'>
      <h2>" . _LINKS . "</h2>
      </div></td>
	  </tr><tr><td width='133'><table width='100%' border='1'>
	  <tr><td><script src='" . XOOPS_URL . "/modules/xp_syndication/mods/mylinks_js.php'></script></td></tr>
      </table></td>";

        echo "<td width='241'>";

        echo "<b>JavaScript: </b><br><textarea name='' cols='30' rows=''>&lt;script src=&quot;" . XOOPS_URL . '/modules/xp_syndication/mods/mylinks_js.php&quot;&gt;&lt;/script&gt;</textarea><br><br>';

        echo "<b>RSS: </b><br><textarea name='' cols='30' rows=''>" . XOOPS_URL . '/modules/xp_syndication/mods/mylinks_rss.php&nbsp;</textarea><br> ';

        echo '</td>';

        echo '</tr>';

        echo '</table>';

        echo "</br><hr width='250'>";
    }

    if ('mydownloads' == $myrow['dirname']) {
        1 == $actmods['mydownloads'];

        echo "<table width='500' border='0' align='center'>";

        echo "<tr>
      <td height='100' colspan='2'> 
      <div align='center'>
      <h2>" . _DOWNLOADS . "</h2>
      </div></td>
	  </tr><tr><td width='133'><table width='100%' border='1'>
	  <tr><td><script src='" . XOOPS_URL . "/modules/xp_syndication/mods/mydownloads_js.php'></script></td></tr>
      </table></td>";

        echo "<td width='241'>";

        echo "<b>JavaScript: </b><br><textarea name='' cols='30' rows=''>&lt;script src=&quot;" . XOOPS_URL . '/modules/xp_syndication/mods/mydownloads_js.php&quot;&gt;&lt;/script&gt;</textarea><br><br>';

        echo "<b>RSS: </b><br><textarea name='' cols='30' rows=''>" . XOOPS_URL . '/modules/xp_syndication/mods/mydownloads_rss.php&nbsp;</textarea><br> ';

        echo '</td>';

        echo '</tr>';

        echo '</table>';

        echo "</br><hr width='250'>";
    }

    if ('ipboard' == $myrow['dirname']) {
        1 == $actmods['ipboard'];

        echo "<table width='500' border='0' align='center'>";

        echo "<tr>
      <td height='100' colspan='2'> 
      <div align='center'>
      <h2>" . _FORUM . "</h2>
      </div></td>
	  </tr><tr><td width='133'><table width='100%' border='1'>
	  <tr><td><script src='" . XOOPS_URL . "/modules/xp_syndication/mods/ipboard_js.php'></script></td></tr>
      </table></td>";

        echo "<td width='241'>";

        echo "<b>JavaScript: </b><br><textarea name='' cols='30' rows=''>&lt;script src=&quot;" . XOOPS_URL . '/modules/xp_syndication/mods/ipboard_js.php&quot;&gt;&lt;/script&gt;</textarea><br><br>';

        echo "<b>RSS: </b><br><textarea name='' cols='30' rows=''>" . XOOPS_URL . '/modules/xp_syndication/mods/ipboard_rss.php&nbsp;</textarea><br> ';

        echo '</td>';

        echo '</tr>';

        echo '</table>';

        echo "</br><hr width='250'>";
    }

    if ('newbb' == $myrow['dirname']) {
        1 == $actmods['newbb'];

        echo "<table width='500' border='0' align='center'>";

        echo "<tr>
      <td height='100' colspan='2'> 
      <div align='center'>
      <h2>" . Forums . "</h2>
      </div></td>
	  </tr><tr><td width='133'><table width='100%' border='1'>
	  <tr><td><script src='" . XOOPS_URL . "/modules/xp_syndication/mods/newbb_js.php'></script></td></tr>
      </table></td>";

        echo "<td width='241'>";

        echo "<b>JavaScript: </b><br><textarea name='' cols='30' rows=''>&lt;script src=&quot;" . XOOPS_URL . '/modules/xp_syndication/mods/newbb_js.php&quot;&gt;&lt;/script&gt;</textarea><br><br>';

        echo "<b>RSS: </b><br><textarea name='' cols='30' rows=''>" . XOOPS_URL . '/modules/xp_syndication/mods/newbb_rss.php&nbsp;</textarea><br> ';

        echo '</td>';

        echo '</tr>';

        echo '</table>';

        echo "</br><hr width='250'>";
    }
}

echo '<br><br>' . _ESPL . '<br>';

CloseTable();
include(XOOPS_ROOT_PATH . '/footer.php');
