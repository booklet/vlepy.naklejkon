<?php
class MinifyFilesStamp
{
    private $files_paths = [];

    public function __construct(array $files_paths)
    {
        $this->files_paths = $files_paths;
    }

    public function getFilesTimeStamp()
    {
        if (empty($this->files_paths)) {
            return null;
        }

        $stamp = '';
        foreach ($this->files_paths as $file_path) {
            $stamp .= filemtime($file_path);
        }
        $short_hashed_stamp = substr(md5($stamp), 0, 10); // 10 characters

        return $short_hashed_stamp;
    }
}
