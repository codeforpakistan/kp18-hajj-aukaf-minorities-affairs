<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApplicantcontactsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApplicantcontactsTable Test Case
 */
class ApplicantcontactsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ApplicantcontactsTable
     */
    public $Applicantcontacts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.applicantcontacts',
        'app.applicants'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Applicantcontacts') ? [] : ['className' => ApplicantcontactsTable::class];
        $this->Applicantcontacts = TableRegistry::getTableLocator()->get('Applicantcontacts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Applicantcontacts);

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
