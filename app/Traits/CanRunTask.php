<?php

namespace Atom26\Traits;

trait CanRunTask {

	/**
	 * Run multiple tasks
	 * 
	 * @param  array $tasks Array of task classes
	 * @return mixed
	 */
	private function runTasks(array $tasks)
	{
		foreach ($tasks as $task) {
			app($task)->run();
		}
	}

	/**
	 * Run single task
	 * 
	 * @param  string $task
	 * @return void
	 */
	private function runTask($task)
	{
		return app($task)->run();
	}
}