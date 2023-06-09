<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $guard = 'course';


    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function pakar()
    {
        return $this->belongsTo(Pakar::class);
    }
    // untuk menampilkan gambar
    // public function getThumbnailUrlAttribute()
    // {
    //     return asset('storage/thumbnail/' . $this->thumbnail);
    // }

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function detailpembayaran()
    {
        return $this->hasMany(DetailPembayaran::class);
    }
}
