<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpotifyController extends Controller
{
    public function getToken() {
        $client_id = "1e61f89944a048cdbf8f01bc9e8c620e";
        $client_secret = "60f1b57d9c74438b89d4798372951899";

        $url = "https://accounts.spotify.com/api/token";
        $headers = [
            "Authorization: Basic " . base64_encode($client_id . ":" . $client_secret),
            "Content-Type: application/x-www-form-urlencoded"
        ];

        $data = "grant_type=client_credentials";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        $json_result = json_decode($result, true);
        return $json_result['access_token'];
    }

    public function buscarArtista(Request $request) {
        $token = $this->getToken();
        $artist_name = $request->input('artist_name');

        // Buscar el artista
        $url = "https://api.spotify.com/v1/search?q=" . urlencode($artist_name) . "&type=artist&limit=1";
        $headers = [
            "Authorization: Bearer " . $token
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        $json_result = json_decode($result, true);

        // Extraer los datos del artista
        if (!empty($json_result['artists']['items'])) {
            $artist = $json_result['artists']['items'][0];
            $artist_data = [
                'id' => $artist['id'],
                'name' => $artist['name'],
                'followers' => $artist['followers']['total'],
                'genres' => implode(', ', $artist['genres']),
                'popularity' => $artist['popularity'],
                'image' => $artist['images'][0]['url'] ?? ''
            ];

            // Obtener el top 5 de canciones
            $top_tracks_url = "https://api.spotify.com/v1/artists/" . $artist_data['id'] . "/top-tracks?market=US";
            $ch = curl_init($top_tracks_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $top_tracks_result = curl_exec($ch);
            curl_close($ch);

            $top_tracks_data = json_decode($top_tracks_result, true);
            $top_tracks = [];

            if (!empty($top_tracks_data['tracks'])) {
                // Extraer solo las primeras 5 canciones
                $top_tracks = array_slice($top_tracks_data['tracks'], 0, 5);
            }
        } else {
            $artist_data = null;
            $top_tracks = null;
        }

        // Devolver los datos del artista y las canciones a la vista
        return view('spotify', compact('artist_data', 'top_tracks'));
    }
}
