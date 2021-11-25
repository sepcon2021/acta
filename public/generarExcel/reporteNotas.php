<?php

require_once "public/PHPExcel/PHPExcel.php";

class ReporteNotasExcel
{

    public function generateReporteNotas($listaNotas)
    {

        // Se crea el objeto PHPExcel
        $objPHPExcel = new PHPExcel();

        // Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator("Registro Notas"); // Nombre del autor
        $objPHPExcel->getProperties()->setLastModifiedBy("Registro Notas"); //Ultimo usuario que lo modificó
        $objPHPExcel->getProperties()->setTitle("Registro Notas"); // Titulo
        $objPHPExcel->getProperties()->setSubject("Reporte Excel con PHP y MySQL"); //Asunto
        $objPHPExcel->getProperties()->setDescription("SEPCON"); //Descripción
        $objPHPExcel->getProperties()->setKeywords("SEPCON"); //Etiquetas
        $objPHPExcel->getProperties()->setCategory("SEPCON"); //Categorias

        $Titulo = array(
            'font' => array(
                'bold' => true,
                'size' => 14,
                'name' => 'Verdana',
            )
        );

        $TituloTabla = array(
            'font' => array(
                'bold' => true,
                'size' => 9,
                'name' => 'Arial',
                'color' => array('rgb' => '000000'),
            )
        );

        $backgroundCellGreen = array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => '90EE90',
            ),
        );
        $backgroundCellRed = array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => 'FFCCCB',
            ),
        );
        

        // Crea un nuevo objeto PHPExcel
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getActiveSheet()->getStyle('B4:AZ4')->applyFromArray($TituloTabla);
        $objPHPExcel->getActiveSheet()->getStyle('B5:AZ5')->applyFromArray($TituloTabla);


        //alineacion
        $objPHPExcel->getActiveSheet()->getStyle('A1:Z3000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:Z3000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(50);


        //ancho de columnas
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(80);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('B5', 'DNI');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C5', 'Nombres y Apellidos');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D5', 'Cargo del trabajador');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E5', 'Proyecto');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('G5', 'Nota');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('F5', 'Comentario');



        $row = 6;
        

        foreach ($listaNotas as $datos) {

            $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(1, $row, $datos->dni);
            $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(2, $row, $datos->nombresApellidos);
            $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(3, $row, $datos->nombreCargo);
            $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(4, $row, $datos->nombeCostos);
            $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(6, $row, $datos->nota);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(6, $row)->getFill()->applyFromArray( $datos->examen =='Si' ?  $backgroundCellGreen : $backgroundCellRed );
            $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(7, $row, $datos->comentario);

            $row++;

        }



        $fecha = new DateTime();
        $fecha = $fecha->getTimestamp();


        $rutaExcel = 'public/reports/registroNotas' . $fecha . '.xlsx';

        // Renombrar Hoja
        $objPHPExcel->getActiveSheet()->setTitle('Registro de Notas');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($rutaExcel);
        return $rutaExcel;
    }


    public function generateReporteNotasSGI($listaNotas,$listaPreguntas,$listaAlternativas)
    {

        // Se crea el objeto PHPExcel
        $objPHPExcel = new PHPExcel();

        // Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator("Registro Notas"); // Nombre del autor
        $objPHPExcel->getProperties()->setLastModifiedBy("Registro Notas"); //Ultimo usuario que lo modificó
        $objPHPExcel->getProperties()->setTitle("Registro Notas"); // Titulo
        $objPHPExcel->getProperties()->setSubject("Reporte Excel con PHP y MySQL"); //Asunto
        $objPHPExcel->getProperties()->setDescription("SEPCON"); //Descripción
        $objPHPExcel->getProperties()->setKeywords("SEPCON"); //Etiquetas
        $objPHPExcel->getProperties()->setCategory("SEPCON"); //Categorias

        $Titulo = array(
            'font' => array(
                'bold' => true,
                'size' => 14,
                'name' => 'Verdana',
            )
        );

        $TituloTabla = array(
            'font' => array(
                'bold' => true,
                'size' => 9,
                'name' => 'Arial',
                'color' => array('rgb' => '000000'),
            )
        );

        $backgroundCellGreen = array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => '90EE90',
            ),
        );
        $backgroundCellRed = array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => 'FFCCCB',
            ),
        );
        

        // Crea un nuevo objeto PHPExcel
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getActiveSheet()->getStyle('B4:AZ4')->applyFromArray($TituloTabla);
        $objPHPExcel->getActiveSheet()->getStyle('B5:AZ5')->applyFromArray($TituloTabla);


        //alineacion
        $objPHPExcel->getActiveSheet()->getStyle('A1:Z3000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:Z3000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(50);


        //ancho de columnas
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(80);

        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(80);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(80);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(80);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(80);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(80);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(80);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(80);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(80);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(80);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(80);


        $objPHPExcel->setActiveSheetIndex()->setCellValue('B5', 'DNI');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C5', 'Nombres y Apellidos');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D5', 'Cargo del trabajador');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E5', 'Proyecto');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('G5', 'Nota');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('F5', 'Comentario');

        $index = 7;

        foreach($listaPreguntas as $preguntas){
            
            $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow($index , 5 , $preguntas->nombre);

            $index ++;
        }



        $row = 6;

        

        

        foreach ($listaNotas as $datos) {

            $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(1, $row, $datos->dni);
            $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(2, $row, $datos->nombresApellidos);
            $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(3, $row, $datos->nombreCargo);
            $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(4, $row, $datos->nombeCostos);
            $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(5, $row, $datos->comentario);
            $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow(6, $row, $datos->nota);
            $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(6, $row)->getFill()->applyFromArray( $datos->examen =='Si' ?  $backgroundCellGreen : $backgroundCellRed );
            
            $index = 7;

            foreach($datos->listaRespuesta as $respuesta){

                if($respuesta['idTipoPregunta'] == 1 ){

                    foreach($listaAlternativas as $alternativa){

                        //echo $alternativa->id.'/'.$respuesta['alternativa'];
                        
                        if($alternativa->id == $respuesta['alternativa']){

                            $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow($index , $row , $alternativa->nombre);

                        }
                    }


                }

                
                if($respuesta['idTipoPregunta'] == 2 ){

                    $objPHPExcel->setActiveSheetIndex()->setCellValueByColumnAndRow($index , $row , $respuesta['alternativa']);

                }

    
                $index ++;
            }

            $row++;

        }



        $fecha = new DateTime();
        $fecha = $fecha->getTimestamp();


        $rutaExcel = 'public/reports/registroNotas' . $fecha . '.xlsx';

        // Renombrar Hoja
        $objPHPExcel->getActiveSheet()->setTitle('Registro de Notas');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($rutaExcel);
        return $rutaExcel;
    }


}
