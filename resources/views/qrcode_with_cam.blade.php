<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>How to Generate QR Code in Laravel 8</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>

<body>

    <div class="container mt-4">

        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h2>QR Code Scanner</h2>
                </div>
                <div class="card-body">
                    <!-- CAMERA -->
                    <div style="width: 500px" id="reader"></div>
                </div>
                <div class="card-footer">
                    <label id="result"></label>
                    <input type="text" id="result">
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
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
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
                        ->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8')) !!} ">
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
                        {!! $QRCode !!}
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
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    

    <!-- CAM FROM UBSEVMS -->
    <script src="{{asset('js/quagga.min.js')}}"  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash.throttle@4.1.1/index.js"></script>

    <!-- CAM FROM UBSEVMS -->
    <script>
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#camera')    // Or '#yourElement' (optional)
            },
            decoder: {
                readers: ["code_39_reader"]
            }
        }, function (err) {
            if (err) {
                console.log(err);
                return
            }
            console.log("Initialization finished. Ready to start");
            Quagga.start();
        });
    
        Quagga.onDetected(function(result) {
            var code = result.codeResult.code;
            document.getElementById('idNumber').value = code;
        });
    
        Quagga.offProcessed(onProcessed); 
        Quagga.offDetected(doOnDetected); 
        Quagga.stop();
    </script>

</body>
</html>