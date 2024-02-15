<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SoapTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('soap')->insert([
            'pasien' => 'Ronaldo',
            'subjektif' => json_encode(['Pasien mengeluhkan terjadi penumpukan plak dan karang gigi.',
                                        'Pasien juga mengatakan bahwa giginya terasa kasar dan tidak nyaman.',
                                        'Pasien tidak melaporkan adanya rasa sakit atau perdarahan pada gusi.']),
            'objektif' => json_encode(['Terdapat penumpukan plak dan karang gigi yang terlihat pada pemeriksaan visual.', 
                                        'Gusi tampak merah dan sedikit bengkak di beberapa area.',
                                        'Tidak terdapat tanda-tanda perdarahan spontan.']),
            'assesment' => json_encode(['Penumpukan plak dan karang gigi menyebabkan iritasi pada gusi (gingivitis).',
                                        'Perlu dilakukan pembersihan karang gigi untuk menghilangkan plak dan karang gigi serta mengurangi peradangan pada gusi.']),
            'plan' => json_encode(['Lakukan pembersihan karang gigi menggunakan skaler dan polisher untuk menghilangkan plak dan karang gigi.', 
                                    'Berikan instruksi kepada pasien mengenai teknik menyikat gigi yang benar dan pentingnya menggunakan benang gigi.']),
            'tindakan' => 'Pembersihan Karang Gigi',
            'jenis_pasien' => 'Asuransi Admedika',
            'biaya' => 'Rp. 50.000.000',
            'tanggal' => '12/02/2023',
            'noresep' => '10458',
            'reminder' => true,
        ]);
    }
}
