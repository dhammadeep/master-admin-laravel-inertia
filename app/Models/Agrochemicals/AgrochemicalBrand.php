<?php

namespace App\Models\Agrochemicals;

use App\Models\General\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AgrochemicalBrand extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agri_agrochemical_brand';

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
        'AgrochemicalID',
        'CompanyID',
        'AgrochemicalStatus',
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
                'required' => true,
                'max' => 50,
                'min' => 1,
            ]
           ],
           [
            'name' => 'Name',
            'label' => 'Brand Name',
            'type' => 'String',
            'formComponent' => 'InputText',
            'searchable' => 'Name',
            'validations' => [
                'required' => true,
                'max' => 50,
                'min' => 1,
            ]
           ],

        [
            'name' => 'CompanyName',
            'label' => 'Company Name',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Company.Name'
        ],
        [
            'name' => 'CompanyID',
            'label' => 'Company Name',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/general/company/list",
            'mount' => true,
            'validations' => [
                'required' => true,
            ]
        ],
        [
            'name' => 'AgrochemicalTypeID',
            'label' => 'Agrochemical Type',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/agrochemicals/agrochemical-type/list",
            'mount' => true,
            'validations' => [
                'required' => true,
            ]
        ],
        [
            'name' => 'AgrochemicalName',
            'label' => 'Agrochemical Name',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Agrochemical.Name'
        ],
        [
            'name' => 'AgrochemicalID',
            'label' => 'Agrochemical Name',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/agrochemicals/agrochemical/list-by-parent",
            'watching' => 'AgrochemicalTypeID',
            'mount' => true,
            'validations' => [
                'required' => true,
            ]
        ],
        [
            'name' => 'AgrochemicalStatus',
            'label' => 'Agrochemical Status',
            'type' => 'String',
            'formComponent' => 'RegularSelect',
            'options' => [
                ['value' => 'Active', 'label' => 'Active'],
                ['value' => 'Banned', 'label' => 'Banned'],
            ],
            'mount' => true
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
        ],
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
            set: fn ($value, $attributes) => $attributes['Name'] = ucwords(strtolower($value)),
        );
    }

     /**
     * Get the agrochemicalGroup associated with the Agrochemical.
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

    public function company()
    {
        return $this->belongsTo(
            related: Company::class,
            foreignKey: 'CompanyID',
            ownerKey: 'ID'
        );
    }

}
