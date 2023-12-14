<?php

namespace App\Models\Regional;

use App\Models\Geographical\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegionalConnectivity extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'regional_connectivity_time';

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
        'SurfacedProportion',
        'UnsurfacedProportion',
        'SurfacedTimeMinPerkm',
        'UnsurfacedTimeMinPerKm'
    ];

    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

   /* protected $casts = [
        'SurfacedProportion' => 'decimal:10',
        'UnsurfacedProportion' => 'decimal:10',
        'SurfacedTimeMinPerkm' => 'decimal:6',
        'UnsurfacedTimeMinPerKm' => 'decimal:6',
    ];*/

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
            'searchable' => 'State.Name'
        ],
        [
            'name' => 'StateCode',
            'label' => 'State',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'source'        => '/geographical/state/list',
            'options' => [],
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
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
            'watching' => 'StateCode',
            'mount' => true,
            'options' => [],
            'validations' => [
                'required' => true,
            ],
        ],
       [
            'name' => 'SurfacedProportion',
            'label' => 'Surfaced Proportion',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'SurfacedProportion',
            'validations' => [
                'required' => true,
            ]
       ],
       [
            'name' => 'UnsurfacedProportion',
            'label' => 'Unsurfaced Proportion',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'UnsurfacedProportion',
            'validations' => [
                'required' => true,
            ]
       ],
       [
            'name' => 'SurfacedTimeMinPerkm',
            'label' => 'Surfaced TimeMin Perkm',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'SurfacedTimeMinPerkm',
            'validations' => [
                'required' => true,
            ]
        ],
        [
            'name' => 'UnsurfacedTimeMinPerKm',
            'label' => 'Unsurfaced TimeMin Perkm',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'UnsurfacedTimeMinPerKm',
            'validations' => [
                'required' => true,
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
     * Get the Region associated with the Regional Connectivity.
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

}
