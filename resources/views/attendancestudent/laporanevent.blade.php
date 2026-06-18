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
                    <p class="text-3xl">{{$totStuAtt}}</p>
                </div>

                <div class="h-full p-2 bg-white flex flex-col items-center justify-center gap-2 rounded-md border-2 border-sky-600">
                    <p class="underline text-xl">Jumlah Kehadiran Pengawas</p>
                    <p class="text-3xl">{{$totTeaAtt}}</p>
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
                            <th class="third" scope="col" colspan="2">Jumlah Pengawas</th>
                        </tr>

                        <tr class="*:font-semibold">
                            <th class="second" scope="col">Senarai Asal</th>
                            <th class="second" scope="col">Kehadiran (%)</th>
                            <th class="third" scope="col">Senarai Asal</th>
                            <th class="third" scope="col">Kehadiran (%)</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td scope="row">1.</td>
                            <td scope="row">Jabatan Sekolah-Sekolah</td>
                            <td>15</td>
                            <td>{{$jssStu}}</td>
                            <td>{{$jssStuAtt}} ({{$perjssStuAtt}}%)</td>
                            <td>{{$jssTea}}</td>
                            <td>{{$jssTeaAtt}} ({{$perjssTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">2.</td>
                            <td scope="row">Jabatan Pendidikan Swasta</td>
                            <td>6</td>
                            <td>{{$jpsStu}}</td>
                            <td>{{$jpsStuAtt}} ({{$perjpsStuAtt}}%)</td>
                            <td>{{$jpsTea}}</td>
                            <td>{{$jpsTeaAtt}} ({{$perjpsTeaAtt}}%)</td>
                        </tr>


                        <tr class="*:font-semibold">
                            <td class="first" scope="row" colspan="2">JUMLAH KESELURUHAN</td>
                            <td class="first">21</td>
                            <td class="second">{{$totStu}}</td>
                            <td class="second">{{$totStuAtt}} ({{$perStuAtt}}%)</td>
                            <td class="third">{{$totTea}}</td>
                            <td class="third">{{$totTeaAtt}} ({{$perTeaAtt}}%)</td>
                        </tr>

                    </tbody>

                </table>
            </div>

        </div>

        {{-- Third Section --}}
        <div class="bg-white rounded-md border-2 border-blue-600 mt-2 mb-10 p-8">

            <div class="text-center">
                <p class="text-xl">LAPORAN PENGLIBATAN DAN KEHADIRAN PENUNTUT BAGI PERBARISAN KEHORMATAN SEMPENA HARI KEPUTERAAN KDYMM YANG KE-78 TAHUN (MENGIKUT SEKOLAH)</p>
                <p class="mt-4 text-sm">(Dikemaskini: <span id="spanDate2" style="color: blue"></span> )</p>
            </div>

            <div class="overflow-x-auto">
                <table class="mt-8 w-full table-bordered">

                    <thead>
                        <tr class="*:font-semibold">
                            <th class="first" scope="col" rowspan="2">Bil.</th>
                            <th class="first" scope="col" rowspan="2">Sekolah</th>
                            <th class="second" scope="col" colspan="2">Penuntut</th>
                            <th class="third" scope="col" colspan="2">Pengawas</th>
                        </tr>
                        <tr class="*:font-semibold">
                            <th class="second" scope="col">Senarai asal</th>
                            <th class="second" scope="col">kehadiran (%)</th>
                            <th class="third" scope="col">Senarai asal</th>
                            <th class="third" scope="col">kehadiran (%)</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td scope="row">1.</td>
                            <td scope="row">Maktab Duli PMAMB</td>
                            <td>{{$mdStu}}</td>
                            <td>{{$mdStuAtt}} ({{$permdStuAtt}}%)</td>
                            <td>{{$mdTea}}</td>
                            <td>{{$mdTeaAtt}} ({{$permdTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">2.</td>
                            <td scope="row">Maktab Sain PSBS</td>
                            <td>{{$msStu}}</td>
                            <td>{{$msStuAtt}} ({{$permsStuAtt}}%)</td>
                            <td>{{$msTea}}</td>
                            <td>{{$msTeaAtt}} ({{$permsTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">3.</td>
                            <td scope="row">Maktab SOAS</td>
                            <td>{{$soasStu}}</td>
                            <td>{{$soasStuAtt}} ({{$persoasStuAtt}}%)</td>
                            <td>{{$soasTea}}</td>
                            <td>{{$soasTeaAtt}} ({{$persoasTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">4.</td>
                            <td scope="row">SM Awang Semaun</td>
                            <td>{{$smasStu}}</td>
                            <td>{{$smasStuAtt}} ({{$persmasStuAtt}}%)</td>
                            <td>{{$smasTea}}</td>
                            <td>{{$smasTeaAtt}} ({{$persmasTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">5.</td>
                            <td scope="row">SM Berakas</td>
                            <td>{{$smbStu}}</td>
                            <td>{{$smbStuAtt}} ({{$persmbStuAtt}}%)</td>
                            <td>{{$smbTea}}</td>
                            <td>{{$smbTeaAtt}} ({{$persmbTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">6.</td>
                            <td scope="row">SM Masin</td>
                            <td>{{$smmasinStu}}</td>
                            <td>{{$smmasinStuAtt}} ({{$persmmasinStuAtt}}%)</td>
                            <td>{{$smmasinTea}}</td>
                            <td>{{$smmasinTeaAtt}} ({{$persmmasinTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">7.</td>
                            <td scope="row">SM Menglait</td>
                            <td>{{$smmenglaitStu}}</td>
                            <td>{{$smmenglaitStuAtt}} ({{$persmmenglaitStuAtt}}%)</td>
                            <td>{{$smmenglaitTea}}</td>
                            <td>{{$smmenglaitTeaAtt}} ({{$persmmenglaitTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">8.</td>
                            <td scope="row">SM PIHM, Serasa</td>
                            <td>{{$smpihmStu}}</td>
                            <td>{{$smpihmStuAtt}} ({{$persmpihmStuAtt}}%)</td>
                            <td>{{$smpihmTea}}</td>
                            <td>{{$smpihmTeaAtt}} ({{$persmpihmTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">9.</td>
                            <td scope="row">SM Rimba</td>
                            <td>{{$smrimbaStu}}</td>
                            <td>{{$smrimbaStuAtt}} ({{$persmrimbaStuAtt}}%)</td>
                            <td>{{$smrimbaTea}}</td>
                            <td>{{$smrimbaTeaAtt}} ({{$persmrimbaTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">10.</td>
                            <td scope="row">SM Sayyidina Husain</td>
                            <td>{{$smshusainStu}}</td>
                            <td>{{$smshusainStuAtt}} ({{$persmshusainStuAtt}}%)</td>
                            <td>{{$smshusainTea}}</td>
                            <td>{{$smshusainTeaAtt}} ({{$persmshusainTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">11.</td>
                            <td scope="row">SM Sayyidina Umar Al-Khattab</td>
                            <td>{{$smsuaStu}}</td>
                            <td>{{$smsuaStuAtt}} ({{$persmsuaStuAtt}}%)</td>
                            <td>{{$smsuaTea}}</td>
                            <td>{{$smsuaTeaAtt}} ({{$persmsuaTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">12.</td>
                            <td scope="row">SM SMJA</td>
                            <td>{{$smjaStu}}</td>
                            <td>{{$smjaStuAtt}} ({{$persmjaStuAtt}}%)</td>
                            <td>{{$smjaTea}}</td>
                            <td>{{$smjaTeaAtt}} ({{$persmjaTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">13.</td>
                            <td scope="row">SM Sultan Sharif Ali</td>
                            <td>{{$smssaStu}}</td>
                            <td>{{$smssaStuAtt}} ({{$persmssaStuAtt}}%)</td>
                            <td>{{$smssaTea}}</td>
                            <td>{{$smssaTeaAtt}} ({{$persmssaTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">14.</td>
                            <td scope="row">Sekolah Sukan</td>
                            <td>{{$sukanStu}}</td>
                            <td>{{$sukanStuAtt}} ({{$persukanStuAtt}}%)</td>
                            <td>{{$sukanTea}}</td>
                            <td>{{$sukanTeaAtt}} ({{$persukanTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">15.</td>
                            <td scope="row">STPRI</td>
                            <td>{{$stpriStu}}</td>
                            <td>{{$stpriStuAtt}} ({{$perstpriStuAtt}}%)</td>
                            <td>{{$stpriTea}}</td>
                            <td>{{$stpriTeaAtt}} ({{$perstpriTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">16.</td>
                            <td scope="row">SM Yayasan SHHB</td>
                            <td>{{$smyayasanStu}}</td>
                            <td>{{$smyayasanStuAtt}} ({{$persmyayasanStuAtt}}%)</td>
                            <td>{{$smyayasanTea}}</td>
                            <td>{{$smyayasanTeaAtt}} ({{$persmyayasanTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">17.</td>
                            <td scope="row">Sekolah St George</td>
                            <td>{{$stgeorgeStu}}</td>
                            <td>{{$stgeorgeStuAtt}} ({{$perstgeorgeStuAtt}}%)</td>
                            <td>{{$stgeorgeTea}}</td>
                            <td>{{$stgeorgeTeaAtt}} ({{$perstgeorgeTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">18.</td>
                            <td scope="row">Sekolah Nusa Laila Puteri, Jangsak</td>
                            <td>{{$nlpjStu}}</td>
                            <td>{{$nlpjStuAtt}} ({{$pernlpjStuAtt}}%)</td>
                            <td>{{$nlpjTea}}</td>
                            <td>{{$nlpjTeaAtt}} ({{$pernlpjTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">19.</td>
                            <td scope="row">SM Chunghwa, BSB</td>
                            <td>{{$chunghwabsbStu}}</td>
                            <td>{{$chunghwabsbStuAtt}} ({{$perchunghwabsbStuAtt}}%)</td>
                            <td>{{$chunghwabsbTea}}</td>
                            <td>{{$chunghwabsbTeaAtt}} ({{$perchunghwabsbTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">20.</td>
                            <td scope="row">Sekolah Seri Mulia Sarjana</td>
                            <td>{{$smsarjanaStu}}</td>
                            <td>{{$smsarjanaStuAtt}} ({{$persmsarjanaStuAtt}}%)</td>
                            <td>{{$smsarjanaTea}}</td>
                            <td>{{$smsarjanaTeaAtt}} ({{$persmsarjanaTeaAtt}}%)</td>
                        </tr>

                        <tr>
                            <td scope="row">21.</td>
                            <td scope="row">Sekolah St Andrew</td>
                            <td>{{$standrewsStu}}</td>
                            <td>{{$standrewsStuAtt}} ({{$perstandrewsStuAtt}}%)</td>
                            <td>{{$standrewsTea}}</td>
                            <td>{{$standrewsTeaAtt}} ({{$perstandrewsTeaAtt}}%)</td>
                        </tr>

                        <tr class="*:font-semibold">
                            <td class="first" scope="row" colspan="2">JUMLAH KESELURUHAN</td>
                            <td class="second" >{{$totStu}}</td>
                            <td class="second" >{{$totStuAtt}} ({{$perStuAtt}}%)</td>
                            <td class="third" >{{$totTea}}</td>
                            <td class="third" >{{$totTeaAtt}} ({{$perTeaAtt}}%)</td>
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

            const stuAtt = parseFloat(<?php echo json_encode($totStuAtt); ?>);
            const stuAbs = parseFloat(<?php echo json_encode($totStuAbs); ?>);

            const teaAtt = parseFloat(<?php echo json_encode($totTeaAtt); ?>);
            const teaAbs = parseFloat(<?php echo json_encode($totTeaAbs); ?>);

            const att = [stuAtt, teaAtt];
            const abs = [stuAbs, teaAbs];

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
                        const percentageValue =(val / totalValue * 100).toFixed(1);
                        const display = [`${val} ( ${percentageValue}% )`]
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
                categories: ["Penuntut","Guru Pengawas"],
                },
                colors: ['rgba(0,143,251,1)', '#F3797E']
            };

            const chart = new ApexCharts(document.querySelector("#stackHadir"), options);
            chart.render();

        });

    </script>

</body>

</html>
