<?php

use Symfony\Component\Process\ProcessBuilder;

class ProcessTest extends PHPUnit_Framework_TestCase
{
    public function testOutput()
    {
        $stdout = '';
        $stderr = '';

        $builder = new ProcessBuilder(array('bin/prog'));

        $builder->getProcess()->run(function ($type, $buffer) use (&$stdout, &$stderr) {
            if ('err' === $type) {
                $stderr = $buffer;
            } else {
                $stdout = $buffer;
            }
        });

        $this->assertEquals("stderr\n", $stderr);
        $this->assertEquals("stdout\n", $stdout);
    }
}
