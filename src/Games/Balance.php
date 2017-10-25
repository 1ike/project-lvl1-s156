<?php

namespace BrainGames\Games;

class Balance extends \BrainGames\Game
{

    private function balance($num)
    {
        $str = (string) $num;

        $input = str_split($str);
        $inputLength = count($input);

        $inputDigit = array_map(function ($val) {
            return (int) $val;
        }, $input);

        $sum = array_reduce($inputDigit, function ($acc, $val) {
            return $acc + $val;
        });

        $evenDigit = round($sum / $inputLength);
        $remainder = $sum % $inputLength;

        $output = [];
        while ($remainder > 0) {
            array_push($output, $evenDigit + 1);
            $remainder -= 1;
        }
        while ($inputLength > count($output)) {
            array_push($output, $evenDigit);
        }

        return (int) implode(array_reverse($output));
    }


    public static function run()
    {
        $rulesMessage = 'Balance the given number.';
        $limitMaxNumber = 1000;

        $getQuestionAnswerPair = function () use ($rulesMessage, $limitMaxNumber) {

            $num = rand(1, $limitMaxNumber);
            $question = $num;

            $correctAnswer = (string) self::balance($num);

            return [
                'question' => $question,
                'correctAnswer' => $correctAnswer
            ];
        };

        $game = new self($rulesMessage, $getQuestionAnswerPair);
        $game->start();
    }
}
