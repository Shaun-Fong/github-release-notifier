<?php

namespace Kanboard\Plugin\GithubReleaseNotifier;

use Kanboard\Core\Base;
use Kanboard\Event\GenericEvent;

/**
 * Github Webhook
 *
 * @author   Shaun Fong
 */
class WebhookHandler extends Base
{
    /**
     * Events
     *
     * @var string
     */
    const EVENT_RELEASED           = 'github.webhook.released';

    /**
     * Project id
     *
     * @access private
     * @var integer
     */
    private $project_id = 0;

    /**
     * Set the project id
     *
     * @access public
     * @param  integer   $project_id   Project id
     */
    public function setProjectId($project_id)
    {
        $this->project_id = $project_id;
    }

    /**
     * Parse Github events
     *
     * @access public
     * @param  string  $type      Github event type
     * @param  object   $payload   Github event
     * @return boolean
     */
    public function parsePayload($type, $payload)
    {
        switch ($type) {
            case 'release':
                return $this->parseReleaseEvent($payload);
        }

        return false;
    }

    /**
     * Parse Github Release events
     */
    public function parseReleaseEvent($payload)
    {
        if (empty($payload->{'action'})) {
            return false;
        }

        switch ($payload->{'action'}) {
            case 'released':
                return $this->handleRelease($payload->{'release'});
        }

        return false;
    }

    /**
     * Handle Release
     */
    public function handleRelease($release)
    {
        
        $columnSelected = $this->projectMetadataModel->get($this->request->getIntegerParam('project_id'),"select_column");
        
        $event = array(
            'project_id' => $this->project_id,
            'column_id' => $columnSelected,
            'reference' => $release->{'tag_name'},
            'title' => $release->{'name'},
            'description' => $release->{'body'}."\n\n[".t('Github Release').']('.$release->{'html_url'}.')',
        );

        $this->dispatcher->dispatch(
            self::EVENT_RELEASED,
            new GenericEvent($event)
        );

        return true;
    }
}
