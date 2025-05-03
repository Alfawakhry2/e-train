<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::factory()->create([
        'name'=>'ALfawakhry',
        'email'=>'ahmed@gmail.com',
        'password'=>bcrypt(123456789),
        'phone'=>'01096330342',
        'address'=>'Belbis , Shrqia',
       ]);
    }
}
