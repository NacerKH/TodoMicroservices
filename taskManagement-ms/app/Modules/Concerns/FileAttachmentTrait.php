<?php

namespace App\Modules\Concerns;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

trait FileAttachmentTrait
{
    /**
     * Handle file attachment and update the data array.
     *
     * @param  array  $data
     * @return void
     */
    protected function handleFileAttachment(array &$data)
    {
        if (isset($data['attachment']) && $data['attachment'] instanceof UploadedFile) {
            $file = $data['attachment'];
          
            $filename = $file->getClientOriginalName();
           
           $data['attachment']=  $file->storePublicly('attachements', ['disk' => $this->TasksDisk()]);
          
            $data['attachment_filename'] = $filename;
        }
    }

    /**
     * Handle file deletion.
     *
     * @param  string  $filePath
     * @return void
     */
    protected function deleteFileAttachment(string $filePath)
    {    
        Storage::disk($this->TasksDisk())->delete($filePath);

    
    }

    /**
     * Add attachment path and URL to the task object.
     *
     * @param  mixed  $task
     * @return void
     */
    protected function addAttachmentInfo(&$task)
    {
        $attachmentPath = $task->attachment;
        $attachmentUrl = Storage::url($attachmentPath);

        $task->attachment_path = $attachmentPath;
        $task->attachment_url = $attachmentUrl;
    }

    /**
     * Get the disk that tasks should be stored on.
     *
     * @return string
     */
    protected function TasksDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }

   
}
