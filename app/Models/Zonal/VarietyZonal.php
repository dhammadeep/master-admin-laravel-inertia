<?php

namespace App\Models\Zonal;

use App\Models\Commodity\Variety;
use App\Models\Commodity\Commodity;
use App\Models\Zonal\ZonalCommodity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VarietyZonal extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zonal_variety';

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
        'ZonalCommodityID',
        'VarietyID',
        'SowingWeekStart',
        'SowingWeekEnd',
        'HarvestWeekStart',
        'HarvestWeekEnd',
        'NoOfDaysForHarvestMonitoring'
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
            'label' => 'Acz',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Acz.Name'
        ],
        [
            'name' => 'CommodityName',
            'label' => 'Commodity',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Commodity.Name'
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
            'name' => 'VarietyName',
            'label' => 'Variety',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Variety.Name'
        ],
        [
            'name' => 'VarietyID',
            'label' => 'Variety',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'source'        => '/commodity/variety/list-by-parent',
            'options' => [],
            'watching' => 'ZonalCommodityID',
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
        [
            'name' => 'SowingWeekStart',
            'label' => 'SowingWeekStart',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/zonal/zonal-commodity/list-meteorological-week/SowingWeekStart",
            'mount' => true,
            'watching' => 'ZonalCommodityID',
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
            'source' => "/zonal/zonal-commodity/list-metetrological-week/SowingWeekEnd",
            'mount' => true,
            'watching' => 'ZonalCommodityID',
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
            'source' => "/zonal/zonal-commodity/list-meteorological-week/HarvestWeekStart",
            'mount' => true,
            'watching' => 'ZonalCommodityID',
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
            'source' => "/zonal/zonal-commodity/list-meteorological-week/HarvestWeekEnd",
            'mount' => true,
            'watching' => 'ZonalCommodityID',
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
     * Get the zonalCommodity associated with the variety zonal.
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
     * Get the Commodity associated with the variety zonal.
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
     * Get the variety associated with the zonal Fertlizer.
     *
     * @return object
     */
    public function variety()
    {
        return $this->belongsTo(
            related: Variety::class,
            foreignKey: 'VarietyID',
            ownerKey: 'ID'
        );
    }

}
