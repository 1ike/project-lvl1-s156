<?php

namespace BrainGames\Games;

class Even extends \BrainGames\Game
{
    public static function run()
    {
        $rulesMessage = 'What is the result of the expression?';

        $getQuestionAnswerPair = function () {

            $limitMinNumber = 0;
            $limitMaxNumber = 100;

            $question = rand($limitMinNumber, $limitMaxNumber);
            $correctAnswer = $question % 2 === 0 ? 'yes' : 'no';

            return [
                'question' => $question,
                'correctAnswer' => $correctAnswer
            ];
        };

        $game = new self($rulesMessage, $getQuestionAnswerPair);
        $game->start();
    }
}
