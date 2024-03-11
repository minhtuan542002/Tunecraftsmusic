<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LessontypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LessontypesTable Test Case
 */
class LessontypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LessontypesTable
     */
    protected $Lessontypes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Lessontypes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Lessontypes') ? [] : ['className' => LessontypesTable::class];
        $this->Lessontypes = $this->getTableLocator()->get('Lessontypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Lessontypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LessontypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
