<?php

namespace Frozennode\Administrator\DataTable\Columns\Relationships;

use Illuminate\Foundation\Application;

class HasOneOrMany extends Relationship
{
    /**
     * Adds selects to a query.
     *
     * @param array $selects
     */
    public function filterQuery(&$selects)
    {
        $model      = $this->config->getDataModel();
        $joins      = $where      = '';
        $columnName = $this->getOption('column_name');

        $relationship = $model->{$this->getOption('relationship')}();
        $from_table   = $this->tablePrefix.$relationship->getRelated()->getTable();
        $field_table  = $columnName.'_'.$from_table;

        //grab the existing where clauses that the user may have set on the relationship
        $relationshipWheres = $this->getRelationshipWheres($relationship, $field_table);

        // bugfix upgrade Laravel 5.3.* to Laravel 5.4.*
        // Why not use app()->version() ?
        // Because in unit test, the Application can't init, it can easy to run the unit test.
        if (version_compare(Application::VERSION, '5.4.0', '<')) {
            /**
             * @link https://github.com/laravel/framework/blob/5.3/src/Illuminate/Database/Eloquent/Relations/HasOneOrMany.php#L388
             */
            $plainForeignKey = $relationship->getPlainForeignKey();
        } else {
            /**
             * @link https://github.com/laravel/framework/blob/5.4/src/Illuminate/Database/Eloquent/Relations/HasOneOrMany.php#L401
             */
            $plainForeignKey = $relationship->getForeignKeyName();
        }

        $where = $this->tablePrefix.$relationship->getQualifiedParentKeyName().
                ' = '.
                $field_table.'.'.$plainForeignKey
                .($relationshipWheres ? ' AND '.$relationshipWheres : '');

        $selects[] = $this->db->raw('(SELECT '.$this->getOption('select').'
										FROM '.$from_table.' AS '.$field_table.' '.$joins.'
										WHERE '.$where.') AS '.$this->db->getQueryGrammar()->wrap($columnName));
    }
}
