<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';

    public $timestamps = false;

    protected $fillable = [
        'id',     'agent_id',       'nama_rumah',      'harga_rumah',     'featured',     'kategori',     'desain',    'image',
        'slug',     'kamar_tidur',      'kamar_mandi',     'kota',     'kota_slug',    'alamat',
        'jumlah_lantai',     'deskripsi',  'video',    'lokasi_strategis',
        
    ];

    public function features()
    {
        return $this->belongsToMany(Feature::class)->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'agent_id');
    }

    public function gallery()
    {
        return $this->hasMany(PropertyImageGallery::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, 'property_id');
    }

    public function NilaiAlternatif()
    {
        return $this->hasMany('App\NilaiAlternatif', 'property_id', 'id');
    }

    public function PembobotanAlternatif()
    {
        return $this->hasMany('App\PembobotanAlternatif', 'property_id', 'id');
    }

    public function Ranking()
    {
        return $this->hasOne('App\Ranking', 'property_id', 'id');
    }

}
