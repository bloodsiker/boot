<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteService extends Model
{
    /**
     * @var string
     */
    protected $table = 'favorite_service_center';

    protected $fillable = ['user_id', 'service_center_id'];

    public $timestamps = false;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsToMany('App\Models\Users');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function service_center()
    {
        return $this->belongsToMany('App\Models\ServiceCenter');
    }


    /**
     * Check favorite service center
     * @param $id
     * @param $user_id
     * @return int
     */
    public static function isFavorite($id, $user_id)
    {
        $count = parent::where('service_center_id', $id)
            ->where('user_id', $user_id)->get()->count();
        if($count > 0){
            return 1;
        }
        return 0;
    }
}
