<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReligonTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReligonTable Test Case
 */
class ReligonTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReligonTable
     */
    public $Religon;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.religon',
        'app.applicant'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Religon') ? [] : ['className' => ReligonTable::class];
        $this->Religon = TableRegistry::getTableLocator()->get('Religon', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Religon);

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
