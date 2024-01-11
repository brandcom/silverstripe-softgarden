<?php

namespace brandcom\Softgarden;

use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;


class JobBenefitDataObj extends DataObject
{

    private static $table_name = 'BrandcomSoftgardenBenefitObject';

    private static array $db = [
        'SortOrder' => 'Int',
        'Benefit' => 'Varchar(255)',
    ];

    private static array $has_one = [
        'BenefitIcon' => Image::class,
    ];

    private static array $summary_fields = [
        'ID' => 'ID',
        'Benefit' => 'Benefit',
        'BenefitIcon.CMSThumbnail' => 'Icon',
    ];


    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeFieldFromTab("Root.Main", "PageID");
        $fields->removeFieldFromTab("Root.Main", "SortOrder");

        return $fields;
    }

}