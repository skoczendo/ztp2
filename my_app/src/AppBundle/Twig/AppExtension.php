<?php
namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('comma', [$this, 'addCommas']),
        ];
    }

    public function addCommas($something, $sep = ',')
    {
        return $something.$sep;
    }
}
