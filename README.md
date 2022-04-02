# Plubo

Plubo is a really simple WordPress plugin boilerplate created to speed up plugin development.


✔️  Use Blade views and directives from the start\
✔️  Add styles in SCSS\
✔️  JavaScript router lets you add scripts on specific WordPress templates (based on body tags) and on specific shortcode tags

## Installation
Not much to explain:
`composer create-project joanrodas/plubo <PROJECT_NAME>`

> After creating the project, plubo will ask you a couple questions (if you want to add Alpine.js, React and/or environment variables).

## Add Alpine.js to your project

`php plubo add alpine`


## Add a React app as a WordPress shortcode automagically! :rocket::rocket::rocket:

If you need to use React in your project, Plubo can prepare a simple structure for you :smiley:

`php plubo add react <APP_NAME>`

> **Note:** If you don't enter an app name, a random one will be assigned.
