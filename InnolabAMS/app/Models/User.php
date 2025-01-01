<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\AdmissionOfficer; // Add this import

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is an admission officer
     */
    public function isAdmissionOfficer()
    {
        return $this->role === 'admission_officer' && $this->admissionOfficer()->exists();
    }

    /**
     * Get the admission officer profile for this user
     */
    public function admissionOfficer()
    {
        return $this->hasOne(AdmissionOfficer::class);
    }

    public function hasEmailDomain($domain)
    {
        return substr(strrchr($this->email, "@"), 1) === $domain;
    }
}
