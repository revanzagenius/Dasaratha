@extends('layouts.app')

@section('content')
    <!-- Container utama -->
    <div class="container mx-auto py-8">
        <!-- Card untuk detail IP -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <div class="bg-gray-800 text-white px-6 py-4">
                <h5 class="text-lg font-semibold">Details for IP: {{ $host->ip }}</h5>
            </div>
            <div class="p-6">
                <table class="w-full text-sm text-left text-gray-800">
                    <tbody>
                        <tr class="border-b">
                            <th class="py-2 px-4 font-medium">IP Address</th>
                            <td class="py-2 px-4">{{ $host->ip }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="py-2 px-4 font-medium">Country</th>
                            <td class="py-2 px-4">{{ $host->country }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="py-2 px-4 font-medium">City</th>
                            <td class="py-2 px-4">{{ $host->city }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="py-2 px-4 font-medium">ISP</th>
                            <td class="py-2 px-4">{{ $host->isp }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="py-2 px-4 font-medium">ASN</th>
                            <td class="py-2 px-4">{{ $host->asn }}</td>
                        </tr>
                        <tr>
                            <th class="py-2 px-4 font-medium">Open Ports</th>
                            <td class="py-2 px-4">
                                @php
                                    $ports = json_decode($host->ports);
                                    echo is_array($ports) ? implode(', ', $ports) : 'N/A';
                                @endphp
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex gap-4 mt-4">
                    <a href="{{ route('dashboard.index') }}" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">Back to Dashboard</a>
                    <a href="{{ route('dashboard.exportPdf', $host->id) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Export to PDF</a>
                </div>
            </div>
        </div>



        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Card untuk Vulnerabilities -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gray-800 text-white px-6 py-4">
                    <h5 class="text-lg font-semibold">Vulnerabilities (CVE)</h5>
                </div>
                <div class="p-6">
                    @if ($host->vulns)
                        <table class="w-full text-sm text-left text-gray-800">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4">CVE ID</th>
                                    <th class="py-2 px-4">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (json_decode($host->vulns) as $vuln)
                                    <tr class="border-b">
                                        <td class="py-2 px-4">{{ $vuln }}</td>
                                        <td class="py-2 px-4">{{ json_decode($host->cve_details)->{$vuln} ?? 'No details available' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-600"><em>No vulnerabilities detected.</em></p>
                    @endif
                </div>
            </div>

            <!-- Card untuk Service Banners -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gray-800 text-white px-6 py-4">
                    <h5 class="text-lg font-semibold">Service Banners</h5>
                </div>
                <div class="p-6">
                    @php
                        $serviceBanners = json_decode($host->service_banners);
                    @endphp
                    @if ($serviceBanners && is_array($serviceBanners))
                        <table class="w-full text-sm text-left text-gray-800">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4">Port</th>
                                    <th class="py-2 px-4">Service Banner</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($serviceBanners as $service)
                                    <tr class="border-b">
                                        <td class="py-2 px-4">{{ $service->port }}</td>
                                        <td class="py-2 px-4">{{ $service->banner }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-600"><em>No service banners available.</em></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection