<?php

namespace App\Models\Geographical;

use App\Models\Geographical\District;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DistrictAlias extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'geo_district_alias';

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
        'DistrictCode',
        'Alias',

    ];

    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

     /**
     * Structure of dynamic form elements
     */
    protected static $tableFields = [
        
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
            'options' => [],
            'source' => "/geographical/state/list",
            'mount' => true
        ],
    
        [
            'name' => 'DistrictName',
            'label' => 'District Alias',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'District.name'
        ],
        [
            'name' => 'DistrictCode',
            'label' => 'District',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/geographical/district/list",
            'mount' => true
        ],
           [
            'name' => 'Name',
            'label' => 'District Alias',
            'type' => 'String',
            'tableComponent' => 'RegularSelect',
            'formComponent' => 'InputText',
            'searchable' => 'Name',
            'validations' => [
                'required' => true,
                'max' => 50,
                'min' => 1,
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
    protected function Alias(): Attribute
    {
        return Attribute::make(
            set: fn ($value, $attributes) => $attributes['Alias'] = ucwords(strtolower($value)),
        );
    }

    /**
     * Get the stateGroup associated with the State.
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
     * Get the district associated with the district alias.
     *
     * @return object
     */
    public function district()
    {
        return $this->belongsTo(
            related: District::class,
            foreignKey: 'DistrictCode',
            ownerKey: 'ID'
        );

    }

}
