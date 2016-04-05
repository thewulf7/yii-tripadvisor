<?php


/**
 * Class CommandTest
 */
class CommandTest extends PHPUnit_Framework_TestCase
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
    public function testCommand()
    {
        $searchResults = $this->tripAdvisor->createCommand()->search('Los Angeles');

        self::assertNotEmpty($searchResults);
        self::assertInstanceOf(\thewulf7\tripadvisor\Object::className(), $searchResults[0]);
    }

    /**
     *
     */
    public function testCommandWithDifferentLang()
    {
        //russian
        $searchResults = $this->tripAdvisor->createCommand()->search('Москва', 'geo', 'ru');

        self::assertNotEmpty($searchResults);
        self::assertInstanceOf(\thewulf7\tripadvisor\Object::className(), $searchResults[0]);
        self::assertEquals('Москва, Россия, Европа', $searchResults[0]->name);
    }

    /**
     *
     */
    public function testCommandWithDifferentTypes()
    {
        $types = \thewulf7\tripadvisor\Query::$available_types;

        foreach($types as $type)
        {
            $searchResults = $this->tripAdvisor->createCommand()->search('New York', $type);

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
    public function testCommandWithEmptyResult()
    {
        $searchResults = $this->tripAdvisor->createCommand()->search('Empty');

        self::assertEmpty($searchResults);
    }
}
