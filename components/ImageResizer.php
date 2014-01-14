<?php
/**
 * Arfooo
 * 
 * @package    Arfooo
 * @copyright  Copyright (c) Arfooo Annuaire (fr) and Arfooo Directory (en)
 *             by Guillaume Hocine (c) 2007 - 2010
 *             http://www.arfooo.com/ (fr) and http://www.arfooo.net/ (en)
 * @author     Guillaume Hocine & Adrian Galewski
 * @license    http://creativecommons.org/licenses/by/2.0/fr/ Creative Commons
 */


class ImageResizer
{
    function resize($srcPath, $dstPath, $newWidth, $newHeight, $proporcion = true, $fixedSize = false)
    {
        $srcImage = new Image($srcPath);

        $newTotalWidth = $newWidth;
        $newTotalHeight = $newHeight;

        if ($proporcion) {
            $scale = max($srcImage->getWidth() / $newWidth, $srcImage->getHeight() / $newHeight);

            $newWidth = floor($srcImage->getWidth() / $scale);
            $newHeight = floor($srcImage->getHeight() / $scale);
        }

        $dstImage = new Image();

        if ($fixedSize) {
            $dstImage->createNew($newTotalWidth, $newTotalHeight);
            $whiteIndex = imagecolorallocate($dstImage->im, 255, 255, 255);
            imagefill($dstImage->im, 0, 0, $whiteIndex);
        } else {
            $dstImage->createNew($newWidth, $newHeight);
        }

        $transparentIndex = imagecolortransparent($srcImage->im);

        if ($transparentIndex >= 0) {
            $transparentColor = imagecolorsforindex($srcImage->im, $transparentIndex);
            $transparentIndex = imagecolorallocate($dstImage->im, $transparentColor['red'], $transparentColor['green'], $transparentColor['blue']);
            imagefill($dstImage->im, 0, 0, $transparentIndex);
            imagecolortransparent($dstImage->im, $transparentIndex);
        }

        if ($fixedSize) {
            $horizontalMargin = ($newTotalWidth - $newWidth) / 2;
            $verticalMargin = ($newTotalHeight - $newHeight) / 2;
        } else {
            $horizontalMargin = 0;
            $verticalMargin = 0;
        }

        imagecopyresampled($dstImage->im, $srcImage->im, $horizontalMargin, $verticalMargin, 0, 0, $newWidth, $newHeight, $srcImage->getWidth(), $srcImage->getHeight());

        $dstImage->setPath($dstPath);
        $dstImage->saveToFile();

    }

    function addTag($srcPath, $dstPath)
    {
        $srcImage = new Image($srcPath);

        $tagImagePath = CODE_ROOT_DIR . "uploads/custom/" . Config::get("watermarkImageSrc");

        if (!file_exists($tagImagePath)) {
            return;
        }

        $tagImage = new Image($tagImagePath);

        list ($posV, $posH) = explode(",", Config::get("imageWatermarkPosition"));

        $tagMarginH = 5;
        $tagMarginV = 5;

        if ($posH == "l") {
            $tagPositionX = 0 + $tagMarginH;
        } else {
            $tagPositionX = max($srcImage->getWidth() - $tagImage->getWidth() - $tagMarginH, 0);
        }
        if ($posV == "t") {
            $tagPositionY = 0 + $tagMarginV;
        } else {
            $tagPositionY = max($srcImage->getHeight() - $tagImage->getHeight() - $tagMarginV, 0);
        }
        imagecopyresampled($srcImage->im, $tagImage->im, $tagPositionX, $tagPositionY, 0, 0, $tagImage->getWidth(), $tagImage->getHeight(), $tagImage->getWidth(), $tagImage->getHeight());

        $srcImage->setPath($dstPath);
        $srcImage->saveToFile();
    }
}
