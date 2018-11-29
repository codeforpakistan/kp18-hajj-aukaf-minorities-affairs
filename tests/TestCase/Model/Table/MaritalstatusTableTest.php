<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MaritalstatusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MaritalstatusTable Test Case
 */
class MaritalstatusTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MaritalstatusTable
     */
    public $Maritalstatus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.maritalstatus',
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
        $config = TableRegistry::getTableLocator()->exists('Maritalstatus') ? [] : ['className' => MaritalstatusTable::class];
        $this->Maritalstatus = TableRegistry::getTableLocator()->get('Maritalstatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Maritalstatus);

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
