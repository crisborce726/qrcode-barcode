@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">


                    <div class="container mt-4">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h2>Barcode</h2>
                                    </div>
                                    <div class="card-body">
                                        <!-- EAN barcode is for international barcode or for products-->
                                        <div class="mb-3">{!!DNS1D::getBarcodeHTML('4445645656', 'EAN13')!!}</div>
                                        <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'C39E') !!}</div>   
                                    </div>
                                </div>
                            </div>
                
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h2>QR Code Scanner</h2>
                                </div>
                                <div class="card-body">
                                    <input placeholder="Enter User ID" type="text" name="idNumber" id="idNumber"
                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    class="form-control sm my-0 py-1" 
                                    required autofocus>
                
                                    <!-- CAMERA UBSEVMS-->
                                    <div class="mt-2" id="camera"></div>
                                </div>
                                <div class="card-footer">
                                    <label id="result"></label>
                                </div>
                            </div>
                        </div>
                     
                    </div>
                
                    <!-- CAM FROM UBSEVMS -->
                    <script src="{{asset('js/quagga.min.js')}}"  crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/lodash.throttle@4.1.1/index.js"></script>
                
                    <!-- CAM FROM UBSEVMS -->
                    <script type="text/javascript">
                        Quagga.init({
                            inputStream : 
                            {
                                name : "Live",
                                type : "LiveStream",
                                target: document.querySelector('#camera')    // Or '#yourElement' (optional)
                            },
                            area: { // defines rectangle of the detection/localization area
                                top: "0%",    // top offset
                                right: "0%",  // right offset
                                left: "0%",   // left offset
                                bottom: "0%"  // bottom offset
                            },
                
                            decoder : {
                                readers : [
                                    "ean_reader",
                                    "ean_8_reader"
                                ],
                                debug: {
                                    drawBoundingBox: true,
                                    showFrequency: true,
                                    drawScanline: true,
                                    showPattern: true
                                }
                            }
                        }, function(err) {
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
    </div>
</div>
@endsection
