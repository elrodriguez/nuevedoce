<?php

namespace Modules\Pharmacy\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Pharmacy\Entities\PharDisease;

class DiseasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Bronquitis aguda (resfriado de pecho)',
                'description' => 'La bronquitis aguda ocurre cuando se inflaman las vías respiratorias de los pulmones y producen mucosidad en los pulmones. Eso es lo que lo hace toser. La bronquitis aguda, con frecuencia llamada resfriado de pecho, dura menos de 3 semanas y es el tipo más común de bronquitis.',
                'causes' => 'La bronquitis aguda suele ser provocada por un virus y, con frecuencia, ocurre después de una infección de las vías respiratorias superiores. Las bacterias, algunas veces, pueden causar bronquitis aguda, pero incluso en estos casos, NO se recomienda la administración de antibióticos y estos no lo ayudarán a mejorar.',
                'fracture' => false
            ],
            [
                'name' => 'Resfriado común',
                'description' => '¿Estornudos, congestión nasal y moqueo? Podría tener un resfriado. Los resfriados son una de las razones más frecuentes de ausencias escolares y laborales. Cada año, los adultos tienen un promedio de 2 a 3 resfriados y los niños tienen aún más.',
                'causes' => 'Más de 200 virus pueden causar un resfriado, pero los rinovirus son el tipo más común. Los virus que causan los resfriados se pueden propagar de persona a persona por el aire y el contacto personal cercano.',
                'fracture' => false
            ],
            [
                'name' => 'Infección de oído',
                'description' => 'Existen distintos tipos de infecciones de oído. La infección del oído medio (otitis media aguda) es una infección en el oído medio. Otra afección que afecta el oído medio se llama otitis media exudativa. Se presenta cuando se acumula líquido en el oído medio sin estar infectado y sin provocar fiebre, dolor de oído o acumulación de pus en el oído medio.',
                'causes' => 'Bacterias, como Streptococcus pneumoniae y Haemophilus influenzae (inclasificable), que son las dos causas bacterianas más comunes. Virus, como los que causan los resfriados o la influenza.',
                'fracture' => false
            ],
            [
                'name' => 'Influenza (gripe)',
                'description' => 'La influenza es una enfermedad respiratoria que se propaga de persona a persona. Puede causar enfermedad moderada a grave. Las consecuencias graves de la influenza pueden llevar a la hospitalización o la muerte. Algunas personas, como las personas mayores, los niños pequeños, las mujeres embarazadas y las personas con ciertas afecciones tienen un alto riesgo de presentar complicaciones graves por la influenza.',
                'causes' => 'La influenza es causada por un virus que se propaga de persona a persona. Cada año provoca epidemias estacionales.',
                'fracture' => false
            ],
            [
                'name' => 'Sinusitis (infección de los senos paranasales)',
                'description' => '¿Congestión nasal que simplemente no mejora? Podría tener una sinusitis, también llamada infección de los senos paranasales.',
                'causes' => 'Las sinusitis ocurren cuando se acumula líquido en las cavidades llenas de aire en la cara (senos paranasales), lo cual permite que los microbios se multipliquen. La mayoría de las sinusitis son causadas por virus, pero algunas pueden ser causadas por bacterias.',
                'fracture' => false
            ],
            [
                'name' => 'Infecciones de la piel',
                'description' => 'Las infecciones de la piel ocurren cuando las bacterias infectan la piel y algunas veces el tejido profundo debajo de la piel. La celulitis es un tipo común de infección de la piel que provoca enrojecimiento, inflamación y dolor en el área infectada de la piel.',
                'causes' => 'Por lo general, en la piel de una persona viven tipos diferentes de bacterias. La celulitis o un absceso se pueden producir si hay un corte o una ruptura en la piel que permitan el ingreso de bacterias y causen una infección.',
                'fracture' => false
            ],
            [
                'name' => 'Dolor de garganta',
                'description' => '¿Duele al tragar? O ¿le pica la garganta? Probablemente tiene dolor de garganta que es provocado por un virus. La mayoría de los dolores de garganta, excepto la infección de garganta por estreptococos, no necesitan antibióticos.',
                'causes' => 'Las causas del dolor de garganta incluyen: Virus, como los que causan los resfriados o la  influenza (gripe), Las bacterias estreptocócicas del grupo A, que causan la infección de garganta por estreptococos (llamada también faringitis estreptocócica), Tabaquismo o exposición al humo de segunda mano, Alergias',
                'fracture' => false
            ],
            [
                'name' => 'Infección urinaria',
                'description' => 'Las infecciones urinarias son infecciones comunes que ocurren cuando entran bacterias a la uretra, generalmente de la piel o el recto, e infectan las vías urinarias. Pueden afectar a distintas partes de las vías urinarias, pero la infección de vejiga (cistitis) es el tipo más común. La infección de los riñones (pielonefritis) es otro tipo de infección urinaria. Es menos común que la infección de vejiga, pero más grave.',
                'causes' => 'Algunas personas tienen mayor riesgo de contraer una infección urinaria. Las infecciones urinarias son más comunes en las mujeres porque la uretra de las mujeres es más corta y está más cerca del recto. Esto facilita la entrada de bacterias a las vías urinarias.',
                'fracture' => false
            ]
        ];

        foreach($data as $row){
            PharDisease::create([
                'name' => $row['name'],
                'description' => $row['description'],
                'causes' => $row['causes'],
                'fracture' => $row['fracture']
            ]);
        }
    }
}
