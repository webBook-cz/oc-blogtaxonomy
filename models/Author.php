<?php namespace Webbook\BlogTaxonomy\Models;

use Model;

/**
 * Model
 */
class Author extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'webbook_blogtaxonomy_authors';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
        'surname' => 'required',
        'mail' => 'email',
        'function' => 'required',
    ];

    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = [
        'function',
        'description',
    ];

    public function getFullNameAttribute($value){
        return $value->name . ' ' . $value->surname;
    }
}
