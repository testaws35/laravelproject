<?php
namespace App;
// classname - HelpComment.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the HelpComment table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;
class HelpComment extends Model
{
    protected $table = 'help_comments';
    protected $fillable = ['Description','parent_id'];
    protected $primaryKey = 'HelpCommentsID';


   //one comment belongsto one user
   public function user()
   {
       return $this->belongsTo(User::class);
   }
   
   //one comment belongsto one Post
   public function post()
   {
       return $this->belongsTo(HelpPost::class);
   }
}
