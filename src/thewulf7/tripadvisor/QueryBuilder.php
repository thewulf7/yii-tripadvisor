<?php
/**
 * yii-tripadvisor.QueryBuilder.php
 * User: johnnyutkin
 * Date: 18.03.16
 * Time: 11:46
 */

namespace thewulf7\tripadvisor;


class QueryBuilder extends \yii\base\Object
{
    /**
     * QueryBuilder constructor.
     *
     * @param Connection $connection
     * @param array      $config
     */
    public function __construct(Connection $connection, $config = [])
    {
        $this->db = $connection;
        parent::__construct($config);
    }

    /**
     * Build the query
     *
     * @param Query $query
     *
     * @return array
     */
    public function build(Query $query)
    {
        return [
            'queryParams' => [
                'action'  => $query->getAction(),
                'types'   => implode(',', $query->getTypes()),
                'query'   => $query->getQuery(),
                'details' => $query->isDetails(),
            ],
            'lang'        => $query->getLang(),
        ];
    }
}