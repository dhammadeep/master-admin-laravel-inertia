<?php

namespace App\Models\Agriculture;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeteorologicalWeek extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agri_meteorological_weeks';

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
        'WeekNo',
        'StartDay',
        'StartMonth',
        'EndDay',
        'EndMonth',
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
            'name' => 'WeekNo',
            'label' => 'Week No',
            'type' => 'Number',
            'tableComponent' => 'RegularText',
            'formComponent' => 'RegularSelect',
            'options' => [
                ['value' => '1', 'label' => '1'],
                ['value' => '2', 'label' => '2'],
                ['value' => '3', 'label' => '3'],
                ['value' => '4', 'label' => '4'],
                ['value' => '5', 'label' => '5'],
                ['value' => '6', 'label' => '6'],
                ['value' => '7', 'label' => '7'],
                ['value' => '8', 'label' => '8'],
                ['value' => '9', 'label' => '9'],
                ['value' => '10', 'label' => '10'],
                ['value' => '11', 'label' => '11'],
                ['value' => '12', 'label' => '12'],
                ['value' => '13', 'label' => '13'],
                ['value' => '14', 'label' => '14'],
                ['value' => '15', 'label' => '15'],
                ['value' => '16', 'label' => '16'],
                ['value' => '17', 'label' => '17'],
                ['value' => '18', 'label' => '18'],
                ['value' => '19', 'label' => '19'],
                ['value' => '20', 'label' => '20'],
                ['value' => '21', 'label' => '21'],
                ['value' => '22', 'label' => '22'],
                ['value' => '23', 'label' => '23'],
                ['value' => '24', 'label' => '24'],
                ['value' => '25', 'label' => '25'],
                ['value' => '26', 'label' => '26'],
                ['value' => '27', 'label' => '27'],
                ['value' => '28', 'label' => '28'],
                ['value' => '29', 'label' => '29'],
                ['value' => '30', 'label' => '30'],
                ['value' => '31', 'label' => '31'],
                ['value' => '32', 'label' => '32'],
                ['value' => '33', 'label' => '33'],
                ['value' => '34', 'label' => '34'],
                ['value' => '35', 'label' => '35'],
                ['value' => '36', 'label' => '36'],
                ['value' => '37', 'label' => '37'],
                ['value' => '38', 'label' => '38'],
                ['value' => '39', 'label' => '39'],
                ['value' => '40', 'label' => '40'],
                ['value' => '41', 'label' => '41'],
                ['value' => '42', 'label' => '42'],
                ['value' => '43', 'label' => '43'],
                ['value' => '44', 'label' => '44'],
                ['value' => '45', 'label' => '45'],
                ['value' => '46', 'label' => '46'],
                ['value' => '47', 'label' => '47'],
                ['value' => '48', 'label' => '48'],
                ['value' => '49', 'label' => '49'],
                ['value' => '50', 'label' => '50'],
                ['value' => '51', 'label' => '51'],
                ['value' => '52', 'label' => '52'],
            ],
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'StartDay',
            'label' => 'Start Date',
            'type' => 'Number',
            'tableComponent' => 'RegularText',
            'formComponent' => 'RegularSelect',
            'options' => [
                ['value' => '1', 'label' => '1'],
                ['value' => '2', 'label' => '2'],
                ['value' => '3', 'label' => '3'],
                ['value' => '4', 'label' => '4'],
                ['value' => '5', 'label' => '5'],
                ['value' => '6', 'label' => '6'],
                ['value' => '7', 'label' => '7'],
                ['value' => '8', 'label' => '8'],
                ['value' => '9', 'label' => '9'],
                ['value' => '10', 'label' => '10'],
                ['value' => '11', 'label' => '11'],
                ['value' => '12', 'label' => '12'],
                ['value' => '13', 'label' => '13'],
                ['value' => '14', 'label' => '14'],
                ['value' => '15', 'label' => '15'],
                ['value' => '16', 'label' => '16'],
                ['value' => '17', 'label' => '17'],
                ['value' => '18', 'label' => '18'],
                ['value' => '19', 'label' => '19'],
                ['value' => '20', 'label' => '20'],
                ['value' => '21', 'label' => '21'],
                ['value' => '22', 'label' => '22'],
                ['value' => '23', 'label' => '23'],
                ['value' => '24', 'label' => '24'],
                ['value' => '25', 'label' => '25'],
                ['value' => '26', 'label' => '26'],
                ['value' => '27', 'label' => '27'],
                ['value' => '28', 'label' => '28'],
                ['value' => '29', 'label' => '29'],
                ['value' => '30', 'label' => '30'],
                ['value' => '31', 'label' => '31'],
            ],
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'StartMonth',
            'label' => 'StartMonth',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [
                ['value' => '1', 'label' => 'January -1'],
                ['value' => '2', 'label' => 'February -2'],
                ['value' => '3', 'label' => 'March -3'],
                ['value' => '4', 'label' => 'April -4'],
                ['value' => '5', 'label' => 'May -5'],
                ['value' => '6', 'label' => 'June -6'],
                ['value' => '7', 'label' => 'July -7'],
                ['value' => '8', 'label' => 'August -8'],
                ['value' => '9', 'label' => 'September -9'],
                ['value' => '10', 'label' => 'October -10'],
                ['value' => '11', 'label' => 'November -11'],
                ['value' => '12', 'label' => 'December -12'],
            ],
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'EndDay',
            'label' => 'End Date',
            'type' => 'Number',
            'tableComponent' => 'RegularText',
            'formComponent' => 'RegularSelect',
            'options' => [
                ['value' => '1', 'label' => '1'],
                ['value' => '2', 'label' => '2'],
                ['value' => '3', 'label' => '3'],
                ['value' => '4', 'label' => '4'],
                ['value' => '5', 'label' => '5'],
                ['value' => '6', 'label' => '6'],
                ['value' => '7', 'label' => '7'],
                ['value' => '8', 'label' => '8'],
                ['value' => '9', 'label' => '9'],
                ['value' => '10', 'label' => '10'],
                ['value' => '11', 'label' => '11'],
                ['value' => '12', 'label' => '12'],
                ['value' => '13', 'label' => '13'],
                ['value' => '14', 'label' => '14'],
                ['value' => '15', 'label' => '15'],
                ['value' => '16', 'label' => '16'],
                ['value' => '17', 'label' => '17'],
                ['value' => '18', 'label' => '18'],
                ['value' => '19', 'label' => '19'],
                ['value' => '20', 'label' => '20'],
                ['value' => '21', 'label' => '21'],
                ['value' => '22', 'label' => '22'],
                ['value' => '23', 'label' => '23'],
                ['value' => '24', 'label' => '24'],
                ['value' => '25', 'label' => '25'],
                ['value' => '26', 'label' => '26'],
                ['value' => '27', 'label' => '27'],
                ['value' => '28', 'label' => '28'],
                ['value' => '29', 'label' => '29'],
                ['value' => '30', 'label' => '30'],
                ['value' => '31', 'label' => '31'],
            ],
            'validations' => [
                'required' => true
            ]
        ],
        [
            'name' => 'EndMonth',
            'label' => 'EndMonth',
            'type' => 'Number',
            'formComponent' => 'RegularSelect',
            'options' => [
                ['value' => '1', 'label' => 'January -1'],
                ['value' => '2', 'label' => 'February -2'],
                ['value' => '3', 'label' => 'March -3'],
                ['value' => '4', 'label' => 'April -4'],
                ['value' => '5', 'label' => 'May -5'],
                ['value' => '6', 'label' => 'June -6'],
                ['value' => '7', 'label' => 'July -7'],
                ['value' => '8', 'label' => 'August -8'],
                ['value' => '9', 'label' => 'September -9'],
                ['value' => '10', 'label' => 'October -10'],
                ['value' => '11', 'label' => 'November -11'],
                ['value' => '12', 'label' => 'December -12'],
            ],
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

    //Display start date in list
    public function getStartDateAttribute()
    {
        $day = $this->attributes['StartDay'];
        $month = $this->attributes['StartMonth'];

        // Format month as its corresponding name
        $formattedMonth = date("F", mktime(0, 0, 0, $month, 1));

        return $day . ' ' . $formattedMonth;
    }

    //Display end date in list
    public function getEndDateAttribute()
    {
        $day = $this->attributes['EndDay'];
        $month = $this->attributes['EndMonth'];

        // Format month as its corresponding name
        $formattedMonth = date("F", mktime(0, 0, 0, $month, 1));

        return $day . ' ' . $formattedMonth;
    }
}
