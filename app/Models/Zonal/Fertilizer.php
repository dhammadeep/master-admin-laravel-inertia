<?php

namespace App\Models\Zonal;

use App\Models\General\Uom;
use App\Models\Stress\DoseFactor;
use App\Models\Zonal\ZonalCommodity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fertilizer extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zonal_fertilizer';

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
        'DoseFactorID',
        'Name',
        'UomID',
        'Dose',
        'Note',
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
            'name' => 'DoseFactorName',
            'label' => 'Dose Factor',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'DoseFactor.name'
        ],
        [
            'name' => 'Name',
            'label' => 'Fertilizer',
            'type' => 'String',
            'tableComponent' => 'RegularText',
        ],
        [
            'name' => 'Name',
            'label' => 'Fertilizer',
            'type' => 'String',
            'formComponent' => 'RegularSelect',
            'source'        => '/agriculture/agriculture-fertilizer/list',
            'options' => [],
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
        [
            'name' => 'Dose',
            'label' => 'Dose',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'Dose',
            'validations' => [
                'required' => true,
                'max' => 50,
                'min' => 1,
            ]
        ],
        [
            'name' => 'UomName',
            'label' => 'UOM',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Uom.name'
        ],
        [
            'name' => 'DoseFactorID',
            'label' => 'Dose Factor',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/stress/dose-factor/list",
            'mount' => true
        ],
        [
            'name' => 'UomID',
            'label' => 'Uom',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/general/uom/list",
            'mount' => true
        ],
        [
            'name' => 'Note',
            'label' => 'Note',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'Note',
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
     * Set the Name attribute in upper case.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function Name(): Attribute
    {
        return Attribute::make(
            set: fn ($value, $attributes) => $attributes['Name'] = ucwords($value),
        );
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
     * Get the dosefactor associated with the zonal Fertlizer.
     *
     * @return object
     */
    public function doseFactor()
    {
        return $this->belongsTo(
            related: DoseFactor::class,
            foreignKey: 'DoseFactorID',
            ownerKey: 'ID'
        );
    }

     /**
     * Get the uomGroup associated with the zonal Fertlizer.
     *
     * @return object
     */
    public function uom()
    {
        return $this->belongsTo(
            related: Uom::class,
            foreignKey: 'UomID',
            ownerKey: 'ID'
        );
    }

}
