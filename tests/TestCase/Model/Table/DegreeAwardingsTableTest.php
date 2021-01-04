<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DegreeAwardingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DegreeAwardingsTable Test Case
 */
class DegreeAwardingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DegreeAwardingsTable
     */
    public $DegreeAwardings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.degree_awardings',
        'app.qualifications'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DegreeAwardings') ? [] : ['className' => DegreeAwardingsTable::class];
        $this->DegreeAwardings = TableRegistry::getTableLocator()->get('DegreeAwardings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DegreeAwardings);

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
