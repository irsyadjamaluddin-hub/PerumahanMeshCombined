<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Verification</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
<body>

<main>
    <div class="container">
      <section class="min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="qr-code-container">
                <div class="qr-code">
                  <!-- Place your QR code image or generation code here -->
                </div>
                <img src="{{ asset('assets/img/download1.png') }}" class="card-img-top smaller-image" alt="...">
              </div>
              <div class="card">
                <div class="card-header text-center"> MOE Event Scan QR Code</div>
                <div class="card-body text-center">
                  <div id="interactive" class="viewport"></div>
                </div>

                <div id="video-container">
                <video id="video" playsinline></video>
              </div>
              <div id="result-container">
                <p id="result"></p>
              </div>
               
              </div>
              
              <!-- Add the video container and result container here -->
            
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>


  
</body>

<style>
    /* Reduce the gap between the card and the download logo */
    .qr-code-container {
      margin-bottom: 20px; /* Adjust this value to reduce or increase the gap */
    }
    
    /* Resize the image and add more spacing around it */
    .smaller-image {
      max-width: 80%; /* Adjust the maximum width to control the image size */
      margin: 20px auto; /* Add margin for spacing around the image */
    }
  </style>

<script src="https://cdn.rawgit.com/cozmo/jsQR/master/dist/jsQR.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const videoElement = document.getElementById("video");
        const resultElement = document.getElementById("result");

        navigator.mediaDevices
            .getUserMedia({ video: { facingMode: "environment", width: 640, height: 480 } })
            .then((stream) => {
                videoElement.srcObject = stream;
                videoElement.play();

                videoElement.onloadedmetadata = () => {
                    // Start QR code scanning after the camera has successfully opened
                    checkForQRCode();
                };

                let lastTimestamp = 0;

                // Continuously scan for QR codes
                function checkForQRCode(timestamp) {
                    if (timestamp - lastTimestamp >= 1000 / 10) { // limit to 10 frames per second
                        const canvas = document.createElement("canvas");
                        const context = canvas.getContext("2d");
                        canvas.width = videoElement.videoWidth;
                        canvas.height = videoElement.videoHeight;
                        context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

                        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                        const qrCode = jsQR(imageData.data, imageData.width, imageData.height);

                        if (qrCode) {
                            // Log QR code data and client ID for debugging
                            const clientId = <?php echo $id; ?>;
                            const qrData = qrCode.data;
                            console.log("QR Code Data:", qrData);
                            console.log("Client ID:", clientId);

                            // Construct the URL using JavaScript
                            const qrCodeLink = `${qrData}/${clientId}`;
                            console.log("Generated Link:", qrCodeLink);
                            window.location.href = qrCodeLink;
                        }

                        lastTimestamp = timestamp;
                    }

                    requestAnimationFrame(checkForQRCode);
                }
            })
            .catch((error) => {
                console.error("Camera access error: ", error);
            });
    });
</script>









</html>