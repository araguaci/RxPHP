<?php

require_once __DIR__ . '/../bootstrap.php';

$range = \Rx\Observable\BaseObservable::fromArray(range(0, 1000));

$source = $range
    ->take(2)
    ->doOnNext(function ($x) {
        echo "Side effect\n";
    });

$published = $source->publishLast();

$published->subscribe($createStdoutObserver('SourceA'));
$published->subscribe($createStdoutObserver('SourceB'));

$connection = $published->connect();

//Side effect
//Side effect
//SourceA Next value: 1
//SourceB Next value: 1
//SourceA Complete!
//SourceB Complete!
