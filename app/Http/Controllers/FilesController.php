<?php
    namespace App\Http\Controllers;
    use Session;
    use DB;
    use Log;
    use Hash;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\File;
    use Illuminate\Support\Facades\Response;
     class FilesController extends Controller
     {
        public function downloadFile($filePath, Request $request){


            
            $fileExists = Storage::disk('public')->has($filePath);
            if(!$fileExists){
                return abort(404);
            }
            if($this->isPublicFolder($request)){
                $fileName = basename($filePath);
                return Storage::disk('public')->download($filePath, $fileName);
            }
            if(!Auth::user()){
                return abort(401);
            }
            $fileName = basename($filePath);
            return Storage::disk('public')->download($filePath, $fileName);
        }

        public function uploadFile(Request $request){
            $file = $request->file('file');
            return $file->getSize();
        }

        public function isPublicFolder($request){
            $allowedPrefixPaths = array("onlinenotification");
            foreach($allowedPrefixPaths as $allowedPrefixPath){
                $targetPath = "storage/".$allowedPrefixPath;
                //dd(strpos($request->path(), $targetPath));
                if(strpos($request->path(), $targetPath) === 0){
                    return true;
                }
            }
        }
     }
?>