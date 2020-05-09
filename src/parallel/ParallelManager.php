<?php


namespace loco\parallel;


use parallel\Runtime;

class ParallelManager {

	private static ?ParallelManager $instance = null;

	/**
	 * @return ParallelManager
	 */
	public static function getInstance(): ParallelManager {
		return self::$instance;
	}

	private Runtime $runtime;

	/** @var ParallelTask[] */
	private array $taskList = [];

	public function __construct() {
		self::$instance = $this;
		$this->runtime = new Runtime();
		$this->taskList = [];
	}

	public function run(callable $task, callable $callback): ParallelTask {
		$task = new ParallelTask($task, $callback);
		$this->taskList[] = $task;

		//$task->run($this->runtime);
		$task->run();
		return $task;
	}

	/**
	 * @internal
	 */
	public function tick(): void {
		static $ticking = false;
		if ($ticking) throw new \BadMethodCallException("ParallelManager::tick()을 실행할 수 없습니다.");
		$ticking = true;
		foreach ($this->taskList as $k => $task) {
			if ($task->getFuture()->done()) {
				$task->getCallback()($task->getFuture()->value());
				unset($this->taskList[$k]);
			}
		}
		$ticking = false;
	}

}