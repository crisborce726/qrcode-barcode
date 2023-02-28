<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleSoftwareIO\QrCode\Generator;
use Illuminate\Support\Facades\Storage;
use App\Models\Code;
use Illuminate\Support\Facades\Validator;

class QrCodeController extends Controller
{
    public function index(Request $request)
    {
    
        date_default_timezone_set('Asia/Manila');
            
                $scanned = $request->get('idNumber');
            

                
                //Second parameter will save your QRCode in Public/qrcodes Directory

                //QrCode::format('png')->size(200)->color(255,0,0)->backgroundColor(255,255,255)->generate('Make me into a QrCode!', public_path('storage/qrcodes/qrcode.png'));

                //EyeColor (int $eyeNumber, int $innerRed, int $innerGreen, int $innerBlue, int $outterRed = 0, int $outterGreen = 0, int $outterBlue = 0)
                //style round, dot, square
                //QrCode::eye('circle'); // Uses the `circle` style eye.
                $QRCode = QrCode::eye('square')->style('dot')->eyeColor(0, 255, 90, 0, 255,0,0)->size(200)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8');
                $rq = QrCode::email('crisborce@gmail.com');

                //Creates a text message with the number and message filled in.
                $msg = QrCode::SMS('09065629055', 'Body of the message');


                $qrcode = new Generator;
                $QrW = $qrcode->size(500)->generate('Make a qrcode without Laravel!');


                $for = $qrcode->format('png')
                        ->eye('circle')//Eye Style
                        ->style('round', 0.5)//square, dot and round
                        ->eyeColor(0, 255, 90, 0, 255,0,0)//First Eye Color
                        ->eyeColor(2, 255, 90, 0, 60, 179, 113)//Third Eye Color
                        ->gradient(2,0,36,25,121,9,'radial')//Gradient $startRed, $startGreen, $startBlue, $endRed, $endGreen, $endBlue, string $type)
                        ->backgroundColor(255,255,255)//White background
                        ->size(200)//Size of the Image or QR Code
                        ->merge(public_path('storage/images/img.png'), 0.2, true)////Logo in the Center>Size  of the Logo>True
                        //This is to Generate the QR Code and The Content of the QR Code
                        ->encoding('UTF-8')
                        ->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8');

                    
                    //Storage::disk('local')->put('example.txt', 'Contents');
                    //Storage::disk('public')->put('qrcodes', $format, 'format.png');
                
                return view('qrcode', compact('QRCode', 'rq','msg', 'scanned', 'for'));
            
    }

    public function code(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);
        
        Code::create([
            'code' => $request->code,
        ]);

        

        return back();
    }

}
