<?php

namespace App\Models\Commodity;

use App\Models\General\Uom;
use App\Models\Commodity\Commodity;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commodity\CommodityClass;
use App\Models\Commodity\GeneralCommodity;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HSNCode extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agri_hs_code';

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
        'GeneralCommodityID',
        'CommodityClassID',
        'HSCode',
        'UomID',
        'Description',
        'Status'
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
            'required' => true
        ]
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
        'name' => 'GeneralCommodityID',
        'label' => 'General Commodity',
        'type' => 'Number',
        'formComponent' => 'RegularSelect',
        'options' => [],
        'source' => "/commodity/general-commodity/list",
        'mount' => true,
        'validations' => [
            'required' => true
        ]
    ],
    [
        'name' => 'GeneralCommodityName',
        'label' => 'General Commodity',
        'type' => 'String',
        'tableComponent' => 'RegularText',
        'searchable' => 'GeneralCommodity.Name'
    ],
    [
        'name' => 'HSCode',
        'label' => 'HSN Code ',
        'type' => 'String',
        'tableComponent' => 'RegularText',
        'formComponent' => 'InputText',
        'searchable' => 'HSCode',
        'validations' => [
            'required' => true
        ]
    ],
    [
        'name' => 'CommodityClassID',
        'label' => 'Commodity Class',
        'type' => 'Number',
        'formComponent' => 'RegularSelect',
        'options' => [],
        'source' => "/commodity/commodity-class/list",
        'mount' => true,
        'validations' => [
            'required' => true
        ]
    ],
    [
        'name' => 'CommodityClassName',
        'label' => 'Commodity Class',
        'type' => 'String',
        'tableComponent' => 'RegularText',
        'searchable' => 'CommodityClass.Name'
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
        'name' => 'UomName',
        'label' => 'Uom',
        'type' => 'String',
        'tableComponent' => 'RegularText',
        'searchable' => 'Uom.Name'
    ],
    [
        'name' => 'Description',
        'label' => 'Description',
        'type' => 'String',
        'tableComponent' => 'RegularText',
        'formComponent' => 'Textarea',
        'searchable' => 'Description',
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
     * Get the Commodity associated with the HSNCode.
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
     * Get the GeneralCommodity associated with the HSNCode.
     *
     * @return object
     */
    public function generalCommodity()
    {
        return $this->belongsTo(
            related: GeneralCommodity::class,
            foreignKey: 'GeneralCommodityID',
            ownerKey: 'ID'
        );
    }


    // /**
    //  * Get the CommodityClass associated with the HSNCode.
    //  *
    //  * @return object
    //  */
    public function commodityClass()
    {
        return $this->belongsTo(
            related: CommodityClass::class,
            foreignKey: 'CommodityClassID',
            ownerKey: 'ID'
        );
    }


    /**
     * Get the Uom associated with the HSNCode.
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
