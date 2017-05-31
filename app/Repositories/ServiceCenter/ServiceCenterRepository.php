<?php

namespace App\Repositories\ServiceCenter;

use App\Models\Comments;
use App\Models\ServiceCenter;
use App\Models\UserRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ServiceCenterRepository implements ServiceCenterRepositoryInterface
{

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllServiceCenter()
    {
        $service_center = ServiceCenter::all();
        $service_center->load('work_days', 'city', 'metro', 'district', 'tags', 'manufacturers');
        $service_center->map(function ($comment) {
            $comment['comments'] = Comments::count_comment($comment->id);
            return $comment;
        });
        $service_center->map(function ($rating) {
            $total_rating = Comments::rating($rating->id, 'total');
            $rating['rating'] = $total_rating;
            return $rating;
        });

        return $service_center;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $service_center = ServiceCenter::find($id);
        $service_center->load('work_days', 'city', 'metro', 'district', 'tags', 'manufacturers', 'advantages', 'price', 'personal', 'service_photo');
        $service_center['count_clients'] = UserRequest::count_request($id);
        $service_center['total_rating'] = Comments::rating($id, 'total');
        $service_center['total_comments'] = Comments::count_comment($id);
        return $service_center;
    }

    /**
     * @param $requestData
     * @return mixed
     */
    public function addServiceCenter($requestData)
    {
        $sc = new ServiceCenter();
        $sc->service_name = $requestData->name;
        $sc->user_id = Auth::id();
        $sc->city_id = $requestData->city;
        $sc->metro_id = $requestData->metro;
        $sc->district_id = $requestData->district;
        $sc->street = $requestData->street;
        $sc->c1 = $requestData->c1;
        $sc->c2 = $requestData->c2;
        $sc->created_at = Carbon::now();
        $sc->save();
        return $sc->id;
    }


    /**
     * @param $requestData
     * @param $id
     * @return string
     */
    public function addLogo($requestData, $id)
    {
        $sc = ServiceCenter::find($id);

        $file = $requestData->logo['base64'];
        $img_name = $sc->service_name . '-' . $requestData->logo['filename'];
        Storage::makeDirectory('/sc_uploads/logo/' . $sc->id);
        $path = "/sc_uploads/logo/{$sc->id}/";
        $path_img = $path . $img_name;
        Storage::disk('public')->put($path_img, base64_decode($file));

        Image::make(public_path() . $path_img)->resize(200, 100)->save(public_path() . $path_img);
        $sc->logo = $path_img;
        $sc->update();
        return $sc->logo;
    }



    /**
     * @param $requestData
     * @param $id
     * @return bool
     */
    public function updateServiceCenter($requestData, $id)
    {
        $sc = ServiceCenter::find($id);

        $sc->service_name = $requestData->service_name;
        $sc->about = $requestData->about;
        $sc->city_id = $requestData->city_id;
        $sc->metro_id = $requestData->metro_id;
        $sc->district_id = $requestData->district_id;
//        $sc->start_day = $requestData->start_day;
//        $sc->end_day = $requestData->end_day;
//        $sc->start_time = $requestData->start_time;
//        $sc->end_time = $requestData->end_time;
        $sc->address = 'Украина, ' . $requestData->city['city_name'] . ', ' . $requestData->street;
        $sc->street = $requestData->street;
        $sc->c1 = $requestData->c1;
        $sc->c2 = $requestData->c2;
        $sc->updated_at = Carbon::now();
        $sc->update();

        return true;
    }

    /**
     * График работы
     * @param $requestData
     * @param $id
     * @return bool
     */
    public function updateWorkingDays($requestData, $id)
    {
        $sc = ServiceCenter::find($id);

        DB::table('service_working_days')->where('service_center_id', '=', $sc->id)->delete();
        foreach ($requestData->work_days as $work_day){
            DB::table('service_working_days')->insert(
                [
                    'service_center_id' => $sc->id,
                    'title' => $work_day['title'],
                    'start_time' => $work_day['start_time'],
                    'end_time' => $work_day['end_time'],
                    'weekend' => $work_day['weekend']
                ]);
        }
        return true;
    }


    /**
     * Преимущества
     * @param $requestData
     * @param $id
     * @return bool
     */
    public function updateAdvantages($requestData, $id)
    {
        $sc = ServiceCenter::find($id);

        DB::table('service_center_advantages')->where('service_center_id', '=', $sc->id)->delete();
        foreach ($requestData->advantages as $advantage){
            DB::table('service_center_advantages')->insert(
                [
                    'service_center_id' => $sc->id,
                    'advantages' => $advantage['advantages']
                ]);
        }
        return true;
    }


    /**
     * Теги
     * @param $requestData
     * @param $id
     * @return bool
     */
    public function updateTags($requestData, $id)
    {
        $sc = ServiceCenter::find($id);

        DB::table('service_center_vs_tags')->where('service_center_id', '=', $sc->id)->delete();
        foreach ($requestData->tags as $tag){
            DB::table('service_center_vs_tags')->insert(
                [
                    'service_center_id' => $sc->id,
                    'tag' => $tag['tag']
                ]);
        }
        return true;
    }


    /**
     * Бренды
     * @param $requestData
     * @param $id
     * @return bool
     */
    public function updateManufacturer($requestData, $id)
    {
        $sc = ServiceCenter::find($id);

        DB::table('service_center_vs_manufacturer')->where('service_center_id', '=', $sc->id)->delete();
        foreach ($requestData->manufacturers as $manufacturer){
            DB::table('service_center_vs_manufacturer')->insert(
                [
                    'service_center_id' => $sc->id,
                    'manufacturer_id' => $manufacturer['id']
                ]);
        }
        return true;
    }


    /**
     * Update price
     * @param $requestData
     * @param $id
     * @return bool
     */
    public function updatePrice($requestData, $id)
    {
        $sc = ServiceCenter::find($id);

        DB::table('service_center_price')->where('service_center_id', '=', $sc->id)->delete();
        foreach ($requestData->price as $price){
            DB::table('service_center_price')->insert(
                [
                    'service_center_id' => $sc->id,
                    'title' => $price['title'],
                    'price' => $price['price']
                ]);
        }
        return true;
    }


    public function addPersonal($requestData, $id)
    {
        $sc = ServiceCenter::find($id);

        $file = $requestData->avatar['data']['base64'];
        $img_name = str_random() . '-' . $sc->service_name . ".jpg";
        Storage::makeDirectory('/sc_uploads/avatars/' . $sc->id);
        $path = "/sc_uploads/avatars/{$sc->id}/";
        $path_img = $path . $img_name;
        Storage::disk('public')->put($path_img, base64_decode($file));

        Image::make(public_path() . $path_img)->resize(300, 300)->save(public_path() . $path_img);

        $sc_personal = [
            'service_center_id' => $sc->id,
            'name' => $requestData->name,
            'work_exp' => $requestData->work_exp,
            'specialization' => $requestData->specialization,
            'info' => $requestData->info,
            'path' => $path,
            'avatar' => $img_name
        ];
        DB::table('service_center_personal')->insert($sc_personal);
        return $sc_personal;
    }


    /**
     * Delete personal from Service Center
     * @param $id
     * @param $id_person
     * @return bool
     */
    public function deletePersonal($id, $id_person)
    {
        $sc = ServiceCenter::find($id);

        DB::table('service_center_personal')
            ->where('service_center_id', '=', $sc->id)
            ->where('id', '=', $id_person)
            ->delete();
        return true;
    }


    public function addPhoto($requestData, $id)
    {
        $sc = ServiceCenter::find($id);

        $file = $requestData->photo['data']['base64'];

        $img_name = str_random() . '-' . $sc->service_name . ".jpg";
        $img_mini = 'mini-' . $img_name;
        Storage::makeDirectory("/sc_uploads/{$requestData->type}/{$sc->id}");
        $path = "/sc_uploads/{$requestData->type}/{$sc->id}/";
        $path_img = $path . $img_name;
        $path_mini = $path . $img_mini;
        Storage::disk('public')->put($path_img, base64_decode($file));
        Storage::disk('public')->put($path_mini, base64_decode($file));

        //Image::make(public_path() . $path_img)->resize(500, 500)->save(public_path() . $path_img);
        Image::make(public_path() . $path_mini)->resize(300, 200)->save(public_path() . $path_mini);

        $sc_photo = [
            'service_center_id' => $sc->id,
            'path' => $path,
            'file_name' => $img_name,
            'file_name_mini' => $img_mini,
            'type' => $requestData->type
        ];

        DB::table('service_center_photo')->insert($sc_photo);
        return $sc_photo;
    }


    /**
     * Delete photo from Service Center
     * @param $id
     * @param $id_photo
     * @return bool
     */
    public function deletePhoto($id, $id_photo)
    {
        $sc = ServiceCenter::find($id);

        DB::table('service_center_photo')
            ->where('service_center_id', '=', $sc->id)
            ->where('id', '=', $id_photo)
            ->delete();
        return true;
    }
}
