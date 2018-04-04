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

    /** @var  string */
    private $stringWithoutEmail = '123@5.78 ffew ejffew4324@ jijijiji';

    public function setUp()
    {
        $this->hide = new DealWithIt();
    }

    public function test_deal_with_it_hide_email()
    {

        $this->assertEquals(
            ['*****************', '******************', '*****************'],
            $this->hide->hideEmailPreg($this->string)
        );
        $this->assertEquals(
            ['*****************', '******************', '*****************'],
            $this->hide->hideEmailNoPreg($this->string)
        );
        echo "\n" . $this->hide->whoFastSpeedwork();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Строка пуста
     */
    public function test_deal_with_it_hide_email_empty()
    {
            $this->hide->hideEmailPreg('');
            $this->hide->hideEmailNoPreg('');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage В строке нет емайлов
     */
    public function test_deal_with_it_hide_no_email()
    {

        $this->assertEquals(
            [''],
            $this->hide->hideEmailPreg($this->stringWithoutEmail)
        );
        $this->assertEquals(
            [''],
            $this->hide->hideEmailNoPreg($this->stringWithoutEmail)
        );
    }
}
