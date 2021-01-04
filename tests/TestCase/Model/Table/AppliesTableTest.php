<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AppliesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AppliesTable Test Case
 */
class AppliesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AppliesTable
     */
    public $Applies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.applies',
        'app.applicants',
        'app.fund_categories',
        'app.sub_categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Applies') ? [] : ['className' => AppliesTable::class];
        $this->Applies = TableRegistry::getTableLocator()->get('Applies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Applies);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
