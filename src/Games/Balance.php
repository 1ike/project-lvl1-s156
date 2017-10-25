<?php

namespace BrainGames\Games;

class Balance extends \BrainGames\Game
{

    private function align($remainder, $evenDigit, $inputLength, $output)
    {
        if ($inputLength == count($output)) {
            return $output;
        }

        $digit = $remainder > 0 ? $evenDigit + 1 : $evenDigit;

        return self::align($remainder - 1, $evenDigit, $inputLength, array_merge(array($digit), $output));
    }

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

        $evenDigit = floor($sum / $inputLength);
        $remainder = $sum % $inputLength;

        $output = self::align($remainder, $evenDigit, $inputLength, []);


        return (int) implode($output);
    }


    public static function run()
    {
        $rulesMessage = 'Balance the given number.';

        $getQuestionAnswerPair = function () {

            $limitMinNumber = 1;
            $limitMaxNumber = 1000;

            $num = rand($limitMinNumber, $limitMaxNumber);
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
