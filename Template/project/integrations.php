<h3><i class="fa fa-github fa-fw"></i>&nbsp;<?= t('Github Release') ?></h3>
<div class="panel">

    <?=$this->form->csrf()?>
    
    <fieldset>
        <legend><?=t('Payload Url')?></legend>
        <input type="text" class="auto-select" readonly="readonly" value="<?= $this->url->href('Webhook', 'handler', array('plugin' => 'GithubReleaseNotifier', 'token' => $webhook_token, 'project_id' => $project['id']), false, '', true) ?>"/><br/>
        <p class="form-help"><a href="https://github.com/Shaun-Fong/github-release-notifier#documentation" target="_blank"><?= t('Help on Github Release Notifier') ?></a></p>
    </fieldset>

    <fieldset>
        <legend><?=t('Column Setting')?></legend>
        <p><?=t('Select the Column to which the task is created.')?></p>
        <?=
        $this->form->select("select_column",
        $this->app->columnModel->getList($project['id']),
        array("select_column"=>$values["select_column"]));
        ?>
         
    </fieldset>

    <div class="form-actions">
        <button type="submit" class="btn btn-blue"><?=t('Save')?></button>
    </div>
</form>
</div>
