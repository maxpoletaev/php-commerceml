<?php namespace Zenwalker\CommerceML\ORM;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Collection $collection
     */
    private $collection;

    /**
     * @var array $source
     */
    private $source;

    /**
     * @return void
     */
    private function buildEnvironment()
    {
        $this->source = array(
            'a1' => (object) array('id' => 'a1', 'prop1' => 'val1', 'prop2' => 2),
            'a2' => (object) array('id' => 'a2', 'prop1' => 'val1', 'prop2' => 3)
        );

        $this->collection = new Collection($this->source);
    }

    /**
     * @test Collection::fetch()
     */
    public function testFetch()
    {
        $this->buildEnvironment();

        $expect = $this->source;
        $result = $this->collection->fetch();

        $this->assertEquals($result, $expect);
    }

    /**
     * @test Collection::add()
     */
    public function testAdd()
    {
        $this->buildEnvironment();

        $this->source['a3'] = $this->source['a1'];
        $this->source['a3']->id = 'a3';

        $this->collection->add($this->source['a1']);

        $this->assertEquals($this->collection->fetch(), $this->source);
    }

    /**
     * @test Collection::filter()
     */
    public function testFilter()
    {
        $this->buildEnvironment();

        $result = $this->collection->filter('prop2', '>', 2)->fetch();
        $expect = $this->source;
        unset($expect['a1']);

        $this->assertEquals($expect, $result);

        $result = $this->collection->filter('prop2', '>=', 2)->fetch();
        $expect = $this->source;

        $this->assertEquals($expect, $result);
    }

    /**
     * @test Collection::first()
     */
    public function testFirst()
    {
        $this->buildEnvironment();

        $result = $this->collection->first();
        $expect = $this->source['a1'];

        $this->assertEquals($expect, $result);
    }

    /**
     * @test Collection::get()
     */
    public function testGet()
    {
        $this->buildEnvironment();

        $result = $this->collection->get('a1');
        $expect = $this->source['a1'];

        $this->assertEquals($expect, $result);
    }

    /**
     * @test Collection::remove()
     */
    public function testRemove()
    {
        $this->buildEnvironment();

        $expect = $this->source;
        unset($expect['a1']);

        $result = $this->collection->remove('a1')->fetch();

        $this->assertEquals($expect, $result);
    }

    /**
     * @test Collection::isEmpty()
     */
    public function testIsEmpty()
    {
        $collection = new Collection();

        $expect = true;
        $result = $collection->isEmpty();

        $this->assertEquals($expect, $result);
    }
}
