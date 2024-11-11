<?php
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Factory;
use Joomla\Database\DatabaseDriver;

require_once __DIR__ . '/helper.php';

// Retrieve module parameters
$customMessage = $params->get('message', 'Hello, World!');
$categoryIds = $params->get('categories', []);
$showFeatured = $params->get('show_featured', 1);

// Ensure categoryIds is an array and not empty
if (empty($categoryIds) || !is_array($categoryIds)) {
    $categoryIds = [];
}

// If no categories are selected, skip the query and return an empty result
$articles = [];
if (!empty($categoryIds)) {
    // Initialize database
    $db = Factory::getDbo();

    // Prepare query to fetch articles
    $query = $db->getQuery(true)
        ->select($db->quoteName(['id', 'alias', 'catid', 'title', 'introtext']))
        ->from($db->quoteName('#__content'))
        ->where($db->quoteName('state') . ' = 1')
        ->where($db->quoteName('catid') . ' IN (' . implode(',', array_map('intval', $categoryIds)) . ')')
        ->order($db->quoteName('publish_up') . ' DESC');



    // Apply the featured filter if set
    if ($showFeatured) {
        $query->where($db->quoteName('featured') . ' = 1');
    }

    // Execute the query
    $db->setQuery($query);
    $articles = $db->loadObjectList();
}

// Load the layout file
require ModuleHelper::getLayoutPath('mod_custommodule');
