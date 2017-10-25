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

            $limitMinNumber = 1;
            $progressionLength = 10;
            $limitStartPosition = 100;
            $limitDiff = 10;
            $maskSymbol = '..';
            $separator = ' ';

            // get question
            $diff = rand($limitMinNumber, $limitDiff);
            $startValue = rand($limitMinNumber, $limitStartPosition);
            $questionResult = self::getProgression(
                $startValue,
                $diff,
                $progressionLength,
                []
            );
            $mask = rand($limitMinNumber, $progressionLength);
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
