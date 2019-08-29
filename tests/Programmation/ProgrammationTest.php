<?php
namespace App\Tests\Programmation;

use App\Programmation\Programmation;
use PHPUnit\Framework\TestCase;

class ProgrammationTest extends TestCase
{
    private $program;


    //pour instancier la class testé avant chaque test
    public function setUp()
    {
        $this->program = new Programmation();
    }

    //exécuté a a fin de chaque test
    public function tearDown()
    {
        $this->program = null;
    }

    function dateProvider()
    {
        return [
            'date-1' => [new \DateTime('2010-08-02'), true],
            'date-2' => [new \DateTime('2021-06-13'), false]
        ];
    }

    /**
     * @dataProvider dateProvider
    
     */
    public function testIsPast($d, $truth)
    {
        $result = $this->program->isPast($d);

        $this->assertEquals($truth, $result);
    }


    function dateProvider2()
    {
        return [
            'date-1' => [new \DateTime('2010-08-02'),new \DateTime('2010-07-02'),new \DateTime('2010-12-02'), true],
            'date-2' => [new \DateTime('2021-06-13'),new \DateTime('2010-08-02'),new \DateTime('2010-08-02'), false]
        ];
    }

    /**
     * Undocumented function
     * @dataProvider dateProvider2
     * 
     */
    public function testIsDateExistingInAnEventInterval($d1, $d2, $d3, $truth)
    {
        $result = $this->program->isDateExistingInAnEventInterval($d1,$d2,$d3);

        $this->assertEquals($truth, $result);
    }
}