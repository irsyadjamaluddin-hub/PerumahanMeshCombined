<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{{ $title }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://cdnjs.cloudflare.com">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
      font-family: system-ui, sans-serif;
      background: #525659;
      overflow: hidden;
    }

    .top-bar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 50px;
      background: #f6f6f6;
      border-bottom: 1px solid #ddd;
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 15px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .pdf-title {
      font-size: 14px;
      font-weight: 500;
      color: #333;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      flex: 1;
      margin-right: 10px;
    }

    .download-btn {
      padding: 8px 16px;
      background: #0066cc;
      color: #fff;
      text-decoration: none;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 600;
      flex-shrink: 0;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .download-btn:active {
      background: #0052a3;
    }

    /* Desktop: iframe viewer */
    .iframe-viewer {
      position: fixed;
      top: 50px;
      bottom: 0;
      left: 0;
      right: 0;
      display: none;
    }

    .iframe-viewer iframe {
      width: 100%;
      height: 100%;
      border: 0;
    }

    /* Mobile: PDF.js canvas viewer */
    .pdf-viewer {
      position: fixed;
      top: 50px;
      bottom: 0;
      left: 0;
      right: 0;
      overflow-y: auto;
      overflow-x: hidden;
      background: #525659;
      display: none;
      padding: 10px 0;
    }

    .pdf-canvas-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
    }

    .pdf-page {
      box-shadow: 0 2px 8px rgba(0,0,0,0.3);
      background: white;
      max-width: 100%;
      display: block;
    }

    .loading {
      color: #fff;
      font-size: 16px;
      text-align: center;
      padding: 40px 20px;
    }

    .loading-spinner {
      display: inline-block;
      width: 40px;
      height: 40px;
      margin: 20px auto;
      border: 4px solid #ddd;
      border-top-color: #0066cc;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    @media (max-width: 600px) {
      .top-bar {
        height: 45px;
        padding: 0 10px;
      }
      
      .pdf-title {
        font-size: 12px;
      }
      
      .download-btn {
        padding: 6px 12px;
        font-size: 13px;
      }
      
      .iframe-viewer,
      .pdf-viewer {
        top: 45px;
      }

      .pdf-viewer {
        padding: 5px 0;
      }

      .pdf-canvas-container {
        gap: 5px;
      }
    }
  </style>
</head>
<body>
  <div class="top-bar">
    <span class="pdf-title">{{ $filename }}</span>
    <a class="download-btn" href="{{ $downloadUrl }}">Download</a>
  </div>

  <!-- Desktop: Fast native iframe -->
  <div class="iframe-viewer" id="iframeViewer">
    <iframe src="{{ $inlineUrl }}"></iframe>
  </div>

  <!-- Mobile: PDF.js viewer (no Open button) -->
  <div class="pdf-viewer" id="pdfViewer">
    <div class="loading">
      Loading PDF...
      <div class="loading-spinner"></div>
    </div>
    <div class="pdf-canvas-container" id="canvasContainer"></div>
  </div>

  <script>
    const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent) && window.innerWidth <= 600;
    const iframeViewer = document.getElementById('iframeViewer');
    const pdfViewer = document.getElementById('pdfViewer');

    if (isMobile) {
      // Mobile: Use PDF.js (no "Open" button)
      pdfViewer.style.display = 'block';
      
      // Load PDF.js
      const script = document.createElement('script');
      script.src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js';
      script.onload = function() {
        initPdfJs();
      };
      document.head.appendChild(script);

    } else {
      // Desktop: Use fast native iframe
      iframeViewer.style.display = 'block';
    }

    function initPdfJs() {
      pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

      const pdfUrl = '{{ $inlineUrl }}';
      const container = document.getElementById('canvasContainer');
      const loadingDiv = document.querySelector('.loading');

      const loadingTask = pdfjsLib.getDocument({
        url: pdfUrl,
        disableRange: false,
        disableStream: false,
      });

      loadingTask.promise.then(function(pdf) {
        // Hide loading
        loadingDiv.style.display = 'none';
        
        const numPages = pdf.numPages;
        const scale = 1.2; // Good quality for mobile

        // Render pages IN ORDER
        function renderPage(pageNum) {
          return pdf.getPage(pageNum).then(function(page) {
            const viewport = page.getViewport({ scale: scale });

            const canvas = document.createElement('canvas');
            canvas.className = 'pdf-page';
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderContext = {
              canvasContext: context,
              viewport: viewport
            };
            
            return page.render(renderContext).promise.then(function() {
              container.appendChild(canvas);
            });
          });
        }

        // Render first 3 pages immediately
        Promise.all([
          renderPage(1),
          renderPage(2),
          renderPage(3)
        ]).then(function() {
          // Then render remaining pages in order
          let currentPage = 4;
          
          function renderNext() {
            if (currentPage <= numPages) {
              renderPage(currentPage).then(function() {
                currentPage++;
                renderNext();
              });
            }
          }
          
          renderNext();
        });

      }).catch(function(error) {
        loadingDiv.innerHTML = '<div style="color: #ff6b6b;">Error loading PDF.<br><a href="{{ $inlineUrl }}" style="color: #0066cc; text-decoration: underline;">Open PDF</a></div>';
        console.error('Error:', error);
      });
    }
  </script>
</body>
</html>