<?php
namespace App\Parse;

use Aspera\Spreadsheet\XLSX\Reader;

/**
 * Parse class which we are parsing excel files
 */
class Parse{

    private $_filename;

    private $_xlxs;

    public function __construct(string $filename)
    {
        $this->_filename = $filename;

        $xlxs  = new Reader();

        $this->_xlxs = $xlxs;
    }

    public function getXLXS()
    {
        return $this->_xlxs;
    }

    public function getFileName()
    {
        return $this->_filename;
    }

    public function parsefile(string $sheetname)
    {
        $arrres = [];
        $reader = $this->getXLXS();
        $filename = $this->getFileName();

        try
        {

            $reader->open($filename);

            $sheets = $reader->getSheets();

            foreach ($sheets as $index => $sheet_data) {

                if($sheet_data->getName() === $sheetname){
            
                    $reader->changeSheet($index);
            
                    foreach ($reader as $row) {
                        array_push($arrres,$row);
                    }
                }
            }

            $reader->close();

        }catch (\Throwable $th)
        {
            die("Error in file parsing !!!!".$th->getMessage());
        }

        return $arrres;
    }

}
