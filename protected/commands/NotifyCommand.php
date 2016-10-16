<?php

class NotifyCommand extends CConsoleCommand {
    public function run($args) {
        $events = Event::model()->findAll('active = 1');

        if($events) {
            foreach ($events as $event) {
                echo $event->date;
            }
        }
    }
}