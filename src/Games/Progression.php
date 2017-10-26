<?php

namespace BrainGames\Games;

class Progression extends \BrainGames\Game
{

    private function getProgression(
        $startValue,
        $diff,
        $progressionLength,
        $output
    ) {
        if ($progressionLength == count($output)) {
            return $output;
        }

        $result = array_merge($output, array($startValue));

        return self::getProgression(
            $startValue + $diff,
            $diff,
            $progressionLength,
            $result
        );
    }


    public static function run()
    {
        $rulesMessage = 'Balance the given number.';


        $getQuestionAnswerPair = function () {

            $limitMinDiff = 1;
            $limitMaxDiff = 10;
            $progressionLength = 10;
            $limitMinStartPosition = 0;
            $limitMaxStartPosition = 100;
            $maskSymbol = '..';
            $separator = ' ';

            // get question
            $diff = rand($limitMinDiff, $limitMaxDiff);
            $startValue = rand($limitMinStartPosition, $limitMaxStartPosition);
            $questionResult = self::getProgression(
                $startValue,
                $diff,
                $progressionLength,
                []
            );
            $mask = rand(0, $progressionLength);
            $questionResult[$mask] = $maskSymbol;

            $question = implode($separator, $questionResult);

            // get correct answer
            $answerDigit = array_map(function ($val) use ($maskSymbol) {
                return $val === $maskSymbol ? $val : (int) $val;
            }, $questionResult);

            $index = array_search($maskSymbol, $answerDigit);
            if ($index === 0) {
                $result = $answerDigit[1] - $diff;
            } else {
                $result = $answerDigit[$index - 1] + $diff;
            }


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
