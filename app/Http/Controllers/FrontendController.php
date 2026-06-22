<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index', [
            'metaDescription' => "AIAE — Construction, énergie solaire, sécurité incendie et préfabrication au Togo. De la conception à la réalisation, votre partenaire BTP tout-en-un.",
            'ogDescription' => "AIAE — Votre partenaire construction et infrastructure au Togo.",
        ]);
    }

    public function about()
    {
        return view('frontend.about', [
            'metaDescription' => "Découvrez AIAE (Afrika Infrastructures And Equipements) — agence de construction au Togo spécialisée en bâtiment, génie civil, énergie solaire, sécurité et préfabrication.",
            'ogDescription' => "AIAE — Agence de construction et d'infrastructures au Togo.",
        ]);
    }

    public function divisions()
    {
        return view('frontend.divisions', [
            'metaDescription' => "AIAE — 4 divisions complémentaires : Construction, Énergie solaire, Sécurité incendie, Préfabrication. Une équipe pluridisciplinaire pour vos projets au Togo.",
            'ogDescription' => "AIAE — Construction, Énergie, Sécurité, Préfabrication au Togo.",
        ]);
    }


    public function faq()
    {
        return view('frontend.faq', [
            'metaDescription' => "FAQ AIAE — Réponses à vos questions sur la construction, le simulateur de devis, l'énergie solaire et les services AIAE au Togo.",
            'ogDescription' => "FAQ — Questions fréquentes sur AIAE et ses services.",
        ]);
    }

    public function contact()
    {
        return view('frontend.contact', [
            'metaDescription' => "Contactez AIAE — Agence de construction et d'infrastructures basée à Lomé, Togo. Tél : +228 90 03 54 16. Demandez un devis gratuit.",
            'ogDescription' => "Contactez AIAE — Lomé, Togo. +228 90 03 54 16.",
        ]);
    }

    public function diaspora()
    {
        return view('frontend.diaspora', [
            'metaDescription' => "AIAE Diaspora — Construire au Togo depuis l'étranger. Accompagnement complet pour la diaspora togolaise : terrain, permis, construction clé en main.",
            'ogDescription' => "AIAE Diaspora — Construisez au Togo depuis l'étranger.",
        ]);
    }

    public function mentionsLegales()
    {
        return view('frontend.mentions-legales', [
            'metaDescription' => "Mentions légales AIAE — Afrika Infrastructures And Equipements. Siège à Lomé, Togo. Informations légales, RGPD et protection des données.",
            'ogDescription' => "Mentions légales AIAE — Informations juridiques.",
        ]);
    }
}
