<?php

namespace Database\Seeders;

use App\Models\MembersModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembersModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MembersModel::insert([
            [
                'name' => 'Josep Ronaldo Francis Siregar',
                'phone_number' => '087893504595',
                'type' => 'pengurus'
            ],
            ['name' => 'Kinta', 'phone_number' => '081378702998', 'type' => 'member'],
            ['name' => 'Badrudin (JABBAR LAUNDRY)', 'phone_number' => '085278738596', 'type' => 'member'],
            ['name' => 'Muchsin Harahap', 'phone_number' => '085296844954', 'type' => 'member'],
            ['name' => 'windra yani', 'phone_number' => '082170065423', 'type' => 'member'],
            ['name' => 'Herman', 'phone_number' => '082172030589', 'type' => 'member'],
            ['name' => 'Alifia Putri Yasmin', 'phone_number' => '082285597003', 'type' => 'member'],
            ['name' => 'Fachroni', 'phone_number' => '082174253999', 'type' => 'pengurus'],
            ['name' => 'Lis Suriati', 'phone_number' => '081275982422', 'type' => 'member'],
            ['name' => 'ERMALIA', 'phone_number' => '085278739176', 'type' => 'member'],
            ['name' => 'adria willy', 'phone_number' => '081371455091', 'type' => 'pengurus'],
            ['name' => 'DORA NATALIA SINGARIMBUN.SE', 'phone_number' => '082112075817', 'type' => 'member'],
            ['name' => 'suhendra', 'phone_number' => '082233300042', 'type' => 'member'],
            ['name' => 'Arnita Sarianti Am.Tg', 'phone_number' => '082256109762', 'type' => 'member'],
            ['name' => 'Asri Suryani Nurlatifah', 'phone_number' => '08117501040', 'type' => 'member'],
            ['name' => 'arbagus emir alam', 'phone_number' => '085363368473', 'type' => 'member'],
            ['name' => 'YUDHA ARMANDA', 'phone_number' => '082172573734', 'type' => 'member'],
            ['name' => 'oerianto pratama', 'phone_number' => '081277600723', 'type' => 'pengurus'],
            ['name' => 'Gilang Bintang', 'phone_number' => '082288226530', 'type' => 'member'],
            ['name' => 'Edotriandes', 'phone_number' => '085263650123', 'type' => 'member'],
            ['name' => 'Endah Rosita', 'phone_number' => '081364747815', 'type' => 'member'],
            ['name' => 'Wisma Leni', 'phone_number' => '082388997529', 'type' => 'panitia'],
            ['name' => 'Dedi Sirait', 'phone_number' => '082180000885', 'type' => 'pengurus'],
            ['name' => 'Indamiati', 'phone_number' => '085271840101', 'type' => 'member'],
            ['name' => 'Jenferi Ginting', 'phone_number' => '082381683772', 'type' => 'pengurus'],
            ['name' => 'Yulia Amalina', 'phone_number' => '081261707744', 'type' => 'member'],
            ['name' => 'Aprima Yogi', 'phone_number' => '085278814342', 'type' => 'member'],
            ['name' => 'Nandang Sugandi', 'phone_number' => '085375899964', 'type' => 'member'],
            ['name' => 'Boby Setia Gunawan', 'phone_number' => '082342766666', 'type' => 'member'],
            ['name' => 'rizqi firdaussyah', 'phone_number' => '082383718317', 'type' => 'panitia'],
            ['name' => 'Wina Wulandari', 'phone_number' => '08126408214', 'type' => 'member'],
            ['name' => 'Jimmy', 'phone_number' => '085265335507', 'type' => 'pengurus'],
            ['name' => 'Zakiah Mulyana', 'phone_number' => '085264583134', 'type' => 'member'],
            ['name' => 'Muhammad Irsyad', 'phone_number' => '08117547776', 'type' => 'pengurus'],
            ['name' => 'Ira Satria', 'phone_number' => '081275940954', 'type' => 'member'],
            ['name' => 'Sonny Rianando', 'phone_number' => '085228020551', 'type' => 'pengurus'],
            ['name' => 'Dori Andelo', 'phone_number' => '085278360021', 'type' => 'panitia'],
            ['name' => 'Riki Rahman', 'phone_number' => '085355008500', 'type' => 'member'],
            ['name' => 'Rahmat Kurniawan', 'phone_number' => '081374763636', 'type' => 'pengurus'],
            ['name' => 'Nopri Sandra', 'phone_number' => '082381604805', 'type' => 'member'],
            ['name' => 'KABUL SANTOSA', 'phone_number' => '085272188095', 'type' => 'pengurus'],
            ['name' => 'Desi Ratna Sari', 'phone_number' => '082384979300', 'type' => 'member'],
            ['name' => 'Endang wiwin', 'phone_number' => '082382546731', 'type' => 'member'],
            ['name' => 'Elisadina Ramadani', 'phone_number' => '081260366660', 'type' => 'member'],
            ['name' => 'Ana Syafitri', 'phone_number' => '082170662075', 'type' => 'member'],
            ['name' => 'endang sulastri', 'phone_number' => '081365435423', 'type' => 'member'],
            ['name' => 'Inong Pinolaya', 'phone_number' => '081222371313', 'type' => 'member'],
            ['name' => 'suliamat', 'phone_number' => '085365818500', 'type' => 'member'],
            ['name' => 'Fitria Helmi', 'phone_number' => '082246148640', 'type' => 'member'],
            ['name' => 'Tria Juwita', 'phone_number' => '085271875336', 'type' => 'member'],
            ['name' => 'Syofia Dona', 'phone_number' => '082388258316', 'type' => 'member'],
            ['name' => 'Eli Marlina', 'phone_number' => '085364838506', 'type' => 'member'],
            ['name' => 'Albert Benny Caruso Manurung', 'phone_number' => '081270406696', 'type' => 'member'],
            ['name' => 'Dwi Khasanah', 'phone_number' => '082246028712', 'type' => 'member'],
            ['name' => 'Zahro Alfatmi', 'phone_number' => '082284723910', 'type' => 'member'],
            ['name' => 'Winda Hayati', 'phone_number' => '081365770785', 'type' => 'member'],
            ['name' => 'Listiawati Zainur', 'phone_number' => '085265902319', 'type' => 'member'],
            ['name' => 'Lolita', 'phone_number' => '081371188168', 'type' => 'member'],
            ['name' => 'Sarizuddin Abdi', 'phone_number' => '085356655300', 'type' => 'member'],
            ['name' => 'Andry Yani Nurhidayah', 'phone_number' => '081277326688', 'type' => 'member'],
            ['name' => 'Indah Herdiana', 'phone_number' => '085272990648', 'type' => 'member'],
            ['name' => 'Agustony Pangaribuan', 'phone_number' => '081289248272', 'type' => 'pengurus'],
            ['name' => 'Syafrijon', 'phone_number' => '085265909010', 'type' => 'member'],
            ['name' => 'Fatmawati', 'phone_number' => '08127572150', 'type' => 'member'],
            ['name' => 'Yandri Endo Mahata', 'phone_number' => '08111931267', 'type' => 'member'],
            ['name' => 'Said Abdul Rahim', 'phone_number' => '081261717772', 'type' => 'panitia'],
            ['name' => 'Lia Roza', 'phone_number' => '082176767755', 'type' => 'member'],
            ['name' => 'Nurhidayati', 'phone_number' => '082284700984', 'type' => 'member'],
            ['name' => 'Dessi Rahmawati', 'phone_number' => '082210106006', 'type' => 'member'],
            ['name' => 'Suhendra Ramadhan', 'phone_number' => '082172828282', 'type' => 'member'],
            ['name' => 'Loli Trisna Wati', 'phone_number' => '082285067001', 'type' => 'member'],
            ['name' => 'Yuliana Idha', 'phone_number' => '082288089599', 'type' => 'member'],
            ['name' => 'Rayhan Syauki Valiandra', 'phone_number' => '082287686551', 'type' => 'pengurus'],
            ['name' => 'Sahril', 'phone_number' => '081356173423', 'type' => 'member'],
            ['name' => 'Asih', 'phone_number' => '082269009804', 'type' => 'member'],
            ['name' => 'Rizka Ade Irma', 'phone_number' => '082172567644', 'type' => 'member'],
            ['name' => 'Enik Vidianti', 'phone_number' => '082173552111', 'type' => 'member'],
            ['name' => 'Sulisna', 'phone_number' => '082386132840', 'type' => 'member'],
            ['name' => 'Suherman', 'phone_number' => '082171099900', 'type' => 'member'],
            ['name' => 'Ramayanti', 'phone_number' => '082285487494', 'type' => 'member'],
        ]);
    }
}
