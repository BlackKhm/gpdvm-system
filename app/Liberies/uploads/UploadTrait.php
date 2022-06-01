<?php

namespace App\Liberies\uploads;

use Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Liberies\uploads\UploadLib;

trait UploadTrait
{
    /**
     * Check file
     *
     * @param string $profile
     * @param string $disk
     * @param boolean $useDefaultImage
     * @return string
     */
    public function myFileExist($profile, $disk = 'uploads', $useDefaultImage = true)
    {
        $newProfile = null;
        if ($profile) {
            // if (\Storage::disk($disk)->exists($profile))
            $newProfile = \Storage::disk($disk)->url($profile);
        }
        if ($useDefaultImage) {
            return $newProfile ?? asset(
                config('const.upload_lib.default_image') ?? 'assets/default.png'
            );
        }
        return $newProfile;
    }

    /**
     * Get all image size
     *
     * @param string $profile
     * @param string $disk
     * @param boolean $useDefaultImage
     */
    public function myAllImageSize($profile, $disk = 'uploads', $useDefaultImage = true)
    {
        $d['small'] = $this->myFileExist($profile, $disk . '_small', $useDefaultImage);
        $d['medium'] = $this->myFileExist($profile, $disk . '_medium', $useDefaultImage);
        $d['large'] = $this->myFileExist($profile, $disk . '_large', $useDefaultImage);
        $d['original'] = $this->myFileExist($profile, $disk, $useDefaultImage);
        return $d;
    }

    /**
     * Get all image sizes
     *
     * @param array $gallery
     * @param string $disk
     * @param boolean $useDefaultImage
     */

    public function myAllImageSizes($gallery, $disk = 'uploads', $useDefaultImage = true)
    {
        $g = [];
        if (is_array($gallery) && count($gallery)) {
            foreach ($gallery as $image) {
                if ($image) {
                    $g[] = self::myAllImageSize($image, $disk, $useDefaultImage);
                }
            }
        }
        return $g;
    }

    public function myAllImageSizeToUrls($gallery, $disk = 'uploads', $useDefaultImage = false)
    {
        $g = [];
        if (is_array($gallery) && count($gallery)) {
            foreach ($gallery as $image) {
                if ($image) {
                    $g[] = self::myFileExist($image, $disk, $useDefaultImage);
                }
            }
        }
        return implode(",",$g);
    }

    /**
     * Single upload base64 image
     *
     * @param array $value
     * @param string $attribute_name
     * @param string $destination_path
     * @param string $disk
     * @param boolean $thumbnail
     * @param boolean $mainImage
     */
    public function myCrudUpload($value, $attribute_name, $destination_path, $disk = 'uploads', $thumbnail = true, $mainImage = true, $data = [])
    {
        $isDoNotDeleteImage = isset($data['doNotDeleteImage']) && $data['doNotDeleteImage'] ? $data['doNotDeleteImage'] : false;

        $request = \Request::instance();
        if ($request->hasFile($attribute_name)) {
            $this->myUploadFileToDisk($value, $attribute_name, $disk, $destination_path, $thumbnail, $mainImage, $isDoNotDeleteImage);
        } else {
            if ($value == null) {
                if(!$isDoNotDeleteImage){
                    UploadLib::clearSingleThumbnail($disk, $this->{$attribute_name});
                }
                $this->attributes[$attribute_name] = null;
            }
            if (is_string($value) && Str::startsWith($value, 'data:image')) {
                if(!$isDoNotDeleteImage){
                    UploadLib::clearSingleThumbnail($disk, $this->{$attribute_name});
                }
                $extension = self::checkExtension($value);

                $image = \Image::make($value);
                $filename = md5($value . time()) . $extension;
                if ($mainImage) {
                    \Storage::disk($disk)->put($destination_path . '/' . $filename, $image->stream());
                }
                if ($thumbnail) {
                    UploadLib::thumbnail($image, $disk, $destination_path . '/' . $filename);
                }
                $this->attributes[$attribute_name] = $destination_path . '/' . $filename;
            }
        }

    }

    /**
     * Multiple upload base64 image|Input file
     *
     * @param array $value
     * @param string $attribute_name
     * @param string $destination_path
     * @param string $disk
     * @param boolean $thumbnail
     * @param boolean $mainImage
     */
    public function myCrudUploads($value, $attribute_name, $destination_path, $disk = 'uploads', $thumbnail = true, $mainImage = true, $data = [])
    {
        $isDoNotDeleteImage = isset($data['doNotDeleteImage']) && $data['doNotDeleteImage'] ? $data['doNotDeleteImage'] : false;

        $request = \Request::instance();
        if ($this->preventMutator) {
            return $this->attributes[$attribute_name] = $value;
        }

        if ($request->hasFile($attribute_name)) { // tested
            $this->myUploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path, $thumbnail, $mainImage, $isDoNotDeleteImage);
        } else {
            $attribute_value = $this->attributeValueToArray($this->{$attribute_name});
            $files_to_clear = $request->get('clear_' . $attribute_name);
            $attribute_value = $this->filesToClear($files_to_clear, $attribute_value, $disk, $isDoNotDeleteImage);
            if (is_array($request->{$attribute_name}) && count($request->{$attribute_name})) {
                foreach ($request->{$attribute_name} as $k => $v) :
                    if (is_string($v) && Str::startsWith($v, 'data:image')) {
                        $extension = self::checkExtension($v);
                        $myImage = \Image::make($v);
                        if ($myImage) {
                            $setFilename = md5('base64image' . $k . time()) . $extension;
                            $setFilePath = $destination_path . '/' . $setFilename;
                            if ($mainImage) {
                                \Storage::disk($disk)->put($setFilePath, $myImage->stream());
                            }
                            if ($thumbnail) {
                                UploadLib::thumbnail($myImage, $disk, $setFilePath);
                            }
                            $attribute_value[] = $setFilePath;
                        }
                    }
                endforeach;
            }
            $this->attributes[$attribute_name] = json_encode($attribute_value);
        }
    }

    public function myUploadFileToDisk($value, $attribute_name, $disk, $destination_path, $thumbnail = true, $mainImage = true, $doNotDeleteImage = false)
    {
        // if a new file is uploaded, delete the file from the disk
        if (request()->hasFile($attribute_name) &&
            $this->{$attribute_name} &&
            $this->{$attribute_name} != null) {
            if(!$doNotDeleteImage){
                UploadLib::clearSingleThumbnail($disk, $this->{$attribute_name});
            }
            $this->attributes[$attribute_name] = null;
        }

        // if the file input is empty, delete the file from the disk
        if (is_null($value) && $this->{$attribute_name} != null) {
            if(!$doNotDeleteImage){
                UploadLib::clearSingleThumbnail($disk, $this->{$attribute_name});
            }
            $this->attributes[$attribute_name] = null;
        }

        // if a new file is uploaded, store it on disk and its filename in the database
        if (request()->hasFile($attribute_name) && request()->file($attribute_name)->isValid()) {
            // 1. Generate a new file name
            $file = request()->file($attribute_name);
            $convertExtensionTo = $file->getClientOriginalExtension();
            // $convertExtensionTo = $this->convertSpecialExtensionTo($file->getClientOriginalExtension());
            $new_file_name = md5($file->getClientOriginalName().random_int(1, 9999).time()).'.'.$convertExtensionTo;

            // 2. Move the new file to the correct path
            $file_path = $file->storeAs($destination_path, $new_file_name, $disk);

            if ($thumbnail) { // Custom Core File
                UploadLib::thumbnail(\Image::make(\Storage::disk($disk)->get($file_path)), $disk, $file_path);
            }
            if (!$mainImage) {
                \Storage::disk($disk)->delete($file_path);
            }

            // 3. Save the complete path to the database
            $this->attributes[$attribute_name] = $file_path;
        }
    }

    public function myUploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path, $thumbnail = true, $mainImage = true, $doNotDeleteImage = false)
    {
        $request = \Request::instance();
        $attribute_value = $this->attributeValueToArray($this->{$attribute_name});
        $files_to_clear = $request->get('clear_' . $attribute_name);
        $attribute_value = $this->filesToClear($files_to_clear, $attribute_value, $disk, $doNotDeleteImage);
        if ($request->hasFile($attribute_name)) {
            foreach ($request->file($attribute_name) as $file) {
                $convertExtensionTo = $file->getClientOriginalExtension();
                // $convertExtensionTo = $this->convertSpecialExtensionTo($file->getClientOriginalExtension());
                if ($file->isValid()) {
                    $new_file_name = md5($file->getClientOriginalName() . random_int(1, 9999) . time()) . '.' . $convertExtensionTo;
                    $file_path = $file->storeAs($destination_path, $new_file_name, $disk);
                    if ($thumbnail) { // Custom Core File
                        UploadLib::thumbnail(\Image::make(\Storage::disk($disk)->get($file_path)), $disk, $file_path);
                    }
                    if (!$mainImage) {
                        \Storage::disk($disk)->delete($file_path);
                    }
                    $attribute_value[] = $file_path;
                }
            }
        }
        $this->attributes[$attribute_name] = json_encode($attribute_value);
    }

    /**
     * return attribute value as array
     *
     * @param string|array $value
     * @return array
     */
    protected function attributeValueToArray($value)
    {
        $attributeValueToArray = $value;
        if (!is_array($value)) {
            $attributeValueToArray = json_decode($value, true) ?? [];
        }
        return $attributeValueToArray;
    }

    /**
     * filesToClear
     *
     * @param array $files_to_clear
     * @param array| $attribute_value
     * @param string $disk
     * @return array
     */
    protected function filesToClear($files_to_clear, $attribute_value, $disk = 'uploads', $doNotDeleteImage)
    {
        if ($files_to_clear && is_array($files_to_clear)) {

            foreach ($files_to_clear as $key => $filename) {
                $filename = parse_url($filename);
                $filename = ltrim($filename['path'], '/');
                if(!$doNotDeleteImage){
                    UploadLib::clearSingleThumbnail($disk, $filename);
                }
                // $attribute_value = Arr::where($attribute_value, function ($value, $key) use ($filename) {
                //     return $value != $filename;
                // });
                $attribute_value = collect(Arr::where($attribute_value, function ($value, $key) use ($filename) {
                    return $value != $filename;
                }))->values()->all();
            }
        }
        return $attribute_value;
    }

    /**
     * checkExtension
     *
     * @param string $value
     * @return string
     */
    protected function checkExtension($value)
    {
        $all_extensions = [
            'jpg', 'png', 'jpeg', 'pdf', 'docx', 'docm', 'dotx', 'dotm',
            'xlsx', 'xlsm', 'xltx', 'xltm', 'xlsb', 'xlam', 'pptx', 'pptm',
            'potx', 'potm', 'ppam', 'ppsx', 'ppsm', 'sldx', 'sldm', 'thmx'
        ];
        $extension = explode(";", explode("/", $value)[1])[0];
        if (in_array($extension, $all_extensions)) {
            return '.' . $extension;
        }
        return '.jpg';
    }


    //Profile
    public function getProfileSmallAttribute()
    {
        return $this->myFileExist($this->image, 'uploads_small');
    }

    public function getProfileMediumAttribute()
    {
        return $this->myFileExist($this->image, 'uploads_medium');
    }

    public function getProfileLargeAttribute()
    {
        return $this->myFileExist($this->image, 'uploads_large');
    }

    public function getProfileOriginalAttribute()
    {
        return $this->myFileExist($this->image, 'uploads');
    }

    // Property photo
    public function getPropertyPhotoSmallAttribute()
    {
        return $this->myFileExist($this->property_photo, 'uploads_small');
    }

    public function getPropertyPhotoMediumAttribute()
    {
        return $this->myFileExist($this->property_photo, 'uploads_medium');
    }

    public function getPropertyPhotoLargeAttribute()
    {
        return $this->myFileExist($this->property_photo, 'uploads_large');
    }

    public function getPropertyPhotoOriginalAttribute()
    {
        return $this->myFileExist($this->property_photo, 'uploads');
    }

    private function galleryToArr($path)
    {
        $arr = [];
        if (is_array($this->gallery)) {
            foreach ($this->gallery as $image) {
                $arr[] = $this->myFileExist($image, $path);
            }
        }
        return $arr;
    }

    private function identityToArr($path)
    {
        $arr = [];
        if (is_array($this->identity_card_photos)) {
            foreach ($this->identity_card_photos as $image) {
                $arr[] = $this->myFileExist($image, $path);
            }
        }
        return $arr;
    }

    private function titleDeedToArr($path)
    {
        $arr = [];
        if (is_array($this->title_deed_photos)) {
            foreach ($this->title_deed_photos as $image) {
                $arr[] = $this->myFileExist($image, $path);
            }
        }
        return $arr;
    }


    //Gallery
    public function getGallerySmallAttribute()
    {
        return $this->galleryToArr('uploads_small');
    }

    public function getGalleryMediumAttribute()
    {
        return $this->galleryToArr('uploads_medium');
    }
    //--------------------------
    public function getGalleryLargeAttribute()
    {
        return $this->galleryToArr('uploads_large');
    }

    public function getGalleryOriginalAttribute()
    {
        return $this->galleryToArr('uploads');
    }

    //Indentity_card_photos
    public function getIdentityCardPhotosSmallAttribute()
    {
        return $this->identityToArr('uploads_small');
    }

    public function getIdentityCardPhotosMediumAttribute()
    {
        return $this->identityToArr('uploads_medium');
    }

    public function getIdentityCardPhotosLargeAttribute()
    {
        return $this->identityToArr('uploads_large');
    }

    public function getIdentityCardPhotosOriginalAttribute()
    {
        return $this->identityToArr('uploads');
    }

    //Title_deed_photos
    public function getTitleDeedPhotosSmallAttribute()
    {
        return $this->titleDeedToArr('uploads_small');
    }

    public function getTitleDeedPhotosMediumAttribute()
    {
        return $this->titleDeedToArr('uploads_medium');
    }

    public function getTitleDeedPhotosLargeAttribute()
    {
        return $this->titleDeedToArr('uploads_large');
    }

    public function getTitleDeedPhotosOriginalAttribute()
    {
        return $this->titleDeedToArr('uploads');
    }

    public function convertSpecialExtensionTo($extension)
    {
        $extension = mb_strtolower($extension);

        switch ($extension) {
            case "heif-sequence":
            case "heic-sequence":
            case "heif_sequence":
            case "heic_sequence":
            case "heif":
            case "heic":
                $extension = 'jpg';
            break;
        }

        return $extension;
    }
}
