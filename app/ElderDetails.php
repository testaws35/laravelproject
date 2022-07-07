<?php
namespace App;

// classname - ElderDetails.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the ElderDetails table  
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;

class ElderDetails extends Model
{
    public $table = 'elder_details';
    public $fillable = ['UserID','Status','CreatedOn','Createdby','Num_Queries_Answered'];
    protected $primaryKey = 'ElderID';

    protected $dates = ['CreatedOn'];
    public $timestamps = false;
}
