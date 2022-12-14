<?php
namespace Cake\TestSuite\Constraint;

use Cake\Event\Event;
use Cake\Event\EventManager;
use PHPUnit_Framework_AssertionFailedError;
use PHPUnit_Framework_Constraint;

/**
 * EventFiredWith constraint
 *
 * Another glorified in_array check
 */
class EventFiredWith extends PHPUnit_Framework_Constraint
{
    /**
     * Array of fired events
     *
     * @var EventManager
     */
    protected $_eventManager;

    /**
     * Event data key
     *
     * @var string
     */
    protected $_dataKey;

    /**
     * Event data value
     *
     * @var string
     */
    protected $_dataValue;

    /**
     * Constructor
     *
     * @param EventManager $eventManager Event manager to check
     * @param string $dataKey Data key
     * @param string $dataValue Data value
     */
    public function __construct($eventManager, $dataKey, $dataValue)
    {
        parent::__construct();
        $this->_eventManager = $eventManager;
        $this->_dataKey = $dataKey;
        $this->_dataValue = $dataValue;

        if ($this->_eventManager->getEventList() === null) {
            throw new PHPUnit_Framework_AssertionFailedError('The event manager you are asserting against is not configured to track events.');
        }
    }

    /**
     * Checks if event is in fired array
     *
     * @param mixed $other Constraint check
     * @return bool
     */
    public function matches($other)
    {
        $firedEvents = [];
        $list = $this->_eventManager->getEventList();
        $totalEvents = count($list);
        for ($e = 0; $e < $totalEvents; $e++) {
            $firedEvents[] = $list[$e];
        }

        $eventGroup = collection($firedEvents)
            ->groupBy(function (Event $event) {
                return $event->name();
            })
            ->toArray();

        if (!array_key_exists($other, $eventGroup)) {
            return false;
        }

        $events = $eventGroup[$other];

        if (count($events) > 1) {
            throw new PHPUnit_Framework_AssertionFailedError(sprintf('Event "%s" was fired %d times, cannot make data assertion', $other, count($events)));
        }

        $event = $events[0];

        if (array_key_exists($this->_dataKey, $event->data) === false) {
            return false;
        }

        return $event->data[$this->_dataKey] === $this->_dataValue;
    }

    /**
     * Assertion message string
     *
     * @return string
     */
    public function toString()
    {
        return 'was fired with ' . $this->_dataKey . ' matching ' . (string)$this->_dataValue;
    }
}
