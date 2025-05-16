<?php

namespace App\Http\Controllers;
use Google_Client;
use App\Models\Test;
use Google_Service_Docs;

use Google_Service_Drive;
use App\Models\GoogleToken;

use App\Models\ReportFormat;
use Illuminate\Http\Request;
use Google_Service_Docs_Document;
use Google_Service_Drive_Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GoogleController extends Controller
{

    public function redirectToGoogle()
    {

        $client = new \Google_Client();
        $client->setClientId("982489806034-7la4bngo53jcg3v2neopton08o2dpo1f.apps.googleusercontent.com");
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri("http://localhost:8000/google/callback");

        $client->addScope([
            'https://www.googleapis.com/auth/drive',
            'https://www.googleapis.com/auth/documents',
        ]);

        $client->setAccessType('offline');
        $client->setPrompt('consent'); // <-- This forces consent screen to refresh scopes

        // return $client->createAuthUrl();
        return redirect($client->createAuthUrl());
    }

    public function handleGoogleCallback()
    {
        // $client = new Google_Client();
        // $client->setClientId(env('GOOGLE_CLIENT_ID'));
        // $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        // $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        // $client->addScope([
        //     'https://www.googleapis.com/auth/drive',
        //     'https://www.googleapis.com/auth/documents',
        // ]);

        // $token = $client->fetchAccessTokenWithAuthCode(request('code'));
        // $client->setAccessToken($token);

        // GoogleToken::updateOrCreate(
        //     ['user_id' => Auth::id() ?? 1],
        //     [
        //         'access_token' => json_encode($token),
        //         'refresh_token' => $token['refresh_token'] ?? null,
        //         'token_expires_at' => now()->addSeconds($token['expires_in'] ?? 3600),
        //     ]
        // );

        // Session::put('google_token', $token); // ✅ This must happen BEFORE return

        // // Optionally retrieve the redirect target from session
        // $to = Session::get('to');
        // $format_name = Session::get('format_name');

        // if ($to && $format_name) {
        //     return redirect("google/create-doc/$format_name");
        // }

        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope([
            'https://www.googleapis.com/auth/drive',
            'https://www.googleapis.com/auth/documents',
        ]);

        $client->setAccessType('offline');      // ✅ important to get refresh_token
        $client->setPrompt('consent');          // ✅ ensures refresh_token on reconsent

        // Exchange auth code for access token
        $token = $client->fetchAccessTokenWithAuthCode(request('code'));

        // Optional: Check for error during token exchange
        if (isset($token['error'])) {
            return redirect()->route('google.login')->withErrors(['google' => $token['error_description'] ?? 'OAuth Error']);
        }

        $client->setAccessToken($token);

        // Save to DB (JSON-encoded)
        GoogleToken::updateOrCreate(
            ['user_id' =>  1], // fallback to ID 1
            [
                'access_token' => json_encode($token),
                'refresh_token' => $token['refresh_token'] ?? null,
                'token_expires_at' => now()->addSeconds($token['expires_in'] ?? 3600),
            ]
        );

        // ✅ Store raw token (array) in session for immediate use
        Session::put('google_token', $token);
        session()->save(); // ensure it's saved before redirect

        // Optional: Set user if not already authenticated (e.g., mock user login)
        // if (!Auth::check()) {
        //     Auth::loginUsingId(1);
        // }

        // Redirect logic
        $to = Session::get('to');
        $format_name = Session::get('format_name');

        if ($to && $format_name) {
            return redirect("google/create-doc/$format_name");
        }



        return redirect()->route('test.all'); // or wherever is appropriate
    }

    // public function handleGoogleCallback()
    // {
    //     $client = new Google_Client();
    //     $client->setClientId(env('GOOGLE_CLIENT_ID'));
    //     $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    //     $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
    //     $client->addScope([
    //         'https://www.googleapis.com/auth/drive',
    //         'https://www.googleapis.com/auth/documents',
    //     ]);

    //     $token = $client->fetchAccessTokenWithAuthCode(request('code'));
    //     $client->setAccessToken($token);

    //     GoogleToken::updateOrCreate(
    //         ['user_id' => 1],
    //         [
    //             'access_token' => json_encode($token),
    //             'refresh_token' => $token['refresh_token'] ?? null,
    //             'token_expires_at' => now()->addSeconds($token['expires_in'] ?? 3600)
    //         ]
    //     );
    //     return redirect()->route('test.all');
    //     return "Hello";
    //     Session::put('google_token', $token);
    //     $to = Session::get('to');
    //     $format_name = Session::get('format_name');
    //     $url = "google/create-doc/" . $format_name;

    //     return redirect()->back();
    // }

    public function listDocs()
    {
        $client = new Google_Client();
        $client->setAccessToken(Session::get('google_token'));

        $service = new Google_Service_Drive($client);
        $results = $service->files->listFiles([
            'q' => "mimeType='application/vnd.google-apps.document'",
            'fields' => 'files(id, name)',
        ]);

        return view('docs.index', ['docs' => $results->getFiles()]);
    }

    // public function createGoogleDoc($testId)
    // {

    //     $token = Session::get('google_token');
    //     if ($token) {

    //         GoogleToken::where('access_token', $token)->update([
    //             'user_id' => auth()->id()
    //         ]);
    //     }
    //     $client = new \Google_Client();
    //     $tokenData = GoogleToken::where('user_id', Auth::id())->first();
    //     Session::put('to', 'google/create-doc');
    //     Session::put('format_name', $testId);
    //     if (!$tokenData) {
    //         return redirect()->to('google/login');
    //        }
    //     $accessToken = json_decode($tokenData->access_token, true);
    //     $client->setAccessToken($accessToken);
    //     if ($client->isAccessTokenExpired()) {
    //         if (!$tokenData->refresh_token) {
    //             return redirect()->to('google/login');
    //         }
    //         $newToken = $client->fetchAccessTokenWithRefreshToken($tokenData->refresh_token);
    //         if (isset($newToken['error'])) {
    //             return redirect()->to('google/login');
    //         }
    //         $client->setAccessToken($newToken);
    //         $tokenData->update([
    //             'access_token' => json_encode($newToken),
    //             'token_expires_at' => now()->addSeconds($newToken['expires_in'] ?? 3600),
    //         ]);
    //     }
    //     $docsService = new \Google_Service_Docs($client);
    //     $test = Test::find($testId);
    //     $document = new \Google_Service_Docs_Document([
    //         'title' => $test->test_name,
    //     ]);
    //     $createdDoc = $docsService->documents->create($document);
    //     $docId = $createdDoc->getDocumentId();
    //     $docUrl = "https://docs.google.com/document/d/$docId/edit";
    //     $driveService = new \Google_Service_Drive($client);
    //     $permission = new \Google_Service_Drive_Permission([
    //         'type' => 'anyone',
    //         'role' => 'writer'
    //     ]);
    //     $driveService->permissions->create($docId, $permission);
    //     ReportFormat::create([
    //         'format_name' => $test->test_name,
    //         'doc_id' => $docId,
    //         'doc_url' => $docUrl,
    //         'test_id' => $testId
    //         ,
    //     ]);
    //     return redirect()->to($docUrl);
    //     return response()->json([
    //         'doc_id' => $docId,
    //         'url' => $docUrl,
    //     ]);
    // }

    public function createGoogleDoc($testId=1)
    {
        $tokenData = GoogleToken::where('user_id', Auth::id())->first();

        // Store destination in session if redirection is needed later
        Session::put('to', 'google/create-doc');
        Session::put('format_name', $testId);

        // If token is missing, redirect to login
        if (!$tokenData) {
            return redirect()->to('google/login');
        }

        $client = new \Google_Client();
        $accessToken = json_decode($tokenData->access_token, true);
        $client->setAccessToken($accessToken);

        // Refresh token if expired
        if ($client->isAccessTokenExpired()) {
            if (!$tokenData->refresh_token) {
                return redirect()->to('google/login');
            }

            $newToken = $client->fetchAccessTokenWithRefreshToken($tokenData->refresh_token);

            if (isset($newToken['error'])) {
                return redirect()->to('google/login');
            }

            $client->setAccessToken($newToken);

            // Update stored token
            $tokenData->update([
                'access_token' => json_encode($newToken),
                'token_expires_at' => now()->addSeconds($newToken['expires_in'] ?? 3600),
            ]);
        }

        // Google Docs creation
        $docsService = new \Google_Service_Docs($client);
        $test = Test::findOrFail($testId); // Use findOrFail to catch invalid test IDs

        $document = new \Google_Service_Docs_Document([
            'title' => $test->test_name,
        ]);

        $createdDoc = $docsService->documents->create($document);
        $docId = $createdDoc->getDocumentId();
        $docUrl = "https://docs.google.com/document/d/$docId/edit";

        // Set sharing permission
        $driveService = new \Google_Service_Drive($client);
        $permission = new \Google_Service_Drive_Permission([
            'type' => 'anyone',
            'role' => 'writer'
        ]);
        $driveService->permissions->create($docId, $permission);

        // Save to DB
        ReportFormat::create([
            'format_name' => $test->test_name,
            'doc_id' => $docId,
            'doc_url' => $docUrl,
            'test_id' => $testId,
        ]);

        // Final redirect
        return redirect()->to($docUrl);
    }


    public function createGoogleDocBackup()
    {
        $client = new \Google_Client();
        $client->setAccessToken(Session::get('google_token'));

        // Initialize Google Docs service
        $docsService = new \Google_Service_Docs($client);

        // Define the new document
        $document = new \Google_Service_Docs_Document([
            'title' => '12345'
        ]);

        // Create the document
        $createdDoc = $docsService->documents->create($document);

        // Get the new Doc's ID and URL
        $docId = $createdDoc->getDocumentId();
        $docUrl = "https://docs.google.com/document/d/$docId/edit";
        // return view('docs.index', ['doc_id' => $docId]);

        return response()->json([
            'doc_id' => $docId,
            'url' => $docUrl,
        ]);
    }


}
