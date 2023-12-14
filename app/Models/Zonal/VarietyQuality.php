<?php

namespace App\Models\Zonal;

use App\Models\Agriculture\Band;
use App\Models\Zonal\VarietyZonal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VarietyQuality extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zonal_variety_quality';

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
        'ZonalVarietyID',
        'CurrentQualityBandID',
        'EstimatedQualityBandID',
        'AllowableVarianceInQualityBandID',
        'IsBenchmark'
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
            'options' => [],
            'source' => "/geographical/state/list",
            'mount' => true,
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'AczName',
            'label' => 'ACZ',
            'type' => 'String',
            'tableComponent' => 'RegularText',
        ],
        [
            'name' => 'AczID',
            'label' => 'Acz',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/geographical/acz/list-by-parent",
            'watching' => 'StateCode',
            'mount' => true,
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'ZonalCommodityName',
            'label' => 'Zonal Commodity',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'ZonalCommodity.Name'
        ],
        [
            'name' => 'ZonalCommodityID',
            'label' => 'Zonal Commodity',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'source'        => '/zonal/zonal-commodity/list-by-parent',
            'options' => [],
            'watching' => 'AczID',
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
        [
            'name' => 'ZonalVarietyName',
            'label' => 'Zonal Variety',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'VarietyZonal.Name'
        ],
        [
            'name' => 'ZonalVarietyID',
            'label' => 'Zonal Variety',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'source'        => '/zonal/variety-zonal/list-by-parent',
            'options' => [],
            'watching' => 'ZonalCommodityID',
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
        [
            'name' => 'CurrentQualityBandName',
            'label' => 'Current Quality Band',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'CurrentQualityBand.Name'
        ],
        [
            'name' => 'CurrentQualityBandID',
            'label' => 'Current Quality Band',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'source'        => '/agriculture/band/list',
            'options' => [],
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
        [
            'name' => 'EstimatedQualityBandName',
            'label' => 'Estimated Quality Band',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'EstimatedQualityBand.Name'
        ],
        [
            'name' => 'EstimatedQualityBandID',
            'label' => 'Estimated Quality Band',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'source'        => '/agriculture/band/list',
            'options' => [],
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
        [
            'name' => 'AllowableVarianceInQualityBandName',
            'label' => 'Allowable Variance In Quality Band',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'AllowableVarianceInQualityBand.Name'
        ],
        [
            'name' => 'AllowableVarianceInQualityBandID',
            'label' => 'Allowable Variance In Quality Band',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'source'        => '/agriculture/band/list',
            'options' => [],
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
        [
            'name' => 'IsBenchmark',
            'label' => 'Is Benchmark?',
            'type' => 'Number',
            'tableComponent' => 'OptionBadge',
            'searchable' => 'IsBenchmark',
            'options' => [
                ['value' => 1, 'label' => 'Yes'],
                ['value' => 0, 'label' => 'No'],
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
     * Get the current Quality Band associated with the variety quality.
     *
     * @return object
     */
    public function currentQualityBand()
    {
        return $this->belongsTo(
            related: Band::class,
            foreignKey: 'CurrentQualityBandID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the Estimated Quality Band associated with the variety quality.
     *
     * @return object
     */
    public function estimatedQualityBand()
    {
        return $this->belongsTo(
            related: Band::class,
            foreignKey: 'EstimatedQualityBandID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the Allowable Variance In Quality Band associated with the variety quality.
     *
     * @return object
     */
    public function allowableVarianceInQualityBand()
    {
        return $this->belongsTo(
            related: Band::class,
            foreignKey: 'AllowableVarianceInQualityBandID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the zonalVariety associated with the zonal Fertlizer.
     *
     * @return object
     */
    public function varietyZonal()
    {
        return $this->belongsTo(
            related: VarietyZonal::class,
            foreignKey: 'ZonalVarietyID',
            ownerKey: 'ID'
        );
    }

}
