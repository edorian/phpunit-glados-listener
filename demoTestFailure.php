<?php

class demoTestFailure extends PHPUnit_Framework_TestCase {

    public function testSucess() {
        $this->assertTrue(false);
    }

}
