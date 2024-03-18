<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Viewing Project') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 grid grid-cols-2 max-w-7xl mx-auto gap-3 sm:px-6 lg:px-8">
        @if(isset($hitsData['data']))
        <div class="col-span-2 flex flex-col gap-2">
            <div class="w-full">
                <h1 class="text-xl mb-1 flex justify-between">Visitors <span class="inline-flex rounded-md shadow-sm">
                        <a href="{{ route('projects.show', $project)}}?timeframe=today"
                            class="px-4 py-2 text-sm font-medium  bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                            Today
                        </a>
                        <a href="{{ route('projects.show', $project)}}?timeframe=week"
                            class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                            Week
                        </a>
                        <a href="{{ route('projects.show', $project)}}?timeframe=month"
                            class="px-4 py-2 text-sm font-medium text-gray-900  bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                            Month
                        </a>
                    </span></h1>
                <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                    <div class="block flex justify-between items-center">
                        <p class="text-md leading-none tracking-tight text-neutral-900 ">
                            This project had <strong> {{$hitsData['total_hits']}} visits</strong> <span
                                class="text-sm">over the
                                last
                                {{isset($_GET['timeframe']) ?
                                $_GET['timeframe'] : 'day'}}</span>

                        </p>
                        <span
                            class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{$hitsData['unique_hits']}}
                            unique visitors</span>
                    </div>
                    <div class="grid grid-cols-2 gap-1">
                        <div>
                            <canvas id="hits"></canvas>
                        </div>
                        <div>
                            <canvas id="uniqueHits"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h1 class="text-xl mb-1">Bandwidth</h1>
                <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                    <p>This project has used <strong> {{$hitsData['bandwidth']}} GB </strong> over the last
                        {{isset($_GET['timeframe']) ?
                        $_GET['timeframe'] : 'day'}}</p>

                </div>
            </div>
        </div>
        @endif

        @if(auth()->user()->is_admin && $project->private_note != null)
        <div
            class="col-span-2 relative w-full rounded-lg border bg-white p-4 [&>svg]:absolute [&>svg]:text-foreground [&>svg]:left-4 [&>svg]:top-4 [&>svg+div]:translate-y-[-3px] [&:has(svg)]:pl-11 text-nuetral-900">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="4 17 10 11 4 5"></polyline>
                <line x1="12" x2="20" y1="19" y2="19"></line>
            </svg>
            <h5 class="mb-1 font-medium leading-none tracking-tight">Private Note</h5>
            <div class="text-sm opacity-70">{{$project->private_note}}</div>
        </div>
        @endif

        @if($project->public_note != null)
        <div
            class="col-span-2 relative w-full rounded-lg border bg-white p-4 [&>svg]:absolute [&>svg]:text-foreground [&>svg]:left-4 [&>svg]:top-4 [&>svg+div]:translate-y-[-3px] [&:has(svg)]:pl-11 text-nuetral-900">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="4 17 10 11 4 5"></polyline>
                <line x1="12" x2="20" y1="19" y2="19"></line>
            </svg>
            <h5 class="mb-1 font-medium leading-none tracking-tight">Notes</h5>
            <div class="text-sm opacity-70">{{$project->public_note}}</div>
        </div>
        @endif

        <div class="flex flex-col gap-4">
            <div>
                <h1 class="text-xl mb-1">Project details</h1>
                <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                    <div class="block mb-3">
                        <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900 flex justify-between">
                            {{$project->name}}
                            <span
                                class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{$project->status}}</span>
                        </h5>
                    </div>
                    <span>Website: <a href="{{$project->url}}"
                            class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{$project->url}}</a></span>
                    <p class="mb-4 text-neutral-500">{{$project->description}}</p>
                </div>
            </div>
            <div>
                <h1 class="text-xl mb-1">Current Status</h1>
                <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                    <h1>The current status of the project</h1>
                    @foreach($project->custom_fields as $field => $value)
                    <div class="flex justify-between">
                        <span class="text-neutral-500">{{$field}}</span>
                        <span class="text-neutral-900">
                            @if($value == 'true')
                            &#9989;

                            @elseif($value == 'false')&#10062;

                            @else
                            <span>{{$value}}
                                @if(intval($project->plan->features->$field) > 1)/
                                {{intval($project->plan->features->$field)}} @endif
                            </span>
                            @endif
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div>
            <h1 class="text-xl mb-1">Plan details</h1>
            <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                <div class="block mb-3">
                    <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">{{$project->plan->name}}
                    </h5>
                </div>
                <p class="mb-4 text-neutral-500">{{$project->plan->description}}</p>

                <h3>Features </h3>
                <div class="grid grid-cols-2 gap-2 my-2">
                    @foreach ($project->plan->features as $feature => $description)

                    <div class="max-w-sm bg-white border rounded-lg shadow-sm p-4 border-neutral-200/60">
                        <div class="block mb-3">
                            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">{{$feature}}</h5>
                        </div>
                        <p class="mb-4 text-neutral-500">{{$description}}</p>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-span-2 mt-4">
            <h2 class="text-xl">Updates</h2>
            @if($timelines->count() == 0)
            <div class="rounded-lg  mt-4">
                <h1 class="text-xl font-bold leading-none tracking-tight text-neutral-900">No updates yet</h1>
                <p class="mb-4 text-neutral-500">There are no updates yet, check back later.</p>
            </div>
            @endif
            <ol class="border-l border-neutral-300 dark:border-neutral-500">
                @foreach ($timelines as $timeline)
                <li>
                    <div class="flex-start flex items-center pt-3">
                        <div class="-ml-[5px] mr-3 h-[9px] w-[9px] rounded-full bg-neutral-500 "></div>
                        <p class="text-sm text-neutral-500 ">
                            {{$timeline->created_at->format('d.m.Y')}}
                        </p>
                    </div>
                    <div class=" ml-4 mt-2">
                        <h4 class="mb-1.5 text-xl font-semibold">{{$timeline->title}}</h4>
                        <p class="mb-3 text-neutral-500 ">
                            {{$timeline->description}}
                        </p>
                    </div>
                </li>
                @endforeach
            </ol>
        </div>
        {{$timelines->links()}}
    </div>

    @if($project->org_id && $project->website_id)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
      const hitsData = {!! json_encode($hitsData['data']) !!};
      const labels = hitsData.map(entry => formatDate(entry.datetime));
      const hitsDataArray = hitsData.map(entry => entry.totalHits);
      const uniqueHitsDataArray = hitsData.map(entry => entry.uniqueHits);

        function formatDate(timestamp) {
        const date = new Date(timestamp);
        const day = date.getDate();
        const month = date.getMonth() + 1;
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
        }

      const hitsConfig = {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: 'Hits',
            data: hitsDataArray,
            fill: true,
            borderColor: 'rgba(54, 162, 235, 1)',
            backgroundColor: '#41C9E2',
            borderWidth: 2,
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: true,
              text: 'Hits'
            }
          },
          scales: {
            x: {
                grid: {
                    display: false
                }
            },
            y: {
              type: 'linear',
              display: true,
              position: 'left',
              scaleLabel: {
                labelString: 'Visits',
                display: true,
              },
              ticks: {
                beginAtZero: true
              },
              grid: {
                display: false
              }
            }
          }
        },
      };

      const hitsCtx = document.getElementById('hits').getContext('2d');
      const hitsChart = new Chart(hitsCtx, hitsConfig);

      const uniqueHitsConfig = {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: 'Unique Hits',
            data: uniqueHitsDataArray,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: true,
              text: 'Unique Hits'
            }
          },
          scales: {
            x: {grid : {
                display: false
            }},
            y: {
              type: 'linear',
              display: true,
              position: 'left',
              scaleLabel: {
                labelString: 'Unique Visits',
                display: true,
              },
              ticks: {
                beginAtZero: true
              },
                grid: {
                    display: false
                },
            }
          },
        },

      };

      const uniqueHitsCtx = document.getElementById('uniqueHits').getContext('2d');
      const uniqueHitsChart = new Chart(uniqueHitsCtx, uniqueHitsConfig);
    });
    </script>
    @endif
</x-app-layout>
