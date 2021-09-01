<?php namespace October\Test\Models;

use Model;

/**
 * User Model
 */
class User extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * implement the TranslatableModel behavior for attachments
     */
    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'october_test_users';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array translatable attributes
     */
    public $translatable = [];

    /**
     * @var array Rules
     */
    public $rules = [
        'username' => 'required',
        'photo' => 'required',
        'portfolio' => 'required',
        'roles' => 'required',
    ];

    /**
     * @var array customMessages
     */
    public $customMessages = [
       'required' => 'The :attribute field is WOW required.',
       'photo.required' => 'The :attribute field is required PHOTO.',
       // @see method beforeValidate
       // 'username.required' => 'Say hello (Username field required)',
    ];

    /**
     * beforeValidate uses hacky validation messages
     */
    public function beforeValidate()
    {
        \Event::listen('translator.beforeResolve', function($key, $replace, $locale) {
            if ($key === 'validation.custom.username.required') {
                return 'Say hello (Username field required)';
            }
        });
    }

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'country' => Country::class
    ];

    public $belongsToMany = [
        'roles' => [
            Role::class,
            'table' => 'october_test_users_roles',
            'timestamps' => true,
            'order' => 'name'
        ],
        // @deprecated
        // 'roles_count' => [
        //     Role::class,
        //     'table' => 'october_test_users_roles',
        //     'count' => true
        // ],
        'roles_pivot' => [
            Role::class,
            'table' => 'october_test_users_roles',
            'pivot' => ['clearance_level', 'is_executive'],
            'timestamps' => true
        ],
        'roles_pivot_model' => [
            Role::class,
            'table' => 'october_test_users_roles',
            'pivot' => ['clearance_level', 'is_executive', 'country_id'],
            'timestamps' => true,
            'pivotModel' => UserRolePivot::class,
        ],
    ];

    public $attachOne = [
        'photo' => \System\Models\File::class,
        'photo_secure' => [\System\Models\File::class, 'public' => false],
        'certificate' => [\System\Models\File::class],
        'certificate_secure' => [\System\Models\File::class, 'public' => false],
        'custom_file' => CustomFile::class
    ];

    public $attachMany = [
        'portfolio' => \System\Models\File::class,
        'portfolio_secure' => [\System\Models\File::class, 'public' => false],
        'files' => [\System\Models\File::class],
        'files_secure' => [\System\Models\File::class, 'public' => false],
    ];

    public function scopeApplyRoleFilter($query, $filtered)
    {
        return $query->whereHas('roles', function($q) use ($filtered) {
            $q->whereIn('id', $filtered);
        });
    }
}
