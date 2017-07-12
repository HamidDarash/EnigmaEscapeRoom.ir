<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $guarded = array();

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

    }

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'family', 'email', 'password', 'telephone', 'mobile',
        'address', 'code_melli', 'zip_code', 'city', 'province', 'avatar', 'bank_account_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the roles a user has
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'users_roles');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function games()
    {
        return $this->belongsToMany('App\Game', 'reservations');
    }

    /**
     * Find out if User is an employee, based on if has any roles
     * @return boolean
     */
    public function isEmployee()
    {
        $roles = $this->roles->toArray();
        return $roles;
    }

    /**
     * Find out if user has a specific role
     * $return boolean
     */
    public function hasRole($check)
    {
        return in_array($check, array_pluck($this->roles->toArray(), 'name'));
    }

    /**
     * Get key in array with corresponding value
     * @return int
     */
    private function getIdInArray($array, $term)
    {
        foreach ($array as $key => $value) {
            if ($value == $term) {
                return $key;
            }
        }
        throw new UnexpectedValueException;
    }

    /**
     * Add roles to user to make them a concierge
     */
    public function makeEmployee($title)
    {
        $assigned_roles = array();
        $roles = array_fetch(Role::all()->toArray(), 'name');
        switch ($title) {
            case 'super_admin':
                $assigned_roles[] = $this->getIdInArray($roles, 'admin_panel');
            case 'admin':
                $assigned_roles[] = $this->getIdInArray($roles, 'admin_panel');
            case 'user':
                $assigned_roles[] = $this->getIdInArray($roles, 'show_profile');
                break;
            default:
                throw new \Exception("The employee status entered does not exist");
        }
        $this->roles()->attach($assigned_roles);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Transactions()
    {
        return $this->belongsToMany('App\Transaction','user_transaction');
    }

}
