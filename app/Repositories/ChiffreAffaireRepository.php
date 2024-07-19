<?php
namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Implementation\ChiffreAffaireRepositoryInterface;
use App\Traits\Validation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Facture;
use Carbon\Carbon;

class ChiffreAffaireRepository implements ChiffreAffaireRepositoryInterface
{
    use Validation;

    public function getChiffreAffaire()
    {
        $date = Carbon::create(2024, 7, 11)->toDateString();
        $demain = Carbon::create(2024, 7, 12)->toDateString();

        //$date = Carbon::today()->toDateString();
        //$demain = Carbon::tomorrow()->toDateString();

        $facturesLivraison = Facture::with(['detailventes.prix', 'livraison'])
            ->whereHas('livraison', function ($query) use ($date) {
                $query->where('date_de_livraison', $date);
            })->get();

        $facturesLivraisonDemain = Facture::with(['detailventes.prix', 'livraison'])
            ->whereHas('livraison', function ($query) use ($demain) {
                $query->where('date_de_livraison', $demain);
            })->get();

        $facturesDate = Facture::with(['detailventes.prix', 'livraison'])
            ->where('date', $date)
            ->get();

        $previsionnel = 0;
        $livre_terrain = 0;
        $non_livre = 0;
        $livre_reel = 0;
        $livraison_previsionnel = 0;
        $livraison_demain = 0;
        $taux = 0;

        foreach ($facturesLivraison as $facture) {
            $this->calculMontants($facture, $date, $previsionnel, $livre_terrain, $non_livre);
        }

        foreach ($facturesLivraisonDemain as $facture) {
            foreach ($facture->detailventes as $detailVente) {
                $montant = $detailVente->Quantite * $detailVente->prix->Prix_detail;
                if ($facture->Id_de_la_mission == "FACEBOOK") {
                    $livraison_demain += $montant;
                }
            }
        }

        foreach ($facturesDate as $facture) {
            foreach ($facture->detailventes as $detailVente) {
                $montant = $detailVente->Quantite * $detailVente->prix->Prix_detail;
                if ($facture->Id_de_la_mission == "FACEBOOK") {
                    $livraison_previsionnel += $montant;
                    if ($facture->Status === 'livre') {
                        $livre_reel += $montant;
                    }
                }
            }
        }

        if ($livre_reel != 0 && $previsionnel != 0) {
            $taux = number_format(($livre_reel * 100) / $previsionnel, 2);
        }

        return [
            'previsionnel' => $previsionnel,
            'livre_terrain' => $livre_terrain,
            'non_livre' => $non_livre,
            'livre_reel' => $livre_reel,
            'livraison_previsionnel' => $livraison_previsionnel,
            'livraison_demain' => $livraison_demain,
            'taux' => $taux,
            'tableData' =>[
            'matricule' =>'VP0080',
            'nom' =>'Sitraka', 
            'previsionnel' => $previsionnel,
            'livre_terrain' => $livre_terrain,
            'non_livre' => $non_livre,
            'livre_reel' => $livre_reel,
            'livraison_previsionnel' => $livraison_previsionnel,
            'livraison_demain' => $livraison_demain,
            'taux' => $taux,
            ] 
        ];
    }

    private function calculMontants($facture, $date, &$previsionnel, &$livre_terrain, &$non_livre)
    {
        foreach ($facture->detailventes as $detailVente) {
            $montant = $detailVente->Quantite * $detailVente->prix->Prix_detail;
            if ($facture->livraison->date_de_livraison == $date) {
                if ($facture->Id_de_la_mission == "FACEBOOK") {
                    $previsionnel += $montant;

                    if (in_array($facture->Status, ['confirmer', 'en_attente'])) {
                        $non_livre += $montant;
                    }

                    if ($facture->Status === 'livre') {
                        $livre_terrain += $montant;
                    }
                } else {
                    $livre_terrain += $montant;
                }
            }
        }
    }
}
