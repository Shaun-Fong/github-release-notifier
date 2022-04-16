<h3><i class="fa fa-github fa-fw"></i>&nbsp;<?= t('Github Release') ?></h3>
<div class="panel">
    <input type="text" class="auto-select" readonly="readonly" value="<?= $this->url->href('Webhook', 'handler', array('plugin' => 'GithubReleaseNotifier', 'token' => $webhook_token, 'project_id' => $project['id']), false, '', true) ?>"/><br/>
    <p class="form-help"><a href="https://github.com/Shaun-Fong/github-release-notifier#documentation" target="_blank"><?= t('Help on Github Release Notifier') ?></a></p>
</div>
