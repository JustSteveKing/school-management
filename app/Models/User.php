<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Identity\Role;
use Carbon\CarbonInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property Role $role
 * @property string $email
 * @property string $password
 * @property null|string $remember_token
 * @property null|CarbonInterface $email_verified_at
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property null|CarbonInterface $deleted_at
 * @property Collection<PersonalAccessToken> $tokens
 */
final class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasUlids;
    use Notifiable;
    use SoftDeletes;

    /**
     * @var array<int,string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'role',
        'email',
        'password',
        'remember_token',
        'email_verified_at',
    ];

    /**
     * @var array<int,string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array<string,string|class-string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => Role::class,
    ];
}
