<?php

namespace App\Models\Zonal;

use App\Models\Geographical\Acz;
use App\Models\Commodity\Commodity;
use App\Models\Stress\CommodityStress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Agrochemicals\AgroCommoditychemical;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ZonalCommodity extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zonal_commodity';

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
        'AczID',
        'CommodityID',
        'SowingWeekStart',
        'SowingWeekEnd',
        'HarvestWeekStart',
        'HarvestWeekEnd',
        'NoOfDaysForHarvestMonitoring',
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
            'searchable' => 'ID'
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
            'name' => 'AczName',
            'label' => 'ACZ',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Acz.Name'
        ],
        [
            'name' => 'CommodityID',
            'label' => 'Commodity',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/commodity/commodity/list",
            'mount' => true,
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'CommodityName',
            'label' => 'Commodity',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Commodity.Name'
        ],
        [
            'name' => 'SowingWeekStart',
            'label' => 'SowingWeekStart',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/agriculture/meteorological-week/list",
            'mount' => true,
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'SowingWeekStart',
            'label' => 'SowingWeekStart',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'SowingWeekStart',
        ],
        [
            'name' => 'SowingWeekEnd',
            'label' => 'SowingWeekEnd',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/agriculture/meteorological-week/list",
            'mount' => true,
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'SowingWeekEnd',
            'label' => 'SowingWeekEnd',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'SowingWeekEnd'
        ],
        [
            'name' => 'HarvestWeekStart',
            'label' => 'HarvestWeekStart',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/agriculture/meteorological-week/list",
            'mount' => true,
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'HarvestWeekStart',
            'label' => 'HarvestWeekStart',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'HarvestWeekStart'
        ],
        [
            'name' => 'HarvestWeekEnd',
            'label' => 'HarvestWeekEnd',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/agriculture/meteorological-week/list",
            'mount' => true,
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'HarvestWeekEnd',
            'label' => 'HarvestWeekEnd',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'HarvestWeekEnd',
        ],
        [
            'name' => 'NoOfDaysForHarvestMonitoring',
            'label' => 'No. of Days For Harvest Monitoring',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'NoOfDaysForHarvestMonitoring',
            'validations' => [
                'required' => true
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
     * Get the Zonal Commodity associated with the Commodity.
     *
     * @return object
     */
    public function commodity()
    {
        return $this->belongsTo(
            related: Commodity::class,
            foreignKey: 'CommodityID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the Zonal Commodity associated with the acz.
     *
     * @return object
     */
    public function acz()
    {
        return $this->belongsTo(
            related: Acz::class,
            foreignKey: 'AczID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the CommodityStress associated with the Commodity.
     *
     * @return object
     */
    public function commodityStress()
    {
        return $this->hasMany(
            related: CommodityStress::class,
            foreignKey: 'CommodityID',
            localKey:'CommodityID'
        );
    }

    /**
     * Get the AgroCommoditychemical associated with the Commodity.
     *
     * @return object
     */
    public function agroCommoditychemical()
    {
        return $this->belongsTo(
            related: AgroCommoditychemical::class,
            foreignKey: 'CommodityID',
            ownerKey:'CommodityID'
        );
    }



}
