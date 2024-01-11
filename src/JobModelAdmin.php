<?php

declare(strict_types=1);

namespace brandcom\Softgarden;

use SilverStripe\Admin\ModelAdmin;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordViewer;

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Control\Controller;
use SilverStripe\Forms\GridField\GridField_HTMLProvider;
use SilverStripe\Forms\GridField\GridField_ActionProvider;


/**
 * Sorgt dafür, dass JobDataObjects im Silverstripe CMS angezeigt werden,
 * so dass man eine Job-Section hat in der Sidebar.
 */

class JobModelAdmin extends ModelAdmin
{
    private static $menu_title = "Job-Section";
    private static $url_segment = "jobs";
    private static $managed_models = [JobDataObject::class];
    private static $menu_icon_class = 'font-icon-sync';

    public function getEditForm($id = null, $fields = null)
    {
        $form = parent::getEditForm($id, $fields);

        if ($this->modelClass == JobDataObject::class) {
            // Creating a custom GridField configuration
            $config = GridFieldConfig_RecordViewer::create();

            // Adding a custom button to the GridField
            $config->addComponent(new CustomGridFieldButton());

            // Creating the GridField
            $gridField = GridField::create(
                $this->sanitiseClassName($this->modelClass),
                false,
                $this->getList(),
                $config
            );

                // Set the form for the GridField
                $gridField->setForm($form);

            // Inserting the GridField into the form
            $form->Fields()->insertBefore($gridField, 'Root');
        }

        return $form;
    }

}

class CustomGridFieldButton implements GridField_HTMLProvider, GridField_ActionProvider
{
    public function getHTMLFragments($gridField)
    {
        $link = Controller::join_links('/dev/tasks/brandcom-Softgarden-JobImportBuildTask');
        $button = '<a href="' . $link . '" class="ss-ui-button" style="background-color: blue; padding: 10px 15px; color: white; border-radius: 8px; letter-spacing: 2px;">Stellenanzeigen IMPORTIEREN</a>';

        return [
            'before' => $button,
        ];
    }

    public function getActions($gridField)
    {
        return ['mycustomaction'];
    }

    public function handleAction(GridField $gridField, $actionName, $arguments, $data)
    {
        if ($actionName == 'mycustomaction') {
            return Controller::curr()->redirectBack();
        }
    }
}