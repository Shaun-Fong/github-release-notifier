<?php

namespace Kanboard\Plugin\GithubReleaseNotifier\Action;

use Kanboard\Action\Base;

/**
 * Create automatically a task to column from a webhook
 *
 * @package Kanboard\Action
 * @author  Shaun Fong
 */
class TaskCreationColumn extends Base
{
    /**
     * Get automatic action description
     *
     * @access public
     * @return string
     */
    public function getDescription()
    {
        return t('Create a task to column from an external provider');
    }

    /**
     * Get the list of compatible events
     *
     * @access public
     * @return array
     */
    public function getCompatibleEvents()
    {
        return array();
    }

    /**
     * Get the required parameter for the action (defined by the user)
     *
     * @access public
     * @return array
     */
    public function getActionRequiredParameters()
    {
        return array();
    }

    /**
     * Get the required parameter for the event
     *
     * @access public
     * @return string[]
     */
    public function getEventRequiredParameters()
    {
        return array(
            'project_id',
            'column_id',
            'reference',
            'title',
        );
    }

    /**
     * Execute the action (create a new task)
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool            True if the action was executed or false when not executed
     */
    public function doAction(array $data)
    {
        return (bool) $this->taskCreationModel->create(array(
            'project_id' => $data['project_id'],
            'column_id' => $data['column_id'],
            'title' => $data['title'],
            'reference' => $data['reference'],
            'description' => isset($data['description']) ? $data['description'] : '',
        ));
    }

    /**
     * Check if the event data meet the action condition
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool
     */
    public function hasRequiredCondition(array $data)
    {
        return true;
    }
}
