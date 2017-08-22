SocialPlugins
==============
This is the simple wrapper around implementing social plugins to your websites.

More info (Facebook) -> https://developers.facebook.com/ 

Instalation
-----------

	composer require jakubenglicky/SocialPlugins

Usage
-----
*Facebook*

	$fb = new jakubenglicky\SocialPlugins\Facebook();
	 
	// Render after body opening tag <body> 
    echo $fb->renderInit();
         
    
    echo $fb->renderComments();
    echo $fb->renderLikeButton();
    echo $fb->renderShareButton();
    echo $fb->renderFollowButton('http://www.facebook.com/zuck');
    echo $fb->renderPagePlugin('https://www.facebook.com/FacebookforDevelopers');
