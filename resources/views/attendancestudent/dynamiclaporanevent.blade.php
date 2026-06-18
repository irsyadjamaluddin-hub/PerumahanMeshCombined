<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Attendance Report</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('img/logo.png') }}" rel="icon">
    <link href="{{ asset('img/logo.png') }}" rel="apple-touch-icon">

    <!-- {{-- Tailwind CSS --}} -->
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Google Fonts: Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    {{-- JQuery (for Slick Slider) --}}
    <script type="text/javascript" src="{{ asset('css/jquery/jquery.min.js') }}"></script>

    <style>

        .first {
            background-color: #868AE8;
        }

        .second {
            background-color: #93BDEB;
        }

        .middle{
            background-color: #EEC8ED;
        }

        .third {
            background-color: #C8A5DB;
        }

        .fourth {
            background-color: #EBCFF7;
        }

        .fifth {
            background-color: #EBEBE6;
        }

        .table-bordered {
            border: 1.5px solid blue !important;
        }

        th, td {
            padding: 8px;
            text-align: center;
            border: 1px solid blue !important;
        }

        .jumlah{
            font-weight: bold;
        }

        .oriGreen {
            background-color: #8fbc94;
        }

        /* ----------------------------------------------------- */
        /* ADDED BY AZB @ 16/07/24 */
        /* ----------------------------------------------------- */

        .check {
            border: 3px solid red;
        }

        .poppins {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

    </style>

</head>

<body class="poppins oriGreen">

    <div class="w-[98%] lg:w-4/5 mx-auto">

        {{-- Header --}}
        <div class="text-center my-10 text-4xl font-medium">
            <p>Laporan {{$attdevent->name}}</p>
        </div>

        {{-- First Section --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">

            {{-- Left --}}
            <div class="grid grid-flow-row grid-cols-1 gap-2">
                <div class="h-full p-2 bg-white flex flex-col items-center justify-center gap-2 rounded-md border-2 border-sky-600">
                    <p class="underline text-xl">Jumlah Kehadiran Penuntut</p>
                    <p class="text-3xl">{{$totalRecSt->filter(function($totalRecSt) {return $totalRecSt->hadir === 'Ya';})->count()}}</p>
                </div>

                <div class="h-full p-2 bg-white flex flex-col items-center justify-center gap-2 rounded-md border-2 border-sky-600">
                    <p class="underline text-xl">Jumlah Kehadiran Persembahan Khas</p>
                    <p class="text-3xl">{{$totalRecPk->filter(function($totalRecPk) {return $totalRecPk->hadir === 'Ya';})->count()}}</p>
                </div>

                <div class="h-full p-2 bg-white flex flex-col items-center justify-center gap-2 rounded-md border-2 border-sky-600">
                    <p class="underline text-xl">Jumlah Kehadiran Pengawas</p>
                    <p class="text-3xl">{{$totalRecTe->filter(function($totalRecTe) {return $totalRecTe->hadir === 'Ya';})->count()}}</p>
                </div>
            </div>

            {{-- Right: Chart --}}
            <div class="bg-white rounded-md border-2 border-sky-600">

                <p class="px-8 py-5 text-xl">Status Kehadiran</p>

                <div id="stackHadir" class="mr-5 ml-5"></div>

            </div>

        </div>

        {{-- Second Section --}}
        <div class="bg-white rounded-md border-2 border-blue-600 mt-2 p-8">

            <div class="text-center">
                <p class="text-xl">LAPORAN PENGLIBATAN DAN KEHADIRAN PENUNTUT BAGI PERBARISAN KEHORMATAN SEMPENA HARI KEPUTERAAN KDYMM YANG KE-78 TAHUN</p>
                <p class="mt-4 text-sm">(Dikemaskini: <span id="spanDate1" style="color: blue"></span> )</p>
            </div>

            <div class="overflow-x-auto">
                <table class="mt-8 w-full table-bordered">

                    <thead>

                        <tr class="*:font-semibold">
                            <th class="first" scope="col" rowspan="2">Bil.</th>
                            <th class="first" scope="col" rowspan="2">Kategori</th>
                            <th class="first" scope="col" rowspan="2">Jumlah Sekolah</th>
                            <th class="second" scope="col" colspan="2">Jumlah Penuntut</th>
                            <th class="middle" scope="col" colspan="2">Jumlah Persembahan</th>
                            <th class="third" scope="col" colspan="2">Jumlah Pengawas</th>
                        </tr>

                        <tr class="*:font-semibold">
                            <th class="second" scope="col">Senarai Asal</th>
                            <th class="second" scope="col">Kehadiran (%)</th>
                            <th class="middle" scope="col">Senarai Asal</th>
                            <th class="middle" scope="col">Kehadiran (%)</th>
                            <th class="third" scope="col">Senarai Asal</th>
                            <th class="third" scope="col">Kehadiran (%)</th>
                        </tr>

                    </thead>

                    <tbody>

                        @php
                            $totalRecordsteaJSS = $records->filter(function($record) {
                                return in_array($record->category, ['Guru Pengawas', 'Guru Fokal']) && $record->school_category == 'JSS';
                            })->count();

                            $guruPengawasGuruFokalYaCountJSS = $records->filter(function($record) {
                                return in_array($record->category, ['Guru Pengawas', 'Guru Fokal']) && $record->hadir === 'Ya' && $record->school_category == 'JSS';
                            })->count();

                            $percentageteaJSS = $totalRecordsteaJSS > 0 ? number_format(($guruPengawasGuruFokalYaCountJSS / $totalRecordsteaJSS) * 100, 2) : '0.00';

                            $totalRecordstJSS = $records->filter(function($record) {
                                return $record->category === 'Pelajar' && $record->school_category == 'JSS';
                            })->count();

                            $pelajarCountJSS = $records->filter(function($record) {
                                return $record->category === 'Pelajar' && $record->hadir == 'Ya' && $record->school_category == 'JSS';
                            })->count();

                            $percentagestJSS = $totalRecordstJSS > 0 ? number_format(($pelajarCountJSS / $totalRecordstJSS) * 100, 2) : '0.00';

                            $totalRecordspkJSS = $records->filter(function($record) {
                                return in_array($record->category, ['Persembahan Khas','Hadrah','Choir']) && $record->school_category == 'JSS';
                            })->count();

                            $pkCountJSS = $records->filter(function($record) {
                                return in_array($record->category, ['Persembahan Khas','Hadrah','Choir']) && $record->hadir === 'Ya' && $record->school_category == 'JSS';
                            })->count();
                            
                            $percentagepkJSS = $totalRecordspkJSS > 0 ? number_format(($pkCountJSS / $totalRecordspkJSS) * 100, 2) : '0.00';


                            //JPS

                             $totalRecordsteaJPS = $records->filter(function($record) {
                                return in_array($record->category, ['Guru Pengawas', 'Guru Fokal']) && $record->school_category == 'JPS';
                            })->count();

                            $guruPengawasGuruFokalYaCountJPS = $records->filter(function($record) {
                                return in_array($record->category, ['Guru Pengawas', 'Guru Fokal']) && $record->hadir === 'Ya' && $record->school_category == 'JPS';
                            })->count();

                            $percentageteaJPS = $totalRecordsteaJPS > 0 ? number_format(($guruPengawasGuruFokalYaCountJPS / $totalRecordsteaJPS) * 100, 2) : '0.00';

                            $totalRecordstJPS = $records->filter(function($record) {
                                return $record->category === 'Pelajar' && $record->school_category == 'JPS';
                            })->count();

                            $pelajarCountJPS = $records->filter(function($record) {
                                return $record->category === 'Pelajar' && $record->hadir == 'Ya' && $record->school_category == 'JPS';
                            })->count();

                            $percentagestJPS = $totalRecordstJPS > 0 ? number_format(($pelajarCountJPS / $totalRecordstJPS) * 100, 2) : '0.00';

                            $totalRecordspkJPS = $records->filter(function($record) {
                                return in_array($record->category, ['Persembahan Khas','Hadrah','Choir']) && $record->school_category == 'JPS';
                            })->count();

                            $pkCountJPS = $records->filter(function($record) {
                                return in_array($record->category, ['Persembahan Khas','Hadrah','Choir']) && $record->hadir === 'Ya' && $record->school_category == 'JPS';
                            })->count();
                            
                            $percentagepkJPS = $totalRecordspkJPS > 0 ? number_format(($pkCountJPS / $totalRecordspkJPS) * 100, 2) : '0.00';

                            //JPKK

                             $totalRecordsteaJPKK = $records->filter(function($record) {
                                return in_array($record->category, ['Guru Pengawas', 'Guru Fokal']) && $record->school_category == 'JPKK';
                            })->count();
                            $guruPengawasGuruFokalYaCountJPKK = $records->filter(function($record) {
                                return in_array($record->category, ['Guru Pengawas', 'Guru Fokal']) && $record->hadir === 'Ya' && $record->school_category == 'JPKK';
                            })->count();
                            $percentageteaJPKK = $totalRecordsteaJPKK > 0 ? number_format(($guruPengawasGuruFokalYaCountJPKK / $totalRecordsteaJPKK) * 100, 2) : '0.00';

                            $totalRecordstJPKK = $records->filter(function($record) {
                                return $record->category === 'Pelajar' && $record->school_category == 'JPKK';
                            })->count();
                            $pelajarCountJPKK = $records->filter(function($record) {
                                return $record->category === 'Pelajar' && $record->hadir == 'Ya' && $record->school_category == 'JPKK';
                            })->count();

                            $percentagestJPKK = $totalRecordstJPKK > 0 ? number_format(($pelajarCountJPKK / $totalRecordstJPKK) * 100, 2) : '0.00';

                            $totalRecordspkJPKK = $records->filter(function($record) {
                                return in_array($record->category, ['Persembahan Khas','Hadrah','Choir']) && $record->school_category == 'JPKK';
                            })->count();

                            $pkCountJPKK = $records->filter(function($record) {
                                return in_array($record->category, ['Persembahan Khas','Hadrah','Choir']) && $record->hadir === 'Ya' && $record->school_category == 'JPKK';
                            })->count();
                            
                            $percentagepkJPKK = $totalRecordspkJPKK > 0 ? number_format(($pkCountJPKK / $totalRecordspkJPKK) * 100, 2) : '0.00';


                            //TOTAL COUNT

                            $totalCountDept = $JSSTotal->count() + $JPSTotal->count() + $JPKKTotal->count();

                            $totalCountStAs = $totalRecordstJSS + $totalRecordstJPS + $totalRecordstJPKK;

                            $totalCountStH = $pelajarCountJSS + $pelajarCountJPS + $pelajarCountJPKK;

                            $totalCountStPerc = $totalCountStAs > 0 ? number_format(($totalCountStH / $totalCountStAs) * 100, 2) : '0.00';

                            $totalCountTeH = $guruPengawasGuruFokalYaCountJSS + $guruPengawasGuruFokalYaCountJPS + $guruPengawasGuruFokalYaCountJPKK;

                            $totalCountTeAs = $totalRecordsteaJSS + $totalRecordsteaJPS + $totalRecordsteaJPKK;

                            $totalCountTePerc = $totalCountStAs > 0 ? number_format(($totalCountTeH / $totalCountTeAs) * 100, 2) : '0.00';

                            $totalCountPkH = $pkCountJSS + $pkCountJPS + $pkCountJPKK;

                            $totalCountPkAs = $totalRecordspkJSS + $totalRecordspkJPS + $totalRecordspkJPKK;

                            $totalCountPkPerc = $totalCountStAs > 0 ? number_format(($totalCountPkH / $totalCountPkAs) * 100, 2) : '0.00';

                        @endphp

                        <tr>
                            <td scope="row">1.</td>
                            <td scope="row">Jabatan Sekolah-Sekolah</td>
                            <td>{{ $JSSTotal->count() }}</td>
                            <td>{{ $totalRecordstJSS }}</td>
                            <td>{{ $pelajarCountJSS }} ( {{ $percentagestJSS }}%)</td>
                            <td>{{ $totalRecordspkJSS }}</td>
                            <td>{{ $pkCountJSS }} ( {{ $percentagepkJSS }}%)</td>
                             <td>{{ $totalRecordsteaJSS }}</td>
                            <td>{{ $guruPengawasGuruFokalYaCountJSS }} ( {{ $percentageteaJSS }}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">2.</td>
                            <td scope="row">Jabatan Pendidikan Swasta</td>
                            <td>{{ $JPSTotal->count() }}</td>
                            <td>{{ $totalRecordstJPS }}</td>
                            <td>{{ $pelajarCountJPS }} ( {{ $percentagestJPS }}%)</td>
                            <td>{{ $totalRecordspkJPS }}</td>
                            <td>{{ $pkCountJPS }} ( {{ $percentagepkJPS }}%)</td>
                            <td>{{ $totalRecordsteaJPS }}</td>
                            <td>{{ $guruPengawasGuruFokalYaCountJPS }} ( {{ $percentageteaJPS }}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">3.</td>
                            <td scope="row">Jabatan Pendidikan Ko-Kurikulum</td>
                            <td>{{ $JPKKTotal->count() }}</td>
                            <td>{{ $totalRecordstJPKK }}</td>
                            <td>{{ $pelajarCountJPKK }} ( {{ $percentagestJPKK }}%)</td>
                            <td>{{ $totalRecordspkJPKK }}</td>
                            <td>{{ $pkCountJPKK }} ( {{ $percentagepkJPKK }}%)</td>
                            <td>{{ $totalRecordsteaJPKK }}</td>
                            <td>{{ $guruPengawasGuruFokalYaCountJPKK }} ( {{ $percentageteaJPKK }}%)</td>
                        </tr>


                        <tr class="*:font-semibold">
                            <td class="first" scope="row" colspan="2">JUMLAH KESELURUHAN</td>
                            <td class="first">{{ $totalCountDept }}</td>
                            <td class="second">{{ $totalCountStAs }}</td>
                            <td class="second">{{ $totalCountStH}} ({{$totalCountStPerc}}%)</td>
                            <td class="middle">{{ $totalCountPkAs }}</td>
                            <td class="middle">{{ $totalCountPkH}} ({{$totalCountPkPerc}}%)</td>
                            <td class="third">{{ $totalCountTeAs }}</td>
                            <td class="third">{{ $totalCountTeH}} ({{$totalCountTePerc}}%)</td>
                        </tr>

                    </tbody>

                </table>
            </div>

        </div>

        {{-- Third Section --}}
        <div class="bg-white rounded-md border-2 border-blue-600 mt-2 mb-10 p-8">

            <div class="text-center">
                <p class="text-xl">LAPORAN PENGLIBATAN DAN KEHADIRAN PENUNTUT BAGI {{$attdevent->name}} (MENGIKUT SEKOLAH)</p>
                <p class="mt-4 text-sm">(Dikemaskini: <span id="spanDate2" style="color: blue"></span> )</p>
            </div>

            <div class="overflow-x-auto">
                <table class="mt-8 w-full table-bordered">

                    <thead>
                        <tr class="*:font-semibold">
                            <th class="first" scope="col" rowspan="2">Bil.</th>
                            <th class="first" scope="col" rowspan="2">Sekolah</th>
                            <th class="second" scope="col" colspan="2">Penuntut</th>
                            <th class="middle" scope="col" colspan="2">Persembahan</th>
                            <th class="third" scope="col" colspan="2">Pengawas</th>
                        </tr>
                        <tr class="*:font-semibold">
                            <th class="second" scope="col">Senarai asal</th>
                            <th class="second" scope="col">kehadiran (%)</th>
                            <th class="middle" scope="col">Senarai asal</th>
                            <th class="middle" scope="col">kehadiran (%)</th>
                            <th class="third" scope="col">Senarai asal</th>
                            <th class="third" scope="col">kehadiran (%)</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($groupedSchools as $school => $records)

                             @php
                                $totalRecordstea = $records->filter(function($record) {
                                    return in_array($record->category, ['Guru Pengawas', 'Guru Fokal']);
                                })->count();
                                $guruPengawasGuruFokalYaCount = $records->filter(function($record) {
                                    return in_array($record->category, ['Guru Pengawas', 'Guru Fokal']) && $record->hadir === 'Ya';
                                })->count();
                                $percentagetea = $totalRecordstea > 0 ? ($guruPengawasGuruFokalYaCount / $totalRecordstea) * 100 : 0;

                                $totalRecordst = $records->filter(function($record) {
                                    return $record->category === 'Pelajar';
                                })->count();
                                $pelajarCount = $records->filter(function($record) {
                                    return $record->category === 'Pelajar' && $record->hadir == 'Ya';
                                })->count();
                                $percentagest = $totalRecordst > 0 ? ($pelajarCount / $totalRecordst) * 100 : 0;

                                $totalRecordspk = $records->filter(function($record) {
                                    return $record->category === 'Pelajar';
                                })->count();
                                $persembahanCount = $records->filter(function($record) {
                                    return in_array($record->category, ['Persembahan Khas','Hadrah','Choir']) && $record->hadir === 'Ya';
                                })->count();
                                $percentageps = $totalRecordspk > 0 ? ($persembahanCount / $totalRecordspk) * 100 : 0;

                            @endphp

                            <tr>
                                <td></td>
                                <td>{{ $school }}</td>
                                <td>{{ $records->filter(function($record) {
                                    return $record->category === 'Pelajar';
                                })->count() }}</td>
                                <td>{{ $records->filter(function($record) {
                                    return $record->category === 'Pelajar' && $record->hadir == 'Ya';
                                })->count() }} ( {{ number_format($percentagest, 2) }}% )</td>
                                <td>{{ $records->filter(function($record) {
                                    return in_array($record->category, ['Persembahan Khas','Hadrah','Choir']);
                                })->count() }}</td>
                                <td>{{ $records->filter(function($record) {
                                    return in_array($record->category, ['Persembahan Khas','Hadrah','Choir']) && $record->hadir === 'Ya';
                                })->count() }} ( {{ number_format($percentageps, 2) }}% )</td>
                                <td>{{ $records->filter(function($record) {
                                    return in_array($record->category, ['Guru Pengawas', 'Guru Fokal']);
                                })->count() }}</td>
                                <td>{{ $records->filter(function($record) {
                                    return in_array($record->category, ['Guru Pengawas', 'Guru Fokal']) && $record->hadir === 'Ya';
                                })->count() }} ( {{ number_format($percentagetea, 2) }}% )</td>
                            </tr>
                        @endforeach

                        @php
                            $totalRecordsteaLastRow = $totalRecTe->filter(function($totalRecTe) {
                                return in_array($totalRecTe->category, ['Guru Pengawas', 'Guru Fokal']);
                            })->count();

                            $guruPengawasGuruFokalYaCountLastRow = $records->filter(function($totalRecTe) {
                                return in_array($totalRecTe->category, ['Guru Pengawas', 'Guru Fokal']) && $totalRecTe->hadir === 'Ya';
                            })->count();

                            $percentageteaLastRow = $totalRecordsteaLastRow > 0 ? number_format(($guruPengawasGuruFokalYaCountLastRow / $totalRecordsteaLastRow) * 100, 2) : '0.00';

                            $totalRecordstLastRow = $totalRecSt->filter(function($totalRecSt) {
                                return $totalRecSt->category === 'Pelajar';
                            })->count();

                            $pelajarCountLastRow = $totalRecSt->filter(function($totalRecSt) {
                                return $totalRecSt->category === 'Pelajar' && $totalRecSt->hadir == 'Ya';
                            })->count();

                            $percentagestLastRow = $totalRecordstLastRow > 0 ? number_format(($pelajarCountLastRow / $totalRecordstLastRow) * 100, 2) : '0.00';

                            $totalRecordspkLastRow = $totalRecPk->filter(function($totalRecPk) {
                                return in_array($totalRecPk->category, ['Persembahan Khas','Hadrah','Choir']);
                            })->count();

                            $pkYaCountLastRow = $records->filter(function($totalRecPk) {
                                return in_array($totalRecPk->category, ['Persembahan Khas','Hadrah','Choir']) && $totalRecPk->hadir === 'Ya';
                            })->count();

                            $percentagepkLastRow = $totalRecordspkLastRow > 0 ? number_format(($pkYaCountLastRow / $totalRecordspkLastRow) * 100, 2) : '0.00';

                        @endphp

                        <tr class="*:font-semibold">
                            <td class="first" scope="row" colspan="2">JUMLAH KESELURUHAN</td>
                            <td class="second">{{ $totalRecSt->count() }}</td>
                            <td class="second">{{ $totalRecSt->filter(function($totalRecSt) { return $totalRecSt->hadir === 'Ya'; })->count() }} ( {{ $totalCountStPerc }}% )</td>
                            <td class="middle">{{ $totalRecPk->count() }}</td>
                            <td class="middle">{{ $totalRecPk->filter(function($totalRecPk) { return $totalRecPk->hadir === 'Ya'; })->count() }} ( {{ $totalCountPkPerc }}% )</td>
                            <td class="third">{{ $totalRecTe->count() }}</td>
                            <td class="third">{{ $totalRecTe->filter(function($totalRecTe) { return $totalRecTe->hadir === 'Ya'; })->count() }} ( {{ $totalCountTePerc }}% )</td>
                        </tr>              
                    </tbody>

                </table>
            </div>

        </div>


        {{-- Current Date --}}
        <script>
            var now = new Date();
            var datetime = now.toLocaleString();
            document.getElementById("spanDate1").innerHTML = datetime;
            document.getElementById("spanDate2").innerHTML = datetime;
        </script>

    </div>

    {{-- Apex Chart Script --}}
    <script>

        document.addEventListener("DOMContentLoaded", () => {

            const stuAtt = parseFloat(<?php echo json_encode($totalRecStH); ?>);
            const stuAbs = parseFloat(<?php echo json_encode($totalRecStTH); ?>);

            const teaAtt = parseFloat(<?php echo json_encode($totalRecTeH); ?>);
            const teaAbs = parseFloat(<?php echo json_encode($totalRecTeTH); ?>);

            const perAtt = parseFloat(<?php echo json_encode($totalRecPkH); ?>);
            const perAbs = parseFloat(<?php echo json_encode($totalRecPkTH); ?>);

            const att = [stuAtt, perAtt, teaAtt];
            const abs = [stuAbs, perAbs, teaAbs];

            const options = {
                chart: {
                    type: "bar",
                    stacked: true,
                    height: 240,
                    // stackType: '100%',
                    toolbar: {
                        show: false
                    },
                },
                plotOptions: {
                    bar: {
                    horizontal: false, // Set to true for horizontal bars
                    },

                },
                tooltip: {
                    enabled: false,
                },
                dataLabels:{
                    enabled: true,
                    style: {
                        fontSize: '12px',
                        fontWeight: '',
                        colors: ['#000']
                    },
                    dropShadow: {
                        enabled: true,
                    },
                    formatter: function (val,opts) {
                        const seriesData = opts.w.config.series;
                        const totalValues = seriesData.map(series => {
                            return series.data.reduce((total, datapoint) => total + datapoint, 0);
                        });
                        const totalValue = totalValues.reduce((total, value) => total + value, 0);
                        // const percentageValue =(val / totalValue * 100).toFixed(1);
                        //const display = [`${val} ( ${percentageValue}% )`]
                        const display = [`${val}`]
                        return display;
                    },
                    offsetX: 0,
                },
                series: [{
                    name: "Hadir",
                    data: att,
                },{
                    name: "Belum Hadir",
                    data: abs,
                }],
                xaxis: {
                categories: ["Penuntut","Persembahan Khas","Guru Pengawas"],
                },
                colors: ['rgba(0,143,251,1)', '#F3797E']
            };

            const chart = new ApexCharts(document.querySelector("#stackHadir"), options);
            chart.render();

        });

    </script>

</body>

</html>
