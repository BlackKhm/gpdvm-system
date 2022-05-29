<?php

namespace App\Liberies\uploads;
use Storage;
use Illuminate\Support\Str;

class UploadLib
    {
        protected static $small = 'small';
        protected static $medium = 'medium';
        protected static $large = 'large';


        protected static function autoResizeWatermark($watermark, $widthFromImage, $heightFromImage)
        {
            $watermark =  \Image::make($watermark);
            $configPercent = config('const.upload_lib.watermark_percentage') ?? 10;
            $resizeFromImageWidth = $widthFromImage * ($configPercent / 100);
            $resizeFromImageHeight = $heightFromImage * ($configPercent / 100);
                $width = $watermark->width();
                $height = $watermark->height();
                if ($width > $height) {
                    $watermark->resize($resizeFromImageWidth, null, function($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                } else {
                    $watermark->resize(null, $resizeFromImageHeight, function($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }
            $watermark->opacity(config('const.upload_lib.watermark_opacity') ?? 50);
            return $watermark;
        }
        
        public static function thumbnail($image, $disk, $pathToFile, $watermark = false)
        {
            $small = config('const.upload_lib.thumbnail_small') ?? 150;
            $medium = config('const.upload_lib.thumbnail_medium') ?? 420;
            $large = config('const.upload_lib.thumbnail_large') ?? 840;
            if ($watermark) { // under maintanent not ready
                $width = $image->width();
                $height = $image->height();
                if (config('const.upload_lib.watermark_image')) {
                    $newWatermark = self::autoResizeWatermark(config('const.upload_lib.watermark_image'), $width, $height);
                    $x = config('const.upload_lib.watermark_offset_x') ?? 0;
                    $y = config('const.upload_lib.watermark_offset_y') ?? 0;
                    $position = config('const.upload_lib.watermark_position') ?? 'top-left';
                    $image->insert($newWatermark, $position, $x, $y);
                }
            }
            self::autoResizeThumb($image, $disk.'_'.self::$large, $pathToFile, $large);
            self::autoResizeThumb($image, $disk.'_'.self::$medium, $pathToFile, $medium);
            self::autoResizeThumb($image, $disk.'_'.self::$small, $pathToFile, $small);
        }

        public static function clearSingleThumbnail($disk, $pathToFile)
        {
            if (!empty($pathToFile)) {
                if (\Storage::disk($disk)->exists($pathToFile)) {
                    \Storage::disk($disk)->delete($pathToFile);
                }
                if (\Storage::disk($disk.'_'.self::$small)->exists($pathToFile)) {
                    \Storage::disk($disk.'_'.self::$small)->delete($pathToFile);
                }
                if (\Storage::disk($disk.'_'.self::$medium)->exists($pathToFile)) {
                    \Storage::disk($disk.'_'.self::$medium)->delete($pathToFile);
                }
                if (\Storage::disk($disk.'_'.self::$large)->exists($pathToFile)) {
                    \Storage::disk($disk.'_'.self::$large)->delete($pathToFile);
                }
            }
        }
        protected static function autoResizeThumb($image, $disk, $pathToFile, $size)
            {
                if (!\Storage::disk($disk)->exists($pathToFile)) {
                    $width = $image->width();
                    $height = $image->height();
                    if ($width > $height) {
                        $image->resize($size, null, function($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });
                    } else {
                        $image->resize(null, $size, function($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });
                    }
                    \Storage::disk($disk)->put($pathToFile, $image->stream());
                }
            }
    }
    

?>