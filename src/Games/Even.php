<?php

namespace BrainGames\Games;

class Even extends \BrainGames\Game
{
    public static function run()
    {
        $rulesMessage = 'What is the result of the expression?';
        $limitMaxNumber = 100;

        $getQuestionAnswerPair = function () use ($rulesMessage, $limitMaxNumber) {

            $question = rand($limitMaxNumber);
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
