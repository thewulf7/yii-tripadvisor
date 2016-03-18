<?php
/**
 * yii-tripadvisor.Query.php
 * User: johnnyutkin
 * Date: 18.03.16
 * Time: 11:45
 */

namespace thewulf7\tripadvisor;


use yii\base\Component;
use yii\db\QueryInterface;
use yii\db\QueryTrait;

class Query extends Component implements QueryInterface
{
    use QueryTrait;

    /**
     * @param null $db
     */
    public function all($db = null)
    {
    }

    /**
     * @param null $db
     */
    public function one($db = null)
    {
    }

    /**
     * @param string $q
     * @param null   $db
     */
    public function count($q = '*', $db = null)
    {
    }

    /**
     * @param null $db
     */
    public function exists($db = null)
    {
    }
}