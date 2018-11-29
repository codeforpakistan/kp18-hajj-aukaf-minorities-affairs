<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InstituteTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InstituteTypesTable Test Case
 */
class InstituteTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InstituteTypesTable
     */
    public $InstituteTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.institute_types',
        'app.institutes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('InstituteTypes') ? [] : ['className' => InstituteTypesTable::class];
        $this->InstituteTypes = TableRegistry::getTableLocator()->get('InstituteTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InstituteTypes);

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
