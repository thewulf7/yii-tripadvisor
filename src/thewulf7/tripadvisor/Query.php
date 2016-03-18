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

/**
 * Class Query
 *
 * @package thewulf7\tripadvisor
 */
class Query extends Component implements QueryInterface
{
    use QueryTrait;

    /**
     *  Simple api variant
     */
    const SIMPLE_API = 'SITEWIDE';

    /**
     *  Complex api variant
     */
    const COMPLEX_API = 'API';

    /**
     * @var string
     */
    private $action = 'API';

    /**
     * @var array
     */
    private $types = [];

    /**
     * @var bool
     */
    private $details = true;

    /**
     * @var string
     */
    private $query;

    /**
     * @var string
     */
    private $lang = 'en';

    /**
     * @var array
     */
    public static $available_types = ['geo', 'eat', 'attr', 'hotel'];

    /**
     * Get Action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param bool $simple
     *
     * @return Query
     */
    public function setAction($simple = false)
    {
        $this->action = $simple ? self::SIMPLE_API : self::COMPLEX_API;

        return $this;
    }

    /**
     * Get Types
     *
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Add type
     *
     * @param string $type
     *
     * @return Query
     */
    public function addType($type)
    {
        if (in_array($type, self::$available_types, true))
        {
            $this->types[] = $type;
        }

        return $this;
    }

    /**
     * Remove type
     *
     * @param $type
     *
     * @return $this
     */
    public function removeType($type)
    {
        $key = array_search($type, $this->types, true);

        if ($key !== false && in_array($type, self::$available_types, true))
        {
            unset($this->types[$key]);
        }

        return $this;
    }

    /**
     * Get Details
     *
     * @return boolean
     */
    public function isDetails()
    {
        return $this->details;
    }

    /**
     * Set details
     *
     * @param boolean $details
     *
     * @return Query
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get Query
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Set query
     *
     * @param string $query
     *
     * @return Query
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get Lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set lang
     *
     * @param string $lang
     *
     * @return Query
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * @param Connection|null $db
     *
     * @return Command
     * @throws \yii\base\InvalidConfigException
     */
    public function createCommand(Connection $db = null)
    {
        if ($db === null)
        {
            $db = \Yii::$app->get('tripadvisor');
        }

        $commandConfig = $db->getQueryBuilder()->build($this);

        return $db->createCommand($commandConfig);
    }

    /**
     * @param null $db
     */
    public function all($db = null)
    {
        $result = $this->createCommand($db)->search();
    }

    /**
     * @param null $db
     */
    public function one($db = null)
    {
        $result = $this->createCommand($db)->search();
    }

    /**
     * @param string $q
     * @param null   $db
     */
    public function count($q = '*', $db = null)
    {
        $result = $this->createCommand($db)->search();
    }

    /**
     * @param null $db
     */
    public function exists($db = null)
    {
        $result = $this->createCommand($db)->search();
    }
}