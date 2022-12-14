<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         3.2.12
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\Datasource;

use Cake\Database\Schema\Table;

/**
 * Defines the interface for getting the schema.
 */
interface TableSchemaInterface
{

    /**
     * Get and set the schema for this fixture.
     *
     * @param \Cake\Database\Schema\Table|null $schema The table to set.
     * @return \Cake\Database\Schema\Table|null
     */
    public function schema(Table $schema = null);
}
