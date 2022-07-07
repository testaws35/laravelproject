<?php
namespace App;
// classname - Invite.php
// author - Raveendra 
// release version - 1.0
// Description-  This Model represents the Invitation table
// created date - Nov 2019

use Illuminate\Database\Eloquent\Model;
class Invite extends Model
{
    protected $table = 'invites';
    protected $fillable = ['email', 'invitationid', 'Mobile_Number', 'Invitee_Name', 'Status', 'Invitedby'];
    protected $primaryKey = 'id';
}
