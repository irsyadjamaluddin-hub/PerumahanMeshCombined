<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Support\Facades\Session;

class FileExtenstionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       //list allowed ext only
       $allowedExtensions =['pdf','jpg','jpeg','png','doc','docx','xls','xlsx','ppt','pptx'];

       
       $allFiles = $request->allFiles();
       if(count($allFiles) == 0){
            return $next($request);
       }
       //loop through all files in the request
       foreach($allFiles as $fileInput){
            //check if the file input array or single file

            if (is_array($fileInput)){
                foreach($fileInput as $files) {
                    if(is_array($files))
                    {
                        foreach($files as $file)
                        {
                            // validate each file ext
                            $this->validateFileExtension ($file, $allowedExtensions);
                        }
                    }else{
                        $this->validateFileExtension ($files, $allowedExtensions);          
                    }

                }      
            }
            else {
                // if its single file, validate ext
                $this->validateFileExtension ($fileInput, $allowedExtensions);

            }
        }
            
        return $next($request);
    }



 protected function validateFIleExtension ($file, $allowedExtensions) {

 // Get the file extension
 if ($file instanceof \Illuminate\Http\UploadedFile) {
    $extension = strtolower($file->getClientOriginalExtension());

    //block disallowed extensions
   
    if ($extension ==='php' || $extension === 'js' || !in_array($extension, $allowedExtensions)) {
   
       //rdirect back with an error and stop the request
   
       abort(422, 'File Type is not allowed. Please choose another file.');
    }
 } 
 
}
}