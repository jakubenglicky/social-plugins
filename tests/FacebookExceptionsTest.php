<?php

use Tester\Assert;
use Tester\TestCase;

require_once "bootstrap.php";
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
        Assert::exception(function ()   {
            $this->fb->renderComments('');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Link must be defined.');

        Assert::exception(function ()   {
            $this->fb->renderComments('http://github.com/','a');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'These values (limit, width) must be integer.');

        Assert::exception(function ()   {
            $this->fb->renderComments('http://github.com/',5,'a');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'These values (limit, width) must be integer.');

        Assert::exception(function ()   {
            $this->fb->renderComments('http://github.com/','a','b');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'These values (limit, width) must be integer.');

        Assert::exception(function ()   {
            $this->fb->renderComments('http://github.com/','a',200);
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'These values (limit, width) must be integer.');
    }

    public function testLike()
    {
        Assert::exception(function ()   {
            $this->fb->renderLikeButton('');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Link must be defined.');


        Assert::exception(function ()   {
            $this->fb->renderLikeButton('http://github.com/',123);
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'These values (shareButton, showFaces) must be boolean.');

        Assert::exception(function ()   {
            $this->fb->renderLikeButton('http://github.com/',TRUE,'test');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Layout must be select from options.');

        Assert::exception(function ()   {
            $this->fb->renderLikeButton('http://github.com/',TRUE,$this->fb::LAYOUT_BUTTON_COUNT,'big');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Size must be select from options.');
    }


    public function testShare()
    {
        Assert::exception(function ()   {
            $this->fb->renderShareButton('');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Share link must be defined in correct format.');


        Assert::exception(function ()   {
        $this->fb->renderShareButton('http://github.com/','test');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Layout must be select from options.');

        Assert::exception(function ()   {
            $this->fb->renderShareButton('http://github.com/',$this->fb::LAYOUT_STANDARD);
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Layout must be select from options.');

        Assert::exception(function ()   {
            $this->fb->renderShareButton('http://github.com/',$this->fb::LAYOUT_BUTTON_COUNT,'big');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Size must be select from options.');

        Assert::exception(function ()   {
            $this->fb->renderShareButton('http://github.com/',$this->fb::LAYOUT_BUTTON_COUNT,$this->fb::SIZE_SMALL,'aaa');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'This value (mobileFrame) must be boolean.');
    }

    public function testFollow()
    {
        Assert::exception(function ()   {
            $this->fb->renderFollowButton('');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Follow link must be defined in correct format.');

        Assert::exception(function ()   {
            $this->fb->renderFollowButton(NULL);
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Follow link must be defined in correct format.');

        Assert::exception(function ()   {
            $this->fb->renderFollowButton('https://www.facebook.cz/zuck','666');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Width must be integer.');

        Assert::exception(function ()   {
            $this->fb->renderFollowButton('https://www.facebook.cz/zuck',200,'big');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Size must be select from options.');

        Assert::exception(function ()   {
        $this->fb->renderFollowButton('https://www.facebook.cz/zuck',200,$this->fb::SIZE_SMALL,'test');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Layout must be select from options.');

        Assert::exception(function ()   {
            $this->fb->renderFollowButton('https://www.facebook.cz/zuck',200,$this->fb::SIZE_SMALL,$this->fb::LAYOUT_BUTTON_COUNT,'string');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'This value (showFaces) must be boolean.');
    }

    public function testPage()
    {
        Assert::exception(function ()   {
            $this->fb->renderPagePlugin('');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Facebook page URL must be defined.');

        Assert::exception(function ()   {
            $this->fb->renderPagePlugin(NULL);
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Facebook page URL must be defined.');

        Assert::exception(function ()   {
            $this->fb->renderPagePlugin('https://www.facebook.cz/zuck','foo');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Tab must be select from options.');

        Assert::exception(function ()   {
            $this->fb->renderPagePlugin('https://www.facebook.cz/zuck',$this->fb::PAGE_TIMELINE,50);
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Width must be in this range -> (180-500)px.');

        Assert::exception(function ()   {
            $this->fb->renderPagePlugin('https://www.facebook.cz/zuck',$this->fb::PAGE_TIMELINE,600);
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Width must be in this range -> (180-500)px.');

        Assert::exception(function ()   {
            $this->fb->renderPagePlugin('https://www.facebook.cz/zuck',$this->fb::PAGE_TIMELINE,450,60);
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'Height must be bigger then 70px.');

        Assert::exception(function ()   {
            $this->fb->renderPagePlugin('https://www.facebook.cz/zuck',$this->fb::PAGE_TIMELINE,450,80,'foo','bar','foo');
        },\jakubenglicky\SocialPlugins\Facebook\Exception\InputException::class,'These values (smallHeader,hideCoverPhoto,showFaces) must be boolean.');
    }
}


(new FacebookExceptionsTest())->run();
