<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public function serviceCenter()
    {
        return $this->belongsTo('App\Models\ServiceCenter');
    }

    /**
     * Рейтинг для внутреней страницы сервисного центра
     * @param $id
     * @param $type || all or total
     * @return array
     */
    public static function rating($id, $type = 'all')
    {
        $rating = parent::where([['service_center_id', $id],['status', '=', '1']])->select('r_total_rating', 'r_quality_of_work', 'r_deadlines', 'r_compliance_cost', 'r_price_quality', 'r_service')->get();
        if(count($rating) > 0){
            $i = 0;
            $r_total_rating = 0;
            $r_quality_of_work = 0;
            $r_deadlines = 0;
            $r_compliance_cost = 0;
            $r_price_quality = 0;
            $r_service = 0;
            $count = count($rating);
            $array_sum = [];
            foreach($rating as $item => $val){
                $r_total_rating += $val['r_total_rating'];
                $r_quality_of_work += $val['r_quality_of_work'] / count($val['r_quality_of_work']);
                $r_deadlines += $val['r_deadlines'] / count($val['r_deadlines']);
                $r_compliance_cost += $val['r_compliance_cost'] / count($val['r_compliance_cost']);
                $r_price_quality += $val['r_price_quality'] / count($val['r_price_quality']);
                $r_service += $val['r_service'] / count($val['r_service']);

                $array_sum = [
                    'r_total_rating' => round($r_total_rating / $count, 0),
                    'r_quality_of_work' => round($r_quality_of_work / $count, 0),
                    'r_deadlines' => round($r_deadlines / $count, 0),
                    'r_compliance_cost' => round($r_compliance_cost / $count, 0),
                    'r_price_quality' => round($r_price_quality / $count, 0),
                    'r_service' => round($r_service / $count, 0),
                ];
                $i++;
            }
            if($type == 'total'){
                return $array_sum['r_total_rating'];
            }
            return $array_sum;
        }
        return 0;
    }

    /**
     * Рейтинг для внутреней страницы сервисного центра
     * @param $id
     * @param string $type
     * @return mixed
     */
//     public static function rating($id, $type = 'all')
//    {
//        $rating = parent::where([['service_center_id', $id],['status', '=', '1']])
//            ->select(DB::raw('
//                    AVG(r_total_rating) as total_rating,
//                    AVG(r_quality_of_work) as quality_of_work,
//                    AVG(r_deadlines) as deadlines,
//                    AVG(r_compliance_cost) as compliance_cost,
//                    AVG(r_price_quality) as price_quality,
//                    AVG(r_service) as service
//                    '))
//            ->groupBy('service_center_id')
//            ->get();
//
//        if($type == 'total'){
//            return $rating['r_total_rating'];
//        }
//        return $rating;
//    }

    /**
     * Кол-вл комментариев
     * @param $id
     * @return mixed
     */
    public static function count_comment($id)
    {
        $count = parent::where('service_center_id', $id)->get()->count();
        return $count;
    }
}
