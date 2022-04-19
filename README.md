# GithubReleaseNotifier
Kanboard Plugin to create task when github release.

# Requirements
* Kanboard >= 1.0.37
* Github webhooks configured for a project

# Installation

You have the choice between 3 methods:
1. Install the plugin from the Kanboard plugin manager in one click
2. Download the zip file and decompress everything under the directory plugins/GithubWebhook
3. Clone this repository into the folder plugins/GithubWebhook
Note: Plugin folder is case-sensitive.

# Documentation

## Github Configuration
1. Go to your repository setting **Webhooks**
2. Then Add webhook.
3. **Payload URL** you can found in **Kanboard Project Setting (Integrations)**
4. Click **Let me select individual events.** Radio , make sure Releases Checkbox is selected.
5. Click **Add webhook** green button.

## Kanboard Configuration
1. Go Kanboard Action Panel
2. Add new Action
3. Select **Create a task to column from an external provider (从外部创建任务并指定栏目)** Next
4. Select **Github: Release** events
5. You may want to set the column which the task is created too, Go **Kanboard Project Setting (Integrations)**
6. Save

Now the task will be automatically create when github release.