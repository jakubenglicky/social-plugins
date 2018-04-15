<?php
namespace jakubenglicky\SocialPlugins\Tests;

use jakubenglicky\SocialPlugins\Twitter\Options\Size;
use Tester\Assert;
use Tester\TestCase;

require_once "bootstrap.php";
/**
 * @testCase
 */
class TwitterExceptionsTest extends TestCase
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

    public function testTweetButton()
    {
        Assert::exception(
            function () {
                $this->tw->renderTweetButton('foo');
            },
            \jakubenglicky\SocialPlugins\Twitter\Exception\InputException::class,
            'Size must be select from options.'
        );

        Assert::exception(
            function () {
                $this->tw->renderTweetButton(Size::SMALL, '');
            },
            \jakubenglicky\SocialPlugins\Twitter\Exception\InputException::class,
            'Link must be in corrent format.'
        );

        Assert::exception(
            function () {
                $this->tw->renderTweetButton(Size::SMALL, 'foo');
            },
            \jakubenglicky\SocialPlugins\Twitter\Exception\InputException::class,
            'Link must be in corrent format.'
        );
    }

    public function testFollowButton()
    {
        Assert::exception(
            function () {
                $this->tw->renderFollowButton('');
            },
            \jakubenglicky\SocialPlugins\Twitter\Exception\InputException::class,
            'Twitter link must be in corrent format.'
        );

        Assert::exception(
            function () {
                $this->tw->renderFollowButton('NULL');
            },
            \jakubenglicky\SocialPlugins\Twitter\Exception\InputException::class,
            'Twitter link must be in corrent format.'
        );

        Assert::exception(
            function () {
                $this->tw->renderFollowButton(null);
            },
            \jakubenglicky\SocialPlugins\Twitter\Exception\InputException::class,
            'Twitter link must be in corrent format.'
        );

        Assert::exception(
            function () {
                $this->tw->renderFollowButton('github.com');
            },
            \jakubenglicky\SocialPlugins\Twitter\Exception\InputException::class,
            'Twitter link must be in corrent format.'
        );

        Assert::exception(
            function () {
                $this->tw->renderFollowButton('http://github.com/', 'bar');
            },
            \jakubenglicky\SocialPlugins\Twitter\Exception\InputException::class,
            'Size must be select from options.'
        );

        Assert::exception(
            function () {
                $this->tw->renderFollowButton('http://github.com/', Size::SMALL, 'false', '');
            },
            \jakubenglicky\SocialPlugins\Twitter\Exception\InputException::class,
            'These values (hideUsername, hideFollowCount) must be boolean.'
        );
    }
}


(new TwitterExceptionsTest())->run();
