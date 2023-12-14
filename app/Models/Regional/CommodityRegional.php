<?php

namespace App\Models\Regional;

use App\Models\Geographical\Acz;
use App\Models\Geographical\State;
use App\Models\Geographical\Region;
use App\Models\Zonal\ZonalCommodity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommodityRegional extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'regional_commodity';

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
        'StateCode',
        'RegionID',
        'AczId',
        'ZonalCommodityID',
        'HarvestRelaxation',
        'MaxRigtsInLot',
        'MinLotSize',
        'TargetValue',
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
            'label' => 'StateCode',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'State.Name',
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
            'source'        => '/geographical/region/list-by-parent',
            'options' => [],
            'watching' => 'StateCode',
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
        [
            'name' => 'AczName',
            'label' => 'Acz',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Acz.Name'
        ],
        [
            'name' => 'AczId',
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
            'searchable' => 'ZonalCommodity.Name'
        ],
        [
            'name' => 'ZonalCommodityID',
            'label' => 'Zonal Commodity',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'source'        => '/zonal/zonal-commodity/list-by-parent',
            'options' => [],
            'watching' => 'AczId',
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
        [
            'name' => 'TargetValue',
            'label' => 'Target Value',
            'type' => 'Number',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'TargetValue',
            'validations' => [
                'required' => true,
                'max' => 50,
                'min' => 1,
            ]
        ],
        [
            'name' => 'MinLotSize',
            'label' => 'Min Lot Size',
            'type' => 'Number',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'MinLotSize',
            'validations' => [
                'required' => true,
                'max' => 50,
                'min' => 1,
            ]
        ],
        [
            'name' => 'MaxRigtsInLot',
            'label' => 'Max Rigts In Lot',
            'type' => 'Number',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'MaxRigtsInLot',
            'validations' => [
                'required' => true,
                'max' => 50,
                'min' => 1,
            ]
        ],
        [
            'name' => 'HarvestRelaxation',
            'label' => 'Harvest Relaxation',
            'type' => 'Number',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'HarvestRelaxation',
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
     * Get the State associated with the regional commodity.
     *
     * @return object
     */
    public function state()
    {
        return $this->belongsTo(
            related: State::class,
            foreignKey: 'StateCode',
            ownerKey: 'ID'
        );
    }

     /**
     * Get the Region associated with the regional commodity.
     *
     * @return object
     */
    public function region()
    {
        return $this->belongsTo(
            related: Region::class,
            foreignKey: 'RegionID',
            ownerKey: 'RegionID'
        );
    }

    /**
     * Get the Acz associated with the regional commodity.
     *
     * @return object
     */
    public function acz()
    {
        return $this->belongsTo(
            related: Acz::class,
            foreignKey: 'AczId',
            ownerKey: 'ID'
        );
    }



    /**
     * Get the Bank associated with the regional commodity.
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
}
