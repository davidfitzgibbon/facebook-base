# Facebook Base

This is a handy set of files that lets you get going with a Facebook app quickly. It is an extension of, and includes, my [Base](https://github.com/davidfitzgibbon/base) boilerplate for websites.

It's still not layed out very well so any forks or comments are welcome!

*note: currently this is optimised to give a mobile user a responsive version of the app, off of Facebook.*



# How to:

## _index.php_

This is the file that you're always going to send the user to. There is a variable $page used that is set to 'blank' by default. This will then load the "blank.php" file and load it into the page. You can change what page is loaded in various ways. You can use a $_GET variable by sending the user to index.php?page=my_page which would load a script called "my_page.php".

Another method is to use logic in the page. You'll see a commented out Time Gate in this file that loads a "like" or "closed" script into the page.

## _settings.php_
This file is where all the basic information goes. You'll see variables for your $appId $secret and other basic Facebook requirements.

This also includes $appUrl and $realUrl. $appUrl referrs to the app, in a Page Tab on Facebook. $realUrl referrs to the actual web address where these files are stored. This is an imprtant difference and you'll find you need both as you work with Facebook.

For example your image files will be on the $realUrl address, but you'll want to redirect the user to $appUrl after they have logged in.

## _mobile_detect.php_

This file will check the user agent string to try and discover if your user is on a mobile phone or not. If the variable $mobile is greater than 0, the user is on a mobile.


## _facebook.php_
This file does all the server side thinking for you with the Facebook PHP sdk.

First off it gathers all your settings and creates a new instance if the Facebook class provided by the sdk.

Next it sets the $like and $fbuser variables. These can be used to create a "Like Gate". If $fbuser is null, then the user is not logged in. Once they are logged in you can get the $like variable. If this is false the user hasnt liked the page, give them some specific content for that. If it's true, they do like it, give them the other content.

Some other useful variables are gathered in this file too.

## _use_

After these files have run you will have access to the following variables:

*$mobile* - if greater than 0, user is on a mobile device

*$fbuser* - contains the output of the Facebook Graph information on the user including their name, age, language and other pieces of information

*$name* - The users name

*$like* - Is the page liked or not

*$language* - the users preferred language


# Required:
The following technologies are needed to get the most out of the SASS framework that's included with these files. However you can also simple delete the sass folder and config.rb to develop your site just in plain ol' CSS

### SASS
http://sass-lang.com/tutorial.html

### COMPASS
http://compass-style.org/install/

### SUSY
http://susy.oddbird.net/guides/getting-started/

