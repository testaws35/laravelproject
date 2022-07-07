<?php
namespace App;
// classname - Comment.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the Comments table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['user_id','parent_id','Comment_Body','created_at','Status'];
    protected $primaryKey = 'id';
    protected $dates = ['created_at'];
    public $timestamps = false;

   //one comment belongs to one user
   public function user()
   {
       return $this->belongsTo(User::class);
   }
   
   //one comment belongsto one Post
   public function post()
   {
       return $this->belongsTo(Post::class);
   }
}
