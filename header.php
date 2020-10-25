<?php
// XP Syndication Module
// Written by LLaumgui (http://www.xperience-fr.net)
//
// Some code used adapted from backend.php (https://www.xoops.org/)
// and Lykos Syndication (http://www.lykoszine.co.uk)

include '../../mainfile.php';

// Include the appropriate language file.

if (file_exists(XOOPS_ROOT_PATH . '/modules/xp_syndication/language/' . $xoopsConfig['language'] . '/main.php')) {
    require XOOPS_ROOT_PATH . '/modules/xp_syndication/language/' . $xoopsConfig['language'] . '/main.php';
} else {
    require XOOPS_ROOT_PATH . '/modules/xp_syndication/language/english/main.php';
}
