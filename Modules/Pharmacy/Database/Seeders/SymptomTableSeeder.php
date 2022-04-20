<?php

namespace Modules\Pharmacy\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Pharmacy\Entities\PharSymptom;

class SymptomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['description' => 'Tos con mucosidad'],
            ['description' => 'Tos sin mucosidad'],
            ['description' => 'Dolor en el pecho'],
            ['description' => 'Cansancio (fatiga)'],
            ['description' => 'Dolor de cabeza leve'],
            ['description' => 'Dolores corporales leves'],
            ['description' => 'Dolor de garganta'],
            ['description' => 'Estornudos'],
            ['description' => 'Congestión nasal'],
            ['description' => 'Moqueo'],
            ['description' => 'Goteo de mucosidad en la garganta (goteo posnasal)'],
            ['description' => 'Lagrimeo'],
            ['description' => 'Fiebre'],
            ['description' => 'Dolor de oído'],
            ['description' => 'Nerviosismo o irritabilidad'],
            ['description' => 'Dificultad para dormir'],
            ['description' => 'Dolor de cabeza'],
            ['description' => 'Escalofríos'],
            ['description' => 'Vómitos'],
            ['description' => 'Diarrhea'],
            ['description' => 'Dolor o presión en la cara'],
            ['description' => 'Mal aliento'],
            ['description' => 'Enrojecimiento de la piel'],
            ['description' => 'Dolor, sensibilidad o sensación de calor cuando se toca la piel afectada'],
            ['description' => 'Inflamación del área afectada'],
            ['description' => 'Ronquera (cambios en la voz que hacen que suene entrecortada, áspera o fatigada)'],
            ['description' => 'Conjuntivitis (también llamada pink eye en inglés)'],
            ['description' => 'Dolor o ardor al orinar'],
            ['description' => 'Orinar con frecuencia'],
            ['description' => 'Sentir la necesidad de orinar a pesar de que la vejiga esté vacía'],
            ['description' => 'Sangre en la orina'],
            ['description' => 'Presión o retorcijones en la ingle o la parte inferior del abdomen'],
            ['description' => 'Dolor en la parte baja de la espalda o en el costado'],
            ['description' => 'Náuseas']
        ];

        foreach($data as $row){
            PharSymptom::create([
                'description' => $row['description']
            ]);
        }
    }
}
