<?php

namespace App\Http\Controllers;


use App\Constant;
use App\Repositories\DeviceRepository;
use Faker\Core\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Device;
use Illuminate\Notifications\Notifiable;
use App\Services\Purchase\GooglePurchase;
use App\Services\Purchase\ApplePurchase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Services;
use Mockery;

class DeviceController extends Controller
{
    use HasFactory, Notifiable, HasApiTokens;

    private $deviceRepository;

    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    public function index()
    {
        return Device::all();
    }

    public function register(Request $request)
    {
        $fields = $request->validate([
            'uid'=> 'required|string',
            'appId'=> 'required|string',
            'os'=> 'required|string|in:'.implode(',', Constant::allowedOS),
            'language'=> 'required|string'
        ]);

        $device = $this->deviceRepository->getDevicebyUid($fields['uid']);
        if (is_null($device)){ //uid kayıtlı değil yeni device kaydedilecek.
            $device = Device::create([
                'uid'=> $fields['uid'],
                'appId'=> $fields['appId'],
                'os'=> $fields['os'],
                'language'=> $fields['language'],
                'status'=> 1
            ]);
        } else {
            $device->tokens()->delete();
        }

        $token = $device->createToken($fields['uid'])->plainTextToken;

        $response = [
            'client-token'=> $token
        ];

        return response($response, 201);
    }


    public function purchase(Request $request)
    {
        $id = auth()->user()->id;
        $device = $this->deviceRepository->showDevice($id);

        $fields = $request->validate([
            'receipt'=> 'required|string'
        ]);

        if($device->os == Constant::ANDROID_OS_KEY){
            $result = app(GooglePurchase::class)->send($request->toArray());
        } elseif ($device->os == Constant::IOS_OS_KEY){
            $result = app(ApplePurchase::class)->send($request->toArray());
        }

        $response = [
            'status'=> 'error'
        ];

        $data['receipt'] = $fields['receipt'];
        if (isset($result['status']) && $result['status']){
            $data['purchase_date'] = date('Y-m-d H:i:s');
            $data['expire_date'] = $result['expire_date'];
            $data['status'] = 1;
            $response = [
                'status'=> 'success',
                'expire_date' => $result['expire_date']
            ];
        }

        $device->update($data);

        return response($response, 200);
    }

    public function checkSucscription(Request $request)
    {
        $id = auth()->user()->id;
        $device = $this->deviceRepository->showDevice($id);

        $response = [
            'status'=> 'success',
            'appId' => $device->appId,
            'purchase_date' => $device->purchase_date,
            'expire_date' => $device->expire_date
        ];

        return response($response, 200);
    }
}
