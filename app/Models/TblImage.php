<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblImage extends Model
{
    protected $table = 'tbl_images';
    protected $primaryKey = 'imageId';
    public $timestamps = false;

    protected $fillable = ['tourId', 'imageURL', 'description', 'uploadDate'];

    public function tour() {
        return $this->belongsTo(TblTour::class, 'tourId', 'tourId');
    }
}
