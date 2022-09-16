<?php

namespace App\Models;

use App\Helpers\APIHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $rules = [
        "drop_list" => 'in:{list}',
        "url"       => 'url',
        "number"    => 'numeric',
        "date"      => 'date_format:d/m/Y',
        "y_n"       => 'in:y,n',
        "table"     => 'array', // array of objects, every object is a row with the keys in the data->rows
        "textarea"  => 'string',
        "checkbox"  => 'boolean'
    ];

    public function __construct(array $attributes = [])
    {
        $this->makeHidden(APIHelper::getLangFrom('name'));
        parent::__construct($attributes);
    }

    protected $guarded = [];
    protected $appends = ['name'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'data'  =>  'array'
    ];

    public function posts()
    {
        return $this->hasMany(BlogPost::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function productRequests()
    {
        return $this->hasMany(ProductRequest::class);
    }

    public function getNameAttribute()
    {
        return $this->{'name_'.\App::getLocale()};
    }

    protected function getRule($name, bool $is_required=false, $data=[])
    {
        $rule = ($is_required?'required|':'').$this->rules[$name];

        if (isset($data['list']))
            $rule=str_replace('{list}', $data['list'], $rule);
        if (isset($data['min']))
            $rule.='|min:'.$data['min'];
        if (isset($data['max']))
            $rule.='|max:'.$data['max'];
        if (isset($data['start']) && $data['start']!=="")
            $rule.='|after:'.date('d/m/Y',strtotime($data['start']));
        if (isset($data['end']) && $data['end']!=="")
            $rule.='|before:'.date('d/m/Y',strtotime($data['end']));

        return $rule;
    }
    public function validateData($required=true)
    {
        collect($this->data)->each(function ($page) use (&$rules, $required){
            collect($page['divs'])->each(function ($div) use (&$rules, $required){
                collect($div['fields'])->each(function ($field) use (&$rules, $required){
                    $name=$field['name'];
                    $data=$field['data']??[];
                    if (($type=$field['type'])==='table')
                        collect($field['data']['cols'])->each(function ($col) use (&$rules, $field, $name, $required){
                            collect($field['data']['rows'])->splice(1)->each(function ($row) use (&$rules, $col, $name, $required){
                                $rules[$name.'.'.$col.'.'.$row] = ($required)?'required':'';
                            });
                        });
                    elseif ($type==='drop_list')
                        $data=["list" => implode(',',array_keys($data))];
                    elseif ($type==='assets'||$type==='links'||strtolower($field['placeholder'])==='price')
                        return;
                    $rules[$name]=$this->getRule($type,$required, $data);
                });
            });
        });
        return $rules;
    }
    public function bindValues($data)
    {
        collect($this->data)->each(function ($page) use (&$r,$data) {
            collect($page['divs'])->each(function ($div) use (&$r, $data) {
                collect($div['fields'])->each(function ($field) use (&$r, $data) {
                    if (($type=$field['type'])==='assets'||$type==='links'||strtolower($field['placeholder'])==='price')
                        return;
                    elseif (isset($data[$field['name']]))
                        $field['value']=$data[$field['name']];
                    else $field['value']=null;
                    $r[] = $field;
                });
            });
        });
        return $r;
    }
}
