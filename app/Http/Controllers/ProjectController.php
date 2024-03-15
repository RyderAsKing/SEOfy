<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $projects = Project::where('user_id', '=', auth()->user()->id)
            ->with('plan')
            ->latest();

        if ($request->has('search')) {
            $projects->where('name', 'like', "%{$request->search}%");
        }

        $projects = $projects->paginate(25);

        return view('projects.index', compact('projects'));
    }

    public function show(Request $request, Project $project)
    {
        //
        $timelines = $project
            ->timeline()
            ->latest()
            ->paginate(25);

        $hitsData = [];
        if ($project->org_id && $project->website_id) {
            $fields = [];

            if ($request->timeframe != null) {
                if ($request->timeframe == 'today') {
                    $fields['start'] = date(
                        'Y-m-d\TH:i:s\Z',
                        strtotime('today midnight')
                    );
                    $fields['end'] = date(
                        'Y-m-d\TH:i:s\Z',
                        strtotime('tomorrow midnight') - 1
                    );
                    $fields['granularity'] = 'hour';
                } elseif ($request->timeframe == 'week') {
                    $fields['start'] = date(
                        'Y-m-d\TH:i:s\Z',
                        strtotime('last monday midnight')
                    );
                    $fields['end'] = date(
                        'Y-m-d\TH:i:s\Z',
                        strtotime('tomorrow midnight') - 1
                    );
                    $fields['granularity'] = 'day';
                } elseif ($request->timeframe == 'month') {
                    $fields['start'] = date(
                        'Y-m-d\TH:i:s\Z',
                        strtotime('first day of this month midnight')
                    );
                    $fields['end'] = date(
                        'Y-m-d\TH:i:s\Z',
                        strtotime('tomorrow midnight') - 1
                    );
                    $fields['granularity'] = 'day';
                }
            } else {
                $fields['start'] = date(
                    'Y-m-d\TH:i:s\Z',
                    strtotime('today midnight')
                );
                $fields['end'] = date(
                    'Y-m-d\TH:i:s\Z',
                    strtotime('tomorrow midnight') - 1
                );
                $fields['granularity'] = 'hour';
            }

            // get the organization and website
            $org_id = $project->org_id;
            $website_id = $project->website_id;

            $url =
                env('ENHANCE_URL') .
                "/orgs/{$org_id}/websites/{$website_id}/metrics";

            $url .= '?' . http_build_query($fields);

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . env('ENHANCE_API'),
                    'Content-Type: application/json',
                ],
            ]);

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($curl);

            if ($response === false) {
                throw new Exception('cURL error: ' . curl_error($curl));
            }

            curl_close($curl);

            $result = json_decode($response, true);
            $hitsData['data'] = $result['items'];

            $hitsData['total_hits'] = array_sum(
                array_column($result['items'], 'totalHits')
            );
            $hitsData['unique_hits'] = array_sum(
                array_column($result['items'], 'uniqueHits')
            );

            $hitsData['bandwidth'] =
                array_sum(array_column($result['items'], 'bytesReceived')) +
                array_sum(array_column($result['items'], 'bytesSent'));

            $hitsData['bandwidth'] =
                $hitsData['bandwidth'] / 1024 / 1024 / 1024;
            $hitsData['bandwidth'] = number_format($hitsData['bandwidth'], 2);
        }

        return view(
            'projects.show',
            compact('project', 'timelines', 'hitsData')
        );
    }
}
