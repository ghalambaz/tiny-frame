<?php
declare(strict_types=1);

namespace App\controllers;

use Core\Kernel\ControllerAbstract;

class Blog extends ControllerAbstract
{
    public function page($west = 'w', $day, $year, $month, $east = 'e')
    {
        return $this->render('blog/page.html.twig',
            ['text' => 'Ali',
                'west' => $west,
                'year' => $year,
                'month' => $month,
                'day' => $day,
                'east' => $east]
        );
    }

}