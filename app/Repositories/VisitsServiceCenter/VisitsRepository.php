<?php

namespace App\Repositories\VisitsServiceCenter;

use App\Models\ServiceCenter;
use App\Models\ServiceVisit;
use App\Models\Visit;
use Carbon\Carbon;

class VisitsRepository implements VisitsRepositoryInterface
{

    /**
     * @param $id
     */
    public function addVisits($id)
    {
        $sc = ServiceCenter::find($id);

        $visitor_ip = $_SERVER['REMOTE_ADDR'];
        $date = Carbon::now()->format('Y-m-d');

        // Проверяем, есть ли посещение за сегодня
        $res = Visit::where('date_view', $date)->where('service_center_id', $sc->id)->count();
        // Если сегодня еще не было посещений
        if($res == 0){
            // Очищаем таблицу ips
            //DB::table('ips_visits')->delete();
            // Заносим в базу IP-адрес текущего посетителя
            Visit::create([
                'service_center_id' => $sc->id,
                'ip_address' => $visitor_ip,
                'date_view' => $date
            ]);
            // Заносим в базу дату посещения и устанавливаем кол-во просмотров и уник. посещений в значение 1
            ServiceVisit::create([
                'service_center_id' => $sc->id,
                'hosts' => 1,
                'views' => 1,
                'date_view' => $date
            ]);
            // Если посещения сегодня уже были
        } else {
            // Проверяем, есть ли уже в базе IP-адрес, с которого происходит обращение
            $res = Visit::where('date_view', $date)->where('service_center_id', $sc->id)->where('ip_address', $visitor_ip)->count();
            // Если такой IP-адрес уже сегодня был (т.е. это не уникальный посетитель)
            if($res > 0){
                //Добавляем для текущей даты +1 просмотр (хит)
                $sc = ServiceVisit::where('date_view', $date)->where('service_center_id', $sc->id)->orderBy('id', 'desc')->first();
                $sc->increment('views', 1);

                // Если сегодня такого IP-адреса еще не было (т.е. это уникальный посетитель)
            } else {
                // Заносим в базу IP-адрес этого посетителя
                Visit::create([
                    'service_center_id' => $sc->id,
                    'ip_address' => $visitor_ip,
                    'date_view' => $date
                ]);

                // Добавляем в базу +1 уникального посетителя (хост) и +1 просмотр (хит)
                $sc = ServiceVisit::where('date_view', $date)->where('service_center_id', $sc->id)->orderBy('id', 'desc')->first();
                $sc->increment('views', 1);
                $sc->increment('hosts', 1);
            }
        }
    }


    /**
     * @param $id
     * @return mixed
     */
    public function allVisits($id)
    {
        return ServiceVisit::where('service_center_id', $id)->get()->toArray();
    }

    /**
     * @param $id
     * @param $start
     * @param $end
     * @return mixed
     */
    public function visitsBetween($id, $start, $end)
    {
        return ServiceVisit::whereBetween('date_view', [$start, $end])->where('service_center_id', $id)->get()->toArray();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function allSumVisits($id)
    {
        return ServiceVisit::where('service_center_id', $id)->sum('views');
    }


    /**
     * @param $id
     * @return mixed
     */
    public function allSumHosts($id)
    {
        return ServiceVisit::where('service_center_id', $id)->sum('hosts');
    }
}