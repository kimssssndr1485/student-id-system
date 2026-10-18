<?php
// Handles saving student photos (JPG or PNG, max 2 MB).
class PhotoUploader
{
    private string $dir;
    private int $maxSize = 2097152; // 2 MB
    private array $allowed = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
    ];

    public function __construct()
    {
        $this->dir = __DIR__ . '/../assets/uploads/photos/';
        if (!is_dir($this->dir)) {
            mkdir($this->dir, 0775, true);
        }
    }

    // Returns the saved file name, or null if no file was chosen.
    // Throws RuntimeException with a message if something is wrong.
    public function upload(array $file, string $studentId): ?string
    {
        if (!isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new RuntimeException('The photo could not be uploaded. Try a smaller image.');
        }
        if ($file['size'] > $this->maxSize) {
            throw new RuntimeException('The photo is too large (maximum 2 MB).');
        }

        $info = @getimagesize($file['tmp_name']);
        if ($info === false || !isset($this->allowed[$info['mime']])) {
            throw new RuntimeException('The photo must be a JPG or PNG image.');
        }

        $name = $studentId . '.' . $this->allowed[$info['mime']];

        // Remove an older photo of this student (could have a different extension).
        foreach ($this->allowed as $ext) {
            $old = $this->dir . $studentId . '.' . $ext;
            if (file_exists($old)) {
                unlink($old);
            }
        }

        if (!move_uploaded_file($file['tmp_name'], $this->dir . $name)) {
            throw new RuntimeException('The photo could not be saved.');
        }
        return $name;
    }
}