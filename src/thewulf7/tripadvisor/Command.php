<?php
/**
 * yii-tripadvisor.Command.php
 * User: johnnyutkin
 * Date: 18.03.16
 * Time: 11:45
 */

namespace thewulf7\tripadvisor;


use yii\base\Component;

/**
 * Class Command
 *
 * @package thewulf7\tripadvisor
 */
class Command extends Component
{
    /**
     * @var Connection
     */
    public $db;

    /**
     * @var array
     */
    public $queryParams;

    /**
     * @var string
     */
    public $lang = 'en';

    /**
     *
     */
    public function search()
    {
        $query = http_build_query($this->queryParams);

        $content = $this->db->makeRequest($query, $this->getDomain());

        return json_decode($content);
    }

    protected function getDomain()
    {
        return 'com';
    }
}