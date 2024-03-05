<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CloudflareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $graphqlApiUrl = 'https://api.cloudflare.com/client/v4/graphql';

        $globalApiKey = 'xxxxxxxxxxxxxxx';
        $accountId = 'xxxxxxxxxxxxxxxx';
        $accountEmail = 'asthanarajat12@gmail.com';

        $graphqlQuery = <<<'GRAPHQL'
    query {
        viewer {
            zones(limit: 5) {
                count
                items {
                    id
                    name
                    development_mode
                }
            }
        }
    }
GRAPHQL;

        $response = Http::withHeaders([
            'X-Auth-Email' => 'YOUR_CLOUDFLARE_EMAIL',
            'X-Auth-Key' => $globalApiKey,
            'Content-Type' => 'application/json',
        ])->post($graphqlApiUrl, ['query' => $graphqlQuery]);

        $zones = $response->json()['data']['viewer']['zones']['items'];

        $additionalData = [
            'status' => 'success',
            'message' => 'Data processed successfully',
        ];

        return view(
            'admin.cloudflare.index',
            compact('globalApiKey', 'accountId', 'zones', 'additionalData')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cloudflare.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $zoneName = $request->input('zone_name');

        return redirect()
            ->route('cloudflare.index')
            ->with('success', 'Zone created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $zone = []; // Retrieve zone details using Cloudflare API

        return view('admin.cloudflare.show', compact('zone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zone = []; // Retrieve zone details using Cloudflare API

        return view('admin.cloudflare.edit', compact('zone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update zone details using Cloudflare API
        // ...

        return redirect()
            ->route('cloudflare.index')
            ->with('success', 'Zone updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete zone using Cloudflare API
        // ...

        return redirect()
            ->route('cloudflare.index')
            ->with('success', 'Zone deleted successfully');
    }
}
