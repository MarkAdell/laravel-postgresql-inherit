<?php namespace ThibaudDauce\PostgresqlSchema;

use Illuminate\Database\PostgresConnection as BasePostgresConnection;

class PostgresConnection extends BasePostgresConnection {

  /**
	 * Get the default schema grammar instance.
	 *
	 * @return \ThibaudDauce\PostgresqlSchema\PostgresGrammar
	 */
	protected function getDefaultSchemaGrammar()
	{
		return $this->withTablePrefix(new PostgresGrammar);
	}

	/**
	 * Get a schema builder instance for the connection.
	 *
	 * @return \Illuminate\Database\Schema\Builder
	 */
	public function getSchemaBuilder()
	{
		$builder = parent::getSchemaBuilder();

		$builder->blueprintResolver(function($table, $callback) {
			return new Blueprint($table, $callback);
		});

		return $builder;
	}

}
