<?php

namespace ProcessMaker\ImportExport\Exporters;

class ProcessNotificationSettingExporter extends ExporterBase
{
    public function export() : void
    {
    }

    public function import() : bool
    {
        return $this->model->save();
    }
}
