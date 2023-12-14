<?php

namespace App\Models\Stress;

use App\Models\Stress\Stage;
use App\Models\Stress\Stress;
use App\Models\Commodity\Commodity;
use App\Models\Phenophase\Phenophase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommodityStressStage extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agri_commodity_stress_stage';

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
        'StressID',
        'StageID',
        'Description',
        'StartPhenophaseID',
        'EndPhenophaseID'
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
            'name' => 'StressName',
            'label' => 'Stress',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Stress.Name'
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
                'required' => true,
            ],
        ],
        [
            'name' => 'StageName',
            'label' => 'Stage',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Stage.Name'
        ],
        [
            'name' => 'StageID',
            'label' => 'Stage',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/stress/stress-stage/list-by-parent",
            'watching' => "StressID",
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
        [
            'name' => 'Description',
            'label' => 'Description',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'Description',
            'validations' => [
                'required' => true,
                'max' => 50,
                'min' => 1,
            ]
        ],
        [
            'name' => 'PhenophaseStartName',
            'label' => 'Start Phenophase',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'PhenophaseStart.Name'
        ],
        [
            'name' => 'StartPhenophaseID',
            'label' => 'Start Phenophase',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/phenophase/commodity-phenophase/list-by-parent",
            'watching' => "CommodityID",
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
        [
            'name' => 'PhenophaseEndName',
            'label' => 'End Phenophase',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'PhenophaseEnd.Name'
        ],
        [
            'name' => 'EndPhenophaseID',
            'label' => 'End Phenophase',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [],
            'source' => "/phenophase/commodity-phenophase/list-by-parent",
            'watching' => "CommodityID",
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
     * Get the Commodity associated with the CommodityStressStage.
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
     * Get the stress associated with the CommodityStressStage.
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
     * Get the Stage associated with the CommodityStressStage.
     *
     * @return object
     */
    public function stage()
    {
        return $this->belongsTo(
            related: Stage::class,
            foreignKey: 'StageID',
            ownerKey: 'ID'
        );
    }

    /**
     * Get the Phenophase associated with the CommodityStressStage.
     *
     * @return object
     */
    public function phenophaseStart()
    {
        return $this->belongsTo(
            related: Phenophase::class,
            foreignKey: 'StartPhenophaseID',
            ownerKey: 'ID'
        );
    }
    /**
     * Get the Phenophase associated with the CommodityStressStage.
     *
     * @return object
     */
    public function phenophaseEnd()
    {
        return $this->belongsTo(
            related: Phenophase::class,
            foreignKey: 'EndPhenophaseID',
            ownerKey: 'ID'
        );
    }
}
