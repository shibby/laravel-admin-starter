<?php

namespace Tests;

trait AutomatedTestTrait
{
    public function testLogin()
    {
        $this->login('admin');
        $this->testAnon();
    }

    public function testAnonMobile()
    {
        $this->mobile();
        $this->testAnon();
    }

    public function testLoginMobile()
    {
        $this->mobile();
        $this->login();
        $this->testAnon();
    }
}
