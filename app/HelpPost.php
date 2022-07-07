<?php
namespace App;
// classname - HelpPost.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the HelpPost table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;

class HelpPost extends Model
{
    protected $table = 'help_post';
    protected $fillable = ['Description','Type','Status','NumReplies','ClosedOn','user_id','Photo','CreatedOn 
    ','CreatedBy','UpdateOn','Updateby'];
    protected $primaryKey = 'HelpID';
    
    
    // this helps to explain the table relationship in Laravel framework so that schema is automatically 
	// created with foreign key constraint
	
	// One post belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
	
	// One post hasmany Comments- we need to mention the foreign key
    public function comments()
    {
        return $this->hasMany(HelpComment::class,'parent_id');
    }
}
