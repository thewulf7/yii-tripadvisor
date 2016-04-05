<?php


/**
 * Class CommandTest
 */
class QueryTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var \thewulf7\tripadvisor\Connection
     */
    private $tripAdvisor;

    /**
     *
     */
    public function setUp()
    {
        $this->tripAdvisor = new \thewulf7\tripadvisor\Connection();
        date_default_timezone_set('UTC');
    }

    /**
     *
     */
    public function testQuery()
    {
        $query = new \thewulf7\tripadvisor\Query();

        $query
            ->setAction()
            ->addType('geo')
            ->setQuery('Los Angeles')
            ->setDetails(false);

        $searchResults = $query->createCommand($this->tripAdvisor)->search();

        self::assertNotEmpty($searchResults);
        self::assertInstanceOf(\thewulf7\tripadvisor\Object::className(), $searchResults[0]);
    }

    /**
     *
     */
    public function testQueryWithDifferentLang()
    {
        $query = new \thewulf7\tripadvisor\Query();

        $query
            ->setAction()
            ->setLang('ru')
            ->addType('geo')
            ->setQuery('Москва')
            ->setDetails(false);

        //russian
        $searchResults = $query->createCommand($this->tripAdvisor)->search();

        self::assertNotEmpty($searchResults);
        self::assertInstanceOf(\thewulf7\tripadvisor\Object::className(), $searchResults[0]);
        self::assertEquals('Москва, Россия, Европа', $searchResults[0]->name);
    }

    /**
     *
     */
    public function testQueryWithDifferentTypes()
    {
        $types = \thewulf7\tripadvisor\Query::$available_types;

        foreach($types as $type)
        {
            $query = new \thewulf7\tripadvisor\Query();

            $query
                ->setAction()
                ->setLang('ru')
                ->addType($type)
                ->setQuery('New York')
                ->setDetails(false);

            //russian
            $searchResults = $query->createCommand($this->tripAdvisor)->search();

            self::assertNotEmpty($searchResults);
            self::assertInstanceOf(\thewulf7\tripadvisor\Object::className(), $searchResults[0]);

            switch($type)
            {
                case 'eat':
                    $typeName = 'eatery';
                    break;
                case 'attr':
                    $typeName = 'attraction';
                    break;
                default:
                    $typeName = $type;
                    break;
            }

            self::assertEquals(strtoupper($typeName), $searchResults[0]->type);
        }
    }

    /**
     *
     */
    public function testQueryWithEmptyResult()
    {
        $query = new \thewulf7\tripadvisor\Query();

        $query
            ->setAction()
            ->setLang('ru')
            ->addType('geo')
            ->setQuery('empty')
            ->setDetails(false);

        //russian
        $searchResults = $query->createCommand($this->tripAdvisor)->search();

        self::assertEmpty($searchResults);
    }

    public function testQueryGetOne()
    {
        $query = new \thewulf7\tripadvisor\Query();

        $query
            ->setAction()
            ->setLang('ru')
            ->addType('geo')
            ->setQuery('Prague')
            ->setDetails(false);

        //russian
        $searchResult = $query->one($this->tripAdvisor);

        self::assertInstanceOf(\thewulf7\tripadvisor\Object::className(), $searchResult);
    }
}
