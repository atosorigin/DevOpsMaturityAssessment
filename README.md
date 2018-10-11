# DevOps Maturity Assessment

## Overview

This is a simple, survey-based tool, to help teams assess where they currently are on their DevOps journey and to help them identify next steps for further improvement.

## Installation

This is a PHP application that should run on any server that supports PHP 5.6 or higher with Mod_Rewrite enabled. 

## Technical Overview

* Survey questions are configured in [questions.json](https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/questions.json)
* When a user first accesses the survey, all the questions are loaded into session storage
* As the user completes the survey, their responses are saved in session storage
* Loading questions, processing responses, and generating summary results is all managed by the Survey class defined in [survey.php](https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/survey.php)
* Rendering of the survey is performed by [collectResponses.php](https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/collectResponses.php)
* Rendering of the survey results is performed by [viewResults.php](https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/viewResults.php)
* Layout uses [Bootstrap](http://getbootstrap.com/) 4.0.0
* Rendering charts uses [Chart.js](https://www.chartjs.org/) 2.7.2
* Icons from [Font Awesome Free](https://fontawesome.com/free) 5.3.1

## License

This source code is released under the [MIT license](https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/LICENSE). Bootstrap and Chart.js are also released under the [MIT license](https://github.com/atosorigin/DevOpsMaturityAssessment/blob/master/LICENSE). Font Awesome Free is provided under the [SIL OFL 1.1 License](https://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL)

## Credits

* Atos and Worldline experts who have contributed to formulation of the questions and creation of the application
* [Bootstrap](http://getbootstrap.com/)
* [Chart.js](https://www.chartjs.org/)
* [Font Awesome Free](https://fontawesome.com/free)
* [Markus Spiske](https://unsplash.com/@markusspiske) for background image, published on [Unsplash](https://unsplash.com/)
