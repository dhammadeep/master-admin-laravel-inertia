<?php

namespace App\Models\Commodity;

use App\Models\Commodity\PlantPart;
use App\Models\Commodity\Commodity;
use App\Models\Phenophase\Phenophase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommodityPlantPart extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agri_commodity_plant_part';

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
        'PhenophaseID',
        'PlantPartID',
        'ImageID',
        'FileUrl',
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
                'required' => true
            ]
        ],
        [
            'name' => 'PhenophaseName',
            'label' => 'Phenophase',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Phenophase.Name'
        ],
        [
            'name' => 'PhenophaseID',
            'label' => 'Phenophase',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/phenophase/commodity-phenophase/list-by-parent",
            'watching' => "CommodityID",
            'mount' => true,
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'PlantPartName',
            'label' => 'PlantPart',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'PlantPart.Name'
        ],
        [
            'name' => 'PlantPartID',
            'label' => 'PlantPart',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/commodity/plant-part/list",
            'mount' => true,
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'FileUrl',
            'label' => 'Browse File',
            'type' => 'String',
            'tableComponent' => 'ThumbImage',
            'formComponent' => 'File'
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
     * Get the Commodity associated with the CommodityPlantPart.
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
     * Get the Phenophase associated with the CommodityPlantPart.
     *
     * @return object
     */
    public function phenophase()
    {
        return $this->belongsTo(
            related: Phenophase::class,
            foreignKey: 'PhenophaseID',
            ownerKey: 'ID'
        );
    }


    // /**
    //  * Get the PlantPart associated with the CommodityPlantPart.
    //  *
    //  * @return object
    //  */
    public function plantPart()
    {
        return $this->belongsTo(
            related: PlantPart::class,
            foreignKey: 'PlantPartID',
            ownerKey: 'ID'
        );
    }

    // /**
    //  * Get the Image associated with the CommodityPlantPart.
    //  *
    //  * @return object
    //  */
    // public function image()
    // {
    //     return $this->belongsTo(
    //         related: Image::class,
    //         foreignKey: 'ImageID',
    //         ownerKey: 'ID'
    //     );
    // }

}
