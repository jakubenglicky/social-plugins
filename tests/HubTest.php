<?php
namespace jakubenglicky\SocialPlugins\Tests;

use Tester\Assert;
use Tester\TestCase;

require_once "bootstrap.php";
/**
 * @testCase
 */
class HubTest extends TestCase
{
    private $hub;

    public function __construct()
    {
        $this->hub = new \jakubenglicky\SocialPlugins\Hub();
    }

    public function testFbInstance()
    {
        Assert::true($this->hub->fb instanceof \jakubenglicky\SocialPlugins\Facebook);
    }

    public function testTwInstance()
    {
        Assert::true($this->hub->tw instanceof \jakubenglicky\SocialPlugins\Twitter);
    }
}


(new HubTest())->run();
