<?php

namespace App\Models\Commodity;

use App\Models\Stress\CommodityStress;
use Illuminate\Database\Eloquent\Model;
use App\Models\Phenophase\CommodityPhenophase;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commodity extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agri_commodity';

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
        'ScientificName',
        'CommodityGroupID',
        'CommodityGroupIndex',
        'Logo',
        'Status',
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
            'name' => 'Name',
            'label' => 'Commodity',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'Name',
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'ScientificName',
            'label' => 'Scientific Name',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'ScientificName'
        ],
        [
            'name' => 'Description',
            'label' => 'Description',
            'type' => 'String',
            'formComponent' => 'Textarea',
            'searchable' => 'Description'
        ],
        [
            'name' => 'CommodityGroupName',
            'label' => 'Commodity Group',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'CommodityGroup.Name'
        ],
        [
            'name' => 'CommodityGroupID',
            'label' => 'Commodity Group',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/commodity/commodity-group/list",
            'mount' => true
        ],
        [
            'name' => 'CommodityGroupIndex',
            'label' => 'Commodity Group Index',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'CommodityGroupIndex'
        ],
        [
            'name' => 'Logo',
            'label' => 'Logo',
            'type' => 'String',
            'tableComponent' => 'ThumbImage',
            'formComponent' => 'File',
            'validations' => [
                'required' => true,
                'mimes' => '.jpg, .jpeg, .png',
                'max' => 4096
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
     * Get the CommodityGroup associated with the Commodity.
     *
     * @return object
     */
    public function commodityGroup()
    {
        return $this->belongsTo(
            related: CommodityGroup::class,
            foreignKey: 'CommodityGroupID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the CommodityPhenophase associated with the Commodity.
     *
     * @return object
     */
    public function commodityPhenophase()
    {
        return $this->hasMany(
            related: CommodityPhenophase::class,
            foreignKey: 'CommodityID'
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
            localKey:'ID'
        );
    }

}
