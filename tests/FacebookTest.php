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
        $this->fb = new \SocialPlugins\Facebook(1614900341916739);
    }

    public function testInstance()
    {
        Assert::true($this->fb instanceof \SocialPlugins\Facebook);
    }

    public function testRenderInit()
    {
        Assert::contains('fb-root',$this->fb->renderInit());
    }

    public function testRenderComments()
    {
        Assert::contains('fb-comments',$this->fb->renderComments('http://www.facebook.com/'));
    }

    public function testRenderLikeButton()
    {
        Assert::contains('fb-like',$this->fb->renderLikeButton('http://www.facebook.com/'));

        Assert::contains('data-share="1"',$this->fb->renderLikeButton('http://www.facebook.com/', TRUE));

        Assert::contains('data-layout="box_count"',$this->fb->renderLikeButton('http://www.facebook.com/', FALSE,$this->fb::LAYOUT_BOX_COUNT));
    }

    public function testRenderShareButton()
    {

        Assert::contains('fb-share-button',$this->fb->renderShareButton('http://www.facebook.com/'));

    }

    public function testRenderFollowButton()
    {

        Assert::contains('fb-follow',$this->fb->renderFollowButton('http://www.facebook.com/zuck'));

    }

    public function testRenderPagePlugin()
    {

        Assert::contains('fb-page', $this->fb->renderPagePlugin('http://www.facebook.com/zuck'));

    }

}


(new FacebookTest())->run();
