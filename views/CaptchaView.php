<?php

class CaptchaView extends View
{
    private $fontsDir = 'captcha_resources/fonts/';
    private $backgroundsDir = 'captcha_resources/backgrounds/';
    private static $dirCache = array();

    public function render($controller)
    {
        $code = $controller->viewVars["code"];

        /**
         * The next part is orginnaly written by ted from mastercode.nl and modified for using in this mod.
         **/

        header("content-type:image/png");
        header('Cache-control: no-cache, no-store');

        $width = 100;
        $height = 30;

        $img = imagecreatefrompng(self::backgroundImage());

        // add noise
        for ($i = 0; $i < 1; $i++) {
            $horizontal_progress = 0;
            $vertical_pos = rand(1, $height / 2);
            do {
                $horizontal_step_size = floor(rand(1, $width / 5));

                imageline($img, $horizontal_progress, $vertical_pos, ($horizontal_progress += $horizontal_step_size), ($vertical_pos = rand(1, $height)), self::color("tekst"));
            } while ($horizontal_progress < $width);
        }

        $background = imagecolorallocate($img, self::color("bg"), self::color("bg"), self::color("bg"));

        for ($g = 0; $g < 30; $g++) {
            $t = rand(10, 20);
            $t = $t[0];

            $ypos = rand(0, $height);
            $xpos = rand(0, $width);

            $kleur = imagecolorallocate($img, self::color("bgtekst"), self::color("bgtekst"), self::color("bgtekst"));

            imagettftext($img, self::size(), self::move(), $xpos, $ypos, $kleur, self::font(), $t);
        }

        $stukje = $width / (strlen($code) + 3) + 5;

        for ($j = 0; $j < strlen($code); $j++) {
            $tek = $code[$j];
            $ypos = rand(23, 27);
            $xpos = $stukje * ($j + 1) - 5;

            $color2 = imagecolorallocate($img, self::color("tekst"), self::color("tekst"), self::color("tekst"));

            imagettftext($img, self::size(), self::move(), $xpos, $ypos, $color2, self::font(), $tek);
        }

        imagepng($img);
        imagedestroy($img);
    }
    /**
     * Some functions :)
     * Also orginally written by mastercode.nl
     **/

    /**
     * Function to create a random color
     * @auteur mastercode.nl
     * @param $type string Mode for the color
     * @return int
     **/
    private static function color($type)
    {
        switch ($type) {
            case "bg":
                $color = rand(224, 255);
                break;

            case "tekst":
                $color = rand(0, 127);
                break;

            case "bgtekst":
                $color = rand(200, 224);
                break;

            default:
                $color = rand(0, 255);
                break;
        }
        return $color;
    }

    /**
     * Function to ranom the size
     * @auteur mastercode.nl
     * @return int
     **/
    private static function size()
    {
        return rand(18, 22);
    }

    /**
     * Function to random the posistion
     * @auteur mastercode.nl
     * @return int
     **/
    private static function move()
    {
        return rand(-22, 22);
    }

    /**
     * Function to return a ttf file from fonts map
     * @auteur mastercode.nl
     * @return string
     **/
    function randomFileByExt($dir, $ext)
    {
        $f = opendir($dir);

        if (empty(self::$dirCache[$dir])) {
            $ar = array();
            while (($file = @readdir($f)) !== false) {
                if (!in_array($file, array('.', '..')) && substr_compare($file, $ext, -strlen($ext)) == 0) {
                    $ar[] = $file;
                }
            }

            self::$dirCache[$dir] = $ar;
        } else {
            $ar = self::$dirCache[$dir];
        }

        if (count($ar)) {
            $i = rand(0, (count($ar) - 1));
            return $dir . $ar[$i];
        }
    }

    private function backgroundImage()
    {
        return self::randomFileByExt(Config::get("VIEWS_PATH") . $this->backgroundsDir, ".png");
    }

    private function font()
    {
        return self::randomFileByExt(Config::get("VIEWS_PATH") . $this->fontsDir, ".ttf");
    }
}
