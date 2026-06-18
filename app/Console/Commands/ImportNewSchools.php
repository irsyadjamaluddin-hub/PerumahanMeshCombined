<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Models\School;

class ImportNewSchools extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:newschools';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import new schools (27 Mar 2025)';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $schools = [
            [ "id" => 156, "code" => 156, "label" => "SEKOLAH CEMERLANG ABEJESS, KG. KAPOK" ],
            [ "id" => 157, "code" => 157, "label" => "SEKOLAH MENENGAH CHUNG HUA, KB" ],
            [ "id" => 158, "code" => 158, "label" => "SEKOLAH NUSA LAILA PUTERI, JANGSAK" ],
            [ "id" => 159, "code" => 159, "label" => "SEKOLAH NUSA LAILA PUTERI, KG. SG BULOH" ],
            [ "id" => 160, "code" => 160, "label" => "SEKOLAH NUSA LAILA PUTERI, KIULAP" ],
            [ "id" => 161, "code" => 161, "label" => "SEKOLAH NUSA LAILA PUTERI, TG. BUNUT" ],
            [ "id" => 162, "code" => 162, "label" => "SEKOLAH PANAGA, SERIA" ],
            [ "id" => 163, "code" => 163, "label" => "SEKOLAH RIVERSIDE, KG. MASIN" ],
            [ "id" => 164, "code" => 164, "label" => "SEKOLAH RIVERSIDE, KG. SG MATAN" ],
            [ "id" => 165, "code" => 165, "label" => "SEKOLAH ST. MARGARET, SERIA" ],
            [ "id" => 166, "code" => 166, "label" => "SEKOLAH STELLA, KG. MANGGIS" ],
            [ "id" => 167, "code" => 167, "label" => "SEKOLAH STELLA, KG. SG. AKAR" ],
            [ "id" => 168, "code" => 168, "label" => "SEKOLAH SYAMDE BRIGHT KIDS, KG. SG. TILONG" ],
            [ "id" => 169, "code" => 169, "label" => "SEKOLAH TINKERBELL LEARNING, KG. SALAMBIGAR" ],
            [ "id" => 170, "code" => 170, "label" => "SEKOLAH TINKERBELL LEARNING, KG. SG.OROK" ],
            [ "id" => 171, "code" => 171, "label" => "SEKOLAH BAKTI DEWA, BERAKAS" ],
            [ "id" => 172, "code" => 172, "label" => "SEKOLAH BAKTI DEWA, JERUDONG" ],
            [ "id" => 173, "code" => 173, "label" => "SEKOLAH BAKTI DEWA, TUTONG" ],
            [ "id" => 174, "code" => 174, "label" => "SEKOLAH CHUNG HWA, TUTONG" ],
            [ "id" => 175, "code" => 175, "label" => "SEKOLAH FAIRVIEW, KG. MANGGIS" ],
            [ "id" => 176, "code" => 176, "label" => "SEKOLAH JOYFUL KIDS MONTESSORI, KG. TELANAI" ],
            [ "id" => 177, "code" => 177, "label" => "SEKOLAH KESUMA MEKAR, KG. RIMBA" ],
            [ "id" => 178, "code" => 178, "label" => "SEKOLAH MIFTAH AN-NUR ISLAMIC INTERNATIONAL, MANGGIS SATU" ],
            [ "id" => 179, "code" => 179, "label" => "SEKOLAH RENDAH JIGSAW, JLN. PASIR BERAKAS" ],
            [ "id" => 180, "code" => 180, "label" => "SEKOLAH RISING STAR CHILD DEVELOPMENT, KG.RIMBA" ],
            [ "id" => 181, "code" => 181, "label" => "SEKOLAH SINARAN PELANGI, KG. SENGKURONG" ],
            [ "id" => 182, "code" => 182, "label" => "SEKOLAH ST. ANDREW, BSB" ],
            [ "id" => 183, "code" => 183, "label" => "SEKOLAH ST. ANGELA, SERIA" ],
            [ "id" => 184, "code" => 184, "label" => "SEKOLAH TADIKA ABC, KB" ],
            [ "id" => 185, "code" => 185, "label" => "SEKOLAH YAYASAN SULTAN HAJI HASSANAL BOLKIAH, SG. AKAR" ],
            [ "id" => 186, "code" => 186, "label" => "SEKOLAH AL-AMEERAH AL-HAJJAH MARYAM" ],
            [ "id" => 187, "code" => 187, "label" => "SEKOLAH ANTARABANGSA SERI MULIA SARJANA, KG. MATA-MATA" ],
            [ "id" => 188, "code" => 188, "label" => "SEKOLAH BRIGHT JIGSAW, KG. SALAMBIGAR" ],
            [ "id" => 189, "code" => 189, "label" => "SEKOLAH CHUNG HWA, KG. KIUDANG" ],
            [ "id" => 190, "code" => 190, "label" => "SEKOLAH CHUNG HWA, LABI" ],
            [ "id" => 191, "code" => 191, "label" => "SEKOLAH DES, KG. ANGGEREK DESA" ],
            [ "id" => 192, "code" => 192, "label" => "SEKOLAH LEARNING TREE, KG. PULAIE" ],
            [ "id" => 193, "code" => 193, "label" => "SEKOLAH LITTLE CALIPHS, KG. SG BULOH" ],
            [ "id" => 194, "code" => 194, "label" => "SEKOLAH MENENGAH CHUNG CHING, JLN. RAJA ISTERI, SERIA" ],
            [ "id" => 195, "code" => 195, "label" => "SEKOLAH SERI MULIA SARJANA, KG. JANGSAK" ],
            [ "id" => 196, "code" => 196, "label" => "SEKOLAH SERI MULIA SARJANA, KG. MATA-MATA" ],
            [ "id" => 197, "code" => 197, "label" => "SEKOLAH SERI MULIA SARJANA, KG. SANTUL" ],
            [ "id" => 198, "code" => 198, "label" => "SEKOLAH ST. JAMES, KUALA BELAIT" ],
            [ "id" => 199, "code" => 199, "label" => "SEKOLAH TADIKA JAYA DATIN HAJAH MALAI ROGAYAH, BERAKAS" ],
            [ "id" => 200, "code" => 200, "label" => "SEKOLAH TAMAN DIDIKAN ANAK-ANAK POLIS DIRAJA BRUNEI, GADONG" ],
            [ "id" => 201, "code" => 201, "label" => "SEKOLAH ALIF, KG. RIMBA" ],
            [ "id" => 202, "code" => 202, "label" => "SEKOLAH ALIF, KUALA BELAIT" ],
            [ "id" => 203, "code" => 203, "label" => "SEKOLAH ANTARABANGSA BRUNEI [ISB], KG. SALAMBIGAR" ],
            [ "id" => 204, "code" => 204, "label" => "PUSAT PEMBELAJARAN INKLUSIF ISB" ],
            [ "id" => 205, "code" => 205, "label" => "SEKOLAH ANTARABANGSA BRUNEI [ISB], SERIA" ],
            [ "id" => 206, "code" => 206, "label" => "SEKOLAH CAHAYA BINA INSAN, BAN 3" ],
            [ "id" => 207, "code" => 207, "label" => "SEKOLAH FREDA RADIN, KG. SG. AKAR" ],
            [ "id" => 208, "code" => 208, "label" => "SEKOLAH MENENGAH CHUNG HWA, BSB" ],
            [ "id" => 209, "code" => 209, "label" => "SEKOLAH PAI YUEK, TEMBURONG" ],
            [ "id" => 210, "code" => 210, "label" => "SEKOLAH PERTAMA, TUTONG" ],
            [ "id" => 211, "code" => 211, "label" => "SEKOLAH RENDAH IQRA', KG. MANGGIS" ],
            [ "id" => 212, "code" => 212, "label" => "SEKOLAH SINARAN MAS, KG. KIARONG" ],
            [ "id" => 213, "code" => 213, "label" => "SEKOLAH SUNSHINE, KG. BERIBI" ],
            [ "id" => 214, "code" => 214, "label" => "SEKOLAH SURIA JAYA, TEMBURONG" ],
            [ "id" => 215, "code" => 215, "label" => "SEKOLAH TAMAN ASUHAN PERTIWI, KG. MABOHAI" ],
            [ "id" => 216, "code" => 216, "label" => "SEKOLAH WONDER KIDZ, JERUDONG" ],
            [ "id" => 217, "code" => 217, "label" => "SEKOLAH  ANTARABANGSA EML, KG. SG. HANCHING" ],
            [ "id" => 218, "code" => 218, "label" => "SEKOLAH AL-FALAAH,  KG. SG. AKAR" ],
            [ "id" => 219, "code" => 219, "label" => "SEKOLAH AL-FALAAH, BAN 5" ],
            [ "id" => 220, "code" => 220, "label" => "SEKOLAH ANTARABANGSA JERUDONG [JIS], TUNGKU" ],
            [ "id" => 221, "code" => 221, "label" => "SEKOLAH CHUNG LIAN, KG. SG. LIANG" ],
            [ "id" => 222, "code" => 222, "label" => "SEKOLAH JIGSAW PLAY, KG. KIARONG" ],
            [ "id" => 223, "code" => 223, "label" => "SEKOLAH NURUL FALAH, KG. PENANJONG" ],
            [ "id" => 224, "code" => 224, "label" => "SEKOLAH NUSA JAYA, KERIAM" ],
            [ "id" => 225, "code" => 225, "label" => "SEKOLAH PGGMB, KG. SG. AKAR" ],
            [ "id" => 226, "code" => 226, "label" => "SEKOLAH ST. GEORGE, BSB" ],
            [ "id" => 227, "code" => 227, "label" => "SEKOLAH ST. JOHN, KUALA BELAIT" ],
            [ "id" => 228, "code" => 228, "label" => "SEKOLAH TANGGA GEMILANG, KG. KAPOK" ],
            [ "id" => 229, "code" => 229, "label" => "SEKOLAH TUNAS JAYA PGGMB, KG. LAMBAK" ],
            [ "id" => 230, "code" => 230, "label" => "SEKOLAH TUNAS JAYA PGGMB, KG. MADANG" ],
            [ "id" => 231, "code" => 231, "label" => "SEKOLAH TUNAS JAYA PGGMB, KUALA BELAIT" ],
            [ "id" => 232, "code" => 232, "label" => "SEKOLAH ANTARABANGSA EML" ],
            [ "id" => 233, "code" => 233, "label" => "SEKOLAH NUSA JAYA" ],
            [ "id" => 234, "code" => 234, "label" => "SEKOLAH NUSA LAILA PUTERI(CAWANGAN KIULAP)" ],
            [ "id" => 235, "code" => 235, "label" => "SEKOLAH NUSA LAILA PUTERI (CAWANGAN SUNGAI BULOH)" ],
            [ "id" => 236, "code" => 236, "label" => "SEKOLAH NUSA LAILA PUTERI (CAWANGAN TANJUNG BUNUT)" ],
            [ "id" => 237, "code" => 237, "label" => "SEKOLAH PANAGA" ],
            [ "id" => 238, "code" => 238, "label" => "SEKOLAH CEMERLANG ABEJESS" ],
            [ "id" => 239, "code" => 239, "label" => "SEKOLAH MENENGAH CHUNG HUA, KB" ],
            [ "id" => 240, "code" => 240, "label" => "SEKOLAH NUSA LAILA PUTERI (JANGSAK)" ],
            [ "id" => 241, "code" => 241, "label" => "SEKOLAH RIVERSIDE CAWANGAN MASIN" ],
            [ "id" => 242, "code" => 242, "label" => "SEKOLAH RIVERSIDE CAWANGAN SUNGAI MATAN" ],
            [ "id" => 243, "code" => 243, "label" => "SEKOLAH ST. MARGARET" ],
            [ "id" => 244, "code" => 244, "label" => "SEKOLAH ST. JOHN" ],
            [ "id" => 245, "code" => 245, "label" => "SEKOLAH STELLA, SG AKAR" ],
            [ "id" => 246, "code" => 246, "label" => "SEKOLAH STELLA (CAWANGAN KG MANGGIS)" ],
            [ "id" => 247, "code" => 247, "label" => "SEKOLAH SYAMDE BRIGHT KIDS" ],
            [ "id" => 248, "code" => 248, "label" => "SEKOLAH TANGGA GEMILANG" ],
            [ "id" => 249, "code" => 249, "label" => "SEKOLAH TINKERBELL LEARNING" ],
            [ "id" => 250, "code" => 250, "label" => "SEKOLAH TINKERBELL LEARNING CAWANGAN SALAMBIGAR" ],
            [ "id" => 251, "code" => 251, "label" => "SEKOLAH BAKTI DEWA CAWANGAN BERAKAS" ],
            [ "id" => 252, "code" => 252, "label" => "SEKOLAH BAKTI DEWA CAWANGAN JERUDONG" ],
            [ "id" => 253, "code" => 253, "label" => "SEKOLAH BAKTI DEWA CAWANGAN TUTONG (TADIKA DAN RENDAH)" ],
            [ "id" => 254, "code" => 254, "label" => "SEKOLAH FAIRVIEW" ],
            [ "id" => 255, "code" => 255, "label" => "SEKOLAH JIGSAW PRIMARY" ],
            [ "id" => 256, "code" => 256, "label" => "JOYFUL KIDS MONTESSORI" ],
            [ "id" => 257, "code" => 257, "label" => "SEKOLAH ANTARABANGSA MIFTAH AN-NUR ISLAMK, MANGGIS SATU" ],
            [ "id" => 258, "code" => 258, "label" => "SEKOLAH RISING STAR CHILD DEVELOPMENT" ],
            [ "id" => 259, "code" => 259, "label" => "SEKOLAH CHUNG HWA, TUTONG" ],
            [ "id" => 260, "code" => 260, "label" => "SEKOLAH KESUMA MEKAR" ],
            [ "id" => 261, "code" => 261, "label" => "SEKOLAH PERSEKUTUAN GURU-GURU MELAYU BRUNEI" ],
            [ "id" => 262, "code" => 262, "label" => "SEKOLAH SINARAN PELANGI" ],
            [ "id" => 263, "code" => 263, "label" => "SEKOLAH ST. ANGELA" ],
            [ "id" => 264, "code" => 264, "label" => "SEKOLAH TADIKA ABC" ],
            [ "id" => 265, "code" => 265, "label" => "SEKOLAH TUNAS JAYA PGGMB CAWANGAN LAMBAK" ],
            [ "id" => 266, "code" => 266, "label" => "SEKOLAH TUNAS JAYA PGGMB CAWANGAN MADANG" ],
            [ "id" => 267, "code" => 267, "label" => "SEKOLAH TUNAS JAYA PGGMB KUALA BELAIT" ],
            [ "id" => 268, "code" => 268, "label" => "SEKOLAH YSHHB (MENENGAH)" ],
            [ "id" => 269, "code" => 269, "label" => "SEKOLAH YSHHB (RENDAH)" ],
            [ "id" => 270, "code" => 270, "label" => "SEKOLAH YSHHB (TASKA)" ],
            [ "id" => 271, "code" => 271, "label" => "SEKOLAH ST. ANDREW" ],
            [ "id" => 272, "code" => 272, "label" => "SEKOLAH AL-FALAAH (CAWANGAN BAN 5)" ],
            [ "id" => 273, "code" => 273, "label" => "SEKOLAH AL-FALAAH (CAWANGAN SG AKAR)" ],
            [ "id" => 274, "code" => 274, "label" => "SEKOLAH BRIGHT JIGSAW" ],
            [ "id" => 275, "code" => 275, "label" => "SEKOLAH CHUNG HWA KIUDANG" ],
            [ "id" => 276, "code" => 276, "label" => "SEKOLAH CHUNG HWA , LABI" ],
            [ "id" => 277, "code" => 277, "label" => "SEKOLAH DES" ],
            [ "id" => 278, "code" => 278, "label" => "SEKOLAH LEARNING TREE" ],
            [ "id" => 279, "code" => 279, "label" => "SEKOLAH LITTLE CALIPHS" ],
            [ "id" => 280, "code" => 280, "label" => "SEKOLAH AL-AMEERAH AL-HAJJAH MARYAM" ],
            [ "id" => 281, "code" => 281, "label" => "SEKOLAH MENENGAH CHUNG CHING" ],
            [ "id" => 282, "code" => 282, "label" => "SEKOLAH CHUNG CHING (PRIMARY)" ],
            [ "id" => 283, "code" => 283, "label" => "SEKOLAH NURUL FALAH" ],
            [ "id" => 284, "code" => 284, "label" => "SEKOLAH ST. JAMES" ],
            [ "id" => 285, "code" => 285, "label" => "SEKOLAH TADIKA JAYA DATIN HAJAH MALAI ROGAYAH" ],
            [ "id" => 286, "code" => 286, "label" => "SEKOLAH TAMAN DIDIKAN ANAK-ANAK POLIS DIRAJA BRUNEI, GADONG" ],
            [ "id" => 287, "code" => 287, "label" => "SEKOLAH ANTARABANGSA SERI MULIA SARJANA" ],
            [ "id" => 288, "code" => 288, "label" => "SEKOLAH SERI MULIA SARJANA (JANGSAK)" ],
            [ "id" => 289, "code" => 289, "label" => "SEKOLAH SERI MULIA SARJANA (SANTUL)" ],
            [ "id" => 290, "code" => 290, "label" => "SEKOLAH SERI MULIA SARJANA (MENENGAH)" ],
            [ "id" => 291, "code" => 291, "label" => "SEKOLAH ST. GEORGE" ],
            [ "id" => 292, "code" => 292, "label" => "SEKOLAH CAHAYA BINA INSAN" ],
            [ "id" => 293, "code" => 293, "label" => "SEKOLAH MENENGAH CHUNG HWA, BSB" ],
            [ "id" => 294, "code" => 294, "label" => "SEKOLAH FREDA RADIN" ],
            [ "id" => 295, "code" => 295, "label" => "ISB CENTRE FOR INCLUSIVE LEARNING" ],
            [ "id" => 296, "code" => 296, "label" => "SEKOLAH ANTARABANGSA JERUDONG (JIS)" ],
            [ "id" => 297, "code" => 297, "label" => "SEKOLAH JIGSAW PLAY" ],
            [ "id" => 298, "code" => 298, "label" => "SEKOLAH PAI YUEK" ],
            [ "id" => 299, "code" => 299, "label" => "SEKOLAH ALIF, KG RIMBA" ],
            [ "id" => 300, "code" => 300, "label" => "SEKOLAH ALIF(CAWANGAN KUALA BELAIT)" ],
            [ "id" => 301, "code" => 301, "label" => "SEKOLAH CHUNG LIAN" ],
            [ "id" => 302, "code" => 302, "label" => "SEKOLAH PERSATUAN TANJUNG MAYA (PERTAMA) TUTONG" ],
            [ "id" => 303, "code" => 303, "label" => "SEKOLAH RENDAH IQRA" ],
            [ "id" => 304, "code" => 304, "label" => "SEKOLAH SINARAN MAS" ],
            [ "id" => 305, "code" => 305, "label" => "SEKOLAH TAMAN ASOHAN KANAK-KANAK PERTIWI" ],
            [ "id" => 306, "code" => 306, "label" => "SEKOLAH SUNSHINE" ],
            [ "id" => 307, "code" => 307, "label" => "SEKOLAH SURIA JAYA" ],
            [ "id" => 308, "code" => 308, "label" => "SEKOLAH ANTARABANGSA BRUNEI (ISB), SALAMBIGAR" ],
            [ "id" => 309, "code" => 309, "label" => "SEKOLAH ANTARABANGSA BRUNEI (ISB), SERIA" ],
            [ "id" => 310, "code" => 310, "label" => "SEKOLAH WONDER KIDZ" ],
        ];
        
        
        
        
        foreach ($schools as $schoolData)
        {
            // $school = School::where('label', $schoolData['label'])->first();
            $this->info($schoolData['id']);
            DB::table('schools')->insert([
                'id' => $schoolData['id'], 
                'code' => $schoolData['code'],
                'label' => $schoolData['label']
            ]);
            // if ($school !== null)
            // {
            //     // DB::table('schools')->where('label', $schoolData['label'])->update([
            //     //     'id' => $schoolData['id'], 
            //     //     'code' => $schoolData['code']
            //     // ]);
            //     // tap($school)->update([
            //     //     'code' => $schoolData['code']
            //     // ]);
            // }
            // School::firstOrCreate(
            //     ['label' => $school['label']],
            //     ['id' => $school['id']],
            //     ['code' => $school['code']],
            // );
        }

        $this->info('successful');
        return Command::SUCCESS;
    }
}
