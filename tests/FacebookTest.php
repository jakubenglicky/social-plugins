<?php

use Tester\Assert;
use Tester\TestCase;

require_once "bootstrap.php";
/**
 * @testCase
 */
class FacebookTest extends TestCase
{
    private $fb;

    public function __construct()
    {
        $this->fb = new \SocialPlugins\Facebook(606483372714289);
    }

    public function testInstance()
    {
        Assert::true($this->fb instanceof \SocialPlugins\Facebook);
    }

    public function testRenderInit()
    {
        Assert::truthy(strpos($this->fb->renderInit(),'fb-root'));
    }

    public function testRenderComments()
    {
        Assert::truthy(strpos($this->fb->renderComments('http://www.facebook.com/'),'fb-comments'));
    }

    public function testRenderLikeButton()
    {
        Assert::truthy(strpos($this->fb->renderLikeButton('http://www.facebook.com/'),'fb-like'));

        Assert::truthy(strpos($this->fb->renderLikeButton('http://www.facebook.com/', TRUE),'data-share="1"'));

        Assert::truthy(strpos($this->fb->renderLikeButton('http://www.facebook.com/', FALSE,$this->fb::LAYOUT_BOX_COUNT),'data-layout="box_count"'));
    }

    public function testRenderShareButton()
    {

        Assert::truthy(strpos($this->fb->renderShareButton('http://www.facebook.com/'),'fb-share-button'));

    }

    public function testRenderFollowButton()
    {

        Assert::truthy(strpos($this->fb->renderFollowButton('http://www.facebook.com/zuck'),'fb-follow'));

    }

    public function testRenderPagePlugin()
    {

        Assert::truthy(strpos($this->fb->renderPagePlugin('http://www.facebook.com/zuck'),'fb-page'));

    }

}


(new FacebookTest())->run();
