<?php

namespace Kanboard\Plugin\GithubReleaseNotifier;

use Kanboard\Plugin\GithubReleaseNotifier\Action\TaskCreationColumn;
use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Security\Role;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        $taskCreationColumnAction = new TaskCreationColumn($this->container);
        $this->actionManager->register($taskCreationColumnAction);
        $taskCreationColumnAction->addEvent(WebhookHandler::EVENT_RELEASED);
        
        //$this->actionManager->getAction('\Kanboard\Action\TaskCreation')->addEvent(WebhookHandler::EVENT_RELEASED);

        $this->template->hook->attach('template:project:integrations', 'GithubReleaseNotifier:project/integrations');
        $this->route->addRoute('/webhook/github/:project_id/:token', 'Webhook', 'handler', 'GithubReleaseNotifier');
        $this->applicationAccessMap->add('Webhook', 'handler', Role::APP_PUBLIC);
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');

        $this->eventManager->register(WebhookHandler::EVENT_RELEASED, t('Github Release'));
    }

    public function getPluginName()
    {
        return 'GithubReleaseNotifier';
    }

    public function getPluginDescription()
    {
        return t('Kanboard Plugin to create task when github release.');
    }

    public function getPluginAuthor()
    {
        return 'Shaun Fong';
    }

    public function getPluginVersion()
    {
        return '1.1.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/Shaun-Fong/github-release-notifier';
    }

    public function getCompatibleVersion()
    {
        return '>=1.0.37';
    }
}
