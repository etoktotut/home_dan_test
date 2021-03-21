<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\IPC;

class StockController extends Controller
{

    public function stock_fill(Request $req)
    {
      
      return view('stock_fill');
    }


    public function stock_pull(Request $req)
    {
      Stock::truncate(); // очищаем базу состояния склада
      $path = $req->file('st_file')->getRealPath(); // запоминаем путь к введенному файлу
      $data = array_map(function($v){return str_getcsv($v, ";");}, file($path)); // набиваем двумерный массив строчка за строчкой разбирая csv-файл.
      // то есть у нас каждая строка - это массив из элементов одной строки. а итоговый массив - это массив из массивов отдельных строк

//удаляем два первые элемента массива( две первых строчки из csv) - это названия колонок на русском и не сильно нужны, sql ругается
      $data1= array_shift($data);
      $data1= array_shift($data);
// набиваем базу строчка за строчкой, поле складской базы и соответствующей ей индекс элемента в разбираемой строчке храним в app.php, типа msk_t это 4-й элемент в строке CSV-файла ( отсчет с 0)

      foreach ($data as $row) {
        $stock = new Stock();
        foreach (config('app.db_fields') as $index => $field) { $stock->$field = $row[$index];}
        $stock->save();
                              }
// тут бы надо какую проверку на ошибки сделать? хотя , может оно и внутри цикла надо делать...
      $cameras=IPC::all();

      foreach ($cameras as $cam) {
        $stock=Stock::firstWhere('ipc_pn',$cam->pn);
//если нашли в складе партномер из нашей базы камер, то id камеры заносим в базу склада
        if (isset($stock)) {
          //dd($cam->id);
          $stock->ipc_id = $cam->id;
          $stock->save();
                          }
                                }
//

      return "OK1";
    }
}
