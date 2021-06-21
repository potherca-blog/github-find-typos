# github-find-typos

> Finding typo's in the most popular github repositories made easy.

![](https://media.giphy.com/media/Re4qpNSjQr8h1RoqYR/giphy.gif)

Live demo: https://find-typos-on-github.glitch.me/

 - - -

This project is part of an experiment to convert command-line scripts to a web-page containing a form.

As such, the logic in this project lives in a function (in `src/function.fetch_results.php`),
but the calling/handling of that logic is done by [cli2web](https://github.com/Potherca/cli2web),
which is also responsible for rendering the output from templates.
