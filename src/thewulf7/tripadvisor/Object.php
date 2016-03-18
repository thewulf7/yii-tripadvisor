<?php
/**
 * yii-tripadvisor.Object.php
 * User: johnnyutkin
 * Date: 18.03.16
 * Time: 12:20
 */

namespace thewulf7\tripadvisor;


use PHPHtmlParser\Dom;

/**
 * Class Object
 *
 * @package thewulf7\tripadvisor
 */
class Object extends \yii\base\Object
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $data_type;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $scope;

    /**
     * @var array
     */
    public $details;

    /**
     * @var int
     */
    public $value;

    /**
     * @var string
     */
    public $coords;

    /**
     * @var array
     */
    public $urls;

    /**
     * @return string
     */
    public function getContent($lang = 'en')
    {
        $baseUrl = Connection::URL . Connection::getDomain($lang);

        $dom = new Dom();
        $dom->loadFromUrl($baseUrl . $this->url);
        $html = $dom->find('.ermb_text .content');

        return $html[0]->text;
    }
}