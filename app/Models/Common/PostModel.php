<?php
namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostModel extends Model
{
	protected $table = 'posts';
	public $timestamps = TRUE;
	protected $fillable = ['user_id','cate_id','title','excerpt','content','thumb','thumb_small','status','mime'];
	
	// 	关联多个标签
	public function belongsTags()
	{
		return $this->belongsToMany('App\Models\Common\TagModel', 'post_tag', 'posts_id', 'tags_id');
	}
	
	public function getCreatedAtAttribute($date)
	{
		if (Carbon::now() < Carbon::parse($date)->addDays(10))
		{
			return Carbon::parse($date);
		}
		return Carbon::parse($date)->diffForHumans();
	}
	
	
	protected static function select()
	{
		$datas = DB::table('posts')
		->join('users', 'posts.user_id', '=', 'users.id')
		->select('posts.id as post_id',
				'posts.title as title',
				'users.name as author',
				'users.id as user_id',
				'posts.excerpt as excerpt',
				'posts.content as content',
				'posts.thumb as thumb',
				'posts.created_at as created_at',
				'posts.comments as countcomment',
				'posts.status as status'
				);
		return $datas;
				
	}
	//文章列表
	public static function lists($user_id = "",$status = "-1",$cateid = "")
	{
		if(!empty($user_id))
		{
			if(!empty($cateid))
			{
				$datas = self::select();
				return $datas->where([
						'posts.user_id'=>$user_id,
						'posts.status'=>$status,
						'posts.cate_id'=>$cateid
				])->orderBy('posts.created_at','desc')->paginate('15');
			}
			if($status >= 0 )
			{
				$datas = self::select();
				return $datas->where([
					'posts.user_id'=>$user_id,
					'posts.status'=>$status
				])->orderBy('posts.created_at','desc')->paginate('15');
			}
			$datas = self::select();
			return $datas->where('posts.user_id','=',$user_id)->orderBy('posts.created_at','desc')->paginate('15');
		}else{
			$datas = self::select();
			return $datas->where('posts.status','=','1')->orderBy('posts.created_at','desc')->paginate('15');
		}
		
	}
	
	//分类文章刷选
	public static function cateArticle($status = "1",$cateid)
	{
		
		$datas = self::select();
		return $datas->where([
				'posts.status'=>$status,
				'posts.cate_id'=>$cateid
		])->orderBy('posts.created_at','desc')->paginate('15');
			
	}
	
	
}
