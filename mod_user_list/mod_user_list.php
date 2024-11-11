<?php
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Factory;

require_once __DIR__ . '/helper.php';

// Retrieve module parameters
$customMessage = $params->get('message', 'Hello, World!');
$userGroupIds = $params->get('userlist', []);
$showFullName = $params->get('show_fullname', 1);
$showUserName = $params->get('show_username', 1); // Corrected parameter name
$showEmail = $params->get('show_email', 1);
$showRegistredDate = $params->get('show_registration_date', 1);
$showLastLoginDate = $params->get('show_last_login_date', 1); // Ensure this matches XML config
$showUserGroup = $params->get('show_user_group', 1);

// Ensure userGroupIds is an array and not empty
if (empty($userGroupIds) || !is_array($userGroupIds)) {
    $userGroupIds = [];
}

// Fetch users if user groups are selected
$users = [];
if (!empty($userGroupIds)) {
    // Initialize database
    $db = Factory::getDbo();

    // Prepare query to fetch users based on group IDs
    $query = $db->getQuery(true)
        ->select($db->quoteName(['u.id', 'u.name', 'u.username', 'u.email', 'u.registerDate', 'u.lastvisitDate']))
        ->from($db->quoteName('#__users', 'u'))
        ->join('INNER', $db->quoteName('#__user_usergroup_map', 'ug') . ' ON ' . $db->quoteName('u.id') . ' = ' . $db->quoteName('ug.user_id'))
        ->where($db->quoteName('ug.group_id') . ' IN (' . implode(',', array_map('intval', $userGroupIds)) . ')')
        ->order($db->quoteName('u.name') . ' ASC');

    // Execute the query
    $db->setQuery($query);
    $users = $db->loadObjectList(); // Changed to $users for clarity
}

// Load the layout file
require ModuleHelper::getLayoutPath('mod_user_list');
