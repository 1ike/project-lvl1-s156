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
        $limitMaxNumber = 30;

        $getQuestionAnswerPair = function () use ($rulesMessage, $limitMaxNumber) {

            $a = rand(1, $limitMaxNumber);
            $b = rand(1, $limitMaxNumber);
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
