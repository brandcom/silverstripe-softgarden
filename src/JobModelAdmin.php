<?php

declare(strict_types=1);

namespace brandcom\Softgarden;

use SilverStripe\Admin\ModelAdmin;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordViewer;

/**
 * Sorgt dafür, dass JobDataObjects im Silverstripe CMS angezeigt werden,
 * so dass man eine Job-Section hat in der Sidebar.
 */

class JobModelAdmin extends ModelAdmin
{
    private static $menu_title = "Job-Section";
    private static $url_segment = "jobs";
    private static $managed_models = [JobDataObject::class];

    public function getEditForm($id = null, $fields = null)
    {
        $form = parent::getEditForm($id, $fields);

        if ($this->modelClass == JobDataObject::class) {
            // Erstellung einer benutzerdefinierten GridField-Konfiguration für die Vorschau
            $config = GridFieldConfig_RecordViewer::create();

            // Einsetzen der benutzerdefinierten Konfiguration im GridField
            $gridField = $form->Fields()->dataFieldByName($this->sanitiseClassName($this->modelClass));
            if ($gridField) {
                $gridField->setConfig($config);
            }
        }

        return $form;
    }
}