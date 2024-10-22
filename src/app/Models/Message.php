<?php 
class Message extends Model
{
    use HasFactory;
    protected $fillable = ['message'];

    //Add the below function
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}