<?php

namespace jakubenglicky\SocialPlugins;


class Twitter
{
	/**
	 * @var Helpers
	 */
	private $helpers;

	/* Sizes */
	const SIZE_SMALL = 'small';
	const SIZE_LARGE = 'large';

	public function __construct()
	{
		$this->helpers = new Helpers();
	}

	public function renderJs()
	{
		return $this->helpers->latte->renderToString(__DIR__ . '/templates/twScript.latte');
	}

	public function renderTweetButton($size = self::SIZE_SMALL, $link = NULL)
	{
		if ($link == NULL) {
			$link = $this->helpers->getUrl();
		}

		$parameters = array(
			"link" => $link,
			"size" => $size,
		);

		return $this->helpers->latte->renderToString(__DIR__ . '/templates/twButton.latte', $parameters);
	}

	public function renderFollowButton($twitterLink, $size = self::SIZE_SMALL, $hideUsername = FALSE, $hideFollowCount = FALSE)
	{
		$parameters = array(
			"link" => $twitterLink,
			"size" => $size,
			"username" => ($hideUsername) ? 'true' : 'false',
			"count" => ($hideFollowCount) ? 'true' : 'false',
		);

		return $this->helpers->latte->renderToString(__DIR__ . '/templates/twFollow.latte', $parameters);
	}
}