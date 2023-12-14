<?php

namespace App\Models\Agrochemicals;

use App\Models\Commodity\Commodity;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agrochemicals\Agrochemical;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AgroCommoditychemical extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agri_commodity_agrochemical';

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
        'Name',
        'AgrochemicalTypeID',
        'CommodityID',
        'CIBRCApproved',
        'AgrochemicalID',
        'WaitingPeriod',
        'Status'
    ];

    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

     /**
     * Structure of dynamic form elements
     */
    protected static $tableFields = [

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
            'name' => 'AgrochemicalTypeName',
            'label' => 'Agrochemical Type',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'AgrochemicalType.Name'
        ],
        [
            'name' => 'AgrochemicalTypeID',
            'label' => 'AgrochemicalType',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/agrochemicals/agrochemical-type/list",
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
        [
            'name' => 'AgrochemicalName',
            'label' => 'Agro chemical',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Agrochemical.Name'
        ],
        [
            'name' => 'AgrochemicalID',
            'label' => 'Agrochemical ',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/agrochemicals/agrochemical/list-by-parent",
            'watching' => 'AgrochemicalTypeID',
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
        [
            'name' => 'CIBRCApproved',
            'label' => 'CIBRC Approved',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'RegularSelect',
            'options' => [
                ['value' => 'Yes', 'label' => 'Yes'],
                ['value' => 'No', 'label' => 'No'],
            ],
            'searchable' => 'CIBRCApproved',
            'validations' => [
                'required' => true,
            ]
        ],
        [
            'name' => 'WaitingPeriod',
            'label' => 'Waiting Period',
            'type' => 'Number',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'options' => [],
            'searchable' => 'WaitingPeriod',
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
     * Get the agroChemicalTypeGroup associated with the AgrochemicalType.
     *
     * @return object
     */
    public function agroChemicalType()
    {
        return $this->belongsTo(
            related: AgrochemicalType::class,
            foreignKey: 'AgrochemicalTypeID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the AgrochemicaleGroup associated with the Agrochemical.
     *
     * @return object
     */
    public function agrochemical()
    {
        return $this->belongsTo(
            related: Agrochemical::class,
            foreignKey: 'AgrochemicalID',
            ownerKey: 'ID'
        );
    }

       /**
     * Get the CommodityGroup associated with the Commodity.
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
}
