@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container mt-4">

            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h2>
                            QR Code Scanner
                        </h2>
                    </div>
                    <div class="card-body">
                        <!-- CAMERA Qr Code-->
                        <div class="float-right" style="width: 500px" id="reader"></div>
                    </div>
                    <div class="card-footer">
                        <label id="result"></label>
                        <input placeholder="Enter User ID" type="text" name="idNumber" id="idNumber" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control sm my-0 py-1" required autofocus>
                    </div>
                </div>
            </div>
            
            
            
            
            
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h2>Image Center QR Code</h2>
                        </div>
                        <div class="card-body">
                            <img src="data:image/png;base64, 
                            {!!base64_encode(QrCode::format('png')
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
                            ->generate('20150001'))!!}
                             ">

                        </div>
                    </div>
                </div>
    
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h2>PNG Format QR Code</h2>
                        </div>
                        <div class="card-body">
                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('Make me into an QrCode!')) !!} ">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h2>Simple QR Code</h2>
                        </div>
                        <div class="card-body">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h2>Color QR Code</h2>
                        </div>
                        <div class="card-body">
                            {!! QrCode::size(200)->color(255,0,0)->backgroundColor(255,255,255)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8') !!}
                        </div>
                    </div>
                </div>
    
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h2>Email QR Code</h2>
                        </div>
                        <div class="card-body">
                            {{$rq}}
                        </div>
                    </div>
            
                </div>
    
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h2>Message QR Code</h2>
                        </div>
                        <div class="card-body">
                            {{$msg}}
                        </div>
                    </div>
                </div>
            </div>
    
            
    
        </div>
        <!-- NEW CAM -->
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    
        <script type="text/javascript">
            let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    
            scanner.addListener('scan', function (content) 
            {
                document.getElementById('idNumber').value = content;
    
                $.ajax({
                url:"{{ route('scan.cam') }}",
                type: "POST",
                data:{code:content,
                    _token: '{{csrf_token()}}'
                    },
                });
            });
            
            Instascan.Camera.getCameras().then(function (cameras) 
            {
                if (cameras.length > 0) 
                {
                    scanner.start(cameras[0]);
                }
                else 
                {
                    console.error('No cameras found.');
                }
            }).catch(function (e) 
            {
                console.error(e);
            });
        </script>
        <script>
            function onScanSuccess(decodedText, decodedResult) {
            // Handle the scanned code as you like, for example:
            //console.log(`Code matched = ${decodedText}`, decodedResult);
            }
    
            const formatsToSupport = [
            Html5QrcodeSupportedFormats.QR_CODE,
            Html5QrcodeSupportedFormats.UPC_A,
            Html5QrcodeSupportedFormats.UPC_E,
            Html5QrcodeSupportedFormats.UPC_EAN_EXTENSION,
            ];
            const html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            {
            fps: 10,
            qrbox: { width: 250, height: 250 },
            formatsToSupport: formatsToSupport
            },
            /* verbose= */ false);
            html5QrcodeScanner.render(onScanSuccess);
            html5QrCode.clear();
        </script>
    </div>
</div>
@endsection
