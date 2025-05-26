<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition(): array
    {
        $cities = [
            'París',
            'Londres',
            'Nueva York',
            'Roma',
            'Tokio',
            'Barcelona',
            'Berlín',
            'Dubái',
            'Sídney',
            'Rio de Janeiro',
            'Ámsterdam',
            'Praga',
            'Estambul',
            'Bangkok',
            'Singapur',
            'Hong Kong',
            'Los Ángeles',
            'Madrid',
            'Viena',
            'Venecia'
        ];

        $activityTypes = [
            'Tour por',
            'Recorrido gastronómico en',
            'Excursión a',
            'Aventura en',
            'Tour cultural por',
            'Experiencia culinaria en',
            'Paseo en bicicleta por',
            'Tour histórico de',
            'Visita guiada a',
            'Exploración de',
            'Crucero por',
            'Tour fotográfico en',
            'Experiencia de arte en',
            'Tour de compras en',
            'Recorrido nocturno por'
        ];

        $landmarks = [
            'el Louvre',
            'Times Square',
            'el Coliseo',
            'la Torre Eiffel',
            'el Big Ben',
            'la Sagrada Familia',
            'el Muro de Berlín',
            'el Burj Khalifa',
            'la Ópera de Sídney',
            'el Cristo Redentor',
            'los canales',
            'el Castillo de Praga',
            'Santa Sofía',
            'los templos budistas',
            'Marina Bay Sands',
            'Victoria Peak',
            'Hollywood',
            'el Palacio Real',
            'el Palacio de Schönbrunn',
            'el Gran Canal'
        ];

        $city = $this->faker->randomElement($cities);
        $activityType = $this->faker->randomElement($activityTypes);
        $landmark = $this->faker->randomElement($landmarks);

        // Construcción inteligente del título
        $title = "$activityType $city";
        if (str_contains($activityType, 'a') || str_contains($activityType, 'de') || str_contains($activityType, 'por')) {
            $title = "$activityType $landmark";
        }

        $descriptions = [
            "Descubre los secretos mejor guardados de $city con nuestros guías expertos locales.",
            "Experimenta la auténtica cultura de $city a través de su historia y tradiciones.",
            "Disfruta de una experiencia única explorando $landmark con visitas exclusivas.",
            "Sumérgete en la vibrante vida de $city con este tour completo por sus principales atracciones.",
            "Saborea la gastronomía local mientras descubres los rincones ocultos de $city.",
            "Aprende sobre la fascinante historia de $landmark con nuestros guías especializados.",
            "Captura los momentos más memorables de tu viaje con este tour fotográfico por $city.",
            "Vive la emoción de $city por la noche con este recorrido lleno de sorpresas.",
            "Explora los lugares más instagrameables de $city con nuestros guías fotógrafos.",
            "Descubre por qué $landmark es uno de los lugares más visitados del mundo."
        ];

        $startDate = $this->faker->dateTimeBetween('now', '+1 month');
        $endDate = Carbon::parse($startDate)->addDays(rand(30, 365)); // Actividades disponibles de 1 mes a 1 año

        return [
            'title' => $title,
            'description' => $this->faker->randomElement($descriptions),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'price_per_person' => $this->faker->randomFloat(2, 20, 500), // Precios entre $20 y $500
            'popularity' => $this->faker->numberBetween(50, 5000), // Popularidad más variada
            'image_path' => $this->getRandomImagePath($city)
        ];
    }

    protected function getRandomImagePath($city)
    {
        $cityImageMap = [
            'París' => ['paris1.jpg', 'paris2.jpg', 'paris3.jpg'],
            'Londres' => ['london1.jpg', 'london2.jpg', 'london3.jpg'],
            'Nueva York' => ['ny1.jpg', 'ny2.jpg', 'ny3.jpg'],
            'Roma' => ['rome1.jpg', 'rome2.jpg', 'rome3.jpg'],
            'Tokio' => ['tokyo1.jpg', 'tokyo2.jpg', 'tokyo3.jpg'],
            'Barcelona' => ['barcelona1.jpg', 'barcelona2.jpg', 'barcelona3.jpg'],
            'Berlín' => ['berlin1.jpg', 'berlin2.jpg', 'berlin3.jpg'],
            'Dubái' => ['dubai1.jpg', 'dubai2.jpg', 'dubai3.jpg'],
            'Sídney' => ['sydney1.jpg', 'sydney2.jpg', 'sydney3.jpg'],
            'Rio de Janeiro' => ['rio1.jpg', 'rio2.jpg', 'rio3.jpg'],
            'Ámsterdam' => ['amsterdam1.jpg', 'amsterdam2.jpg', 'amsterdam3.jpg'],
            'Praga' => ['prague1.jpg', 'prague2.jpg', 'prague3.jpg'],
            'Estambul' => ['istanbul1.jpg', 'istanbul2.jpg', 'istanbul3.jpg'],
            'Bangkok' => ['bangkok1.jpg', 'bangkok2.jpg', 'bangkok3.jpg'],
            'Singapur' => ['singapore1.jpg', 'singapore2.jpg', 'singapore3.jpg'],
            'Hong Kong' => ['hongkong1.jpg', 'hongkong2.jpg', 'hongkong3.jpg'],
            'Los Ángeles' => ['la1.jpg', 'la2.jpg', 'la3.jpg'],
            'Madrid' => ['madrid1.jpg', 'madrid2.jpg', 'madrid3.jpg'],
            'Viena' => ['vienna1.jpg', 'vienna2.jpg', 'vienna3.jpg'],
            'Venecia' => ['venice1.jpg', 'venice2.jpg', 'venice3.jpg']
        ];

        if (array_key_exists($city, $cityImageMap)) {
            return 'activities/' . $this->faker->randomElement($cityImageMap[$city]);
        }

        return 'activities/default.jpg';
    }
}
