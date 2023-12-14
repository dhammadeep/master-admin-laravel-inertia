<?php

namespace App\Models\Regional;

use App\Models\Agriculture\Season;
use App\Models\Geographical\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeasonRegional extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'regional_season';

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
        'SeasonID',
        'SeasonStartWeek',
        'SeasonEndWeek',
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
            'name' => 'SeasonName',
            'label' => 'Season',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Season.Name'
        ],
        [
            'name' => 'SeasonID',
            'label' => 'Season',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'source'        => '/agriculture/season/list',
            'options' => [],
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
        [
            'name' => 'SeasonStartWeek',
            'label' => 'Season Start Week',
            'type' => 'Number',
            'tableComponent' => 'RegularText',
            'searchable' => 'SeasonStartWeek',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/agriculture/meteorological-week/list",
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
       ],
        [
            'name' => 'SeasonEndWeek',
            'label' => 'Season End Week',
            'type' => 'Number',
            'tableComponent' => 'RegularText',
            'searchable' => 'SeasonEndWeek',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/agriculture/meteorological-week/list",
            'mount' => true,
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
     * Get the State associated with the Regional Season.
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
     * Get the Season associated with the Regional Season.
     *
     * @return object
     */
    public function season()
    {
        return $this->belongsTo(
            related: Season::class,
            foreignKey: 'SeasonID',
            ownerKey: 'ID'
        );
    }

}
