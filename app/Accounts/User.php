<?php

namespace Atom26\Accounts;

use Atom26\Sports\Sport;
use Atom26\Web\InternetPass;
use Illuminate\Notifications\Notifiable;
use Atom26\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['info', 'roles', 'sports'];

    /**
     * Get the user's bio.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function info()
    {
        return $this->hasOne(UserInfo::class);
    }

    /**
     * Get user's roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get user's attended sports
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sports()
    {
        return $this->belongsToMany(Sport::class);
    }

    public function internetPass()
    {
        return $this->hasOne(InternetPass::class);
    }

    /**
     * Get user's department
     * 
     * @return \Atom26\Accounts\Department
     */
    public function department()
    {
        return $this->info->department;
    }

    /**
     * Get user's university
     * 
     * @return \Atom26\Accounts\University
     */
    public function university()
    {
        return $this->info->university;
    }

    /**
     * Get user's type.
     * 
     * @return \Atom26\Accounts\UserType
     */
    public function type()
    {
        return $this->info->type;
    }

    /**
     * Check if user has specific role
     *
     * @param  string  $rolename
     * @return boolean
     */
    public function hasRole($rolename)
    {
        if ($this->isAdmin()) {
            return true;
        }
        
        return $this->roles->contains(function ($role) use ($rolename) {
            return $role->name == $rolename;
        });
    }

    /**
     * Check if user is admin
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->roles->contains(function ($role) {
            return $role->name == 'admin';
        });
    }

    /**
     * Check if user is host
     * 
     * @return boolean
     */
    public function isHost()
    {
        $hostType = collect(['A', 'B', 'Bo', 'E']);

        return $hostType->contains(function ($value) {
            return $this->type()->code == $value;
        });
    }

    /**
     * Check if user is athlete.
     *
     * @return bool
     */
    public function isAthlete()
    {
        return $this->sports->count() > 0;
    }

    /**
     * Check if the user is own the specific model
     *
     * @param  mixed    $model  Any Eloquent model
     * @return boolean
     */
    public function own($model)
    {
        return $model->own();
    }

    /**
     * Attach sports to user
     * 
     * @param mixed $sport
     * @return void
     */
    public function addSports($sport)
    {
        $this->sports()->attach($sport);
    }

    /**
     * Detach sports from user
     * 
     * @param mixed $sport
     * @return void
     */
    public function removeSports($sport)
    {
        $this->sports()->detach($sport);
    }

    /**
     * Get user QRCode string.
     *    
     * @return String
     */
    public function getQRCode()
    {
        return $this->type()->code . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Get user fullname.
     *
     * @return string
     */
    public function fullname()
    {
        return $this->info->title . trim($this->info->firstname) . ' ' . $this->info->lastname;
    }

    /**
     * Get user's picture.
     *
     * @return mixed
     */
    public function pic()
    {
        return url('/'.$this->info->pic);
    }

    /**
     * Get user's ID Card URL.
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function idCard()
    {
        return url('/files/card/uni_' . $this->university()->id . '/card_' . $this->getQRCode() . '.png');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, $this));
    }
}
