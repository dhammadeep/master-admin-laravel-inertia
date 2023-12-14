<?php

namespace App\Models\Regional;

use Carbon\Carbon;
use App\Models\General\Uom;
use App\Models\Geographical\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonthlyTravelTime extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'regional_monthly_weather_based_travel_time';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RegionID',
        'Month',
        'UnitType',
    ];

    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

     /**
     * Structure of dynamic form elements
     */
    protected static $tableFields = [
        [
            'name' => 'ID',
            'label' => 'ID',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'ID',
            'validations' => [
                'required' => true,
                'max' => 50,
                'min' => 1,
            ]
       ],
       [
            'name' => 'RegionName',
            'label' => 'Region',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Region.Name'
       ],
       [
            'name' => 'RegionID',
            'label' => 'Region',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'source'        => '/geographical/region/list',
            'options' => [],
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
       ],
       [
            'name' => 'Month',
            'label' => 'Month',
            'type' => 'Number',
            'tableComponent' => 'RegularText',
            'formComponent' => 'RegularSelect',
            'options' => [
                ['value' => 1, 'label' => 'Jan'],
                ['value' => 2, 'label' => 'Feb'],
                ['value' => 3, 'label' =>  'Mar'],
                ['value' => 4, 'label' =>  'Apr'],
                ['value' => 5, 'label' =>  'May'],
                ['value' => 6, 'label' =>  'Jun'],
                ['value' => 7, 'label' =>  'Jul'],
                ['value' => 8, 'label' =>  'Aug'],
                ['value' => 9, 'label' =>  'Sep'],
                ['value' => 10, 'label' =>  'Oct'],
                ['value' => 11, 'label' =>  'Nov'],
                ['value' => 12, 'label' =>  'Dec'],
            ],
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
       ],
       [
            'name' => 'UomName',
            'label' => 'Unit',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Uom.Name'
        ],
        [
            'name' => 'UnitType',
            'label' => 'Unit',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'source'        => '/general/uom/list',
            'options' => [],
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
       [
            'name' => 'Status',
            'label' => 'Status',
            'type' => 'Number',
            'tableComponent' => 'OptionBadge',
            'searchable' => 'Status',
            'options' => [
                ['value' => 0, 'label' => 'Active'],
                ['value' => 1, 'label' => 'Inactive'],
                ['value' => 2, 'label' =>  'Approved'],
                ['value' => 3, 'label' =>  'Rejected'],
                ['value' => 4, 'label' =>  'Deleted'],
            ],
            'colors' => [
                'Active'    => 'info',
                'Inactive'  => 'warning',
                'Approved'  => 'primary',
                'Rejected'  => 'secondary',
                'Deleted'   => 'danger'
            ]
        ]
    ];

    /**
     * Getter function for tableElements
     *
     * @return array
     */
    public static function getTableFields(): array
    {
        $fields = [];
        $tableFieldsCollection = collect(self::$tableFields)->whereNotNull('tableComponent');
        $fields = $tableFieldsCollection->map(function (array $field) {
            return [
                'name'           => $field['name'],
                'label'          => $field['label'],
                'tableComponent' => $field['tableComponent'],
                'colors'         => $field['colors'] ?? [],
                'searchable'     => $field['searchable'] ?? false,
            ];
        })->all();
        return $fields;
    }

    /**
     * Getter function for formElements
     *
     * @return array
     */
    public static function getFormFields(): array
    {
        $fields = [];
        $tableFieldsCollection = collect(self::$tableFields)->whereNotNull('formComponent');
        $fields = $tableFieldsCollection->map(function (array $field) {
            return [
                'name'            => $field['name'],
                'label'           => $field['label'],
                'type'            => $field['type'],
                'formComponent'   => $field['formComponent'],
                'options'         => $field['options'] ?? [],
                'validations'     => $field['validations'] ?? [],
                'source'          => $field['source'] ?? null,
                'watching'        => $field['watching'] ?? null,
                'mount'           => $field['mount'] ?? false,
            ];
        })->all();
        return $fields;
    }

    /**
     * get the Month attribute in month name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function MonthName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Carbon::createFromFormat('!m', $attributes['Month'])->format('M'),
        );
    }

    /**
     * Get the Unit associated with with the Monthly Travel Time.
     *
     * @return object
     */
    public function Uom()
    {
        return $this->belongsTo(
            related: Uom::class,
            foreignKey: 'UnitType',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the Region associated with the Monthly Travel Time.
     *
     * @return object
     */
    public function Region()
    {
        return $this->belongsTo(
            related: Region::class,
            foreignKey: 'RegionID',
            ownerKey: 'RegionID'
        );
    }

}
