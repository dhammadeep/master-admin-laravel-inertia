<?php

namespace App\Models\Zonal;

use App\Models\Geographical\State;
use App\Models\Zonal\VarietyZonal;
use App\Models\Phenophase\Phenophase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhenophaseDuration extends Model
{
     use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zonal_phenophase_duration';

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
        'ZonalVarietyID',
        'PhenophaseID',
        'StartDas',
        'EndDas',
        'PhenophaseOrder'
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
            'name' => 'PhenophaseName',
            'label' => 'Phenophase',
            'type' => 'String',
            'tableComponent' => 'RegularText',
            'searchable' => 'Phenophase.name'
        ],
        [
            'name' => 'PhenophaseID',
            'label' => 'Phenophase',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'source'        => '/phenophase/phenophase/list',
            'options' => [],
            'mount' => true,
            'validations' => [
                'required' => true,
            ],
        ],
       [
            'name' => 'StartDas',
            'label' => 'Start DAS',
            'type' => 'Number',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'StartDas',
            'validations' => [
                'required' => true,
                'max' => 50,
                'min' => 1,
            ]
       ],
       [
            'name' => 'EndDas',
            'label' => 'End DAS',
            'type' => 'Number',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'EndDas',
            'validations' => [
                'required' => true,
                'max' => 50,
                'min' => 1,
            ]
        ],
        [
            'name' => 'PhenophaseOrder',
            'label' => 'Phenophase Order',
            'type' => 'Number',
            'tableComponent' => 'RegularText',
            'formComponent' => 'InputText',
            'searchable' => 'PhenophaseOrder',
            'validations' => [
                'required' => true,
                'max' => 50,
                'min' => 1,
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
     * Get the state associated with the zonal Fertlizer.
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

     /**
     * Get the Phenophase associated with the zonal phenophase.
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


}
