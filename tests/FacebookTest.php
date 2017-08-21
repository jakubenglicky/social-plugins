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

    public function testRenderComments()
    {
        Assert::truthy(strpos($this->fb->renderComments('http://www.facebook.com/'),'fb-comments'));
    }

    public function testRenderInit()
    {
        Assert::truthy(strpos($this->fb->renderComments('http://www.facebook.com/'),'fb-comments'));
    }


}


(new FacebookTest())->run();
