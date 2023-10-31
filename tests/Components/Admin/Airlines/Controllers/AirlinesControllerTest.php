<?php

namespace Tests\Components\Admin\Airlines\Controllers;

use Kaban\Components\Admin\Airlines\Resources\EditResource;
use PHPUnit\Framework\TestCase;

class AirlinesControllerTest extends TestCase
{
    public function test__construct()
    {

    }

    public function testUpdate()
    {

    }

    public function testEdit()
    {
        $resource = new EditResource;

        $this->assertThat($resource, EditResource::class);
    }

    public function testStore()
    {

    }
}
