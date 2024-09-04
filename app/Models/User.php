<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Scolarite;
use App\Models\RequestPayment;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = ['profile_photo_url'];

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function scolarite()
    {
        return $this->hasMany(Scolarite::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function request_payment()
    {
        return $this->hasMany(RequestPayment::class);
    }

    public function teacher()
    {
        return $this->hasMany(Teacher::class);
    }

    public static function log($message)
    {
        $user = Auth::user();
        $filename = $user->name . '.txt';
        $content = '[' . now() . '] ' . $message . "\n";

        Storage::append('user_logs/' . $filename, $content);
    }
}
