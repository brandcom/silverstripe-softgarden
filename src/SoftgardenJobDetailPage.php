<?php

namespace brandcom\Softgarden;

use SilverStripe\Forms\TextField;

class SoftgardenJobDetailPage extends \Page
{
    /**
     * Defines the database table name
     *  @var string
     */
    private static $table_name = 'SoftgardenJobDetailPage';

    /**
     * Database fields
     * @var array
     */
    private static $db = [
        'SoftgardenBenefitsLimit' => 'Varchar(255)',
    ];


    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab("Root.Main", new TextField("SoftgardenBenefitsLimit", "Maximale Anzahl der Benefits"));

        return $fields;
    }
}
