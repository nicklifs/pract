<?php
    interface FigureInterface {
        public function printToScreen( );
        public function move($x,$y);
        public function zoom($rate);
        public function getSquare( );
    }

    abstract class Figure implements FigureInterface
    {
        public $x = 0, $y = 0;
    }

    class Rectangle extends Figure  {
        public $a, $b, $zoom;

        function __construct($a, $b, $zoom = 0) {
            $this->a = $a;
            $this->b = $b;
            $this->zoom = $zoom/100 + 1;
        }

        public function printToScreen( ){
            $hZoom = ( $this->zoom > 1) ? $this->zoom * $this->b : $this->b;
            $image = imagecreatetruecolor($this->a + $this->x + 10 + $this->a * $this->zoom,
                $this->y + $hZoom );

            // do transparency = 100%
            imagesavealpha($image, true);		//save alpha channel
            $trans_colour = imagecolorallocatealpha($image, 0, 0, 0, 127);
            imagefill($image, 0, 0, $trans_colour);		//fill image

            //draw rectangles
            $color = imagecolorallocate($image, 200, 200, 200);
            imagefilledrectangle($image, $this->x, $this->y,
                $this->a + $this->x, $this->b + $this->y, $color);


            if ($this->zoom != 1)
                imagefilledrectangle($image, $this->a + $this->x + 10, $this->y,
                    $this->a + $this->x + 10 + $this->a * $this->zoom,
                    $this->y + $hZoom, 	$color);

            // create file image.png
            imagepng($image, "image.png");
            imagedestroy($image);
        }

        public function move($x,$y){
            $this->x = $x;
            $this->y = $y;
        }

        public function zoom($zoom){
            $this->zoom = $zoom;
        }

        public function getSquare( ){
            return $this->a * $this->b;
        }
    }

class Triangle extends Figure  {
    public $r,$cords;

    function __construct($x1, $y1, $x2, $y2, $x3, $y3, $zoom = 0) {
        $this->cords = array($x1, $y1, $x2, $y2, $x3, $y3);
        //echo '<br>arr :'."$x1, $y1, $x2, $y2, $x3, $y3";
        $this->zoom = $zoom/100 + 1;
    }

    private function getNew($m1, $m2)
    {
        return $m2 + ($m2 - $m1) * ($this->zoom - 1);
    }

    public function printToScreen( ){
        $x1 = $this->cords[0];      $y1 = $this->cords[1];
        $x2 = $this->cords[2];      $y2 = $this->cords[3];
        $x3 = $this->cords[4];      $y3 = $this->cords[5];

        // find len shift figure1
        $minX = min($x1,$x2,$x3);       $shiftX = $this->x - $minX;
        $minY = min($y1,$y2,$y3);       $shiftY = $this->y - $minY;

        // find cords for zoom figure
        if ($minY==$y1)
        {
            $x1New = $x1;   $y1New = $y1;
            $x2New = $this->getNew($x1,$x2);
            $y2New = $this->getNew($y1,$y2);
            $x3New = $this->getNew($x1,$x3);
            $y3New = $this->getNew($y1,$y3);
        }
        else  if ($minY==$y2)
        {
            $x1New = $x2;   $y1New = $y2;
            $x2New = $this->getNew($x2,$x1);
            $y2New = $this->getNew($y2,$y1);
            $x3New = $this->getNew($x2,$x3);
            $y3New = $this->getNew($y2,$y3);
        }
        else   if ($minY==$y3)
        {
            $x1New = $x3;   $y1New = $y3;
            $x2New = $this->getNew($x3,$x2);
            $y2New = $this->getNew($y3,$y2);
            $x3New = $this->getNew($x3,$x1);
            $y3New = $this->getNew($y3,$y1);
        }

        // find width and height area for figure
        $maxX = max($x1,$x2,$x3);       $width1 = $maxX - $minX;
        $maxY = max($y1,$y2,$y3);       $height1 = $maxY - $minY;

        // find width and height area for zoom figure
        $width2 = max($x1New,$x2New,$x3New) - min($x1New,$x2New,$x3New);
        $height2 = max($y1New,$y2New,$y3New) - min($y1New,$y2New,$y3New);;

        // find len shift zoom figure
        $shiftX1 = $shiftX + $width1 + 20 ;
        $shiftY1 = $shiftY;

        // create image
        $image = imagecreatetruecolor($width1 + 20 + $width2 + $this->x, (($height2 > $height1)? $height2: $height1)+$this->y );

        // do transparency = 100%
        imagesavealpha($image, true);		//save alpha channel
        $trans_colour = imagecolorallocatealpha($image, 0, 0, 0, 127);
        imagefill($image, 0, 0, $trans_colour);		//fill image


        $color = imagecolorallocate($image, 200, 200, 200);
        imagefilledpolygon($image, array($x1 + $shiftX, $y1 + $shiftY,
                                            $x2 + $shiftX, $y2 + $shiftY,
                                                $x3 + $shiftX, $y3 + $shiftY), 3, $color);
        if ($this->zoom!=1)
        imagefilledpolygon($image, array($x1New + $shiftX1, $y1New + $shiftY1,
                                            $x2New + $shiftX1, $y2New + $shiftY1,
                                                $x3New + $shiftX1, $y3New + $shiftY1), 3, $color);

        // create file image.png
        imagepng($image, "image.png");
        imagedestroy($image);
    }

    public function move($x,$y){
        $this->x = $x;
        $this->y = $y;
        //echo "<br> x = $this->x y = $this->x <br>";
    }

    public function zoom($zoom){
        $this->zoom = $zoom;
    }


    private function getLen($x1, $y1, $x2, $y2 ){
        //echo '<br>'.$y1.'  '.  $y2 . '<br>';
        if ($y1 == $y2) return abs($x1 - $x2);
        else
        {
            if ($x1 == $x2) return abs($y1 - $y2);
            else return bcsqrt(pow(abs($x1 - $x2), 2) + pow(abs($y1 - $y2), 2));
        }
    }

    public function getSquare( ){
        $a = $this->getLen($this->cords[0], $this->cords[1], $this->cords[2], $this->cords[3]);
        $b = $this->getLen($this->cords[0], $this->cords[1], $this->cords[4], $this->cords[5]);
        $c = $this->getLen($this->cords[2], $this->cords[3], $this->cords[4], $this->cords[5]);
        echo "Cтороны: $a $b $c<br>";
        $p = ($a + $b + $c)/2;
        $s = bcsqrt($p*($p-$a)*($p-$b)*($p-$c),2);
        //return 'abc: '.$a .' '. $b . ' ' . $c . '<br';
        return round($s);
    }
}

class Circle extends Figure  {
    public $r;

    function __construct($r, $zoom = 0) {
        $this->r = $r;
        $this->zoom = $zoom/100 + 1;
    }

    public function printToScreen( ){
        $hZoom = ( $this->zoom > 1) ? $this->zoom * $this->r * 2 : 2 * $this->r;
        $image = imagecreatetruecolor($this->r * 2 + $this->x + 10 + $this->r * 2 * $this->zoom,
            $this->y + $hZoom );

        // do transparency = 100%
        imagesavealpha($image, true);		//save alpha channel
        $trans_colour = imagecolorallocatealpha($image, 0, 0, 0, 127);
        imagefill($image, 0, 0, $trans_colour);		//fill image


        //draw rectangles
        $d = 2 * $this->r;
        $color = imagecolorallocate($image, 200, 200, 200);
        imagefilledellipse($image, $this->x + $this->r, $this->y + $this->r, $d, $d, $color);

        if ($this->zoom != 1)
            imagefilledellipse($image, $this->x + $this->r*2 + 10 + $d/2*$this->zoom,
                                            $this->y  + $this->r*$this->zoom ,
                                    $d*$this->zoom, $d*$this->zoom, $color);

        // create file image.png
        imagepng($image, "image.png");
        imagedestroy($image);
    }

    public function move($x,$y){
        $this->x = $x;
        $this->y = $y;
    }

    public function zoom($zoom){
        $this->zoom = $zoom;
    }

    public function getSquare( ){
        return $this->r * $this->r * 3.14;
    }
}
?>