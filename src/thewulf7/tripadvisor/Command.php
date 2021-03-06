<?php
/**
 * yii-tripadvisor.Command.php
 * User: johnnyutkin
 * Date: 18.03.16
 * Time: 11:45
 */

namespace thewulf7\tripadvisor;

use yii\base\Component;
use yii\base\Object;

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
    public $lang = 'eng';

    /**
     * @param string   $string
     * @param string   $type
     * @param string $lang
     *
     * @return array
     */
    public function search($string = false, $type = false, $lang = 'eng')
    {
        if ($string)
        {
            $query = new Query();

            $query
                ->setAction()
                ->setQuery($string)
                ->setLang($lang)
                ->addType($type ?: 'geo');

            $params = $this->db->getQueryBuilder()->build($query);

            $this->queryParams = $params['queryParams'];
            $this->lang        = $params['lang'];
        }

        $query = http_build_query($this->queryParams);

        $content = $this->db->makeRequest($query, $this->db->getDomain($this->lang));

        $arResult = json_decode($content, true);

        return array_map(function ($arItem)
        {
            return new Object($arItem);
        }, $arResult['results']);
    }
}
