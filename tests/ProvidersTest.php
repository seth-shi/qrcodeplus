<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class ProvidersTest extends TestCase
{
    protected $file = __DIR__.'/../src/Providers.php';

    public function testProvidersExists()
    {
        $this->assertFileExists($this->file);
    }

    public function testReadabld()
    {
        $this->assertFileIsReadable($this->file);
    }

    public function testProvidersCount()
    {
        $providers = require $this->file;

        $this->assertCount(2, $providers);

        return $providers;
    }

    /**
     * @depends testProvidersCount
     */
    public function testProvidersContent($providers)
    {
        $this->assertArrayHasKey('color', $providers);
        $this->assertArrayHasKey('image', $providers);
    }
}
