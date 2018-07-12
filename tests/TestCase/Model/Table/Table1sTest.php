<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\Table1s;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\Table1s Test Case
 */
class Table1sTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\Table1s
     */
    public $Table1s;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('1s') ? [] : ['className' => Table1s::class];
        $this->Table1s = TableRegistry::getTableLocator()->get('1s', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Table1s);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
