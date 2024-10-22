<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'name_table';
    protected $fillable = [
        'user_id', 
        'patient_id', 
        'number_from', '
        number_to', 
        'direction', 
        'message_text'];
    public function patient()
        {
            return $this->belongsTo(Patient::class);
        }
        
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
