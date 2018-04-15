<?php
namespace jakubenglicky\SocialPlugins\Tests;

use jakubenglicky\SocialPlugins\Facebook;
use jakubenglicky\SocialPlugins\Facebook\Options\Layout;
use jakubenglicky\SocialPlugins\Facebook\Options\Size;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . "/bootstrap.php";
/**
 * @testCase
 */
class FacebookTest extends TestCase
{
    private $fb;

    public function __construct()
    {
        $this->fb = new Facebook();
    }

    public function testInstance()
    {
        Assert::true($this->fb instanceof Facebook);
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
        Assert::contains('fb-like', $this->fb->renderLikeButton(false, Layout::BOX_COUNT, Size::SMALL, false, 'http://www.facebook.com/'));

        Assert::contains('data-share="true"', $this->fb->renderLikeButton(true, Layout::BOX_COUNT, Size::SMALL, false, 'http://www.facebook.com/'));

        Assert::contains('data-layout="box_count"', $this->fb->renderLikeButton(false, Layout::BOX_COUNT, Size::SMALL, false, 'http://www.facebook.com/'));
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
