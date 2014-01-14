<?php
/**
 * Arfooo
 * 
 * @package    Arfooo
 * @copyright  Copyright (c) Arfooo Annuaire (fr) and Arfooo Directory (en)
 *             by Guillaume Hocine (c) 2007 - 2010
 *             http://www.arfooo.com/ (fr) and http://www.arfooo.net/ (en)
 * @author     Guillaume Hocine & Adrian Galewski
 * @license    http://creativecommons.org/licenses/by/2.0/fr/ Creative Commons
 */


abstract class BackgroundTask extends Model
{
    protected $taskId;
    protected $items;
    protected $data;
    protected $parsedItems = 0;
    protected $totalItems;
    protected $pauseUpdateStatusInterval;
    protected $request;
    protected $scriptMaxExecutionTime = 60;
    protected $nextStart = false;

    abstract protected function loadItems();
    abstract protected function parseItem($item);

    protected function beforeInit()
    {}
    protected function beforeParsing()
    {}
    protected function afterParsing()
    {}

    public function init()
    {
        $this->request = Request::getInstance();
        $this->beforeInit();
        $this->task->delByPk($this->taskId);

        $task = new TaskRecord();
        $task->taskId = $this->taskId;
        $task->parsedItems = 0;
        $task->data = serialize($this->data);
        $task->status = "init";
        $task->save();
    }

    public function fork($path)
    {
        $postData = "taskId=" . $this->taskId;

        $fp = fsockopen($_SERVER['HTTP_HOST'], 80);
        $query = "POST " . $path . " HTTP/1.0\r\n"
                 . "Host: " . $_SERVER['HTTP_HOST'] . "\r\n"
                 . "Content-Type: application/x-www-form-urlencoded\r\n"
                 . "Content-Length: " . strlen($postData) . "\r\n"
                 . "Connection: close\r\n\r\n"
                 . $postData;

        fwrite($fp, $query);

        fclose($fp);
    }

    public function nextStart()
    {
        $this->nextStart = true;
        $this->start();
    }

    public function start()
    {
        $scriptStartTime = time();
        ignore_user_abort(true);
        set_time_limit(60 * 5);

        $taskCriteria = new Criteria();
        $taskCriteria->add("taskId", $this->taskId);

        $task = $this->task->find($taskCriteria);

        if (empty($task)) {
            return;
        }
        if (!in_array($task->status, array("init", "next"))) {
            return;
        }

        $this->data = unserialize($task->data);

        if ($task->status == "next") {
            $taskData = Cacher::getInstance()->load("taskData" . $this->taskId);
            if (empty($taskData)) {
                return;
            }

            $this->items = $taskData['items'];
            $startIndex = $taskData['startIndex'];
            $this->parsedItems = $startIndex;
        } else {
            $startIndex = 0;
            $this->loadItems();
        }

        $this->totalItems = count($this->items);
        $task->totalItems = $this->totalItems;
        $task->status = "active";
        $task->save();
        $lp = 0;

        $this->beforeParsing();
        $executeNextProcess = false;

        for ($i = $startIndex, $itemsCount = count($this->items); $i < $itemsCount && !$executeNextProcess; $i++) {
            $item = $this->items[$i];
            $this->parseItem($item);

            $task->parsedItems = ++$this->parsedItems;
            $task->save();

            if ($this->parsedItems < $this->totalItems) {
                $taskStatus = $this->task->get("status", $taskCriteria);

                if ($taskStatus == "pause") {
                    do {
                        sleep($this->pauseUpdateStatusInterval);
                        $taskStatus = $this->task->get("status", $taskCriteria);
                    } while ($taskStatus == "pause");
                }

                if ($taskStatus == "stop") {
                    break;
                }

                if (time() - $scriptStartTime > $this->scriptMaxExecutionTime) {
                    $executeNextProcess = true;
                    $taskData = array("items" => $this->items,
                                      "startIndex" => $i + 1);
                    Cacher::getInstance()->save($taskData, "taskData" . $this->taskId);
                }
            }

        }

        if ($executeNextProcess) {
            $task->status = "next";
            $task->save();
            $this->fork(AppRouter::getRewrittedUrl("/admin/task/nextStart"));
        } else {
            Cacher::getInstance()->delete("taskData" . $this->taskId);
            $task->status = "finish";
            $task->save();

            $this->afterParsing();
        }
    }

    private function setStatus($status)
    {
        $this->task->updateByPk(array("status" => $status), $this->taskId);
    }

    public function pause()
    {
        return $this->setStatus("pause");
    }

    public function resume()
    {
        return $this->setStatus("active");
    }

    public function stop()
    {
        return $this->setStatus("stop");
    }

    public function getStatus()
    {
        $task = $this->task->findByPk($this->taskId, "status, parsedItems, totalItems");
        return ($task) ? $task->toArray() : array();
    }
}
