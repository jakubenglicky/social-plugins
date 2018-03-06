<?php
namespace jakubenglicky\SocialPlugins\Tests;

use jakubenglicky\SocialPlugins\Facebook\Constains;
use jakubenglicky\SocialPlugins\Facebook\Exception\InputException;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . "/bootstrap.php";
/**
 * @testCase
 */
class FacebookExceptionsTest extends TestCase
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

    public function testComments()
    {
        Assert::exception(function () {
            $this->fb->renderComments(5, 550, '');
        }, InputException::class, 'Link must be in corrent format.');

        Assert::exception(function () {
            $this->fb->renderComments('5', 22, 'http://github.com/');
        }, InputException::class, 'These values (limit, width) must be integer.');

        Assert::exception(function () {
            $this->fb->renderComments('a', 'b', 'http://github.com/');
        }, InputException::class, 'These values (limit, width) must be integer.');

        Assert::exception(function () {
            $this->fb->renderComments('a', 200, 'http://github.com/');
        }, InputException::class, 'These values (limit, width) must be integer.');

        Assert::exception(function () {
            $this->fb->renderComments('55', 200, 'http://github.com/');
        }, InputException::class, 'These values (limit, width) must be integer.');
    }

    public function testLike()
    {
        Assert::exception(function () {
            $this->fb->renderLikeButton(false, Constains::LAYOUT_BOX_COUNT, Constains::SIZE_SMALL, false, '');
        }, InputException::class, 'Link must be in corrent format.');


        Assert::exception(function () {
            $this->fb->renderLikeButton('http://github.com/', 123);
        }, InputException::class, 'These values (shareButton, showFaces) must be boolean.');

        Assert::exception(function () {
            $this->fb->renderLikeButton(true, 'foo');
        }, InputException::class, 'Layout must be select from options.');

        Assert::exception(function () {
            $this->fb->renderLikeButton(true, Constains::LAYOUT_BOX_COUNT, 'bar');
        }, InputException::class, 'Size must be select from options.');
    }


    public function testShare()
    {
        Assert::exception(function () {
            $this->fb->renderShareButton('');
        }, InputException::class, 'Share link must be in correct format.');


        Assert::exception(function () {
            $this->fb->renderShareButton('http://github.com/', 'test');
        }, InputException::class, 'Layout must be select from options.');

        Assert::exception(function () {
            $this->fb->renderShareButton('http://github.com/', Constains::LAYOUT_STANDARD);
        }, InputException::class, 'Layout must be select from options.');

        Assert::exception(function () {
            $this->fb->renderShareButton('http://github.com/', Constains::LAYOUT_BUTTON_COUNT, 'big');
        }, InputException::class, 'Size must be select from options.');

        Assert::exception(function () {
            $this->fb->renderShareButton('http://github.com/', Constains::LAYOUT_BUTTON_COUNT, Constains::SIZE_SMALL, 'aaa');
        }, InputException::class, 'This value (mobileFrame) must be boolean.');
    }

    public function testFollow()
    {
        Assert::exception(function () {
            $this->fb->renderFollowButton(null);
        }, InputException::class, 'Follow link must be defined in correct format.');

        Assert::exception(function () {
            $this->fb->renderFollowButton('');
        }, InputException::class, 'Follow link must be defined in correct format.');

        Assert::exception(function () {
            $this->fb->renderFollowButton('https://www.facebook.cz/zuck', '666');
        }, InputException::class, 'Width must be integer.');

        Assert::exception(function () {
            $this->fb->renderFollowButton('https://www.facebook.cz/zuck', 200, 'big');
        }, InputException::class, 'Size must be select from options.');

        Assert::exception(function () {
            $this->fb->renderFollowButton('https://www.facebook.cz/zuck', 200, Constains::SIZE_SMALL, 'test');
        }, InputException::class, 'Layout must be select from options.');

        Assert::exception(function () {
            $this->fb->renderFollowButton('https://www.facebook.cz/zuck', 200, Constains::SIZE_SMALL, Constains::LAYOUT_BUTTON_COUNT, 'string');
        }, InputException::class, 'This value (showFaces) must be boolean.');
    }

    public function testPage()
    {
        Assert::exception(function () {
            $this->fb->renderPagePlugin('');
        }, InputException::class, 'Facebook page URL must be defined in correct format.');

        Assert::exception(function () {
            $this->fb->renderPagePlugin(null);
        }, InputException::class, 'Facebook page URL must be defined in correct format.');

        Assert::exception(function () {
            $this->fb->renderPagePlugin('https://www.facebook.cz/zuck', 'foo');
        }, InputException::class, 'Tab must be select from options.');

        Assert::exception(function () {
            $this->fb->renderPagePlugin('https://www.facebook.cz/zuck', Constains::PAGE_TIMELINE, 50);
        }, InputException::class, 'Width must be in this range -> (180-500)px.');

        Assert::exception(function () {
            $this->fb->renderPagePlugin('https://www.facebook.cz/zuck', Constains::PAGE_TIMELINE, 600);
        }, InputException::class, 'Width must be in this range -> (180-500)px.');

        Assert::exception(function () {
            $this->fb->renderPagePlugin('https://www.facebook.cz/zuck', Constains::PAGE_TIMELINE, 450, 60);
        }, InputException::class, 'Height must be bigger then 70px.');

        Assert::exception(function () {
            $this->fb->renderPagePlugin('https://www.facebook.cz/zuck',Constains::PAGE_TIMELINE, 450, 80, 'foo', 'bar', 'foo');
        }, InputException::class, 'These values (smallHeader,hideCoverPhoto,showFaces) must be boolean.');
    }

    public function testSetterException()
    {
        Assert::exception(function () {
            $this->fb->setCommentsWidth('foo');
        }, InputException::class, 'Width must be integer.');
    }
}


(new FacebookExceptionsTest())->run();
