#!/usr/bin/env php
<?php

# ======== Preencha os nomes dos participantes

$allBlacks = [
    0 => ['João Pedro Alexandroni', 'Vagner Galvão', 'Matheus Vieira'],
    1 => ['Pablo Albernaz', 'Gabriel Cruz', 'Jerfeson Guerreiro']
];

$vikings = [
    0 => ['Thiago Daher', 'Maria Paula'],
    1 => ['Wilson', 'Fernando'],
];

# ==================================

function arguments($argv)
{
    $_ARG = array();
    foreach ($argv as $arg) {
        if (preg_match('#^-{1,2}([a-zA-Z0-9]*)=?(.*)$#', $arg, $matches)) {
            $key = $matches[1];
            switch ($matches[2]) {
                case '':
                case 'true':
                    $arg = true;
                    break;
                case 'false':
                    $arg = false;
                    break;
                default:
                    $arg = $matches[2];
            }
            $_ARG[$key] = $arg;
        } else {
            $_ARG['input'][] = $arg;
        }
    }
    return $_ARG;
}

$args = arguments($argv);

if (isset($args['input'])) {
    if ($args['input'][0] == $_SERVER['SCRIPT_NAME']) {
        // Remove o primeiro parâmetro, caso este seja o nome do script atual
        array_shift($args['input']);
    }

    if (count($args['input']) > 0) {
        $dataExploded = explode('/', $args['input'][0]);
        $date = mktime(0, 0, 0, $dataExploded[1], $dataExploded[0], $dataExploded[2]);
    }
}

if (!isset($date)) {
    $date = strtotime('today');
}

sort($allBlacks[0]);
sort($allBlacks[1]);
sort($vikings[0]);
sort($vikings[1]);

$weekOfYear = date('W', $date) - 1;
$dayOfWeek  = date('w', $date);
$dayOfYear  = date('z', $date);
$lastSunday = $dayOfYear - $dayOfWeek + 1;
$lastSundayTimestamp = mktime(0, 0, 0, 1, $lastSunday);
$lastSundayFormated  = date('d/m/Y H:i:s', $lastSundayTimestamp);

$diaPar     = ($dayOfYear  % 2) == 0;
$semanaPar  = ($weekOfYear % 2) == 0;
$domingoPar = ($lastSunday % 2) == 0;

if (!$semanaPar && !$domingoPar) {
    $allBlacks = array_reverse($allBlacks);
    $vikings = array_reverse($vikings);
}

if ($diaPar) {
    $allBlacks = array_reverse($allBlacks);
    $vikings = array_reverse($vikings);
}

$template = <<<TEMPLATE
Escala almoço dia %s

Equipe AllBlacks
 - 12h: %s
 - 13h: %s

Equipe Vikings
 - 12h: %s
 - 13h: %s
TEMPLATE;

echo sprintf(
    $template,
    date('d/m/Y', $date),
    implode(', ', $allBlacks[0]),
    implode(', ', $allBlacks[1]),
    implode(', ', $vikings[0]),
    implode(', ', $vikings[1])
);
echo PHP_EOL;
