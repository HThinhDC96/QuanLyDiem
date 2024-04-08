<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanBo extends Model
{
    use HasFactory;

    protected $table = "canbo";
    protected $primaryKey = "macanbo";
    protected $fillable = [
        'macanbo',
        'matkhau',
        'hoten',
        'gioitinh',
        'ngaysinh',
        'diachi',
        'sdt',
        'loai'
    ];

    public $timestamps = false;
}
