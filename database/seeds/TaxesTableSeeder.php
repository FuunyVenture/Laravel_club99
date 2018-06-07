<?php

use Illuminate\Database\Seeder;

class TaxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table("taxes")->delete();

        \DB::table("taxes")->insert(array(
            0 =>
                array(
                    "description" => "LIVE DOGS",
                    "code" => "01",
                    "tarif_heading" => "0106.1910",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            1 =>
                array(
                    "description" => "LIVE CATS",
                    "code" => "01",
                    "tarif_heading" => "0106.1920",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            2 =>
                array(
                    "description" => "T BONE STEAK",
                    "code" => "21",
                    "tarif_heading" => "0202.2000",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            3 =>
                array(
                    "description" => "STEAK",
                    "code" => "21",
                    "tarif_heading" => "0202.3000",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            4 =>
                array(
                    "description" => "HAM",
                    "code" => "21",
                    "tarif_heading" => "0203.1200",
                    "duty" => "25%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            5 =>
                array(
                    "description" => "CHICKEN",
                    "code" => "21",
                    "tarif_heading" => "0207.1100",
                    "duty" => "40%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            6 =>
                array(
                    "description" => "TURKEY",
                    "code" => "21",
                    "tarif_heading" => "0207.2400",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            7 =>
                array(
                    "description" => "LIVE FISH",
                    "code" => "21",
                    "tarif_heading" => "0301.1010",
                    "duty" => "35%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            8 =>
                array(
                    "description" => "MILK",
                    "code" => "21",
                    "tarif_heading" => "0401.2020",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            9 =>
                array(
                    "description" => "EGGS",
                    "code" => "21",
                    "tarif_heading" => "0407.0010",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            10 =>
                array(
                    "description" => "LIVE TREES",
                    "code" => "01",
                    "tarif_heading" => "0602.2090",
                    "duty" => "25%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            11 =>
                array(
                    "description" => "SOD AND GRASS",
                    "code" => "21",
                    "tarif_heading" => "0602.9020",
                    "duty" => "25%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            12 =>
                array(
                    "description" => "FRESH FLPOWERS",
                    "code" => "21",
                    "tarif_heading" => "0603.9000",
                    "duty" => "35%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            13 =>
                array(
                    "description" => "VEGETABLES",
                    "code" => "21",
                    "tarif_heading" => "0709.9090",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            14 =>
                array(
                    "description" => "NUTS",
                    "code" => "21",
                    "tarif_heading" => "0802.3190",
                    "duty" => "35%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            15 =>
                array(
                    "description" => "COFFEE",
                    "code" => "21",
                    "tarif_heading" => "0901.2100",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            16 =>
                array(
                    "description" => "TEA",
                    "code" => "21",
                    "tarif_heading" => "0902.4000",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            17 =>
                array(
                    "description" => "RICE",
                    "code" => "21",
                    "tarif_heading" => "1006.4000",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            18 =>
                array(
                    "description" => "SUGAR",
                    "code" => "21",
                    "tarif_heading" => "1701.9910",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            19 =>
                array(
                    "description" => "CHOCOLATES",
                    "code" => "21",
                    "tarif_heading" => "1806.3100",
                    "duty" => "40%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            20 =>
                array(
                    "description" => "NOODLES",
                    "code" => "21",
                    "tarif_heading" => "1902.3010",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            21 =>
                array(
                    "description" => "SNACKS",
                    "code" => "21",
                    "tarif_heading" => "1905.9090",
                    "duty" => "40%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            22 =>
                array(
                    "description" => "FRUIT JUICES",
                    "code" => "21",
                    "tarif_heading" => "2009.9090",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            23 =>
                array(
                    "description" => "INSTANT COFFEE",
                    "code" => "21",
                    "tarif_heading" => "2101.2000",
                    "duty" => "30%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            24 =>
                array(
                    "description" => "VITAMINS",
                    "code" => "21",
                    "tarif_heading" => "2106.9090",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            25 =>
                array(
                    "description" => "VITAMIN SUPPLEMENTS",
                    "code" => "21",
                    "tarif_heading" => "2106.9090",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            26 =>
                array(
                    "description" => "OTHER FOOD PREPERATION",
                    "code" => "21",
                    "tarif_heading" => "2106.9090",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            27 =>
                array(
                    "description" => "DRINKING WATER",
                    "code" => "31",
                    "tarif_heading" => "2201.9010",
                    "duty" => "75%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            28 =>
                array(
                    "description" => "SODAS",
                    "code" => "31",
                    "tarif_heading" => "2202.1010",
                    "duty" => "60%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            29 =>
                array(
                    "description" => "NON ALCOHOLIC BEER",
                    "code" => "31",
                    "tarif_heading" => "2202.9020",
                    "duty" => "55%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            30 =>
                array(
                    "description" => "MALT BEVERAGES",
                    "code" => "31",
                    "tarif_heading" => "2202.9030",
                    "duty" => "55%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            31 =>
                array(
                    "description" => "FRUIT DRINKS",
                    "code" => "31",
                    "tarif_heading" => "2202.9040",
                    "duty" => "60%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            32 =>
                array(
                    "description" => "ANIMALS FOOD",
                    "code" => "21",
                    "tarif_heading" => "2309.9030",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            33 =>
                array(
                    "description" => "CIGARS",
                    "code" => "21",
                    "tarif_heading" => "2402.1000",
                    "duty" => "0%",
                    "excise" => "220%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            34 =>
                array(
                    "description" => "CIGARETTES",
                    "code" => "21",
                    "tarif_heading" => "2402.2000",
                    "duty" => "0%",
                    "excise" => "220%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            35 =>
                array(
                    "description" => "TOCACCO",
                    "code" => "21",
                    "tarif_heading" => "2403.1010",
                    "duty" => "0%",
                    "excise" => "220%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            36 =>
                array(
                    "description" => "GASOLINE",
                    "code" => "33",
                    "tarif_heading" => "2710.1140",
                    "cost" => 1.06,
                    "duty" => "7%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now()
                ),
            37 =>
                array(
                    "description" => "DIESEL",
                    "code" => "33",
                    "tarif_heading" => "2710.1910",
                    "cost" => 0.25,
                    "duty" => "34.5 %",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now()
                ),
            38 =>
                array(
                    "description" => "MEDICAMENTS",
                    "code" => "21",
                    "tarif_heading" => "3004.9000",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            39 =>
                array(
                    "description" => "HOUSE PAINTS",
                    "code" => "31",
                    "tarif_heading" => "3208.2090",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            40 =>
                array(
                    "description" => "JOINT COMPOUND",
                    "code" => "21",
                    "tarif_heading" => "3414.1010",
                    "duty" => "35%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            41 =>
                array(
                    "description" => "TINSET",
                    "code" => "21",
                    "tarif_heading" => "3414.1090",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            42 =>
                array(
                    "description" => "INKS",
                    "code" => "21",
                    "tarif_heading" => "3215.1100",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            43 =>
                array(
                    "description" => "PERFUMES",
                    "code" => "21",
                    "tarif_heading" => "3303.0010",
                    "duty" => "0%",
                    "excise" => "10%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            44 =>
                array(
                    "description" => "SKIN PREPERATIONS",
                    "code" => "21",
                    "tarif_heading" => "3304.9900",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            45 =>
                array(
                    "description" => "SHAMPOOS",
                    "code" => "21",
                    "tarif_heading" => "3305.1000",
                    "duty" => "40%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            46 =>
                array(
                    "description" => "HAIR PREPERATIONS",
                    "code" => "21",
                    "tarif_heading" => "3305.9000",
                    "duty" => "40%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            47 =>
                array(
                    "description" => "TOOTHPASTE",
                    "code" => "21",
                    "tarif_heading" => "3306.1010",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            48 =>
                array(
                    "description" => "DEODORANTS",
                    "code" => "21",
                    "tarif_heading" => "3307.2000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            49 =>
                array(
                    "description" => "SOAPS",
                    "code" => "21",
                    "tarif_heading" => "3304.1190",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            50 =>
                array(
                    "description" => "LIQUID SOAP",
                    "code" => "21",
                    "tarif_heading" => "3401.2010",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            51 =>
                array(
                    "description" => "LIQUID TIDE",
                    "code" => "21",
                    "tarif_heading" => "3402.2010",
                    "duty" => "7%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            52 =>
                array(
                    "description" => "DISHWASHING LIQUID",
                    "code" => "21",
                    "tarif_heading" => "3402.2020",
                    "duty" => "40%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            53 =>
                array(
                    "description" => "POWDER DETERGENT",
                    "code" => "21",
                    "tarif_heading" => "3402.2040",
                    "duty" => "7%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            54 =>
                array(
                    "description" => "LIQUID BLEACH",
                    "code" => "21",
                    "tarif_heading" => "3402.2060",
                    "duty" => "60%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            55 =>
                array(
                    "description" => "CLEANING PREPERATIONS",
                    "code" => "21",
                    "tarif_heading" => "3402.2090",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            56 =>
                array(
                    "description" => "SPRAY STRACH",
                    "code" => "21",
                    "tarif_heading" => "3505.1000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            57 =>
                array(
                    "description" => "FILMS",
                    "code" => "21",
                    "tarif_heading" => "3701.2000",
                    "duty" => "25%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            58 =>
                array(
                    "description" => "INSECTICIDES",
                    "code" => "21",
                    "tarif_heading" => "3808.9100",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            59 =>
                array(
                    "description" => "RODENTICIDES",
                    "code" => "21",
                    "tarif_heading" => "3808.9920",
                    "duty" => "40%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            60 =>
                array(
                    "description" => "REAGENTS/TEST STRIPS",
                    "code" => "21",
                    "tarif_heading" => "3822.0010",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            61 =>
                array(
                    "description" => "SHOPPING BAGS",
                    "code" => "21",
                    "tarif_heading" => "3923.2110",
                    "duty" => "60%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            62 =>
                array(
                    "description" => "DISPOSABLE PLASTIC ARTICLES",
                    "code" => "21",
                    "tarif_heading" => "3924.9000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            63 =>
                array(
                    "description" => "OTHER ARTICLES OF PLASTIC",
                    "code" => "21",
                    "tarif_heading" => "3926.9000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            64 =>
                array(
                    "description" => "TIRES",
                    "code" => "1",
                    "tarif_heading" => "4011.1000",
                    "duty" => "0%",
                    "excise" => "45%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            65 =>
                array(
                    "description" => "HANDBAGS",
                    "code" => "1",
                    "tarif_heading" => "4202.2100",
                    "duty" => "0%",
                    "excise" => "10%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            66 =>
                array(
                    "description" => "PLYWOOD",
                    "code" => "13",
                    "tarif_heading" => "4412.3100",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            67 =>
                array(
                    "description" => "WOODEN DOORS",
                    "code" => "21",
                    "tarif_heading" => "4418.2000",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            68 =>
                array(
                    "description" => "DISPOSABLE PAPER ARTICLES",
                    "code" => "21",
                    "tarif_heading" => "4823.6900",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            69 =>
                array(
                    "description" => "OTHER ARTICLES OF PAPER",
                    "code" => "21",
                    "tarif_heading" => "4823.9000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            70 =>
                array(
                    "description" => "BOOKS",
                    "code" => "21",
                    "tarif_heading" => "4901.9910",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            71 =>
                array(
                    "description" => "CALENDARS",
                    "code" => "21",
                    "tarif_heading" => "4910.0090",
                    "duty" => "60%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            72 =>
                array(
                    "description" => "CARPETS",
                    "code" => "13",
                    "tarif_heading" => "5701.9000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            73 =>
                array(
                    "description" => "CLOTHING",
                    "code" => "21",
                    "tarif_heading" => "6209.9090",
                    "duty" => "25%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            74 =>
                array(
                    "description" => "BED LINEN",
                    "code" => "21",
                    "tarif_heading" => "6302.2100",
                    "duty" => "30%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            75 =>
                array(
                    "description" => "TABLE LINEN",
                    "code" => "21",
                    "tarif_heading" => "6302.5100",
                    "duty" => "0%",
                    "excise" => "10%",
                    "stamp" => "7%",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            76 =>
                array(
                    "description" => "SAILS",
                    "code" => "21",
                    "tarif_heading" => "6306.3000",
                    "duty" => "30%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            77 =>
                array(
                    "description" => "WORN CLOTHING",
                    "code" => "21",
                    "tarif_heading" => "6309.0010",
                    "duty" => "25%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            78 =>
                array(
                    "description" => "FOOTWEAR",
                    "code" => "5",
                    "tarif_heading" => "6401.9900",
                    "duty" => "25%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            79 =>
                array(
                    "description" => "TENNIS SHOES",
                    "code" => "5",
                    "tarif_heading" => "6404.1100",
                    "duty" => "25%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            80 =>
                array(
                    "description" => "HATS",
                    "code" => "21",
                    "tarif_heading" => "6501.0000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            81 =>
                array(
                    "description" => "HUMAN HAIR/WIGS",
                    "code" => "21",
                    "tarif_heading" => "6703.0000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            82 =>
                array(
                    "description" => "TILES",
                    "code" => "26",
                    "tarif_heading" => "6802.1000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            83 =>
                array(
                    "description" => "SHEETROCK",
                    "code" => "21",
                    "tarif_heading" => "6809.1100",
                    "duty" => "25%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            84 =>
                array(
                    "description" => "OTHER ARTICLES OF GLASS",
                    "code" => "21",
                    "tarif_heading" => "7020.0000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            85 =>
                array(
                    "description" => "STEEL DOORS",
                    "code" => "26",
                    "tarif_heading" => "7308.3000",
                    "duty" => "25%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            86 =>
                array(
                    "description" => "GAS STOVES",
                    "code" => "1",
                    "tarif_heading" => "7321.1100",
                    "duty" => "25%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            87 =>
                array(
                    "description" => "B.B.Q GRILL",
                    "code" => "1",
                    "tarif_heading" => "7321.8900",
                    "duty" => "25%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            88 =>
                array(
                    "description" => "ALUMINIUM FOIL",
                    "code" => "21",
                    "tarif_heading" => "7607.1100",
                    "duty" => "30%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            89 =>
                array(
                    "description" => "ALUMINIUM DOORS",
                    "code" => "21",
                    "tarif_heading" => "7610.1020",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            90 =>
                array(
                    "description" => "TOOLS",
                    "code" => "21",
                    "tarif_heading" => "8206.0000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            91 =>
                array(
                    "description" => "LOCKS",
                    "code" => "21",
                    "tarif_heading" => "8301.4000",
                    "duty" => "35%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            92 =>
                array(
                    "description" => "BOAT ENGINES",
                    "code" => "1",
                    "tarif_heading" => "8407.2100",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            93 =>
                array(
                    "description" => "AUTOMOBILE ENGINES",
                    "code" => "1",
                    "tarif_heading" => "8407.3110",
                    "duty" => "0%",
                    "excise" => "60%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            94 =>
                array(
                    "description" => "FANS",
                    "code" => "1",
                    "tarif_heading" => "8414.5100",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            95 =>
                array(
                    "description" => "RANGE HOOD",
                    "code" => "1",
                    "tarif_heading" => "8414.6000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            96 =>
                array(
                    "description" => "AIR CONDITION UNITS",
                    "code" => "1",
                    "tarif_heading" => "8415.1000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            97 =>
                array(
                    "description" => "CENTRAL A/C UNITS",
                    "code" => "1",
                    "tarif_heading" => "8415.8200",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            98 =>
                array(
                    "description" => "REFRIGERATORS/ENERGY SAVING",
                    "code" => "1",
                    "tarif_heading" => "8418.2110",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            99 =>
                array(
                    "description" => "REFRIGERATORS",
                    "code" => "1",
                    "tarif_heading" => "8418.2190",
                    "duty" => "25%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            100 =>
                array(
                    "description" => "FREEZERS/ENERGY SAVING",
                    "code" => "1",
                    "tarif_heading" => "8418.4010",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            101 =>
                array(
                    "description" => "FREEZERS",
                    "code" => "1",
                    "tarif_heading" => "8418.4090",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            102 =>
                array(
                    "description" => "DISHWASHERS/ENERGY SAVING",
                    "code" => "1",
                    "tarif_heading" => "8422.1110",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            103 =>
                array(
                    "description" => "DISHWASHERS ",
                    "code" => "1",
                    "tarif_heading" => "8422.1190",
                    "duty" => "35%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            104 =>
                array(
                    "description" => "ALL IN ONE PRINTER",
                    "code" => "1",
                    "tarif_heading" => "8443.3100",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            105 =>
                array(
                    "description" => "PRINTERS",
                    "code" => "1",
                    "tarif_heading" => "8443.3210",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            106 =>
                array(
                    "description" => "WASHING MACHINES/ENERYY EFFICIENT",
                    "code" => "1",
                    "tarif_heading" => "8450.1110",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            107 =>
                array(
                    "description" => "WASHING MACHINES ",
                    "code" => "1",
                    "tarif_heading" => "8450.1190",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            108 =>
                array(
                    "description" => "SEWING MACHINES",
                    "code" => "1",
                    "tarif_heading" => "8452.1000",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            109 =>
                array(
                    "description" => "CALCULATORS",
                    "code" => "1",
                    "tarif_heading" => "8470.1000",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            110 =>
                array(
                    "description" => "CASH REGISTERS",
                    "code" => "1",
                    "tarif_heading" => "8470.9000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            111 =>
                array(
                    "description" => "LAPTOPS",
                    "code" => "1",
                    "tarif_heading" => "8471.4110",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            112 =>
                array(
                    "description" => "COMPUTER SYSTEMS",
                    "code" => "1",
                    "tarif_heading" => "8471.4990",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            113 =>
                array(
                    "description" => "VENDING MACHINES",
                    "code" => "1",
                    "tarif_heading" => "8476.2100",
                    "duty" => "60%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            114 =>
                array(
                    "description" => "GENERATORS",
                    "code" => "1",
                    "tarif_heading" => "8502.2000",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            115 =>
                array(
                    "description" => "VACUUM CLEANERS",
                    "code" => "1",
                    "tarif_heading" => "8508.1100",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            116 =>
                array(
                    "description" => "BLENDERS/MIXERS/JUICERS",
                    "code" => "1",
                    "tarif_heading" => "8509.4000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            117 =>
                array(
                    "description" => "WATER HEATERS",
                    "code" => "1",
                    "tarif_heading" => "8516.1000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            118 =>
                array(
                    "description" => "TELEPHONES",
                    "code" => "1",
                    "tarif_heading" => "8517.1100",
                    "duty" => "25%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            119 =>
                array(
                    "description" => "CELLULAR PHONES",
                    "code" => "1",
                    "tarif_heading" => "8517.1200",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            120 =>
                array(
                    "description" => "CD'S RECORDED",
                    "code" => "1",
                    "tarif_heading" => "8523.2910",
                    "duty" => "0 % ",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            121 =>
                array(
                    "description" => "CD'S BLANK",
                    "code" => "1",
                    "tarif_heading" => "8523.2990",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            122 =>
                array(
                    "description" => "RADIOS",
                    "code" => "1",
                    "tarif_heading" => "8527.1900",
                    "duty" => "35%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            123 =>
                array(
                    "description" => "COMPUTER MONITORS",
                    "code" => "1",
                    "tarif_heading" => "8528.4100",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            124 =>
                array(
                    "description" => "OTHER MONITORS",
                    "code" => "1",
                    "tarif_heading" => "8528.4900",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            125 =>
                array(
                    "description" => "TRACTORS",
                    "code" => "1",
                    "tarif_heading" => "8701.1000",
                    "duty" => "0%",
                    "excise" => "45%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            126 =>
                array(
                    "description" => "PASSENGER VANS",
                    "code" => "1",
                    "tarif_heading" => "8702.1000",
                    "duty" => "0%",
                    "excise" => "55%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            127 =>
                array(
                    "description" => "GOLF CARTS",
                    "code" => "1",
                    "tarif_heading" => "8703.1010",
                    "duty" => "0%",
                    "excise" => "30%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            128 =>
                array(
                    "description" => "USED VEHICLES UNDER $10,000.00",
                    "code" => "1",
                    "tarif_heading" => "8703.2120",
                    "duty" => "0%",
                    "excise" => "55%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            129 =>
                array(
                    "description" => "USED VEHICLES $10 - 20,000.00",
                    "code" => "1",
                    "tarif_heading" => "8703.2140",
                    "duty" => "0%",
                    "excise" => "60%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            130 =>
                array(
                    "description" => "USED VEHICLES $20 - 25,000.00",
                    "code" => "1",
                    "tarif_heading" => "8703.2160",
                    "duty" => "0%",
                    "excise" => "75%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            131 =>
                array(
                    "description" => "USED VEHICLES OVER $25,000.00",
                    "code" => "1",
                    "tarif_heading" => "8703.2180",
                    "duty" => "0%",
                    "excise" => "85%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            132 =>
                array(
                    "description" => "HYBRID MOTOR VEHICLES",
                    "code" => "1",
                    "tarif_heading" => "8703.2190",
                    "duty" => "0%",
                    "excise" => "25%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            133 =>
                array(
                    "description" => "TRUCKS",
                    "code" => "1",
                    "tarif_heading" => "8704.2200",
                    "duty" => "0%",
                    "excise" => "60%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            134 =>
                array(
                    "description" => "AUTO PARTS",
                    "code" => "1",
                    "tarif_heading" => "8708.1090",
                    "duty" => "0%",
                    "excise" => "60%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            135 =>
                array(
                    "description" => "BICYCLES",
                    "code" => "1",
                    "tarif_heading" => "8712.0000",
                    "duty" => "0%",
                    "excise" => "45%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            136 =>
                array(
                    "description" => "BABY CARRIAGES",
                    "code" => "21",
                    "tarif_heading" => "8715.0000",
                    "duty" => "0%",
                    "excise" => "0%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            137 =>
                array(
                    "description" => "CONTACT LENSES - CORRECTIVE",
                    "code" => "1",
                    "tarif_heading" => "9001.4010",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            138 =>
                array(
                    "description" => "OTHER SPECTACLE LENSES",
                    "code" => "1",
                    "tarif_heading" => "9001.4090",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            139 =>
                array(
                    "description" => "SUNGLASSES",
                    "code" => "1",
                    "tarif_heading" => "9004.1000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            140 =>
                array(
                    "description" => "INSTANT PRINT CAMERS",
                    "code" => "1",
                    "tarif_heading" => "9006.4000",
                    "duty" => "0%",
                    "excise" => "7%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            141 =>
                array(
                    "description" => "PROJECTION SCREENS",
                    "code" => "1",
                    "tarif_heading" => "9010.6000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            142 =>
                array(
                    "description" => "WATCHES",
                    "code" => "1",
                    "tarif_heading" => "9101.1100",
                    "duty" => "0%",
                    "excise" => "10%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            143 =>
                array(
                    "description" => "CLOCKS",
                    "code" => "1",
                    "tarif_heading" => "9103.9000",
                    "duty" => "0%",
                    "excise" => "10%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            144 =>
                array(
                    "description" => "MUSICAL INSTRUMENTS",
                    "code" => "1",
                    "tarif_heading" => "9207.9000",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            145 =>
                array(
                    "description" => "REVOLVERS AND PISTOLS",
                    "code" => "1",
                    "tarif_heading" => "9302.0000",
                    "duty" => "0%",
                    "excise" => "85%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            146 =>
                array(
                    "description" => "SHOTGUNS",
                    "code" => "1",
                    "tarif_heading" => "9303.2000",
                    "duty" => "0%",
                    "excise" => "85%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            147 =>
                array(
                    "description" => "AMMUNITION",
                    "code" => "21",
                    "tarif_heading" => "9306.2900",
                    "duty" => "0%",
                    "excise" => "85%",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            148 =>
                array(
                    "description" => "INFANT CAR SEAT",
                    "code" => "1",
                    "tarif_heading" => "9401.2010",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            149 =>
                array(
                    "description" => "OFFICE CHAIRS",
                    "code" => "1",
                    "tarif_heading" => "9401.3000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            150 =>
                array(
                    "description" => "MEDICAL OR BARBER CHAIRS",
                    "code" => "21",
                    "tarif_heading" => "9402.1000",
                    "duty" => "35%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            151 =>
                array(
                    "description" => "KITCHEN CABINETS",
                    "code" => "1",
                    "tarif_heading" => "9403.4000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            152 =>
                array(
                    "description" => "BEDROOM FURNITURE",
                    "code" => "1",
                    "tarif_heading" => "9403.5090",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            153 =>
                array(
                    "description" => "MATTRESSES",
                    "code" => "1",
                    "tarif_heading" => "9404.2190",
                    "duty" => "60%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            154 =>
                array(
                    "description" => "CHANDELIERS",
                    "code" => "21",
                    "tarif_heading" => "9405.1000",
                    "duty" => "35%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            155 =>
                array(
                    "description" => "LAMPS",
                    "code" => "21",
                    "tarif_heading" => "9405.2000",
                    "duty" => "35%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            156 =>
                array(
                    "description" => "LIGHTING FIXTURES",
                    "code" => "21",
                    "tarif_heading" => "9405.4000",
                    "duty" => "35%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            157 =>
                array(
                    "description" => "TRICYCLES, SCOOTERS & PEDAL CARS",
                    "code" => "1",
                    "tarif_heading" => "9503.0000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            158 =>
                array(
                    "description" => "EXERCISE EQUIPMENT",
                    "code" => "1",
                    "tarif_heading" => "9506.9100",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            159 =>
                array(
                    "description" => "FISHING RODS",
                    "code" => "1",
                    "tarif_heading" => "9507.1000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            160 =>
                array(
                    "description" => "BROOMS",
                    "code" => "1",
                    "tarif_heading" => "9603.1000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            161 =>
                array(
                    "description" => "PENS",
                    "code" => "1",
                    "tarif_heading" => "9608.1000",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            162 =>
                array(
                    "description" => "PENCILS AND CRAYONS",
                    "code" => "21",
                    "tarif_heading" => "9609.1000",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            163 =>
                array(
                    "description" => "AIR FRESHNERS",
                    "code" => "21",
                    "tarif_heading" => "9616.1000",
                    "duty" => "45%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            164 =>
                array(
                    "description" => "ANTIQUES",
                    "code" => "21",
                    "tarif_heading" => "9706.0000",
                    "duty" => "10%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
            165 =>
                array(
                    "description" => "HUMAN REMAINS",
                    "code" => "1",
                    "tarif_heading" => "9801.0010",
                    "duty" => "0%",
                    "excise" => "",
                    "stamp" => "",
                    "env_levy" => "",
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                    "cost" => 1
                ),
        ));
    }
}
