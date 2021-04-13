<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Interfaces\OfferRepositoryInterface;
use App\Models\Offer;
use App\Models\User;

// zrobić implementację kazdego projektu dla aplikacji elektron ;-)

class OfferRepository implements OfferRepositoryInterface
{
    public function getoffers() : Collection
    {
        $offers = Offer::with('images')->get();
        return $offers;//response()->json($offers);
    }
    /*
        return a collection excluding offer owner
    */
    public function getOffer($id)
    {
        return Offer::with('images')->findOrFail($id);
    }
    public function createOffer($data)
    {
        //refac: destrukturyzacja -> dodać cały obiekt $data + offer_type = 1 - do niego
        $offer = Offer::create([
            'state_id' => 1,
            'type_id' => $data['type_id']
        ]);
        $offer->users()->saveMany(User::find([$data['user_id'],11]));
        return $offer;
    }
    public function deleteOffer($id)
    {
        try{
            $offer = Offer::find($id);
        }
        catch(\Throwable $e)
        {
            report($e);
            return null;
        }
    }
    public function updateOffer($data, $id)
    {
        $offer = Offer::findOrFail($id);
        $offer->update($data);
        return $offer;
    }
   
}