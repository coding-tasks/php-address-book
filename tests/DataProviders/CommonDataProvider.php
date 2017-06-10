<?php

namespace App\Tests\DataProviders;

class CommonDataProvider
{
    /**
     * Get data for name search.
     *
     * @return array
     */
    public function getDataForNameSearch() : array
    {
        return [
            ['Hank', 2],
            ['HaNK', 2],
            ['francis', 2],
            ['Francis', 2],
            ['Tammy', 1],
            ['Ankit', 0],
            ['', 0],
            ['     ', 0],
            [' Jim ', 1],
            ['Jim Lee', 1],
            ['Jim    Lee', 1],
            ['Jer Lewis ', 0],
            ['Karen Donna', 0],
            [' Jim ', 1],
            [' Mack ', 1],
            ['RALPH LAUREN', 1],
        ];
    }

    /**
     * Get data for name search.
     *
     * @return array
     */
    public function getDataForEmailSearch() : array
    {
        return [
            ['hank@francis.com', 1],
            ['HANK@aaron.com', 1],
            ['hank', 2],
            ['francis', 0],
            ['jim@lee.com', 1],
            ['hello', 0],
            ['ha', 0],
            ['', 0],
        ];
    }
}
