<?php

namespace App\Imports;

use App\books;
use Response;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
class BookImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
  {
      return 2;
  }
    public function model(array $row)
    {
      if(!books::where('bookID', '=', $row[0])->exists()) {
         books::create([
          'bookID'     => $row[0],
          'bname'    => $row[1],
          'author'  => $row[2],
          'price' => (integer)$row[3],
          'description' => $row[4],
          'publisher' => $row[5],
          'bCategory' => $row[6],
          'bcount' => (integer)$row[7],
          'status' => $row[8],
          'bImage' => ''
        ]);
      }else{}
    }
}
