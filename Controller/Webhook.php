<?php

namespace Kanboard\Plugin\GithubReleaseNotifier\Controller;

use Kanboard\Controller\BaseController;
use Kanboard\Plugin\GithubReleaseNotifier\WebhookHandler;

/**
 * Webhook Controller
 *
 * @package  controller
 * @author   Shaun Fong
 */
class Webhook extends BaseController
{
    /**
     * Handle Github webhooks
     *
     * @access public
     */
    public function handler()
    {
        $this->checkWebhookToken();

        $githubWebhook = new WebhookHandler($this->container);
        $githubWebhook->setProjectId($this->request->getIntegerParam('project_id'));
        
        parse_str($this->request->getBody(),$arr);
        $jsonEncode = json_encode($arr);
        $jsonObject = json_decode($jsonEncode);
        $json = json_decode($jsonObject->{'payload'});
        
        $result = $githubWebhook->parsePayload(
            $this->request->getHeader('X-Github-Event'),
            //$this->request->getJson()
            $json
        );

        $this->response->text($result ? 'PARSED' : 'IGNORED');
    }
}
