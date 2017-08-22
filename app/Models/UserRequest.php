<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRequest
 * @package App\Models
 */
class UserRequest extends Model
{

    protected $table = 'requests';

    protected $fillable = ['user_name', 'phone', 'comment', 'operator_comment', 'status'];


    /**
     * @param $status
     * @return string
     */
    public static function colorStatusHelpRequest($status)
    {
        switch ($status)
        {
            case 'Новая':
                return 'in_work';
                break;
            case 'Закрыта':
                return 'expect';
                break;
            case 'Не отвечает':
                return 'pend';
                break;
            default:
                return 'expect';
        }
    }
}
