<?php

namespace BrainGames\Games;

class GCD extends \BrainGames\Game
{
    private function getGCD($a, $b)
    {
        if (!$b) {
            return $a;
        }

        return self::getGCD($b, $a % $b);
    }

    public static function run()
    {
        $rulesMessage = 'Find the greatest common divisor of given numbers.';
        $limitMinNumber = 1;
        $limitMaxNumber = 30;

        $getQuestionAnswerPair = function () use (
            $rulesMessage,
            $limitMinNumber,
            $limitMaxNumber
        ) {

            $a = rand($limitMinNumber, $limitMaxNumber);
            $b = rand($limitMinNumber, $limitMaxNumber);
            $question = $a.' '.$b;

            $result = self::getGCD($a, $b);
            $correctAnswer = (string) $result;

            return [
                'question' => $question,
                'correctAnswer' => $correctAnswer
            ];
        };

        $game = new self($rulesMessage, $getQuestionAnswerPair);
        $game->start();
    }
}
