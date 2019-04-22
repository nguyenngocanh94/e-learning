<?php


namespace common\utilities;


class Time
{
    public $minutes;
    public $seconds;
    public $miliseconds;

    public function __construct($minutes, $seconds, $miliseconds)
    {
        $this->minutes = $minutes;
        $this->seconds = $seconds;
        $this->miliseconds = $miliseconds;
    }

    /**
     * return NOW
     * @return false|string
     */
    public static function Now(){
        return date('Y-m-d h:i:s');
    }

    /**
     * @param $time1
     * @param $time2
     * @return Time
     */
    public static function Sum(Time $time1,Time $time2){
        $milisecond = $time1->miliseconds + $time2->miliseconds;
        $seconds = $time1->seconds + $time2->seconds;
        $mimutes = $time1->minutes + $time2->minutes;
        if ($milisecond > 99){
            $milisecond = $milisecond-99;
            $seconds++;
        }
        if ($seconds > 59){
            $seconds = $seconds-59;
            $mimutes++;
        }


        return new Time($mimutes, $seconds, $milisecond);
    }

    public static function Time($time){
        if ($time == null){
            return new Time(0,0,0);
        }
        $ser = explode (':', $time);
        return new Time($ser[0],$ser[1],$ser[2]);
    }

    public function toString(){
        return $this->minutes.':'.$this->seconds.':'.$this->miliseconds;
    }
}