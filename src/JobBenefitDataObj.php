<?php

namespace brandcom\Softgarden;

use SilverStripe\Assets\File;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\TextareaField;


class JobBenefitDataObj extends DataObject
{

    private static $table_name = 'BrandcomSoftgardenBenefitObject';

    private static array $db = [
        'SortOrder' => 'Int',
        'Benefit' => 'Text',
    ];

    private static array $has_one = [
        'BenefitIcon' => File::class,
    ];

    private static array $summary_fields = [
        'ID' => 'ID',
        'Benefit' => 'Benefit',
        'BenefitIcon.CMSThumbnail' => 'Icon',
    ];


    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['PageID', 'SortOrder']);

        $fields->addFieldToTab(
            'Root.Main',
            TextareaField::create(
                'Benefit',
                'Keywords'
            )->setDescription(
                'Keywords, denen dieser Icon zugeordnet werden soll'
            )
        );
        return $fields;
    }
}
