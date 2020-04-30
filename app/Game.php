<?php

namespace App;

use App\States\Hand;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $guarded = [];

    public function game_type()
    {
        return $this->belongsTo(GameType::class);
    }

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

    public function currentRound()
    {
        return $this->belongsTo(Round::class, 'current_round');
    }

    public function players()
    {
        return $this->belongsToMany(User::class);
    }

    public function getJoinLinkAttribute()
    {
        return route('games.join', Hashids::encode($this->id));
    }

    public function getPlayLinkAttribute()
    {
        return route('games.play', Hashids::encode($this->id));
    }

    public function start() 
    {
        $type = $this->game_type;
        $players = $this->players;

        foreach($type->rounds as $index => $round) {
            $activePlayer = $players[$index] ?? $players[$index-$players->count()];
            $gameRound = $this->rounds()->create([
                'num_cards' => $round['num_cards'], 
                'active_player_id' => $activePlayer->id,
                'goals' => $round['goals'],
            ]);

            if($index === 0) {
                $this->current_round = $gameRound->id;
                $this->save();
            }

            // generate stock for round
            $gameRound->stock()->createMany( 
                (new Deck(round($players->count()/2), 'normal-with-jokers'))->cards->map(function($card) {
                    return [
                        'card_id' => $card->id,
                    ];
                })
            );

            // deal from stock to players
            foreach(range(1, $round['num_cards']) as $i){
                foreach($players as $player) {
                    $gameRound->stock->firstWhere('model_id', null)->location->transitionTo(Hand::class, $player);
                    $gameRound->refresh();
                }
            }
        }
    }
}
