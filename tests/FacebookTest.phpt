<?php
namespace jakubenglicky\SocialPlugins\Tests;

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
        $this->fb = new \jakubenglicky\SocialPlugins\Facebook();
    }

    public function testInstance()
    {
        Assert::true($this->fb instanceof \jakubenglicky\SocialPlugins\Facebook);
    }

    public function testRenderInit()
    {
        Assert::contains('fb-root', $this->fb->renderInit());
    }

    public function testRenderComments()
    {
        Assert::contains('fb-comments', $this->fb->renderComments(5, 550, 'http://github.com/'));
    }

    public function testRenderLikeButton()
    {
        $fb = $this->fb;

        Assert::contains('fb-like', $this->fb->renderLikeButton(false, $fb::LAYOUT_BOX_COUNT, $fb::SIZE_SMALL, false, 'http://www.facebook.com/'));

        Assert::contains('data-share="1"', $this->fb->renderLikeButton(true, $fb::LAYOUT_BOX_COUNT, $fb::SIZE_SMALL, false, 'http://www.facebook.com/'));

        Assert::contains('data-layout="box_count"', $this->fb->renderLikeButton(false, $fb::LAYOUT_BOX_COUNT, $fb::SIZE_SMALL, false, 'http://www.facebook.com/'));
    }

    public function testRenderShareButton()
    {

        Assert::contains('fb-share-button', $this->fb->renderShareButton('http://www.facebook.com/'));
    }

    public function testRenderFollowButton()
    {

        Assert::contains('fb-follow', $this->fb->renderFollowButton('http://www.facebook.com/zuck'));
    }

    public function testRenderPagePlugin()
    {

        Assert::contains('fb-page', $this->fb->renderPagePlugin('http://www.facebook.com/zuck'));
    }
}


(new FacebookTest())->run();
