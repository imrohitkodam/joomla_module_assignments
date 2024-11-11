<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class ModUserListHelper
{
    public static function getUsersByGroups($userGroupIds)
    {
        // Check if userGroupIds is an array and not empty
        if (empty($userGroupIds) || !is_array($userGroupIds)) {
            return []; // Return empty array if no valid group IDs are provided
        }

        // Get the database object
        $db = Factory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__user_usergroup_map', 'g'))
            ->where($db->quoteName('g.group_id') . ' IN (' . implode(',', array_map('intval', $userGroupIds)) . ')');

        // Execute the query
        $db->setQuery($query);
        return $db->loadObjectList();
    }
}
