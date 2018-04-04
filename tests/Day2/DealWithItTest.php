<?php

namespace Tests\Day2;

use Day2\DealWithIt\DealWithIt;
use PHPUnit\Framework\TestCase;

class DealWithItTest extends TestCase
{

    /** @var  DealWithIt */
    private $hide;

    public function setUp()
    {
        $this->hide = new DealWithIt();
    }

    /**
     * @dataProvider successfulProvider
     * @param string $string
     */
    public function test_deal_with_it_hide_email(string $string)
    {

        $this->assertEquals(
            ['*****************', '******************', '*****************'],
            $this->hide->hideEmail($string)
        );
    }

    /**
     * @dataProvider successfulProvider
     * @param string $string
     */
    public function test_deal_with_it_hide_email_no_preg(string $string)
    {

        $this->assertEquals(
            ['*****************', '******************', '*****************'],
            $this->hide->hideEmailNoPreg($string)
        );
    }

    public function successfulProvider()
    {
        yield
        [
            '123@5.78 ffew ejffew4324@ ayufatov@avito.ru ayufatov@avito.com jijijiji ayufatov@avito.рф',
        ];
    }
}
