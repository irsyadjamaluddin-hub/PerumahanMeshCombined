<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssetCategoryCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssetCategoryCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!AssetCategoryCode::count()) {

            DB::table('asset_category_codes')->insert([
                
                // ------------------------------------------
                // Category A
                // ------------------------------------------

                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A1',
                    'name' => 'PC',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A2',
                    'name' => 'Notebook/Tablet',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A3',
                    'name' => 'Server',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A4',
                    'name' => 'Monitor Screen (TV, LCD)',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A5',
                    'name' => 'Printer',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A6',
                    'name' => 'Scanner',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A7',
                    'name' => 'Projector',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A8',
                    'name' => 'Token',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A9',
                    'name' => 'Wireless Adapter',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A10',
                    'name' => 'Video Splitter',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A11',
                    'name' => 'IPad',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A12',
                    'name' => 'Modem',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A13',
                    'name' => 'PDA',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A14',
                    'name' => 'KVM',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A15',
                    'name' => 'Plotter',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A16',
                    'name' => 'Mouse',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A17',
                    'name' => 'Keyboard',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A18',
                    'name' => 'Webcam',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A19',
                    'name' => 'Headset',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A20',
                    'name' => 'Portable Hardisk',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A21',
                    'name' => 'Pen Drive',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A22',
                    'name' => 'Digital Recorder',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A23',
                    'name' => 'Mobile',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A24',
                    'name' => 'Printer Stand',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A25',
                    'name' => 'Harddisk',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A26',
                    'name' => 'Docking Station',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A27',
                    'name' => 'External DVD Burner',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A28',
                    'name' => 'Computer Stick',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A29',
                    'name' => 'CPU',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A30',
                    'name' => 'Storage',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '1',
                    'code' => 'A31',
                    'name' => 'Security (Hardware)',
                    'deleted' => 'no',
                ],

                // ------------------------------------------
                // Category B
                // ------------------------------------------
                [
                    'main_asset_category_code_id' => '2',
                    'code' => 'B1',
                    'name' => 'Security (Software)',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '2',
                    'code' => 'B2',
                    'name' => 'Back-up',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '2',
                    'code' => 'B3',
                    'name' => 'Operating Systems',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '2',
                    'code' => 'B4',
                    'name' => 'PKI',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '2',
                    'code' => 'B5',
                    'name' => 'Network and System Management',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '2',
                    'code' => 'B6',
                    'name' => 'Office Application',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '2',
                    'code' => 'B7',
                    'name' => 'Multimedia and Web Publishing',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '2',
                    'code' => 'B8',
                    'name' => 'Email',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '2',
                    'code' => 'B9',
                    'name' => 'Environmental Monitoring/Manager System',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '2',
                    'code' => 'B10',
                    'name' => 'Business Management System',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '2',
                    'code' => 'B11',
                    'name' => 'Video Conference System',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '2',
                    'code' => 'B12',
                    'name' => 'Media Kits Software',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '2',
                    'code' => 'B13',
                    'name' => 'Interact Pro Mixer Programming',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '2',
                    'code' => 'B14',
                    'name' => 'Virtualization Software',
                    'deleted' => 'no',
                ],

                // ------------------------------------------
                // Category C
                // ------------------------------------------
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C1',
                    'name' => 'Switch',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C2',
                    'name' => 'Router/AP',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C3',
                    'name' => 'Firewall',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C4',
                    'name' => 'Load Balancer',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C5',
                    'name' => 'Bandwidth Manager',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C6',
                    'name' => 'Switch',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C7',
                    'name' => 'Lan Controller',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C8',
                    'name' => 'PoE Injector',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C9',
                    'name' => 'Patch Panel',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C10',
                    'name' => 'Diagnostic Tool',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C11',
                    'name' => 'Switch Expansion Accessories',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C12',
                    'name' => 'Cable Management',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C13',
                    'name' => 'Surface Mount Box',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C14',
                    'name' => 'Intrusion Detection / Prevention',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C15',
                    'name' => 'IDS/IPS Sensor',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C16',
                    'name' => 'Proxy Appliance',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C17',
                    'name' => 'Wireless Controller',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C18',
                    'name' => 'SSL/IPSec VPN',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C19',
                    'name' => 'Content Security',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C20',
                    'name' => 'Touch Controller',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C21',
                    'name' => 'KVM Switch',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C22',
                    'name' => 'KVM Switch Cables',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '3',
                    'code' => 'C23',
                    'name' => 'Transceiver',
                    'deleted' => 'no',
                ],

                // ------------------------------------------
                // Category D
                // ------------------------------------------
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D1',
                    'name' => 'Smoke Detector',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D2',
                    'name' => 'Vesda',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D3',
                    'name' => 'Fire Extinguisher',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D4',
                    'name' => 'Water Detection System',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D5',
                    'name' => 'Air-Cond',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D6',
                    'name' => 'UPS',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D7',
                    'name' => 'CCTV',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D8',
                    'name' => 'Proximity Reader',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D9',
                    'name' => 'Bio-metric Reader',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D10',
                    'name' => 'Generator',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D11',
                    'name' => 'Safe',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D12',
                    'name' => 'Fax-Machine',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D13',
                    'name' => 'Telephone',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D14',
                    'name' => 'Walkie-Talkie',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D15',
                    'name' => 'Shredder',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D16',
                    'name' => 'DVD Player',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D17',
                    'name' => 'Video Conference System',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D18',
                    'name' => 'Speaker',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D19',
                    'name' => 'Podium',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D20',
                    'name' => 'PA System',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D21',
                    'name' => 'Calculator',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D22',
                    'name' => 'Tripod Portable Projector Screen',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D23',
                    'name' => 'Petty Cash with Lock',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D24',
                    'name' => 'Steel Locker wc Lockset & Key (4 Compartments)',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D25',
                    'name' => 'Steel Locker wc Lockset & Key (6 Compartments)',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D26',
                    'name' => 'Microphone Tripod Stand',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D27',
                    'name' => 'Labelling Machine',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D28',
                    'name' => 'Interactive White Board',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D27',
                    'name' => 'Labelling Machine',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D28',
                    'name' => 'Interactive White Board',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D29',
                    'name' => 'Surge Arrestor',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D30',
                    'name' => 'Camera',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D31',
                    'name' => 'Binding Machine',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D32',
                    'name' => 'Amplifier',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D33',
                    'name' => 'Door',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D34',
                    'name' => 'Extension Socket',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D35',
                    'name' => 'Keyholder',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D36',
                    'name' => 'Cutter',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D37',
                    'name' => 'Locker',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D38',
                    'name' => 'Interact Pro Mixer',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D39',
                    'name' => 'Microphone Expansion Device for Interact Pro Mixer',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D40',
                    'name' => 'Interact Dilaer',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D41',
                    'name' => 'Table Microphone with Microphone Stand',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D42',
                    'name' => 'Feedback Eliminator',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D43',
                    'name' => 'Refrigerator',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D44',
                    'name' => 'Water Dispenser / Water Cooler',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D45',
                    'name' => 'Microwave',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D46',
                    'name' => 'Video Wall Converter, HDMI Cable, DVI Cable',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D47',
                    'name' => 'Video Wall Converter',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D48',
                    'name' => 'Wall Bracket',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D49',
                    'name' => 'Door Lock',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '4',
                    'code' => 'D50',
                    'name' => 'Rectifier Switch (ATS Board)',
                    'deleted' => 'no',
                ],

                // ------------------------------------------
                // Category E
                // ------------------------------------------
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E1',
                    'name' => 'WhiteBoard/DisplayBoard',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E2',
                    'name' => 'Chair',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E3',
                    'name' => 'Sofa',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E4',
                    'name' => 'Cabinet / Shelf',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E5',
                    'name' => 'Table',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E6',
                    'name' => 'Flashlight / Torchlight',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E7',
                    'name' => 'Server Rack / Syntax Rack',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E8',
                    'name' => 'Network Equipment Rack',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E9',
                    'name' => '3 Drawer Cabinet',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E10',
                    'name' => 'Office Chair with Mobile Pedestal',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E11',
                    'name' => 'Trolley',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E12',
                    'name' => 'Quotation Box',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E13',
                    'name' => 'Garbage Bin',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E14',
                    'name' => 'Cubicle Desk',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E15',
                    'name' => '3-Drawer Cabinet with Mobile Pedestal',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E16',
                    'name' => '2-Door Cabinet',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E17',
                    'name' => 'Visitor Chair',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E18',
                    'name' => 'Pigeon Hole',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E19',
                    'name' => 'Signage [with and without stand]',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E20',
                    'name' => 'Ear-Muffs',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E21',
                    'name' => 'First Aid Kit',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E22',
                    'name' => 'Safety Goggles',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E23',
                    'name' => 'Safety Helmet',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E24',
                    'name' => 'Fire Blanket',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E25',
                    'name' => 'Stepping Stool',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E26',
                    'name' => 'Rack',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E27',
                    'name' => 'Glass Board',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E28',
                    'name' => 'Letter Tray; Bracket',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E29',
                    'name' => 'ID Tag Machine',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E30',
                    'name' => 'Whistle',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E31',
                    'name' => 'Glove',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E32',
                    'name' => 'Safety Vest',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E33',
                    'name' => 'Tally Counter',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E34',
                    'name' => 'Pool Table',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E35',
                    'name' => 'Workstation Desk',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E36',
                    'name' => 'Screw Toolkits / Cleaning Toolkits',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E37',
                    'name' => 'Hand Sanitizer',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '5',
                    'code' => 'E38',
                    'name' => 'Facemask',
                    'deleted' => 'no',
                ],
                
                // ------------------------------------------
                // Category F
                // ------------------------------------------
                [
                    'main_asset_category_code_id' => '6',
                    'code' => 'F1',
                    'name' => 'EGNC Corportate Video',
                    'deleted' => 'no',
                ],
                [
                    'main_asset_category_code_id' => '6',
                    'code' => 'F2',
                    'name' => 'IT Books',
                    'deleted' => 'no',
                ],

        
            ]);

        }
    }
}
