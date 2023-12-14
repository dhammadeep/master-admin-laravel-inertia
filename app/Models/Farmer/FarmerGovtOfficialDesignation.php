<?php

namespace App\Models\Farmer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FarmerGovtOfficialDesignation extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'farmer_govt_official_designation';

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
        'DepartmentID',
        'Name'
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
        'name' => 'DepartmentName',
        'label' => 'Department',
        'type' => 'String',
        'tableComponent' => 'RegularText',
        'searchable' => 'Department.Name'
    ],
    [
        'name' => 'DepartmentID',
        'label' => 'Department',
        'type' => 'Number',
        'formComponent' => 'RegularSelect',
        'options' => [],
        'source' => "/farmer/govt-department/list",
        'mount' => true
    ],
       [
        'name' => 'Name',
        'label' => 'Govt Official Designation',
        'type' => 'String',
        'tableComponent' => 'RegularText'
       ],
       [
        'name' => 'Name',
        'label' => 'Govt Official Designation Name',
        'type' => 'String',
        'formComponent' => 'InputText',
        'searchable' => 'Name',
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
     * Get the FarmerGovtDepartment associated with the FarmerGovtOfficialDesignation.
     *
     * @return object
     */
    public function farmerGovtDepartment()
    {
        return $this->belongsTo(
            related: FarmerGovtDepartment::class,
            foreignKey: 'DepartmentID',
            ownerKey: 'ID'
        );
    }

}
