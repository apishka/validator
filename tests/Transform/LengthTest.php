<?php

namespace ApishkaTest\Transformer\Transform;

use Apishka\Transformer\Transform\Length;

/**
 * Length transform test
 */
class LengthTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Prepare assert
     *
     * @return Lower
     */
    protected function prepareSanitizer()
    {
        return new Length();
    }

    /**
     * Test null
     */
    public function testNull()
    {
        $this->assertNull(
            $this->prepareSanitizer()->process(null)
        );
    }

    /**
     * Test no options
     *
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Not found "min" or "max" in options
     */
    public function testNoOptiopns()
    {
        $this->prepareSanitizer()->process(10);
    }

    /**
     * Test good values
     *
     * @param mixed $expected
     * @param mixed $value
     * @param array $options
     *
     * @dataProvider             providerTestGoodValues
     */
    public function testGoodValues($expected, $value, array $options)
    {
        $this->assertSame(
            $expected,
            $this->prepareSanitizer()->process($value, $options)
        );
    }

    /**
     * Provider test good values
     *
     * @return array
     */
    public function providerTestGoodValues()
    {
        return [
            [
                10,
                10,
                [
                    'min' => 0,
                    'max' => 5,
                ],
            ],
            [
                10.0,
                10.0,
                [
                    'min' => 0,
                    'max' => 5,
                ],
            ],
            [
                '10.0',
                '10.0',
                [
                    'min' => 0,
                    'max' => 5,
                ],
            ],
        ];
    }

    /**
     * Test bad min values
     *
     * @param mixed $expected
     * @param mixed $value
     * @param array $options
     *
     * @expectedException              \Apishka\Transformer\Exception
     * @expectedExceptionMessageRegExp #min \d+ characters#
     * @dataProvider                   badMinValuesProvider
     */
    public function testBadMinValues($expected, $value, array $options)
    {
        $this->assertSame(
            $expected,
            $this->prepareSanitizer()->process($value, $options)
        );
    }

    /**
     * Bad min values provider
     *
     * @return array
     */
    public function badMinValuesProvider()
    {
        return [
            [
                10,
                10,
                [
                    'min' => 5,
                ],
            ],
            [
                10.0,
                10.0,
                [
                    'min' => 5,
                ],
            ],
            [
                '10.0',
                '10.0',
                [
                    'min' => 5,
                ],
            ],
        ];
    }

    /**
     * Test bad max values
     *
     * @param mixed $expected
     * @param mixed $value
     * @param array $options
     *
     * @expectedException              \Apishka\Transformer\Exception
     * @expectedExceptionMessageRegExp #max \d+ characters#
     * @dataProvider                   badMaxValuesProvider
     */
    public function testBadMaxValues($expected, $value, array $options)
    {
        $this->assertSame(
            $expected,
            $this->prepareSanitizer()->process($value, $options)
        );
    }

    /**
     * Bad max values provider
     *
     * @return array
     */
    public function badMaxValuesProvider()
    {
        return [
            [
                10,
                10,
                [
                    'max' => 1,
                ],
            ],
            [
                10.0,
                10.0,
                [
                    'max' => 1,
                ],
            ],
            [
                '10.0',
                '10.0',
                [
                    'max' => 1,
                ],
            ],
        ];
    }

    /**
     * Test wrong values
     *
     * @dataProvider             wrongValuesProvider
     * @expectedException        \Apishka\Transformer\Exception
     * @expectedExceptionMessage wrong input format
     * @param mixed $wrong_type
     */
    public function testWrongValues($wrong_type)
    {
        $assert = $this->prepareSanitizer();
        $assert->process($wrong_type);
    }

    /**
     * Wrong data provider
     *
     * @return array
     */
    public function wrongValuesProvider()
    {
        return [
            [[]],
            [STDOUT],
            [function () {}],
            [new \StdClass()],
        ];
    }
}
