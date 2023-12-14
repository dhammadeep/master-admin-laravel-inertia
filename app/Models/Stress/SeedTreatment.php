<?php

namespace App\Models\Stress;

use App\Models\General\Uom;
use App\Models\Commodity\Variety;
use App\Models\Commodity\Commodity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeedTreatment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agri_seed_treatment';

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
        'CommodityID',
        'VarietyID',
        'UomID',
        'Name',
        'Dose'
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
            'name' => 'CommodityName',
            'label' => 'Commodity',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Commodity.Name'
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
            'options' => [],
            'source' => "/commodity/variety/list-by-parent",
            'watching' => "CommodityID",
            'mount' => true,
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'UomName',
            'label' => 'UOM',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Uom.Name'
        ],
        [
            'name' => 'UomID',
            'label' => 'Uom',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/general/uom/list",
            'mount' => true,
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'Name',
            'label' => 'Name',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'Name',
            'validations' => [
                'required' => true,
                'max' => 50,
                'min' => 1,
            ]
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
     * Get the Commodity associated with the SeedTreatment.
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
     * Get the Variety associated with the SeedTreatment.
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


    /**
     * Get the Uom associated with the SeedTreatment.
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
