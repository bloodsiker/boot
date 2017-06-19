<?php

namespace App\Http\Controllers;

use App\Models\ServiceCenter;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function load()
    {
        $path = storage_path() . "/json/brands.json"; // ie: /var/www/laravel/app/storage/json/filename.json
        if (!File::exists($path)) {
            throw new Exception("Invalid File");
        }

        $file = File::get($path); // string
        //$json = json_decode($file);
        dd($file);
//        foreach ($file as $value){
//            DB::table('manufacturers')->insert(
//                [
//                    'address' => $street->address,
//                    'c1' => $street->c1,
//                    'c2' => $street->c2,
//                    'city_id' => 1
//                ]
//            );
//        }
        return true;
    }

    public function excel()
    {
        $path = storage_path() . "/excel/center-7.xlsx"; // ie: /var/www/laravel/app/storage/json/filename.json
        if (!File::exists($path)) {
            throw new Exception("Invalid File");
        }

//        $data = Excel::load($path, function($reader) {
//
//        })->get();
        if(!empty($data) && $data->count()){
            $i = 0;
            foreach ($data->toArray() as $value) {

                $user_id = 2;
                if(!empty($value['e_mail'])){
                    $user = User::where('email', $value['e_mail'])->first();
                    if($user){
                        $user_id = $user->id;
                    } else {
                        $user = new User();
                        $user->name = $value['e_mail'];
                        $user->email = $value['e_mail'];
                        $user->password = bcrypt($value['e_mail']);
                        $user->role_id = 2;
                        $user->save();
                        $user_id = $user->id;
                    }
                } else {
                    $user = new User();
                    $user->name = $value['nazvanie'];
                    $user->email = str_slug($value['nazvanie']) . '@example.ua';
                    $user->password = bcrypt($user->email);
                    $user->role_id = 2;
                    $user->save();
                    $user_id = $user->id;
                }


                /**
                 * Create Service Center
                 */
                $address = explode(',', $value['adres_yandex']);
                $insert[$i]['service_center'] = [
                    'service_name' => $value['nazvanie'],
                    'user_id' => $user_id,
                    'city_id' => 1,
                    'address' => $value['adres_yandex'],
                    'site' => $value['sayt'],
                    'street' => trim($address[2]),
                    'number_h' => (string)$value['number_h'],
                    'number_h_add' => $value['number_h_add'],
                    'c1' => $value['dolgota'],
                    'c2' => $value['shirota'],
                    'logo' => '/site/img/logo_boot.png',
                    'created_at' => Carbon::now(),
                ];
                $sc = new ServiceCenter();
                $sc->service_name = $value['nazvanie'];
                $sc->user_id = $user_id;
                $sc->city_id = 1;
                $sc->address = $value['adres_yandex'];
                $sc->site = $value['sayt'];
                $sc->street = trim($address[2]);
                $sc->number_h = (string)$value['number_h'];
                $sc->number_h_add = $value['number_h_add'];
                $sc->c1 = $value['dolgota'];
                $sc->c2 = $value['shirota'];
                $sc->logo = '/site/img/logo_boot.png';
                $sc->created_at = Carbon::now();
                $sc->save();


                /**
                 * Phone service center
                 */
                $phones = explode(',', $value['telefony']);
                $service_phone = [];
                $m = 0;
                foreach ($phones as $phone){
                    $service_phone[$m]['service_center_id'] = 1;
                    $service_phone[$m]['phone'] = trim($phone);
                    DB::table('service_center_phone')->insert([
                        'service_center_id' => $sc->id,
                        'phone' => trim($phone)
                    ]);
                    $m++;

                }
                $insert[$i]['service_center_phone'] = $service_phone;


                /**
                 * Working days service center
                 */
                $insert[$i]['service_working_days'] = [
                    [
                        'service_center_id' => $sc->id,
                        'title' => 'ПН',
                        'start_time' => (!empty($value['pn'])) ? Carbon::parse($value['pn'])->format('H:i') : null,
                        'end_time' => (!empty($value['pn2'])) ? Carbon::parse($value['pn2'])->format('H:i') : null,
                        'weekend' => (!empty($value['pn']) && !empty($value['pn2'])) ? 0 : 1
                    ],
                    [
                        'service_center_id' => $sc->id,
                        'title' => 'ВТ',
                        'start_time' => (!empty($value['vt'])) ? Carbon::parse($value['vt'])->format('H:i') : null,
                        'end_time' => (!empty($value['vt2'])) ? Carbon::parse($value['vt2'])->format('H:i') : null,
                        'weekend' => (!empty($value['vt']) && !empty($value['vt2'])) ? 0 : 1
                    ],
                    [
                        'service_center_id' => $sc->id,
                        'title' => 'СР',
                        'start_time' => (!empty($value['sr'])) ? Carbon::parse($value['sr'])->format('H:i') : null,
                        'end_time' => (!empty($value['sr2'])) ? Carbon::parse($value['sr2'])->format('H:i') : null,
                        'weekend' => (!empty($value['sr']) && !empty($value['sr2'])) ? 0 : 1
                    ],
                    [
                        'service_center_id' => $sc->id,
                        'title' => 'ЧТ',
                        'start_time' => (!empty($value['cht'])) ? Carbon::parse($value['cht'])->format('H:i') : null,
                        'end_time' => (!empty($value['cht2'])) ? Carbon::parse($value['cht2'])->format('H:i') : null,
                        'weekend' => (!empty($value['cht']) && !empty($value['cht2'])) ? 0 : 1
                    ],
                    [
                        'service_center_id' => $sc->id,
                        'title' => 'ПТ',
                        'start_time' => (!empty($value['pt'])) ? Carbon::parse($value['pt'])->format('H:i') : null,
                        'end_time' => (!empty($value['pt2'])) ? Carbon::parse($value['pt2'])->format('H:i') : null,
                        'weekend' => (!empty($value['pt']) && !empty($value['pt2'])) ? 0 : 1
                    ],
                    [
                        'service_center_id' => $sc->id,
                        'title' => 'СБ',
                        'start_time' => (!empty($value['sb'])) ? Carbon::parse($value['sb'])->format('H:i') : null,
                        'end_time' => (!empty($value['sb2'])) ? Carbon::parse($value['sb2'])->format('H:i') : null,
                        'weekend' => (!empty($value['sb']) && !empty($value['sb2'])) ? 0 : 1
                    ],
                    [
                        'service_center_id' => $sc->id,
                        'title' => 'НД',
                        'start_time' => (!empty($value['nd'])) ? Carbon::parse($value['nd'])->format('H:i') : null,
                        'end_time' => (!empty($value['nd2'])) ? Carbon::parse($value['nd2'])->format('H:i') : null,
                        'weekend' => (!empty($value['nd']) && !empty($value['nd2'])) ? 0 : 1
                    ],
                ];
                foreach ($insert[$i]['service_working_days'] as $work){
                    DB::table('service_working_days')->insert($work);
                }


                /**
                 * Manufacturer service center
                 */
                if($value['marki_telefonov'] == 'all'){
                    $all = DB::table('manufacturers')->select('id')->get();
                    $service_manufacturer = [];
                    $t = 0;
                    foreach ($all as $manufacture){
                        $service_manufacturer[$t]['service_center_id'] = $sc->id;
                        $service_manufacturer[$t]['manufacturer_id'] = $manufacture->id;
                        DB::table('service_center_vs_manufacturer')->insert([
                            'service_center_id' => $sc->id,
                            'manufacturer_id' => $manufacture->id
                        ]);
                        $t++;
                    }
                } else {
                    $manufacturer = explode(',', $value['marki_telefonov']);
                    $service_manufacturer = [];
                    $n = 0;
                    foreach ($manufacturer as $manufacture){
                        $id = DB::table('manufacturers')->select('id')->where('manufacturer', trim($manufacture))->first();
                        //$id = Manufacturer::where('manufacturer', $manufacture)->select('id')->first();
                        if($id){
                            $service_manufacturer[$n]['service_center_id'] = $sc->id;
                            $service_manufacturer[$n]['manufacturer_id'] = $id->id;
                            DB::table('service_center_vs_manufacturer')->insert([
                                'service_center_id' => $sc->id,
                                'manufacturer_id' => $id->id
                            ]);
                        }
                        $n++;
                    }
                }
                $insert[$i]['service_center_vs_manufacturer'] = $service_manufacturer;


                /**
                 * Advantages service center
                 */
                if(!empty($value['preimushchestva'])){
                    DB::table('service_center_advantages')->insert([
                        'service_center_id' => $sc->id,
                        'advantages' => trim($value['preimushchestva'])
                    ]);
                    $insert[$i]['service_center_vs_manufacturer'] = $value['preimushchestva'];
                }

                $i++;
            }
            dd($insert);
        }
    }
}
