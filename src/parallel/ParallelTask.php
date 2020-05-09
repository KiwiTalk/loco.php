<?php


namespace loco\parallel;


use parallel\Future;
use parallel\Runtime;

class ParallelTask {

	private ?Future $future = null;
	private Runtime $runtime;

	/** @var callable */
	private $task;

	/** @var callable */
	private $callback;

	public function __construct(callable $task, callable $callback) {
		$this->task = $task;
		$this->callback = $callback;
	}

	public function run(): Future {
		if ($this->future instanceof Future) throw new \Exception("이미 병렬 작업이 실행 중입니다.");
		return $this->future = ($this->runtime = new Runtime())->run($this->task);
	}

	/**
	 * @return Future|null
	 */
	public function getFuture(): ?Future {
		return $this->future;
	}

	/**
	 * @return callable
	 */
	public function getCallback() {
		return $this->callback;
	}

}