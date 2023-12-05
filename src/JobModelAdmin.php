<?php

declare(strict_types=1);

namespace brandcom\Softgarden;

use SilverStripe\Admin\ModelAdmin;

/**
 * Sorgt dafür, dass JobDataObjects im Silverstripe CMS angezeigt werden,
 * so dass man eine Job-Section hat in der Sidebar.
 */
class JobModelAdmin extends ModelAdmin
{
    private static string $menu_title = "Job-Section";

    private static string $url_segment = "jobs";

    private static array $managed_models = [JobDataObject::class];
}
