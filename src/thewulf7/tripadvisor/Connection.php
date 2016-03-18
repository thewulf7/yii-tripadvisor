<?php

/**
 * yii-tripadvisor.Connection.php
 * User: johnnyutkin
 * Date: 18.03.16
 * Time: 11:42
 */

namespace thewulf7\tripadvisor;

use \yii\base\Component;

/**
 * Class Connection
 *
 * @package thewulf7\tripadvisor
 */
class Connection extends Component
{
    /**
     * @var string
     */
    protected $url = "http://www.tripadvisor.";

    /**
     * @var string
     */
    protected $path = 'TypeAheadJson';

    /**
     *
     */
    public function init()
    {
        //init here
    }

    /**
     * @param array $config
     *
     * @return Command
     */
    public function createCommand($config = [])
    {
        $config['db'] = $this;

        return new Command($config);
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder()
    {
        return new QueryBuilder($this);
    }

    /**
     * @param array $query
     * @param string $domain
     *
     * @return string
     */
    public function makeRequest($query, $domain = 'com')
    {
        $baseUrl = $this->url . $domain . DIRECTORY_SEPARATOR . $this->path . '?';

        return file_get_contents($baseUrl . $query);
    }
}