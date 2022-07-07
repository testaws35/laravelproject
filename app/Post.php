<?php
namespace App;
// classname - Post.php
// author - Raveendra 
// release version - 1.0
// Description-  This model represents the FAQ Posts table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'faq_posts';
    protected $fillable = ['FAQ_Title','FAQ_Body','FAQ_UserID','FAQ_CreatedDate','FAQ_IsActive','FAQ_Photo','created_at'];
    protected $primaryKey = 'FAQ_PostID';
    protected $dates = ['FAQ_CreatedDate'];
    public $timestamps = false;

	// One post belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
	
	// One post hasmany Comments- we need to mention the foreign key
    public function comments()
    {
        return $this->hasMany(Comment::class,'parent_id');
    } 
}
