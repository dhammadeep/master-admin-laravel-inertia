<?php

namespace App\Models\Agriculture;

use App\Models\Commodity\Variety;
use App\Models\Agriculture\Season;
use App\Models\Geographical\State;
use App\Models\Geographical\Region;
use App\Models\Commodity\Commodity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BenchmarkVariety extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agri_benchmark_variety';

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
        'RegionID',
        'SeasonID',
        'CommodityID',
        'VarietyID',
        'IsDrkBenchmark',
        'IsAgmBenchmark'
    ];

    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

    /**
     * Structure of dynamic form elements
     */
    protected static $tableFields = [
        //add array from generator form
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
            'name' => 'RegionName',
            'label' => 'Region',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Region.Name'
        ],
        [
            'name' => 'RegionID',
            'label' => 'Region',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'source'        => '/geographical/region/list',
            'options' => [],
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
        [
            'name' => 'StateName',
            'label' => 'StateCode',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'State.Name',
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
            'source'        => '/regional/season-regional/list-by-parent',
            'watching' => "StateCode",
            'mount' => true,
            'options' => [],
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
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
            'name' => 'IsDrkBenchmark',
            'label' => 'IsDrkBenchmark',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'RegularSelect',
            'options' => [
                ['value' => 'Yes', 'label' => 'Yes'],
                ['value' => 'No', 'label' => 'No'],
            ],
            'searchable' => 'IsDrkBenchmark',
            'validations' => [
                'required' => true,
            ]
        ],
        [
            'name' => 'IsAgmBenchmark',
            'label' => 'IsAgmBenchmark',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'RegularSelect',
            'options' => [
                ['value' => 'Yes', 'label' => 'Yes'],
                ['value' => 'No', 'label' => 'No'],
            ],
            'searchable' => 'IsAgmBenchmark',
            'validations' => [
                'required' => true,
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
     * Get the Region associated with the BenchmarkVariety.
     *
     * @return object
     */
    public function region()
    {
        return $this->belongsTo(
            related: Region::class,
            foreignKey: 'RegionID',
            ownerKey: 'RegionID'
        );
    }

    /**
     * Get the State associated with the BenchmarkVariety.
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
     * Get the Season associated with the BenchmarkVariety.
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

    /**
     * Get the Commodity associated with the BenchmarkVariety.
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
     * Get the Variety associated with the BenchmarkVariety.
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
}
