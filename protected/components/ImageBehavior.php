<?php

/*
 * @author QuanNT
 */
class ImageBehavior extends CBehavior
{

    public $attr = null;

    public function getDirectory()
    {
        $owner = $this->getOwner();
        $model = $owner->tableName();
        if ($this->attr) {
            $folder_name = $owner->{$this->attr};
        } else {
            $folder_name = $owner->id;
        }
        $dir = '/images/' . $model . '/' . $folder_name . '/';
        return $dir;
    }

    public function getMainImage()
    {
        $images = $this->getAllImages();
        return $images[0];
    }

    public function getAllImages()
    {
        $dir = $this->getDirectory();
        $curr_dir = getcwd();
        $absoluted_dir = $curr_dir. $dir ;
        //$absoluted_dir = __DIR__ . '/../..' . $dir;
        $images = array();
        if (file_exists($absoluted_dir) && $handle = opendir($absoluted_dir)) {
            while (false !== ($file = readdir($handle))) {
                if (strpos($file, '.') != 0) {
                    $images[] = Yii::app()->baseUrl . $dir . $file;
                }
            }
            closedir($handle);
        }
        if (count($images) == 0) {
            $images[] = Yii::app()->baseUrl . '/images/' . 'no-image.jpg';
        }
        return $images;
    }

    public function createDirectoryIfNotExists()
    {
        $dir = $this->getDirectory();

        $curr_dir = getcwd();
        $absoluted_dir = $curr_dir. $dir ;
        //$absoluted_dir = __DIR__ . '/../..' . $dir;
        if (!file_exists($absoluted_dir)) {
            mkdir($absoluted_dir);
            chmod($absoluted_dir, 0777);
        }
        return $absoluted_dir;
    }

    public function removeMainImage()
    {
        $dir = $this->getDirectory();
        $curr_dir = getcwd();
        $absoluted_dir = $curr_dir. $dir ;
        // $absoluted_dir = __DIR__ . '/../..' . $dir;
        if (file_exists($absoluted_dir) && $handle = opendir($absoluted_dir)) {
            while (false !== ($file = readdir($handle))) {
                if (strpos($file, '.') != 0) {
                    unlink($absoluted_dir . $file);
                    break;
                }
            }
            closedir($handle);
        }
    }

    public function saveImage($image)
    {
        $owner = $this->getOwner();
        $path = $this->createDirectoryIfNotExists();
        $publicPath = Yii::app()->getBaseUrl() . "/images/{$owner->tableName()}/{$owner->id}/";
        $image->mime_type = $image->file->getType();
        $image->size = $image->file->getSize();
        $image->name = $image->file->getName();
        $filename = time() . '_' . $image->name;
        if ($image->validate()) {
            $image->file->saveAs($path . $filename);
            chmod($path . $filename, 0777);
            return json_encode(
                array(
                    array(
                        'name' => $image->name,
                        'type' => $image->mime_type,
                        'size' => $image->size,
                        'url' => $publicPath . $filename,
                        'thumbnail_url' => $publicPath . $filename,
                        'delete_url' => Yii::app()->createUrl('deleteImage', array(
                            'id' => $owner->id,
                            '_method' => 'delete',
                            'file' => $filename)
                        ),
                        'delete_type' => 'POST'
                    )
                )
            );
        } else {
            return json_encode(array(
                array('error' => $image->getErrors('file'),
            )));
        }
    }

    public function removeImageAndDirecroty()
    {
        $this->removeMainImage();
        $dir = $this->getDirectory();
        $curr_dir = getcwd();
        $absoluted_dir = $curr_dir. $dir ;
        //$absoluted_dir = __DIR__ . '/../..' . $dir;
        if (file_exists($absoluted_dir) && is_dir($absoluted_dir)) {
            $files = glob($absoluted_dir . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            rmdir($absoluted_dir);
        }
    }

}

?>