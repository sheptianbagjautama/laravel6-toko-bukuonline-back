<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\User;
        $administrator->username = "administrator";
        $administrator->name = "Site Administrator";
        $administrator->email = "admin@gmail.com";
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->phone = "087824392231";
        $administrator->password = \Hash::make("admin123");
        $administrator->avatar = "saat-ini-tidak-ada-file.png";
        $administrator->address = "Sarmili, Bintaro, Tangerang Selatan";

        $administrator->save();

        $this->command->info("User Admin berhasil diinsert");
    }
}
