<?php $__env->startSection('title', 'MOE MESH - Dashboard'); ?>

<?php $__env->startSection('content'); ?>

  <?php
    $pagename = "Dashboard";
  ?>

<style>

.carousel-control-next, .carousel-control-prev {
  width: 8%;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
  height: 35px;
  width: 35px;
  background-size: 40%, 40%;
  border-radius: 100%;
  background-color: grey;
}

.carousel-indicators {
    margin-bottom: 0rem;
}

</style>

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner ">
          <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bns): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="carousel-item <?php if($loop->first): ?> active <?php endif; ?>">
                <div class="slider-image text-center">
                    <img src="<?php echo e(asset($bns->bn_image_path)); ?>" style="width:100%; height:300px;" class="d-inline-block border text-center rounded" alt="<?php echo e($bns->bn_image); ?>">
                </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
      </button>
    </div>

            
            
            

    <?php if(session('success')): ?>
    <div class="alert alert-success" style="margin-top: 20px">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="col-span-12 lg:col-span-6 mt-7">

                
                <div class="border-b-2 px-4 py-2 bg-white rounded-t-md flex items-center justify-between shadow-md">

                    <div class="flex flex-col md:flex-row md:items-center gap-1.5">
                        <p class="text-lg font-semibold text-blue-900" id="pgap">Announcements</p>
                        <p class="text-sm text-blue-900 hidden md:block" id="pgap">|</p>
                        <p class="text-sm text-gray-400" id="pgap" title="Only the latest 4 Announcement are shown">Latest Announcements<span class="required-symbol">*</span></p>
                        <p class="text-sm text-blue-900 hidden md:block" id="pgap">|</p>
                            <form method="POST" action="<?php echo e(route('subscribeannouncement')); ?>">
                                <?php echo csrf_field(); ?>

                                
                                <?php
                                    $userEmail = Auth::user()->email;
                                    $userIC = Auth::user()->ic_no;
                                    $subscription = \App\Models\Announcementnotification::where('email', $userEmail)
                                        ->where('ic_no', $userIC)
                                        ->first();
                                ?>

                                
                                <?php if(!$subscription || ($subscription && !$subscription->notification)): ?>
                                    <p class="text-sm cursor-pointer" style="color:#006cbf;" id="pgap" title="Click to receive notification in email">
                                        <button type="submit">Subscribe</button>
                                    </p>
                                <?php else: ?>
                                    <p class="text-sm cursor-pointer" style="color:#006cbf;" id="pgap" title="Click to disable receiving notification in email">
                                        <button type="submit" formaction="<?php echo e(route('unsubscribeannouncement')); ?>">Unsubscribe</button>
                                    </p>
                                <?php endif; ?>
                            </form>
                    </div>

                    <div class="hover:text-blue-400 cursor-pointer flex items-center gap-2 text-sm lg:text-md">
                        <a href="<?php echo e(route('announcement.announcementindex')); ?>">View All</a>
                        <div class="bi bi-chevron-right"></div>
                    </div>
                </div>

            <?php if($announcementExist): ?>
                <div class="bg-white overflow-y-auto shadow-md rounded-b-md">
                    <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="grid grid-cols-12 gap-4 p-4 border-b-2">
                            <div class="col-span-12 sm:col-span-2" style="height: 200px; width: 150px;">
                                <!-- Image -->
                                <?php if($announcement->announcement_file_path): ?>
                                    <a href="<?php echo e(asset($announcement->announcement_file_path)); ?>" target="_blank">
                                        <img src="<?php echo e(asset($announcement->announcement_file_path)); ?>" alt="Image" class="custom-imageannouncement">
                                    </a>
                                <?php else: ?>
                                    <img src="<?php echo e(asset('img/Announcement.png')); ?>" class="custom-imageannouncement" >
                                <?php endif; ?>
                            </div>
                            <div class="col-span-12 sm:col-span-10">
                                <!-- Announcement Information -->
                                <div class="flex items-center justify-between">
                                    <div>
                                    <p class="text-md font-semibold" style="font-size: 18px; font-family: Roboto; text-decoration: underline; display: inline-block;">
                                        <?php echo e($announcement->announcement_title); ?>

                                    </p>                                                
                                    </div>
                                    <!-- File -->
                                    <?php if(!empty($announcement->pdf_file_path)): ?>
                                        <?php if(count($announcement->pdf_file_path) === 1): ?>
                                            <a href="<?php echo e(asset($announcement->pdf_file_path[0])); ?>" target="_blank">
                                                <i class="btn btn-outline-primary mr-2 bi bi-file-earmark-arrow-down-fill"></i>
                                            </a>
                                        <?php else: ?>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#documentsModal<?php echo e($announcement->id); ?>">
                                            <i class="btn btn-outline-primary mr-2 bi bi-file-earmark-arrow-down-fill"></i>
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="documentsModal<?php echo e($announcement->id); ?>" tabindex="-1" aria-labelledby="documentsModalLabel<?php echo e($announcement->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mx-auto" id="documentsModalLabel">Documents Posted</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Loop through the documents and display them in a grid -->
                                                        <div class="grid <?php echo e(count($announcement->pdf_file_path) === 1 ? 'grid-cols-1 justify-center' : (count($announcement->pdf_file_path) === 2 ? 'grid-cols-2 justify-center' : 'grid-cols-3')); ?> gap-4">
                                                            <?php $__currentLoopData = $announcement->pdf_file_path; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filePath): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    $filenameWithoutExtension = pathinfo($filePath, PATHINFO_FILENAME);
                                                                    $nameParts = explode('_', $filenameWithoutExtension);
                                                                    $documentName = implode(' ', array_slice($nameParts, 1));
                                                                ?>
                                                                <div class="text-center">
                                                                    <a href="<?php echo e(asset($filePath)); ?>" target="_blank">
                                                                        <i class="btn btn-outline-primary mb-2 bi bi-file-earmark-arrow-down-fill"></i>
                                                                    </a>
                                                                    <p class="text-xs"><?php echo e($documentName); ?></p>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-custom-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="flex items-center gap-2">
                                    <p class="text-gray-400 my-2"><?php echo e($announcement->announcement_date); ?></p>
                                    <?php
                                        $icons = json_decode($announcement->announcement_icon, true);
                                    ?>
                                    <?php if(in_array("info", $icons)): ?>
                                        <div class="text-sm px-2 py-1 bg-green-300 rounded-md" title="Information">
                                            <i class="bi bi-info-circle"></i>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(in_array("maintenance", $icons)): ?>
                                        <div class="text-sm px-2 py-1 bg-yellow-300 rounded-md" title="Maintenance">
                                            <i class="bi bi-wrench"></i>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(in_array("update", $icons)): ?>
                                        <div class="text-sm px-2 py-1 bg-gray-300 rounded-md" title="Update">
                                            <i class="bi bi-gear"></i>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(in_array("urgent", $icons)): ?>
                                        <div class="text-sm px-2 py-1 bg-red-300 rounded-md" title="Urgent">
                                            <i class="bi bi-exclamation-triangle"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <p class="overflow-hidden" id="justify" style="font-family: Open Sans; padding-top: 10px; font-size: 0.9rem; line-height: 1.2;">             
                                    <?php
                                    $contentWithLinks = preg_replace(
                                        '/\b(?:https?:\/\/|www\.)\S+\b/',
                                        '<a href="$0" target="_blank">$0</a>',
                                        nl2br(e($announcement->announcement_content))
                                    );
                                    echo $contentWithLinks;
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                
                <div class="NoNewsbox">
                    There are currently no announcement!
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>

        
        
        

        <div class="row">
            <div class="col-span-12 lg:col-span-6 mt-7">
                
                <div class="border-b-2 px-4 py-2 bg-white rounded-t-md flex items-center justify-between shadow-md">
                    <div class="flex flex-col md:flex-row md:items-center gap-1.5">
                        <p class="text-lg font-semibold text-blue-900" id="pgap">News</p>
                        <p class="text-sm text-blue-900 hidden md:block" id="pgap">|</p>
                        <p class="text-sm text-gray-400"  id="pgap" title="Only the latest 3 News are shown">Latest News<span class="required-symbol">*</span></p>
                    </div>

                    <div class="hover:text-blue-400 cursor-pointer flex items-center gap-2 text-sm lg:text-md">
                        <a href="<?php echo e(route('news.newsindex')); ?>">View All</a>
                        <div class="bi bi-chevron-right"></div>
                    </div>
                </div>

                <?php if($newsExist): ?>
                    
                    <div class="bg-white overflow-y-auto shadow-md rounded-b-md">
                        
                        <div class="sliderItems flex" style="justify-content: center;">
                            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="mx-10 w-80 newsborder">
                                    
                                    <div class="h-32 middleimage">
                                        <?php if(is_array($item->news_file_path) && count($item->news_file_path) > 0): ?>
                                            <?php
                                                $imagePath = null;
                                                foreach ($item->news_file_path as $file) {
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                                                        $imagePath = $file;
                                                        break;
                                                    }
                                                }
                                            ?>

                                            <?php if($imagePath): ?>
                                                <a href="<?php echo e(asset($imagePath)); ?>" target="_blank">
                                                    <img src="<?php echo e(asset($imagePath)); ?>" alt="Image" class="custom-imagenews">
                                                </a>
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('simpur/img/LatestNewswhite.png')); ?>" class="custom-altimagenews">
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('simpur/img/LatestNewswhite.png')); ?>" class="custom-altimagenews">
                                        <?php endif; ?>
                                    </div>

                                    <div class="mt-4">
                                        
                                        <p class="text-md font-semibold hover:text-indigo-500 cursor-pointer" style="height:30px;text-align: center; " title="<?php echo e($item->news_title); ?>">
                                        <?php
                                            $content = nl2br($item->news_title); // Convert newlines to <br> tags
                                            $words = explode(' ', $content);
                                            $limitedContent = implode(' ', array_slice($words, 0, 10)); // Change '10' to the desired word limit
                                            echo $limitedContent . '...';
                                        ?>
                                        </p>
                                        
                                        <?php if($item->news_name): ?>
                                        <div class="gap-2" style="text-align: center; padding-top:20px;">
                                        <hr class="custom-hr" style="width: 100%; margin: 0;">
                                            <p class="text-gray-400 my-2"><?php echo e($item->news_name); ?> - <?php echo e($item->news_date->format('j M Y')); ?></p>
                                        <hr class="custom-hr" style="width: 100%; margin: 0;">
                                        </div>
                                        <?php else: ?>
                                        <div class="gap-2" style="text-align: center; padding-top:20px;">
                                        <hr class="custom-hr" style="width: 100%; margin: 0;">
                                            <p class="text-gray-400 my-2"><?php echo e($item->news_date->format('j M Y')); ?></p>
                                        <hr class="custom-hr" style="width: 100%; margin: 0;">
                                        </div>
                                        <?php endif; ?>                                        
                                        <p class="line-clamp-4 overflow-hidden mt-2" style="text-align: justify;"><?php echo e($item->news_content); ?></p>
                                    </div>
                                    
                                    <div class="card-footer font-semibold text-right">
                                        <a href="#" class="read-more-link" data-toggle="modal" data-target="#newsModal<?php echo e($item->id); ?>">Read more</a>
                                    </div>
                                </div>

                                <!-- News Modal -->
                                <div class="modal fade" id="newsModal<?php echo e($item->id); ?>" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel<?php echo e($item->id); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered custom-modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title news-title-modal" id="newsModalLabel<?php echo e($item->id); ?>"><?php echo e($item->news_title); ?></h5>
                                            </div>
                                            <div class="modal-body">
                                                <?php if($item->news_name): ?>
                                                <p class="card-text" style="font-style: italic; padding-bottom: 10px;"><?php echo e($item->news_name); ?> - <?php echo e($item->news_date->format('j/n/Y')); ?></p>
                                                <?php else: ?>
                                                <p class="card-text" style="font-style: italic; padding-bottom: 10px;"><?php echo e($item->news_date->format('j/n/Y')); ?></p>
                                                <?php endif; ?>
                                                <hr>
                                                <p class="card-text custom-newscontent" style="text-align: justify;"><?php echo nl2br($item->news_content); ?></p>
                                                <?php if(!empty($item->news_file_path)): ?>
                                                    
                                                    <?php
                                                        $hasImage = false;
                                                        foreach ($item->news_file_path as $filePath) {
                                                            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                                            if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                                                                $hasImage = true;
                                                                break;
                                                            }
                                                        }
                                                    ?>

                                                    <?php if($hasImage): ?>
                                                        <hr>
                                                        <div class="thumbnail-gallery text-center" style="padding-bottom:20px;">
                                                            <div class="thumbnail-gallery-inner">
                                                                <?php $__currentLoopData = $item->news_file_path; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filePath): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php
                                                                        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                                                    ?>

                                                                    <?php if(in_array($extension, ['jpg', 'jpeg', 'png'])): ?>
                                                                        <a href="<?php echo e(asset($filePath)); ?>" target="_blank" style="border: 1px solid #ddd;">
                                                                            <img src="<?php echo e(asset($filePath)); ?>" alt="Thumbnail" class="thumbnail">
                                                                        </a>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                    
                                                    <?php
                                                        $hasPdf = false;
                                                        foreach ($item->news_file_path as $filePath) {
                                                            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                                            if ($extension === 'pdf') {
                                                                $hasPdf = true;
                                                                break;
                                                            }
                                                        }
                                                    ?>

                                                    <?php if($hasPdf): ?>
                                                        <hr>
                                                        <div class="thumbnail-gallery text-center">
                                                            <div class="thumbnail-gallery-inner">
                                                                <?php $__currentLoopData = $item->news_file_path; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filePath): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php
                                                                        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                                                    ?>

                                                                    <?php if($extension === 'pdf'): ?>
                                                                        <div class="text-center">
                                                                            <a href="<?php echo e(asset($filePath)); ?>" target="_blank">
                                                                                <i class="btn btn-outline-primary mr-2 bi bi-file-earmark-arrow-down-fill"></i>
                                                                            </a>
                                                                            <p class="text-xs">
                                                                            <?php
                                                                                $content = basename($filePath); // Convert newlines to <br> tags
                                                                                $words = explode(' ', $content);
                                                                                $limitedContent = implode(' ', array_slice($words, 0, 3)); // Change '10' to the desired word limit
                                                                                echo $limitedContent . '...';
                                                                            ?>
                                                                            </p>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    
                <?php else: ?>
                    
                    <div class="NoNewsbox">
                        There are Currently No News!
                    </div>
                <?php endif; ?>
            </div>
        </div>

    <style>
        #editgapbelow {
            padding-bottom: 10px;
        }

        .modal-dialog{
            max-width: 20%;
            min-width: 15%;
        }

        .modal-header{
            padding-left: 20%;
        }

        .modal-title{
            /* Text */
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Roboto", sans-serif;
        }

        .btn-custom-secondary {
            background-color: #007bff;
            border-color: #007bff;
            color: #ffffff; /* Text color (white in this example) */
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-custom-secondary:hover {
            background-color: #ffffff;
            border-color: #007bff;
            color: #007bff;
        }

        .newsallbox {
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

            background-color: white;
        }

        .custom-hr {
            margin: 0.2rem !important;
            /* Add your desired styles for the hr element */
        }

        .newsborder {
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

            background-color: white;
            padding: 10px 10px 10px 10px;
            display: flex;
            flex-direction: column;
            margin: 15px 40px 15px 40px;
        }

        .card-footer {
            padding-top:10px;
            padding-bottom:5px !important;
            margin-top: auto;
        }

        .custom-imageannouncement {
            width: 150px; /* Adjust the width as needed */
            height: 200px; /* Let the height adjust automatically */
            object-fit: scale-down; /* Adjust the object-fit property as needed */
            border-radius: 5px; /* Add border-radius for rounded corners if desired */
        }

        .custom-imagenews {
            height: 8rem;
            object-fit: scale-down; /* Adjust the object-fit property as needed */
            border-radius: 5px; /* Add border-radius for rounded corners if desired */
        }

        .custom-altimagenews {
            height: 8rem;
            width: 100%;
            object-fit: scale-down; /* Adjust the object-fit property as needed */
            border-radius: 5px; /* Add border-radius for rounded corners if desired */
        }

        .middleimage {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .read-more-link {
            color: blue;
            cursor: pointer;
        }

        .news-title {
            font-size: 23px;
            font-weight: bold;
            font-family: Gelasio !important;
            line-height: 1.1 !important;
            font-weight: 600 !important;
        }

        .news-title-modal {
            font-size: 41px;
            font-weight: bold;
            font-family: Gelasio !important;
            line-height: 1.1 !important;
            font-weight: 600 !important;
        }

        .custom-modal-dialog {
            max-width: 1000px !important; /* Adjust the width as needed */
            margin: 0 auto;
        }

        /* Thumbnail Gallery Styles */
        .thumbnail-gallery {
            margin-top: 20px;
        }

        .thumbnail-gallery-inner {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center; /* Center the thumbnails */
        }

        .thumbnail-gallery .thumbnail {
            width: 70px;
            height: 70px;
            object-fit: cover;
            cursor: pointer;
        }

        /* Section Heading Styles */
        .section-heading {
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Line Styles */
        .line {
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }

        .NoNewsbox {
            height:8rem; 
            background-color:white;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  

            /* Text */
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Roboto", sans-serif;
        }
        @media (max-width: 1980px) {
            .sm\:col-span-10 {
                margin-left: 2rem;
            }
        }
        @media (max-width: 1480px) {
            .sm\:col-span-10 {
                margin-left: 3rem;
            }
        }
        @media (max-width: 1080px) {
            .sm\:col-span-10 {
                margin-left: 3rem;
            }
        }

        /* Media query for smaller screens */
        @media (max-width: 768px) {
            .sm\:col-span-10 {
                margin-left: 3rem;
            }

            .col-span-2 {
                margin-left: 0;
                margin-bottom: 10px; /* Add some space below the image */
            }

            .modal-dialog{
                max-width: 60%;
                min-width: 15%;
            }

            .modal-header{
                padding-left: 20%;
            }
        }
    </style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-all', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH S:\Mesh110626\resources\views//home.blade.php ENDPATH**/ ?>