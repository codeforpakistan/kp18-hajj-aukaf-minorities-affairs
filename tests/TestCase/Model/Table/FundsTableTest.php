<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FundsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FundsTable Test Case
 */
class FundsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FundsTable
     */
    public $Funds;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.funds',
        'app.fund_categories',
        'app.sub_categories',
        'app.applicant_funddetails'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Funds') ? [] : ['className' => FundsTable::class];
        $this->Funds = TableRegistry::getTableLocator()->get('Funds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Funds);

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
