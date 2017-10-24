<?php

namespace BrainGames\Games;

class Even extends \BrainGames\Game
{
    public static function run()
    {
        $rulesMessage = 'Answer "yes" if number is even otherwise answer "no".';
        $limitMaxNumber = 100;

        $getQuestionAnswerPair = function () use ($rulesMessage, $limitMaxNumber) {

            $question = rand(0, $limitMaxNumber);
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
