<?php

class NotifyCommand extends CConsoleCommand
{
    public function run($args)
    {
        $events = Event::model()->findAll('active = 1');

        if($events) {
            foreach ($events as $event) {
                $datetime1 = DateTime::createFromFormat('d/m/Y', $event->date);
                $datetime2 = new DateTime('now');
                $interval = $datetime1->diff($datetime2);
                if ($interval->format('%a') == 4) {
                    if ($eventMembers = $event->event_members) {
                        foreach ($eventMembers as $member) {
                            Yii::app()->email->four_days_event_email($member, $event);
                            Yii::log("Emails was sent. Event - ".$event->id.", date - ".date('Y-m-d'));
                        }
                    }
                }
            }
        }
    }
}