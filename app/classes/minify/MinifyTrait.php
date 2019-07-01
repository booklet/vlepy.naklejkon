<?php
use MatthiasMullie\Minify;

trait MinifyTrait
{
    private $files = [];
    private $files_path;
    private $output_minify_path;
    private $stamp_file_path;

    public function __construct(array $files = [], array $params = [])
    {
        $this->files = $files;
        $this->files_path = $params['files_path'] ?? self::FILES_PATH;
        $this->output_minify_path = $params['output_minify_path'] ?? self::OUTPUT_MINIFY_PATH;
        $this->stamp_file_path = $this->output_minify_path . 'stamp';
        $this->current_files_stamp = $this->currentFilesStamp();
    }

    public function minify()
    {
        if ($this->hasFilesChanged()) {
            $this->minifyAndSave();
            $this->saveCurrentStamp();
        }
    }

    public function getMinifyFilePath()
    {
        return self::OUTPUT_MINIFY_PATH . self::MINIFY_FILE_PREFIX . $this->lastFilesStamp() . self::MINIFY_FILE_EXTENSION;
    }

    private function minifyAndSave()
    {
        $minifier_class_name = 'MatthiasMullie\Minify\\' . self::MINIFY_TYPE;
        $minifier = new $minifier_class_name($this->filesPaths());

        $this->saveMinifyFile($this->minifyFileName(), $minifier->minify());
    }

    private function hasFilesChanged()
    {
        if ($this->current_files_stamp != $this->lastFilesStamp()) {
            // mam wrazenie ze minify uruchamia sie wtedy kiedy nie powinno
            // Log::info('Create minify file', [
            //     'current_files_stamp' => $this->current_files_stamp,
            //     'lastFilesStamp' => $this->lastFilesStamp(),
            //     'minify_object' => $this,
            // ]);

            return true;
        }

        return false;
    }

    private function currentFilesStamp()
    {
        $mfs = new MinifyFilesStamp($this->filesPaths());

        return $mfs->getFilesTimeStamp();
    }

    private function filesPaths()
    {
        $files_paths = [];
        foreach ($this->files as $file_name) {
            $files_paths[] = $this->files_path . $file_name;
        }

        return $files_paths;
    }

    private function lastFilesStamp()
    {
        return file_get_contents($this->stamp_file_path);
    }

    private function saveMinifyFile($file_name, $content)
    {
        file_put_contents($this->output_minify_path . $file_name, $content);
    }

    private function saveCurrentStamp()
    {
        file_put_contents($this->stamp_file_path, $this->current_files_stamp);
    }

    private function minifyFileName()
    {
        return self::MINIFY_FILE_PREFIX . $this->current_files_stamp . self::MINIFY_FILE_EXTENSION;
    }
}
