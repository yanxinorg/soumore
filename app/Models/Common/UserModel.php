<?php

namespace App\Models\Common;

use App\RoleUser;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class UserModel extends Model
{
	use EntrustUserTrait;
    use Searchable;
	protected $table = 'users';
	public $timestamps = TRUE;
	protected $fillable = ['uid','name', 'email','password','avator','latest_login_time','latest_login_ip','latest_logout_time'];

    //返回特定内容
    public function toSearchableArray()
    {
        #_ Read Data & Filter Field
        $Arr_Users = array_only($this -> toArray(), ['name','email','status']);
        #_ Back to Scout
        return $Arr_Users;
    }
    //该用户所拥有的角色
    public function roleLists()
    {
        return $this->hasMany(RoleUser::class,'user_id','id','status');
    }

}
