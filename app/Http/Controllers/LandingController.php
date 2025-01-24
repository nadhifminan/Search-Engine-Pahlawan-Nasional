<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class LandingController extends Controller
{
    public function search(Request $request)
    {
        // $category = Input::get('category', 'default category');
        $query = $request->input('q');
        $rank = $request->input('rank');
        $provinsi = $request->input('provinsi');

        $process = new Process(['python', "query.py", "pahlawan", $rank, $query, $provinsi],
    null,
    ['SYSTEMROOT' => getenv('SYSTEMROOT'), 'PATH' => getenv("PATH")]);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $list_data = array_filter(explode("\n",$process->getOutput()));
        
        $data = array();

        foreach ($list_data as $book) {
            $dataj =  json_decode($book, true);
            array_push($data, '
            <div class="col-lg-5">
                <div class="card mb-2">
                    <div style="display: flex; flex: 1 1 auto;">
                        <div class="img-square-wrapper">
                            <img src="'.$dataj['img'].'">
                        </div>
                        <div class="card-body">
                            <b><h4 class="card-text text-success">'.$dataj['nama'].'</h4></b>
                            <p class="card-text text-success"><b>Nama Asli : </b>'.$dataj['namaLngkp'].'</p>
                            <p class="card-text text-success"><b>Asal Daerah : </b>'.$dataj['asal'].'</p>
                            <p class="card-text text-success"><b>Kategorisasi : </b>'.$dataj['kategori'].'</p>
                            <p class="card-text text-success"><b>Histori : </b>'.$dataj['history'].'</p>
                            <p class="card-text text-success"><b>Lahir : </b>'.$dataj['lahir'].'</p>
                            <p class="card-text text-success"><b>Wafat : </b>'.$dataj['gugur'].'</p>
                            <p class="card-text text-success"><b>Makam : </b>'.$dataj['lokMakam'].'</p>
                        </div>
                    </div>
                
                </div>
            </div>
            ');
        }
        echo json_encode($data);
    }
}