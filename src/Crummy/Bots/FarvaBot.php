<?php

namespace Crummy\Bots;

use Crummy\Phlack\Bot\AbstractBot;
use Crummy\Phlack\Common\Matcher;
use Crummy\Phlack\WebHook\CommandInterface;

class FarvaBot extends AbstractBot
{
    protected $taunts = [
        'I\'m not even gonna dignify myself with a response to that.',
        'Sing it again, rookie biatch!',
        'Where\'d you learn that, Cheech? Drug school?',
        'Are you done?',
        'Say car ramrod'
    ];

    protected $sayings = [
        'meow'  => 'Hell I can say "meow". I can say "moo". For twenty bucks, I\'ll call the guy a chickenfucker!',
        'punch' => 'You wanna go punch for punch?',
        'quote' => [
            'You burger punk sonofabitch!',
            'I don\'t want a large Farva...I want a goddamn litre o\' cola!',
            'Cap\'n, You know I\'m not a pro union guy.',
            'You look like the President and CEO of Levi-Strauss!',
            'Say car ramrod'
        ],
        'shenanigans' => [
            'Did someone say Shenanigans?',
            'Are you guys talking about Shenanigans?',
            'Say car ramrod'
        ],
        'car ramrod' => [
            'Say car ramrod',
            'License and registration, chickenfucker! Ba-COCK!!!',
        ]
    ];

    /**
     * @param CommandInterface $command
     * @return \Crummy\Phlack\Common\Encodable
     */
    public function execute(CommandInterface $command)
    {
        $text = preg_replace(sprintf('/^%s /', $command['command']), '', $command['text']);

        foreach (array_keys($this->sayings) as $trigger) {
            if (false === strpos($text, $trigger)) {
                continue;
            }

            if (is_array($this->sayings[$trigger])) {
                return $this->reply($command, $this->sayings[$trigger][array_rand($this->sayings[$trigger])]);
            }

            return $this->reply($command, $this->sayings[$trigger]);
        }

        // No command matched, taunt the user instead
        return $this->reply($command, $this->taunts[array_rand($this->taunts)]);
    }

    /**
     * @return callable|Matcher\MatcherInterface
     */
    public function getMatcher()
    {
        return function (CommandInterface $command) {
            return 0 === strpos($command['text'], 'farva');
        };
    }

    /**
     * @return string
     */
    protected function getRandomQuote()
    {
        return $this->sayings[array_rand($this->sayings)];
    }
}
