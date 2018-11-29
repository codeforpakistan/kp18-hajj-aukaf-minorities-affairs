<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApplicantFunddetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApplicantFunddetailsTable Test Case
 */
class ApplicantFunddetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ApplicantFunddetailsTable
     */
    public $ApplicantFunddetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.applicant_funddetails',
        'app.applicants',
        'app.funds',
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
        $config = TableRegistry::getTableLocator()->exists('ApplicantFunddetails') ? [] : ['className' => ApplicantFunddetailsTable::class];
        $this->ApplicantFunddetails = TableRegistry::getTableLocator()->get('ApplicantFunddetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApplicantFunddetails);

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
