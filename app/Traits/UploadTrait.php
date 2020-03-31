<?php


namespace App\Traits;
use Illuminate\Http\Request;

trait UploadTrait
{
//    public function imageUpload($photos, $fileColumn = null)
    public function imageUpload($files, $path = '', $type = null)
    {
        $response = null;

        if (is_array($files)) {
            foreach ($files as $file) {
                if ($type) {
                    $response[] = [
                        $type => $file->store($path, 'public')
                    ];
                } else {
                    $response[] = $file->store($path, 'public');
                }
            }

            return $response;
        } else {
            return $files->store($path, 'public');
        }
    }

}
