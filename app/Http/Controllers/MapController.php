<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Resolve a short Google Maps link to a usable embed URL and redirect.
     * This follows redirects server-side, extracts lat/lng if possible, and
     * redirects the client (iframe) to a stable embed URL.
     */
    public function redirectToEmbed(Request $request)
    {
        // Use fixed coordinates provided by the user (RM Gulai Kambing Kakek)
        $lat = '-0.9630501253081452';
        $lng = '100.60195909658837';

        $embed = "https://maps.google.com/maps?q={$lat},{$lng}&z=17&output=embed";
        return redirect()->away($embed);
    }
}
