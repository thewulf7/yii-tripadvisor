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
    const URL = "http://www.tripadvisor.";

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
     * @param array  $query
     * @param string $domain
     *
     * @return string
     */
    public function makeRequest($query, $domain = 'com')
    {
        $baseUrl = self::URL . $domain . DIRECTORY_SEPARATOR . $this->path . '?';

        return file_get_contents($baseUrl . $query);
    }

    /**
     * @param string $lang
     *
     * @return string
     */
    public static function getDomain($lang = 'en')
    {
        switch ($lang)
        {
            case 'ru':
                $sResult = 'ru';
                break;
            case 'en':
            default:
                $sResult = 'com';
                break;
        }

        return $sResult;
    }
}