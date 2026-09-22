<?php

namespace App\Models;

use App\Enums\ComplaintStatus;
use Database\Factories\ComplaintFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $tenant_id
 * @property int $resident_id
 * @property string $category
 * @property string $title
 * @property string $description
 * @property ComplaintStatus $status
 * @property string|null $attachment_path
 * @property string|null $admin_response
 * @property int|null $responded_by
 * @property Carbon|null $responded_at
 */
#[Fillable(['category', 'title', 'description'])]
class Complaint extends Model
{
    /** @use HasFactory<ComplaintFactory> */
    use HasFactory;

    /** @var array<string, string> */
    public const CATEGORIES = [
        'keamanan' => 'Keamanan',
        'kebersihan' => 'Kebersihan',
        'fasilitas' => 'Fasilitas',
        'lingkungan' => 'Lingkungan',
        'administrasi' => 'Administrasi',
        'lainnya' => 'Lainnya',
    ];

    public function categoryLabel(): string
    {
        return self::CATEGORIES[$this->category] ?? $this->category;
    }

    protected function casts(): array
    {
        return [
            'status' => ComplaintStatus::class,
            'responded_at' => 'datetime',
        ];
    }

    /** @return BelongsTo<Tenant, $this> */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /** @return BelongsTo<Resident, $this> */
    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class);
    }

    /** @return BelongsTo<User, $this> */
    public function responder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responded_by');
    }
}
