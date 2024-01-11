<?php

declare(strict_types=1);

namespace brandcom\Softgarden;

use SilverStripe\Admin\ModelAdmin;

/**
 * Sorgt dafür, dass JobBenefitDataObj im Silverstripe CMS redaktioniert werden können tags
 */
class JobBenefitModelAdmin extends ModelAdmin
{
    private static string $menu_title = "Job-Benefits";

    private static string $url_segment = "job-benefits";

    private static $menu_icon_class = 'font-icon-happy';

    private static array $managed_models = [JobBenefitDataObj::class];
}