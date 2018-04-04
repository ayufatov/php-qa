<?php

namespace Tests\Day2;

use Day2\DealWithIt\DealWithIt;
use PHPUnit\Framework\TestCase;

class DealWithItTest extends TestCase
{

    /** @var  DealWithIt */
    private $hide;

    /** @var  string */
    private $string = '123@5.78 ffew ejffew4324@ ayufatov@avito.ru ayufatov@avito.com jijijiji ayufatov@avito.рф';

    public function setUp()
    {
        $this->hide = new DealWithIt();
    }

    public function test_deal_with_it_hide_email()
    {

        $this->assertEquals(
            ['*****************', '******************', '*****************'],
            $this->hide->hideEmail($this->string)
        );
    }

    public function test_deal_with_it_hide_email_no_preg()
    {

        $this->assertEquals(
            ['*****************', '******************', '*****************'],
            $this->hide->hideEmailNoPreg($this->string)
        );
    }
}
