<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class User extends Model
{
    use SoftDeletes;

    protected $table = 'users';

    protected $hidden = ['id', 'password', 'blocked',
        'email_verified_at', 'mobile_verified_at',
        'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'deleted_at'];

    protected $casts = [
        'blocked' => 'boolean',
    ];

    public function getEmailAttribute($value)
    {
        $request_user = request()->user;
     
        if (empty($request_user)) {
            return null;
        }
        if ($request_user->is_administrator || $request_user->is_super_administrator) {
            return $value;
        }

        if ($this->id === $request_user->id) {
            return $value;
        }
        $value_exploded = explode('@', $value);
        
        return $this->stringToSecret($value_exploded[0]) . '@' . $value_exploded[1];
    }

    public function getMobileAttribute($value)
    {
        $request_user = request()->user;
        if (empty($request_user)) {
            return null;
        }
        if ($request_user->is_administrator || $request_user->is_super_administrator) {
            return $value;
        }

        if ($this->id === $request_user->id) {
            return $value;
        }
        return $this->stringToSecret($value);
    }

    private function stringToSecret(string $string = null)
    {
        if (!$string) {
            return null;
        }
        $length = strlen($string);
        $visibleCount = (int) round($length / 4);
        $hiddenCount = $length - ($visibleCount * 2);
        return substr($string, 0, $visibleCount) . str_repeat('*', $hiddenCount) . substr($string, ($visibleCount * -1), $visibleCount);
    }

    public function setPasswordAttribute($value)
    {

        return $this->attributes['password'] = Hash::make($value);

    }

    public function verify_password($password)
    {
        return Hash::check($password, $this->password);
    }

    public function roles()
    {

        return $this->hasMany('App\Models\User\UserRoleRelation', 'user_id', 'id');
    }

    public function getRoleNamesAttribute()
    {
        $role_names = [];
        $this->roles()->each(function ($item, $key) use (&$role_names) {
            $role_names[] = $item->role->name;
        });
        return $role_names;
    }

    public function has_role( $role_name)
    {
        return in_array($role_name, $this->role_names);
    }

    public function getIsSuperAdministratorAttribute() // is_super_administrator
    {
        if (in_array('Super Administrator', $this->role_names)) {
            return true;
        }
        return false;
    }
    public function getIsAdministratorAttribute() // is_administrator
    {

        if (in_array('Administrator', $this->role_names)) {
            return true;
        }
        return false;
    }

    public function getIsDoctorAttribute() //is_doctor
    {

        if (in_array('Doctor', $this->role_names)) {
            return true;
        }
        return false;
    }

    public function getIsFrontDeskAttribute()  // is_front_desk
    {

        if (in_array('Front Desk', $this->role_names)) {
            return true;
        }
        return false;
    }

    public function getIsPharmacistAttribute()  //is_pharmacist
    {

        if (in_array('Pharmacist', $this->role_names)) {
            return true;
        }
        return false;
    }
    public function getIsPatientAttribute()  //is_pharmacist
    {

        if (in_array('Patient', $this->role_names)) {
            return true;
        }
        return false;
    }

    public function getGenderTextAttribute(){
        $value = $this->gender;
        if($value === 'm'){
            return 'Male';
        }
        if($value === 'f'){
            return 'Female';
        }
        if($value === 'o'){
            return 'Other';
        }
        return 'Undefined';

    }

    public function getFormattedAttribute(){
        return (object)[
            'dob' => $this->dob?Carbon::parse($this->dob)->format('d-m-Y'):'',
            'age' => $this->dob?Carbon::parse($this->dob)->age:''
        ];
    }

    public function user_custom_value($field_uuid, $value = NULL){

        $field = UserCustomField::where('uuid', $field_uuid)->first();
        if(empty($field)){
            return NULL;
        }

        $row = UserCustomValue::where('user_custom_field_id', $field->id)
                    ->where('user_id', $this->id)
                    ->when($value, function($query) use ($value){
                        return $query->where('value', $value);
                    })
                    ->first();
        if(empty($row)){
            return NULL;
        }
        return $row->value;
    }


    public function can_view_menu_item($roles = array()){
        if(empty($roles)){
            return false;
        }
        $roles_trimmed = array_map(function($role){
            return trim($role);
        }, $roles);
        
        $authorize = false;
        $request_user = request()->user;
        foreach($roles_trimmed as $role){
            if($role === 'Super Administrator' && $request_user->is_super_administrator){
                $authorize = true;
            }
            if($role === 'Administrator' && $request_user->is_administrator){
                $authorize = true;
            }
            if($role === 'Pharmacist' && $request_user->is_pharmacist){
                $authorize = true;
            }
            if($role === 'Front Desk' && $request_user->is_front_desk){
                $authorize = true;
            }
            if($role === 'Doctor' && $request_user->is_doctor){
                $authorize = true;
            }
            if($role === 'Patient' && $request_user->is_patient){
                $authorize = true;
            }
        }
        return $authorize;

    }
}
