<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Model;
use App\Models\Weapon;
use App\Models\Magazine;
use App\Models\WeaponType;
use App\Models\Shift;
use App\Models\License;
use App\Models\Branch;
use App\Models\Division;
use App\Models\Officer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

       // WeaponTypes
$weaponType1 = WeaponType::create([
    'category' => 'Rifle',
    'description' => 'Armas de fuego largas diseñadas para precisión.',
]);

$weaponType2 = WeaponType::create([
    'category' => 'Pistola',
    'description' => 'Armas cortas y ligeras de uso personal.',
]);

$weaponType3 = WeaponType::create([
    'category' => 'Escopeta',
    'description' => 'Armas de fuego diseñadas para munición de perdigones.',
]);

$weaponType4 = WeaponType::create([
    'category' => 'Subfusil',
    'description' => 'Armas automáticas compactas con alto poder de fuego.',
]);

$weaponType5 = WeaponType::create([
    'category' => 'Francotirador',
    'description' => 'Armas de fuego diseñadas para largo alcance.',
]);

// Models
$model1 = Model::create([
    'name' => 'AR-15',
    'supplier' => 'Colt',
    'image' => 'ar15.jpg',
]);

$model2 = Model::create([
    'name' => 'Glock 19',
    'supplier' => 'Glock',
    'image' => 'glock19.jpg',
]);

$model3 = Model::create([
    'name' => 'Remington 870',
    'supplier' => 'Remington',
    'image' => 'remington870.jpg',
]);

$model4 = Model::create([
    'name' => 'MP5',
    'supplier' => 'Heckler & Koch',
    'image' => 'mp5.jpg',
]);

$model5 = Model::create([
    'name' => 'Barrett M82',
    'supplier' => 'Barrett',
    'image' => 'barrettm82.jpg',
]);

// Weapons
$weapon1 = Weapon::create([
    'model_id' => $model1->id,
    'nombre' => 'AR-15 Modelo Especial',
    'wtype_id' => $weaponType1->id,
    'status' => 'disponible',
]);

$weapon2 = Weapon::create([
    'model_id' => $model2->id,
    'nombre' => 'Glock 19 Compact',
    'wtype_id' => $weaponType2->id,
    'status' => 'disponible',
]);

$weapon3 = Weapon::create([
    'model_id' => $model3->id,
    'nombre' => 'Remington 870 Tactical',
    'wtype_id' => $weaponType3->id,
    'status' => 'disponible',
]);

$weapon4 = Weapon::create([
    'model_id' => $model4->id,
    'nombre' => 'MP5 SD',
    'wtype_id' => $weaponType4->id,
    'status' => 'disponible',
]);

$weapon5 = Weapon::create([
    'model_id' => $model5->id,
    'nombre' => 'Barrett M82A1',
    'wtype_id' => $weaponType5->id,
    'status' => 'disponible',
]);

// Magazines
$magazine1 = Magazine::create([
    'caliber' => '5.56mm',
    'capacity' => 30,
    'model_id' => $model1->id,
    'model_magazine' => 'AR-15 Standard',
    'status' => 'disponible',
]);

$magazine2 = Magazine::create([
    'caliber' => '9mm',
    'capacity' => 15,
    'model_id' => $model2->id,
    'model_magazine' => 'Glock 19 Standard',
    'status' => 'disponible',
]);

$magazine3 = Magazine::create([
    'caliber' => '12 Gauge',
    'capacity' => 5,
    'model_id' => $model3->id,
    'model_magazine' => 'Remington 870 Shell',
    'status' => 'disponible',
]);

$magazine4 = Magazine::create([
    'caliber' => '9mm',
    'capacity' => 30,
    'model_id' => $model4->id,
    'model_magazine' => 'MP5 Standard',
    'status' => 'disponible',
]);

$magazine5 = Magazine::create([
    'caliber' => '.50 BMG',
    'capacity' => 10,
    'model_id' => $model5->id,
    'model_magazine' => 'Barrett M82 Magazine',
    'status' => 'disponible',
]);

        // Crear turnos (Shifts)
        $morningShift = Shift::create(['name' => 'Morning Shift']);
        $nightShift = Shift::create(['name' => 'Night Shift']);

        // Crear licencias (Licenses)
        $weaponLargeLicense = License::create(['name' => 'Rifle']);
        $weaponShortLicense = License::create(['name' => 'Subfusil']);

        // Crear sucursales (Branches)
        $mainBranch = Branch::create([
            'name' => 'Main Branch',
            'location' => '123 Main Street, City Center',
        ]);

        $secondaryBranch = Branch::create([
            'name' => 'Secondary Branch',
            'location' => '456 Secondary Ave, Suburbia',
        ]);

        // Crear divisiones (Divisions)
        $investigationDivision = Division::create([
            'name' => 'Investigation',
            'description' => 'Handles criminal investigations and forensics.',
        ]);

        $patrolDivision = Division::create([
            'name' => 'Patrol',
            'description' => 'Responsible for city patrols and rapid response.',
        ]);

        // Crear oficiales (Officers)
        $officer1 = Officer::create([
            'name' => 'John Doe',
            'id_branch' => $mainBranch->id,
            'id_shift' => $morningShift->id,
            'division_id' => $investigationDivision->id,
            'join_date' => '2022-01-15',
            'email' => 'johndoe@example.com',
            'phone' => '5551234',
            'curp' => '123456789012345678',
            'birthday' => '1988-01-01',
        ]);



        // Asignar licencias a oficiales
        $officer1->licenses()->attach([$weaponLargeLicense->id, $weaponShortLicense->id]);

    }
}
