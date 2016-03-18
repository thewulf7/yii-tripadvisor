<?php

/**
 * yii-tripadvisor.Connection.php
 * User: johnnyutkin
 * Date: 18.03.16
 * Time: 11:42
 */

namespace thewulf7\tripadvisor;

use \yii\base\Component;

class Connection extends Component
{
    /**
     * @var string
     */
    protected $url = "http://www.tripadvisor.com/TypeAheadJson";

    /**
     *
     */
    public function init()
    {

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
}