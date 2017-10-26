<?php

namespace BrainGames\Games;

class Prime extends \BrainGames\Game
{

    private function isPrime($num, $upperLimit, $next = 2)
    {

        if ($num <= 1 || $num % $next == 0) {
            return false;
        }

        if ($next > $upperLimit) {
            return true;
        }

        return self::isPrime($num, $upperLimit, $next + 1);
    }


    public static function run()
    {
        $rulesMessage = 'Balance the given number.';


        $getQuestionAnswerPair = function () {

            $limitMinNumber = 1;
            $limitMaxNumber = 50;

            $question = rand($limitMinNumber, $limitMaxNumber);

            $isPrime = self::isPrime($question, sqrt($question));
            $correctAnswer = $isPrime ? 'yes' : 'no';

            return [
                'question' => $question,
                'correctAnswer' => $correctAnswer
            ];
        };

        $game = new self($rulesMessage, $getQuestionAnswerPair);
        $game->start();
    }
}
