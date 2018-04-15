<?php
namespace jakubenglicky\SocialPlugins\Tests;

use jakubenglicky\SocialPlugins\Twitter\Options\Size;
use Tester\Assert;
use Tester\TestCase;

require_once "bootstrap.php";
/**
 * @testCase
 */
class TwitterTest extends TestCase
{
    private $tw;

    public function __construct()
    {
        $this->tw = new \jakubenglicky\SocialPlugins\Twitter();
    }

    public function testInstance()
    {
        Assert::true($this->tw instanceof \jakubenglicky\SocialPlugins\Twitter);
    }

    public function testRenderJs()
    {
        Assert::contains('//platform.twitter.com/widgets.js', $this->tw->renderJs());
    }

    public function testRenderTweetButton()
    {
        Assert::contains('twitter-share-button', $this->tw->renderTweetButton(Size::SMALL, 'http://github.com/'));
    }

    public function testRenderFollowButton()
    {
        Assert::contains('twitter-follow-button', $this->tw->renderFollowButton('https://twitter.com/kubaenglicky', Size::SMALL));
    }
}


(new TwitterTest())->run();
