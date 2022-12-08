<?php

namespace Database\Factories;
use App\Models\Employe;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeFactory extends Factory
{
    protected $model = Employe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'matricule' => $this->faker->unique()->bankAccountNumber,
            'nom' => $this->faker->firstName,
            'prenom' => $this->faker->lastName,
            'situation_matrimoniale_id' => random_int(1,4),
            'commune_id' => random_int(1,8),
            'piece_identite_id' => random_int(1,3),
            "dateNaissance" => $this->faker->dateTimeBetween("1980-01-01", "2001-12-30"),
            'sexe' => array_rand(["F", "H"], 1),
            'nombre_enfant' => random_int(1,5),
            'email'=> $this->faker->unique()->safeEmail(),
            'telephone1' => $this->faker->unique()->phoneNumber,
            'telephone2' => $this->faker->unique()->phoneNumber,
            'numeroPermis'=> $this->faker->unique()->bankAccountNumber,
            'numeroIdentite' => $this->faker->unique()->bankAccountNumber,
            'numeroCNPS' => $this->faker->unique()->randomNumber(5, true),
            'personContactNum'=> $this->faker->unique()->phoneNumber,
            'personContact' => $this->faker->name(), 
            'photo' => 'images/imageplaceholder.png',
            'acteNaissance' => 'images/imageplaceholder.png',
            'photoPiece' => 'images/imageplaceholder.png',
        ];
    }
}
