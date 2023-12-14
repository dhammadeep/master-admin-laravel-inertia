<?php

namespace App\Models\Zonal;

use App\Models\Stress\Stress;
use App\Models\General\WeatherParams;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConduciveWeather extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zonal_conducive_weather';

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
        'ZonalCommodityID',
        'StressID',
        'WeatherParameterID',
        'Lower',
        'Upper',
        'ConduciveDuration',
        'RelaxingDuration',
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
                'name' => 'StateName',
                'label' => 'State',
                'type' => 'String',
                'tableComponent' => 'RegularText',
            ],
            [
                'name' => 'StateCode',
                'label' => 'State',
                'type' => 'Number',
                'formComponent' => 'RegularSelect',
                'options' => [],
                'source' => "/geographical/state/list",
                'mount' => true,
                'validations' => [
                    'required' => true
                ]
           ],
            [
                'name' => 'AczName',
                'label' => 'ACZ',
                'type' => 'String',
                'tableComponent' => 'RegularText',
            ],
            [
                'name' => 'AczID',
                'label' => 'Acz',
                'type' => 'Number',
                'formComponent' => 'RegularSelect',
                'options' => [],
                'source' => "/geographical/acz/list-by-parent",
                'watching' => 'StateCode',
                'mount' => true,
                'validations' => [
                    'required' => true
                ]
            ],

           [
            'name' => 'ZonalCommodityName',
            'label' => 'Zonal Commodity',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'ZonalCommodity.name'
            ],
            [
                'name' => 'ZonalCommodityID',
                'label' => 'Zonal Commodity',
                'type' => 'Number',
                'formComponent' => 'RegularSelect',
                'source'        => '/zonal/zonal-commodity/list-by-parent',
                'options' => [],
                'watching' => 'AczID',
                'mount' => true,
                'validations' => [
                    'required' => true,
                ],
            ],
            [
                'name' => 'StressTypeName',
                'label' => 'Stress Type',
                'type' => 'String',
                'tableComponent' => 'RegularText',
                'searchable' => 'Stress.name'
            ],
            [
                'name' => 'StressType',
                'label' => 'StressType',
                'type' => 'Number',
                'formComponent' => 'RegularSelect',
                'options' => [],
                'source' => "/stress/stress-type/list",
                'mount' => true,
                'validations' => [
                    'required' => true
                ]
            ],
            [
                'name' => 'StressName',
                'label' => 'Stress',
                'type' => 'String',
                'tableComponent' => 'RegularText',
                'searchable' => 'Stress.name'
            ],
            [
                'name' => 'StressID',
                'label' => 'Stress',
                'type' => 'Number',
                'formComponent' => 'RegularSelect',
                'options' => [],
                'source' => "/zonal/zonal-commodity/list-stress",
                'watching' => 'ZonalCommodityID',
                'mount' => true,
                'validations' => [
                    'required' => true
                ]
            ],
            [
                'name' => 'WeatherParameterName',
                'label' => 'Weather Parameter',
                'type' => 'String',
                'tableComponent' => 'RegularText',
                'searchable' => 'WeatherParameter.Name'
            ],
            [
                'name' => 'WeatherParameterID',
                'label' => 'Weather parameter',
                'type' => 'Number',
                'formComponent' => 'RegularSelect',
                'options' => [],
                'source' => "/general/weather-params/list-by-parent",
                'watching' => 'StressID',
                'mount' => true,
                'validations' => [
                    'required' => true
                ]
            ],
       [
            'name' => 'Lower',
            'label' => 'Lower',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'Lower',
            'validations' => [
                'required' => true,
                'max' => 50,
                'min' => 1,
            ]
       ],
       [
            'name' => 'Upper',
            'label' => 'Upper',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'Upper',
            'validations' => [
                'required' => true,
                'max' => 50,
                'min' => 1,
            ]
       ],
       [
            'name' => 'ConduciveDuration',
            'label' => 'Conducive Duration',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'ConduciveDuration',
            'validations' => [
                'required' => true,
                'max' => 50,
                'min' => 1,
            ]
       ],
       [
            'name' => 'RelaxingDuration',
            'label' => 'Relaxing Duration',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'RelaxingDuration',
            'validations' => [
                'required' => true,
                'max' => 50,
                'min' => 1,
            ]
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
     * Get the zonalCommodity associated with the zonal Fertlizer.
     *
     * @return object
     */
    public function zonalCommodity()
    {
        return $this->belongsTo(
            related: ZonalCommodity::class,
            foreignKey: 'ZonalCommodityID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the Stress associated with the zonal Fertlizer.
     *
     * @return object
     */
    public function stress()
    {
        return $this->belongsTo(
            related: Stress::class,
            foreignKey: 'StressID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the WeatherParameter associated with the zonal Fertlizer.
     *
     * @return object
     */
    public function WeatherParameter()
    {
        return $this->belongsTo(
            related: WeatherParams::class,
            foreignKey: 'WeatherParameterID',
            ownerKey: 'ID'
        );
    }

}
