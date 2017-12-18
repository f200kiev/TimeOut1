TimeOut
========

This is small test project for TimeOut company.

System requirements:

``php >= 5.5.9``

``composer installed on your local computer``

If not, go here: https://getcomposer.org/doc/00-intro.md

After you downloaded github repository, goto project folder and do following steps:

1. Run ``composer install``

2. Run ``bin/console server:start``

In console please check what port was assigned to the project and open that link in your browser to make sure that it works
Example: http://127.0.0.1:8001

3. There are 6 different tests that cover all possible cases for business logic (Service you can find here: src/AppBundle/Service/VenuesService.php)
Please run ``bin/phpspec run`` to make sure that everything is working correctly.
(Please take a look into spec/AppBundle/Services/VenuesServiceSpec.php if you would like to check tests)

4. Goto frontpage and select different guests and application will define places to go 
(Example: http://127.0.0.1:8001)

NOTE: I haven't spent a lot of time to provide the proper user interface, just used default controller with index.html.twig and some javascript to make it work very simple.

 