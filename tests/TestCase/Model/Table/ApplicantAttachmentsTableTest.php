<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApplicantAttachmentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApplicantAttachmentsTable Test Case
 */
class ApplicantAttachmentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ApplicantAttachmentsTable
     */
    public $ApplicantAttachments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.applicant_attachments',
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
        $config = TableRegistry::getTableLocator()->exists('ApplicantAttachments') ? [] : ['className' => ApplicantAttachmentsTable::class];
        $this->ApplicantAttachments = TableRegistry::getTableLocator()->get('ApplicantAttachments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApplicantAttachments);

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
