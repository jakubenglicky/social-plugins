Twitter
=========

**Initialization of Twitter class**

	$tw = new jakubenglicky\SocialPlugins\Twitter();

**Render script link**

	$tw->renderJs();

This method render `<script></script>` with attribute src to your HTML code.

**Render Tweet button**

	$tw->renderTweetButton();

This method has 2 parameters - $size and $link. All these parameters can be nullable.

	$size - use options from class Options\Size
	$link - you can set the link of the page which you wish tweet

**Render Follow button**

	$tw->renderFollowButton('');

This method has 4 parameters - **$twitterLink**, $size, $hideUsername and $hideFollowCount.

	$twitterLink - you must set the link of the twitter page which you wish follow
	$size - use options from class Options\Size
	$hideUsername - TRUE/FALSE
	$hideFollowCount - TRUE/FALSE

*For more info about twitter social plugins you can visit https://dev.twitter.com/*