<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\Table2;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\Table2 Test Case
 */
class Table2Test extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\Table2
     */
    public $Table2;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('2') ? [] : ['className' => Table2::class];
        $this->Table2 = TableRegistry::getTableLocator()->get('2', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Table2);

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
