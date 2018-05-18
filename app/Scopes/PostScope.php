<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 15:01
 */

namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PostScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        return $builder->where('status', '=', '1');
    }
}