<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FundCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FundCategoriesTable Test Case
 */
class FundCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FundCategoriesTable
     */
    public $FundCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fund_categories',
        'app.applies',
        'app.funds',
        'app.provided_funds',
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
        $config = TableRegistry::getTableLocator()->exists('FundCategories') ? [] : ['className' => FundCategoriesTable::class];
        $this->FundCategories = TableRegistry::getTableLocator()->get('FundCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FundCategories);

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
}
