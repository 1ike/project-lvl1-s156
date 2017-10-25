<?php
namespace BrainGames;

use function \cli\line;

class Game
{
    public static $attemptsNumber = 3;

    public function __construct($rulesMessage, $getQuestionAnswerPair)
    {
        $this->rulesMessage = $rulesMessage;
        $this->getQuestionAnswerPair = $getQuestionAnswerPair;
    }

    public function play($getQuestionAnswerPair, $name, $counter)
    {
        if ($counter === self::$attemptsNumber) {
            line('Congratulations, %s!', $name);
            return;
        }

        $questionAnswerPair = $getQuestionAnswerPair();
        $question = $questionAnswerPair['question'];
        $correctAnswer = $questionAnswerPair['correctAnswer'];

        line('Question: %s', $question);
        $questionMessage = 'Your $answer';
        $answer = \cli\prompt($questionMessage);
        if ($answer === $correctAnswer) {
            line('Correct!');
            $this->play($getQuestionAnswerPair, $name, $counter + 1);
        } else {
            line("'%s' is wrong ;(. Correct was '%s'.", $answer, $correctAnswer);
            line("Let's try again, %s!", $name);
        }
    }

    public function start()
    {
        line('Welcome to the Brain Game!');
        line($this->rulesMessage.PHP_EOL);
        $name = \cli\prompt('May I have your name?');
        line("Hello, %s!".PHP_EOL, $name);

        $this->play($this->getQuestionAnswerPair, $name, 0);
    }
}
