<?php

namespace BrainGames\Games;

class Calc extends \BrainGames\Game
{
    private function getOperator($limitDiceFaces)
    {
        $dice = rand(0, $limitDiceFaces);

        switch ($dice) {
            case 0:
                $operator = '+';
                break;
            case 1:
                $operator = '-';
                break;
            default:
                $operator = '*';
                break;
        }

        return $operator;
    }

    private function calculate($operator, $a, $b)
    {
        switch ($operator) {
            case '+':
                $result = $a + $b;
                break;
            case '-':
                $result = $a - $b;
                break;
            default:
                $result = $a * $b;
                break;
        }

        return $result;
    }



    public static function run()
    {
        $rulesMessage = 'Answer "yes" if number is even otherwise answer "no".';
        $limitMaxNumber = 30;
        $limitDiceFaces = 3;

        $getQuestionAnswerPair = function () use (
            $rulesMessage,
            $limitMaxNumber,
            $limitDiceFaces
        ) {

             // get $question
            $a = rand(0, $limitMaxNumber);
            $b = rand(0, $limitMaxNumber);

            $operator = self::getOperator($limitDiceFaces);

            $question = $a.$operator.$b;

            // get correct answer
            $result = self::calculate($operator, $a, $b);
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
