<?php

namespace App\Models\Zonal;

use App\Models\General\Uom;
use App\Models\Stress\Stress;
use App\Models\Zonal\ZonalCommodity;
use App\Models\Stress\Recommendation;
use App\Models\Stress\ControlMeasures;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stress\AgrochemicalApplication;
use App\Models\Stress\AgrochemicalInstructions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StressControl extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zonal_stress_control_recommendation';

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
        'ZonalCommodityID',
        'StressControlMeasureID',
        'StressID',
        'RecomendationID',
        'AgrochemicalInstructionID',
        'AgrochemApplicationTypeID',
        'AgrochemicalID',
        'DosePerAcre',
        'PerAcreUomID',
        'WaterPerAcre',
        'PerAcreWaterUomID',
        'DosePerLitre'
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
            'name' => 'StressControlMeasureName',
            'label' => 'Stress Control Measure',
            'type' => 'String',
            'tableComponent' => 'RegularText',
        ],
        [
            'name' => 'StressControlMeasureID',
            'label' => 'Stress Control Measure',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/stress/control-measures/list",
            'mount' => true,
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'StressName',
            'label' => 'Stress',
            'type' => 'String',
            'tableComponent' => 'RegularText',
        ],
        [
            'name' => 'StressID',
            'label' => 'Stress',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/stress/stress/list",
            'mount' => true,
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'RecomendationName',
            'label' => 'Recommendation',
            'type' => 'String',
            'tableComponent' => 'RegularText',
        ],
        [
            'name' => 'RecomendationID',
            'label' => 'Recommendation',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/stress/recommendation/list",
            'mount' => true,
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'AgrochemicalName',
            'label' => 'Agrochemical',
            'type' => 'String',
            'tableComponent' => 'RegularText',
        ],
        [
            'name' => 'AgrochemicalID',
            'label' => 'Agrochemical',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/zonal/zonal-commodity/list-agrochemical",
            'mount' => true,
            'watching' => 'ZonalCommodityID',
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'DosePerAcre',
            'label' => 'Dose Per Acre',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'DosePerAcre',
            'validations' => [
                'required' => true,
            ]
        ],
        [
            'name' => 'PerAcreUomName',
            'label' => 'Per Acre Uom',
            'type' => 'String',
            'tableComponent' => 'RegularText',
        ],
        [
            'name' => 'PerAcreUomID',
            'label' => 'Per Acre Uom',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/general/uom/list",
            'mount' => true,
        ],
        [
            'name' => 'WaterPerAcre',
            'label' => 'Water Per Acre',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'WaterPerAcre',
            'validations' => [
                'required' => true,
            ]
        ],
        [
            'name' => 'PerAcreWaterUomName',
            'label' => 'Per Acre Water Uom',
            'type' => 'String',
            'tableComponent' => 'RegularText',
        ],
        [
            'name' => 'PerAcreWaterUomID',
            'label' => 'Per Acre Water Uom',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/general/uom/list",
            'mount' => true,
        ],
        [
            'name' => 'AgrochemApplicationTypeName',
            'label' => 'Agrochemical Application Type',
            'type' => 'String',
            'tableComponent' => 'RegularText',
        ],
        [
            'name' => 'AgrochemApplicationTypeID',
            'label' => 'Agrochemical Application Type',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/stress/agrochemical-application/list",
            'mount' => true,
        ],
        [
            'name' => 'AgrochemicalInstructionName',
            'label' => 'Agrochemical Instruction',
            'type' => 'String',
            'tableComponent' => 'RegularText',
        ],
        [
            'name' => 'AgrochemicalInstructionID',
            'label' => 'Agrochemical Instruction',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/stress/agrochemical-instructions/list",
            'mount' => true,
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
     * Get the zonalCommodity associated with the stress controll recommendation.
     *
     * @return object
     */
    public function zonalCommodity()
    {
        return $this->belongsTo(
            related: ZonalCommodity::class,
            foreignKey: 'ZonalCommodityID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the controlMeasure associated with the stress controll recommendation.
     *
     * @return object
     */
    public function controlMeasure()
    {
        return $this->belongsTo(
            related: ControlMeasures::class,
            foreignKey: 'StressControlMeasureID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the Stress associated with the stress controll recommendation.
     *
     * @return object
     */
    public function stress()
    {
        return $this->belongsTo(
            related: Stress::class,
            foreignKey: 'StressID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the Recomendation associated with the stress controll recommendation.
     *
     * @return object
     */
    public function recomendation()
    {
        return $this->belongsTo(
            related: Recommendation::class,
            foreignKey: 'RecomendationID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the AgrochemicalInstruction associated with the stress controll recommendation.
     *
     * @return object
     */
    public function agrochemicalInstruction()
    {
        return $this->belongsTo(
            related: AgrochemicalInstructions::class,
            foreignKey: 'AgrochemicalInstructionID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the AgrochemApplicationType associated with the stress controll recommendation.
     *
     * @return object
     */
    public function AgrochemApplicationType()
    {
        return $this->belongsTo(
            related: AgrochemicalApplication::class,
            foreignKey: 'AgrochemApplicationTypeID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the PerAcreUom associated with the stress controll recommendation.
     *
     * @return object
     */
    public function perAcreUom()
    {
        return $this->belongsTo(
            related: Uom::class,
            foreignKey: 'PerAcreUomID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the PerAcreWaterUomID associated with the stress controll recommendation.
     *
     * @return object
     */
    public function perAcreWaterUom()
    {
        return $this->belongsTo(
            related: Uom::class,
            foreignKey: 'PerAcreWaterUomID',
            ownerKey: 'ID'
        );
    }

}
