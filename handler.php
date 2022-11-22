<?php
define('PVZ', 25);
define('LAST_MILE', 0.05);
define('CLOTHES', 0.12);
define('PAY_TAX', 0.015);

$data['price'] = $_POST["price"];
$data['volume'] = $_POST["volume"];
$data['volumeMass'] = $_POST["volume-mass"];
$data['comission'] = $_POST["comission"];
$data['bet'] = $_POST["bet"];
$data['count'] = $_POST["count"];
$data['betCount'] = $_POST["bet-count"];

function volumeWeight($volume, $volumeMass)
{
    $vol = $volume / 5;
    if ($vol > $volumeMass)
        return $vol;
    else 
        return $volumeMass;
}

function getLogistics()
{
    $logistics = [
        "0.1" => [
            "PERCENT" => 0.05,
            "MIN" => 38,
            "MAX" => 50
        ],
        "0.2" => [
            "PERCENT" => 0.05,
            "MIN" => 39,
            "MAX" => 50
        ],
        "0.3" => [
            "PERCENT" => 0.05,
            "MIN" => 40,
            "MAX" => 60
        ],
        "0.4" => [
            "PERCENT" => 0.05,
            "MIN" => 41,
            "MAX" => 60
        ],
        "0.5" => [
            "PERCENT" => 0.05,
            "MIN" => 41,
            "MAX" => 65
        ],
        "0.6" => [
            "PERCENT" => 0.05,
            "MIN" => 43,
            "MAX" => 70
        ],
        "0.7" => [
            "PERCENT" => 0.05,
            "MIN" => 43,
            "MAX" => 70
        ],
        "0.8" => [
            "PERCENT" => 0.05,
            "MIN" => 45,
            "MAX" => 75
        ],
        "0.9" => [
            "PERCENT" => 0.05,
            "MIN" => 47,
            "MAX" => 75
        ],
        "1" => [
            "PERCENT" => 0.06,
            "MIN" => 49,
            "MAX" => 85
        ],
        "1.1" => [
            "PERCENT" => 0.06,
            "MIN" => 53,
            "MAX" => 90
        ],
        "1.2" => [
            "PERCENT" => 0.06,
            "MIN" => 55,
            "MAX" => 90
        ],
        "1.3" => [
            "PERCENT" => 0.06,
            "MIN" => 59,
            "MAX" => 100
        ],
        "1.4" => [
            "PERCENT" => 0.06,
            "MIN" => 60,
            "MAX" => 100
        ],
        "1.5" => [
            "PERCENT" => 0.06,
            "MIN" => 61,
            "MAX" => 115
        ],
        "1.6" => [
            "PERCENT" => 0.06,
            "MIN" => 63,
            "MAX" => 115
        ],
        "1.7" => [
            "PERCENT" => 0.06,
            "MIN" => 65,
            "MAX" => 120
        ],
        "1.8" => [
            "PERCENT" => 0.06,
            "MIN" => 67,
            "MAX" => 125
        ],
        "1.9" => [
            "PERCENT" => 0.06,
            "MIN" => 67,
            "MAX" => 130
        ],
    ];
    return $logistics;
}

function main($data)
{
    $logistics = getLogistics();
    $data['volumeWeight'] = strval(round(volumeWeight($data['volume'], $data['volumeMass']), 1));
    if ($logistics[$data['volumeWeight']]['PERCENT'] * $data['price'] > $logistics[$data['volumeWeight']]['MIN']){
        $pvzEntryComission = $logistics[$data['volumeWeight']]['PERCENT'] * $data['PRICE'];
    } else {
        $pvzEntryComission = $logistics[$data['volumeWeight']]['MIN'];
    }
    $actualComission = $pvzEntryComission + $data['comission'] * 0.01 * $data['price'] + PVZ + LAST_MILE * $data['price'] + PAY_TAX * $data['price'];
    $actualPrice = $data['price'] - $actualComission;
    $total = $actualPrice * $data['count'];
    $totalComissionWithBet = $data['betCount'] * $data['bet'] * $data['price'] * 0.01 + $actualComission;
    $totalSubstractedBet = $total - $totalComissionWithBet + $actualComission;
    $log = date('Y-m-d H:i:s') . "\n Цена:" . $data['price'] . "\nПродано всего:" . $data['count'] . "\nПродано ставками: " . $data['betCount'] . "\n Коммисия сервису за шт.: " . $actualComission . "\nОбщая комиссия сервису: " . $totalComissionWithBet . "\nСуммарно заработано (с вычетом всех трат): " . $totalSubstractedBet . "\n----------";
    file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);
}

main($data);
header('Location: /log.txt');