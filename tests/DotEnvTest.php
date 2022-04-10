<?php

declare(strict_types=1);

namespace Tests;

use PHPizer\DotEnv\DotEnv;
use PHPUnit\Framework\TestCase;

final class DotEnvTest extends TestCase
{
    protected $path;
    protected DotEnv $dotEnv;


    public function testLoadEnv(): void
    {
        $this->path = "./tests/test.env";
        $this->dotEnv = new DotEnv($this->path);
        $this->assertNull($this->dotEnv->variables);
        $this->dotEnv->load();
        $envArray = [
            "DATABASE_URL" => "postgres://localhost:5432/noah_arc",
            "LOG_LEVEL" => "debug",
            "NODE_ENV" => "development",
            "PORT" => 8080,
            "SESSION_SECRET" => "development",
            "API_KEY" => "hwhhwhshs6585gahwhgwuwjwusuhs",
            "APP_KEY" => "VGhpcyBpcyBhbiBlbmNvZGVkIHN0cmluZw==",
            "APP_DESCRIPTION" => "This is a long sentence with whitespace and characters "
        ];
        foreach ($this->dotEnv->variables as $key => $value) {
            $this->assertEquals($value, $_ENV[$key]);
            $this->assertEquals($value, $_SERVER[$key]);
            $this->assertEquals($value, $envArray[$key]);
        }
        $this->assertTrue(true);
    }
}
