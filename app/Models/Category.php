<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // codigo propio

    // especifica el nombre de la tabla en la base de datos
    protected $table = 'categories';

    // especifica los campos que se pueden llenar
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status'
    ];

    /**
     * Muestra todos los productos de la categoría
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
