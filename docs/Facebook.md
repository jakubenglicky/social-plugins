Facebook
=========

**Initialization of Facebook class**

	$fb = new jakubenglicky\SocialPlugins\Facebook();

**Render `<div class="fb-root"></div>` and JS**

You must render this div after opening `<body>` tag

	$fb->renderInit();
	$fb->setLocale(Options\Language::ENGLISH); // for setting plugin language
	$fb->setCommentsWidth(550); // for setting global comments plugin width

**Render comments**

	$fb->renderComments();

This method has 3 parameters - $limit, $width and $link. All these parameters can be nullable.

	$limit - how much comments show for first look
	$width - by default set on 550px or set with method setCommentsWidth()
	$link - you can set the link of the page which you wish comment

**Render LikeButton**

	$fb->renderLikeButton();



This method has 5 parameters - $shareButton, $layout, $size, $showFaces, $link. All these parameters can be nullable.

	$shareButton - TRUE/FALSE
	$layout - use options from class Options\Layout
	$size - use options from class Options\Size
	$showFaces - TRUE/FALSE
	$link - you can set the link of the page which you wish like


**Render ShareButton**

	$fb->renderShareButton();

This method has 4 parameters - $shareLink, $layout, $size, $mobileFrame. All these parameters can be nullable.

	$shareLink - you can set the link of the page which you wish share
	$layout - use options from class Options\Layout
	$size - use options from class Options\Size
	$mobileFrame - TRUE/FALSE

**Render FollowButton**

	$fb->renderFollowButton('');

This method has 5 parameters - **$fbFollowLink**, $width, $size, $layout, $showFaces.

	$fbFollowLink - you must set the link of the page which you wish follow
	$width - by default set on 200px
	$size - use options from class Options\Size
	$layout - use options from class Options\Layout
	$showFaces - TRUE/FALSE

**Render PagePlugin**

	$fb->renderPagePlugin('');

This method has 7 parameters - **$fbPageLink**, $tabs, $width, $height, $smallHeader, $hideCoverPhoto, $showFaces.

	$fbPageLink - you must set the link of the page which you wish show
	$tabs - use options from class Options\Tab
	$width - by default set on 350px
	$height - by default set on 500px;
	$smallHeader - TRUE/FALSE
	$hideCoverPhoto - TRUE/FALSE
	$showFaces - TRUE/FALSE

*For more info about facebook social plugins you can visit https://developers.facebook.com/*




