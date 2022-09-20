<?php

namespace Tests\Feature\ImportExport\Api;

use ProcessMaker\Models\Screen;
use Tests\Feature\Shared\RequestHelper;
use Tests\TestCase;

class ExportTest extends TestCase
{
    use RequestHelper;

    public function testGetTree()
    {
        $screen = factory(Screen::class)->create();

        $route = route('api.export.tree', [
            'type' => 'screen',
            'id' => $screen->id,
        ]);
        $response = $this->apiCall('GET', $route);

        $response->assertStatus(200);
        $data = $response->getData();
        $this->objectHasAttribute('tree', $data);
        $this->objectHasAttribute('manifest', $data);
    }

    public function testDownloadFile()
    {
        $screen = factory(Screen::class)->create();

        $route = route('api.export.download', [
            'type' => 'screen',
            'id' => $screen->id,
        ], [
            'password' => null,
        ]);
        $response = $this->apiCall('GET', $route);

        // Ensure we can download the exported file.
        $response->assertStatus(200);
        $response->assertHeader('content-disposition', 'attachment; filename=export.json');
    }
}
