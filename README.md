<p align="center">
  <img src='https://github.com/joanrodas/plubo-docs/blob/main/src/.vuepress/public/images/plubo-banner.png?raw=true' alt='Plubo' />
</p>

[![GitHub stars](https://img.shields.io/github/stars/joanrodas/plubo?style=for-the-badge)](https://github.com/joanrodas/plubo/stargazers)


Plubo is a really simple WordPress plugin boilerplate created to speed up plugin development.


✔️  Use Blade views and directives from the start\
✔️  Add styles in SCSS\
✔️  JavaScript router lets you add scripts on specific WordPress templates (based on body tags) and on specific shortcode tags


<br/>

## Getting started
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/joanrodas/plubo/On%20Template?label=build&style=for-the-badge)
![Code Climate maintainability](https://img.shields.io/codeclimate/maintainability-percentage/joanrodas/plubo?style=for-the-badge)
[![GitHub issues](https://img.shields.io/github/issues/joanrodas/plubo?style=for-the-badge)](https://github.com/joanrodas/plubo/issues)

[Read the Docs](https://www.plubo.dev/docs/)

There are 2 options to start using Plubo:

### 1. As a GitHub template

If you intend to use GitHub for your project, your best option is to create a new repo using this one as a template, just clicking the ***Use this template*** button.

When the new repo is ready, you can just clone it, run ``composer install`` and start programming.

> When using Plubo as a template, a pipeline will be executed right after the repo creation, modifiyng the filenames and classes to match your new project name.<br><br> The pipeline files will be autoremoved.

### 2. With composer

```bash
composer create-project joanrodas/plubo <PROJECT_NAME>
```

> After creating the project, use the command php plubo add to add Alpine.js, React and/or environment variables to your project.

<br/>


## Create a React app as a WordPress shortcode automagically! :rocket::rocket::rocket:

If you need to use React in your project, Plubo can prepare a simple structure for you :smiley:

```bash
php plubo add react <APP_NAME>
```

> **Note:** If you don't enter an app name, a random one will be assigned.

<br/>

## Contributions
[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=for-the-badge)](https://github.com/joanrodas/plubo/issues)
[![GitHub license](https://img.shields.io/github/license/joanrodas/plubo?style=for-the-badge)](https://github.com/joanrodas/plubo/blob/main/LICENSE)


Feel free to contribute to the project, suggesting improvements, reporting bugs and coding.
