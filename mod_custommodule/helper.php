<?php
defined('_JEXEC') or die;

class ModCustomModuleHelper
{
    public static function getCustomMessage($params)
    {
        return $params->get('message', 'Hello from Helper!');
    }
}
