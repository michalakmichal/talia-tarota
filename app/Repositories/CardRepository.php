<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Interfaces\CardRepositoryInterface;
use App\Models\Card;

// zrobić implementację kazdego projektu dla aplikacji elektron ;-)

class CardRepository implements CardRepositoryInterface
{
    public function getCards() : Collection
    {
        $cards = Card::all();
        return $cards;//response()->json($sessions);
    }
    public function getCard($id)
    {
        return Card::findOrFail($id);
    }
    public function updateCard($data, $id)
    {
        $card = Card::findOrFail($id);
        $card->update($data['data']);
        return $card;
    }
    /*
        return a collection excluding session owner
    */
  
}