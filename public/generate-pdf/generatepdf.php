<?php
require_once "public/fpdf/fpdf.php";

class GeneratePDF
{


    var $filasPorHoja  = 11;


    public function isFile($file)
    {
        $f = pathinfo($file, PATHINFO_EXTENSION);
        return (strlen($f) > 0) ? true : false;
    }

    public function generateAsistenciaPdf($evaluacion)
    {

        $pdf = new FPDF();

        $numeracion = 1;

        $arrayCantidadPaginas = $this->crearArray($evaluacion->listaEvaluacion);


        for ($index = 0; $index <  (count($arrayCantidadPaginas) - 1); $index++) {


            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(0, 0, 0);

            $pdf->Image('public/img/logo.png', 11, 14, 18);
            $pdf->Image('public/img/cliente.jpeg', 30, 14, 18);

            $pdf->Cell(40, 20, '', 1, 0, 'C');



            $pdf->MultiCell(100, 20, utf8_decode('CONTROL DE ASISTENCIA A CAPACITACIONES'), 1, 'C', false);
            $pdf->SetFont('Helvetica', '', 8);

            $pdf->SetXY(150, 10);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(45, 5, utf8_decode('
            
       
Página No .......... de ..........'), 1, 'L', false);

            $pdf->SetXY(150, 10);
            $pdf->SetFont('Helvetica', '', 6.5);
            $pdf->MultiCell(45, 3.5, utf8_decode('PMAL-300-OP-H-005 Prot. 01
Revisión: 0
Emisión: 24/06/2021
Página: 1 de ' . ($index + 1)), 1, 'L', false);

            /**
             *         
             */


            $pdf->SetXY(10, 30);
            $pdf->SetFont('Helvetica', '', 8);
            $pdf->Cell(185, 5, '', 1);

            $pdf->SetXY(10, 30);
            $pdf->Cell(50, 5, 'Nro de Registro ', 0);

            $pdf->SetXY(35, 31);
            $pdf->Cell(30, 3, utf8_decode(''), 1);



            $pdf->SetXY(10, 35);
            $pdf->SetFont('Helvetica', '', 8);
            $pdf->SetFillColor(255, 252, 187); //Fondo verde de celda
            $pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
            $pdf->Cell(185, 5, utf8_decode('A. INFORMACIÓN DEL EMPLEADOR '),  1, 0, 'C', true);




            $pdf->SetXY(10, 40);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(110, 3.5, utf8_decode('
        Razón Social : SERVICIOS PETROLEROS Y CONSTRUCCIONES SEPCON S.A.C
        RUC: 20504898173 
        Domicilio: Av. San Borja Norte 445 - San Borja -Perú
        Tipo de Acntividad Económica:
        '), 1, 'L', false);

            $pdf->SetXY(120, 40);
            $pdf->MultiCell(75, 3, utf8_decode('
        Trabajadores del Proyecto:
        Año de Inicio del Proyecto: 2021 
        Número de Trabajadores Afiliados al SCTR:
        Número de Trabajadores No Afiliados al SCTR:
        Nombre de la Asegurador : RIMAC
        '), 1, 'L', false);


            $pdf->Line(160, 46, 193, 46);
            $pdf->Line(175, 51, 193, 51);
            $pdf->Line(180, 55, 193, 55);





            $pdf->SetXY(10, 61);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(140, 3.5, utf8_decode('
        PROYECTO:    ' . $evaluacion->proyecto . '
        FASE:        ' . $evaluacion->fase . '
        FACILITADOR:        ' . $evaluacion->facilitador . '
        '), 1, 'J', false);

            $pdf->SetXY(90, 61);
            $pdf->MultiCell(50, 3.5, utf8_decode('

        CLIENTE:  ' . $evaluacion->cliente . '
        N° PARTICIPANTES: ' . count($evaluacion->listaEvaluacion) . '
        '), 0, 'J', false);


            $pdf->SetXY(150, 61);
            $pdf->MultiCell(45, 3.5, utf8_decode('
        Fecha:  ' . $evaluacion->fecha . '
        Hora Inicio: 
        Duración:    ' . $evaluacion->duracion . '    minutos
        '), 1, 'J', false);



            $pdf->Line(32, 68, 140, 68);
            $pdf->Line(25, 71, 95, 71); // +4
            $pdf->Line(35, 75, 95, 75); // +5


            $pdf->Line(110, 71, 140, 71);
            $pdf->Line(120, 75, 140, 75);


            $pdf->Line(165, 68, 193, 68);
            $pdf->Line(170, 72, 193, 72);
            $pdf->Line(168, 75, 175, 75);



            $pdf->SetXY(10, 78.5);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(120, 2.5, utf8_decode('




        '), 1, 'J', false);

            $pdf->SetXY(10, 78.5);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(60, 3, utf8_decode('
        Orientación(Inducción Inicial)
        Charlas Diarias
        Capacitación Interna
        '), 0, 'J', false);




            $pdf->SetXY(75, 78.5);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(60, 3, utf8_decode('
        Capacitación Externa
        Entrenamiento
        Simulacro
        Otros
        '), 0, 'J', false);

            $pdf->SetXY(50, 82);
            $pdf->Cell(5, 2, $evaluacion->idTipo == "2" ?  utf8_decode('X') : utf8_decode(''), 1);

            $pdf->SetXY(50, 85);
            $pdf->Cell(5, 2, $evaluacion->idTipo  == "3" ?  utf8_decode('X') : utf8_decode(''), 1);

            $pdf->SetXY(50, 88);
            $pdf->Cell(5, 2, $evaluacion->idTipo  == "4" ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(110, 82);
            $pdf->Cell(5, 2, $evaluacion->idTipo == "5" ?  utf8_decode('X') : utf8_decode(''), 1);

            $pdf->SetXY(110, 85);
            $pdf->Cell(5, 2, $evaluacion->idTipo == "6" ?  utf8_decode('X') : utf8_decode(''), 1);

            $pdf->SetXY(110, 88);
            $pdf->Cell(5, 2, $evaluacion->idTipo == "7" ?  utf8_decode('X') : utf8_decode(''), 1);

            $pdf->SetXY(110, 91);
            $pdf->Cell(5, 2, $evaluacion->idTipo == "8" ?  utf8_decode('X') : utf8_decode(''), 1);



            $pdf->SetXY(10, 93.5);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(120, 2.5, utf8_decode('
        Nombre del Tema :       

        '), 1, 'J', false);


            $pdf->SetXY(40, 94);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(80, 2.5, utf8_decode($evaluacion->tema), 0, 'J', false);


            $pdf->SetXY(10, 103.5);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(120, 3.6, utf8_decode('                                               (Lllenar solo en capacitaciones)
        Temario:  a)    ' . $evaluacion->temarioA . '
                        b)      ' . $evaluacion->temarioB . '
        Hora inicio:    ' . ($evaluacion->horaInicio != '00:00:00' ? $evaluacion->horaInicio : '        ') . '          Hora finalización:  ' . ($evaluacion->horaFin != '00:00:00' ? $evaluacion->horaFin : '        ') . '
        '), 1, 'J', false);

            $pdf->Line(32, 111, 120, 111);

            $pdf->Line(32, 114, 120, 114);


            $pdf->Line(32, 118, 42, 118);


            $pdf->Line(62, 118, 72, 118);


            $pdf->SetXY(130, 78.5);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(65, 7.185, utf8_decode('




        '), 1, 'J', false);



            $pdf->SetXY(130, 74.5);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(65, 4, utf8_decode('
        (Lllenar solo en capacitaciones)
        Duración Programada:  ' . ($evaluacion->duracionProgramada != 0 ? $evaluacion->duracionProgramada : '') . '     horas
        Duración efectiva:   ' . ($evaluacion->duracionEfectiva != 0 ? $evaluacion->duracionEfectiva : '') . '      horas
        '), 0, 'J', false);

            $pdf->SetXY(125, 88);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(65, 4, utf8_decode('
        Curso audio visual
        Curso oral 
        '), 0, 'J', false);

            $pdf->SetXY(160, 88);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(65, 4, utf8_decode('
        Curso teórico
        Curso práctico
        '), 0, 'J', false);



            $pdf->SetXY(155, 93);
            $pdf->Cell(5, 2, $evaluacion->idCurso == "2" ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(155, 97);
            $pdf->Cell(5, 2, $evaluacion->idCurso == "3" ?  utf8_decode('X') : utf8_decode(''), 1);



            $pdf->SetXY(185, 93);
            $pdf->Cell(5, 2, $evaluacion->idCurso == "4" ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(185, 97);
            $pdf->Cell(5, 2, $evaluacion->idCurso == "5" ?  utf8_decode('X') : utf8_decode(''), 1);



            $pdf->SetXY(130, 102);
            $pdf->SetFont('Helvetica', 'B', 7);
            $pdf->MultiCell(65, 2, utf8_decode('Area de capacitación'), 0, 'J', false);


            $pdf->SetXY(125, 102);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(65, 4, utf8_decode('
        Seguridad
        Medio ambiente
        Otros
        '), 0, 'J', false);

            $pdf->SetXY(160, 102);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(65, 4, utf8_decode('
        Salud
        Calidad
        '), 0, 'J', false);



            $pdf->SetXY(155, 107);
            $pdf->Cell(5, 2, $evaluacion->idAreaCapacitacion == "2" ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(155, 111);
            $pdf->Cell(5, 2, $evaluacion->idAreaCapacitacion == "3" ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(155, 115);
            $pdf->Cell(5, 2, $evaluacion->idAreaCapacitacion == "4" ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(185, 107);
            $pdf->Cell(5, 2, $evaluacion->idAreaCapacitacion == "5" ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(185, 111);
            $pdf->Cell(5, 2, $evaluacion->idAreaCapacitacion == "6" ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(155, 115);
            $pdf->Cell(5, 2, utf8_decode(''), 1);




            $pdf->SetXY(10, 121.5);
            //DATOS DE LAS FIRMAS Y LOS TRABAJADORES



            $width_cell = array(20, 67.5, 67.5, 30);
            // Header starts /// 
            $pdf->Cell($width_cell[0], 10, utf8_decode('N° de personas'), 1, 0, 'C', false); // First header column 
            $pdf->Cell($width_cell[1], 10, 'NOMBRE Y APELLIDO', 1, 0, 'C', false); // Second header column
            $pdf->Cell($width_cell[2], 10, 'CARGO', 1, 0, 'C', false); // Third header column 
            $pdf->Cell($width_cell[3], 10, 'FIRMA', 1, 1, 'C', false); // Fourth header column

            $pdf->SetFont('Arial', '', 6);

            for ($indexRegistro =  $arrayCantidadPaginas[$index]; $indexRegistro <  $arrayCantidadPaginas[$index + 1]; $indexRegistro++) {

                //array_key_exists($key, $table)
                if (array_key_exists($indexRegistro, $evaluacion->listaEvaluacion)) {

                    // First row of data 
                    $pdf->Cell($width_cell[0], 10, $numeracion, 1, 0, 'C', false); // First column of row 1 
                    $pdf->Cell($width_cell[1], 10, $evaluacion->listaEvaluacion[$indexRegistro]->nombresApellidos, 1, 0, 'C', false); // Second column of row 1 
                    $pdf->Cell($width_cell[2], 10, utf8_decode($evaluacion->listaEvaluacion[$indexRegistro]->cargoTrabajador), 1, 0, 'C', false); // Third column of row 1 
                    $pdf->Cell($width_cell[3], 10, $pdf->Image('firmas/' . $evaluacion->listaEvaluacion[$indexRegistro]->firma, $pdf->GetX(), $pdf->GetY(), 20, 10), 1, 1, 'C', false); // Fourth column of row 1 



                } else {

                    // First row of data 
                    $pdf->Cell($width_cell[0], 10, '', 1, 0, 'C', false); // First column of row 1 
                    $pdf->Cell($width_cell[1], 10, '', 1, 0, 'C', false); // Second column of row 1 
                    $pdf->Cell($width_cell[2], 10, '', 1, 0, 'C', false); // Third column of row 1 
                    $pdf->Cell($width_cell[3], 10, '', 1, 1, 'C', false); // Fourth column of row 1 




                }

                $numeracion++;
            }


            //Observaciones
            $pdf->SetXY(10, 241.5);
            $pdf->SetFont('Helvetica', '', 8);
            $pdf->MultiCell(90, 5, utf8_decode('Observaciones:
        
        

        '), 1, 'J', false);


            $pdf->SetXY(11, 246);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(80, 3.5, utf8_decode($evaluacion->observacion), 0, 'J', false);


            //Preguntas acerca de la capacitación
            $pdf->SetXY(100, 241.5);
            $pdf->SetFont('Helvetica', '', 6);
            $pdf->MultiCell(47.5, 5, utf8_decode('(Llenar solo en capacitaciones) 
        
        
        
        '), 1, 'C', false);


            $pdf->SetXY(100, 246);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(47.5, 4, utf8_decode('Estado del curso:          Si          No
Finalizo? 
Continuará?'), 0, 'L', false);


            //Casillas para marcar SI
            $pdf->SetXY(126, 251);
            $pdf->Cell(5, 2, $evaluacion->finalizo == 1 ?  utf8_decode('X') : utf8_decode(''), 1);

            //Casillas para marcar SI
            $pdf->SetXY(135, 251);
            $pdf->Cell(5, 2, $evaluacion->finalizo == 0 ?  utf8_decode('X') : utf8_decode(''), 1);


            //Casillas para marcar SI
            $pdf->SetXY(126, 255);
            $pdf->Cell(5, 2, $evaluacion->continuara == 1 ?  utf8_decode('X') : utf8_decode(''), 1);

            //Casillas para marcar NO
            $pdf->SetXY(135, 255);
            $pdf->Cell(5, 2, $evaluacion->continuara == 0 ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(100, 260);
            $pdf->SetFont('Helvetica', '', 6);
            $pdf->Cell(5, 2, utf8_decode('Fecha de continuación:    ' . ($evaluacion->continuara == 1 ? $evaluacion->fechaContinuacion : '')), 0);



            //Firma del facilitador
            $pdf->SetXY(147.5, 241.5);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(47.5, 5, utf8_decode('FIRMA FACILITADOR:
        
        
        
        '), 1, 'J', false);

            $pdf->Image(strlen($evaluacion->firmaFacilitador) > 0 ? 'firmas/' . $evaluacion->firmaFacilitador : 'firmas/blank.png', 150, 245, 40, 18);
        }




        $fecha = new DateTime();
        $fecha = $fecha->getTimestamp();

        $filename = "public/reports/asistencia" . $fecha . ".pdf";

        if (file_exists($filename)) {
            unlink($filename);
        }

        $pdf->Output($filename, 'F');
        if (file_exists($filename)) {
            return $filename;
        } else {
            return "fail documento";
        }
    }



    public function generateAsistenciaEstandarPdf($evaluacion)
    {

        $pdf = new FPDF();

        $numeracion = 1;

        $arrayCantidadPaginas = $this->crearArray($evaluacion->listaEvaluacion);


        for ($index = 0; $index <  (count($arrayCantidadPaginas) - 1); $index++) {


            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(0, 0, 0);

            $pdf->Image('public/img/logo.png', 11, 14, 30);
            //$pdf->Image('public/img/cliente.jpeg', 30, 14, 18);

            $pdf->Cell(40, 20, '', 1, 0, 'C');



            $pdf->MultiCell(100, 20, utf8_decode('CONTROL DE ASISTENCIA A CAPACITACIONES'), 1, 'C', false);
            $pdf->SetFont('Helvetica', '', 8);

            $pdf->SetXY(150, 10);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(45, 5, utf8_decode('
            
       
Página No .......... de ..........'), 1, 'L', false);

            $pdf->SetXY(150, 10);
            $pdf->SetFont('Helvetica', '', 6.5);
            $pdf->MultiCell(45, 3.5, utf8_decode('PSPC-610-X-PR-003-FR-003
Revisión: 0
Emisión: 08/05/2019
Página: 1 de ' . ($index + 1)), 1, 'L', false);

            /**
             *         
             */


            $pdf->SetXY(10, 30);
            $pdf->SetFont('Helvetica', '', 8);
            $pdf->Cell(185, 5, '', 1);

            $pdf->SetXY(10, 30);
            $pdf->Cell(50, 5, 'Nro de Registro ', 0);

            $pdf->SetXY(35, 31);
            $pdf->Cell(30, 3, utf8_decode(''), 1);



            $pdf->SetXY(10, 35);
            $pdf->SetFont('Helvetica', '', 8);
            $pdf->SetFillColor(255, 252, 187); //Fondo verde de celda
            $pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
            $pdf->Cell(185, 5, utf8_decode('A. INFORMACIÓN DEL EMPLEADOR '),  1, 0, 'C', true);




            $pdf->SetXY(10, 40);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(110, 3.5, utf8_decode('
        Razón Social : SERVICIOS PETROLEROS Y CONSTRUCCIONES SEPCON S.A.C
        RUC: 20504898173 
        Domicilio: Av. San Borja Norte 445 - San Borja -Perú
        Tipo de Acntividad Económica:
        '), 1, 'L', false);

            $pdf->SetXY(120, 40);
            $pdf->MultiCell(75, 3, utf8_decode('
        Trabajadores del Proyecto:
        Año de Inicio del Proyecto: 2021 
        Número de Trabajadores Afiliados al SCTR:
        Número de Trabajadores No Afiliados al SCTR:
        Nombre de la Asegurador : RIMAC
        '), 1, 'L', false);


            $pdf->Line(160, 46, 193, 46);
            $pdf->Line(175, 51, 193, 51);
            $pdf->Line(180, 55, 193, 55);





            $pdf->SetXY(10, 61);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(140, 3.5, utf8_decode('
        PROYECTO:    ' . $evaluacion->proyecto . '
        FASE:        ' . $evaluacion->fase . '
        FACILITADOR:        ' . $evaluacion->facilitador . '
        '), 1, 'J', false);

            $pdf->SetXY(90, 61);
            $pdf->MultiCell(50, 3.5, utf8_decode('

        CLIENTE:  ' . $evaluacion->cliente . '
        N° PARTICIPANTES: ' . count($evaluacion->listaEvaluacion) . '
        '), 0, 'J', false);


            $pdf->SetXY(150, 61);
            $pdf->MultiCell(45, 3.5, utf8_decode('
        Fecha:  ' . $evaluacion->fecha . '
        Hora Inicio: 
        Duración:    ' . $evaluacion->duracion . '    minutos
        '), 1, 'J', false);



            $pdf->Line(32, 68, 140, 68);
            $pdf->Line(25, 71, 95, 71); // +4
            $pdf->Line(35, 75, 95, 75); // +5


            $pdf->Line(110, 71, 140, 71);
            $pdf->Line(120, 75, 140, 75);


            $pdf->Line(165, 68, 193, 68);
            $pdf->Line(170, 72, 193, 72);
            $pdf->Line(168, 75, 175, 75);



            $pdf->SetXY(10, 78.5);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(120, 2.5, utf8_decode('




        '), 1, 'J', false);

            $pdf->SetXY(10, 78.5);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(60, 3, utf8_decode('
        Orientación(Inducción Inicial)
        Charlas Diarias
        Capacitación Interna
        '), 0, 'J', false);




            $pdf->SetXY(75, 78.5);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(60, 3, utf8_decode('
        Capacitación Externa
        Entrenamiento
        Simulacro
        Otros
        '), 0, 'J', false);

            $pdf->SetXY(50, 82);
            $pdf->Cell(5, 2, $evaluacion->idTipo == "2" ?  utf8_decode('X') : utf8_decode(''), 1);

            $pdf->SetXY(50, 85);
            $pdf->Cell(5, 2, $evaluacion->idTipo  == "3" ?  utf8_decode('X') : utf8_decode(''), 1);

            $pdf->SetXY(50, 88);
            $pdf->Cell(5, 2, $evaluacion->idTipo  == "4" ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(110, 82);
            $pdf->Cell(5, 2, $evaluacion->idTipo == "5" ?  utf8_decode('X') : utf8_decode(''), 1);

            $pdf->SetXY(110, 85);
            $pdf->Cell(5, 2, $evaluacion->idTipo == "6" ?  utf8_decode('X') : utf8_decode(''), 1);

            $pdf->SetXY(110, 88);
            $pdf->Cell(5, 2, $evaluacion->idTipo == "7" ?  utf8_decode('X') : utf8_decode(''), 1);

            $pdf->SetXY(110, 91);
            $pdf->Cell(5, 2, $evaluacion->idTipo == "8" ?  utf8_decode('X') : utf8_decode(''), 1);



            $pdf->SetXY(10, 93.5);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(120, 2.5, utf8_decode('
        Nombre del Tema :       

        '), 1, 'J', false);


            $pdf->SetXY(40, 94);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(80, 2.5, utf8_decode($evaluacion->tema), 0, 'J', false);


            $pdf->SetXY(10, 103.5);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(120, 3.6, utf8_decode('                                               (Lllenar solo en capacitaciones)
        Temario:  a)    ' . $evaluacion->temarioA . '
                        b)      ' . $evaluacion->temarioB . '
        Hora inicio:    ' . ($evaluacion->horaInicio != '00:00:00' ? $evaluacion->horaInicio : '        ') . '          Hora finalización:  ' . ($evaluacion->horaFin != '00:00:00' ? $evaluacion->horaFin : '        ') . '
        '), 1, 'J', false);

            $pdf->Line(32, 111, 120, 111);

            $pdf->Line(32, 114, 120, 114);


            $pdf->Line(32, 118, 42, 118);


            $pdf->Line(62, 118, 72, 118);


            $pdf->SetXY(130, 78.5);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(65, 7.185, utf8_decode('




        '), 1, 'J', false);



            $pdf->SetXY(130, 74.5);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(65, 4, utf8_decode('
        (Lllenar solo en capacitaciones)
        Duración Programada:  ' . ($evaluacion->duracionProgramada != 0 ? $evaluacion->duracionProgramada : '') . '     horas
        Duración efectiva:   ' . ($evaluacion->duracionEfectiva != 0 ? $evaluacion->duracionEfectiva : '') . '      horas
        '), 0, 'J', false);

            $pdf->SetXY(125, 88);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(65, 4, utf8_decode('
        Curso audio visual
        Curso oral 
        '), 0, 'J', false);

            $pdf->SetXY(160, 88);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(65, 4, utf8_decode('
        Curso teórico
        Curso práctico
        '), 0, 'J', false);



            $pdf->SetXY(155, 93);
            $pdf->Cell(5, 2, $evaluacion->idCurso == "2" ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(155, 97);
            $pdf->Cell(5, 2, $evaluacion->idCurso == "3" ?  utf8_decode('X') : utf8_decode(''), 1);



            $pdf->SetXY(185, 93);
            $pdf->Cell(5, 2, $evaluacion->idCurso == "4" ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(185, 97);
            $pdf->Cell(5, 2, $evaluacion->idCurso == "5" ?  utf8_decode('X') : utf8_decode(''), 1);



            $pdf->SetXY(130, 102);
            $pdf->SetFont('Helvetica', 'B', 7);
            $pdf->MultiCell(65, 2, utf8_decode('Area de capacitación'), 0, 'J', false);


            $pdf->SetXY(125, 102);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(65, 4, utf8_decode('
        Seguridad
        Medio ambiente
        Otros
        '), 0, 'J', false);

            $pdf->SetXY(160, 102);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(65, 4, utf8_decode('
        Salud
        Calidad
        '), 0, 'J', false);



            $pdf->SetXY(155, 107);
            $pdf->Cell(5, 2, $evaluacion->idAreaCapacitacion == "2" ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(155, 111);
            $pdf->Cell(5, 2, $evaluacion->idAreaCapacitacion == "3" ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(155, 115);
            $pdf->Cell(5, 2, $evaluacion->idAreaCapacitacion == "4" ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(185, 107);
            $pdf->Cell(5, 2, $evaluacion->idAreaCapacitacion == "5" ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(185, 111);
            $pdf->Cell(5, 2, $evaluacion->idAreaCapacitacion == "6" ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(155, 115);
            $pdf->Cell(5, 2, utf8_decode(''), 1);




            $pdf->SetXY(10, 121.5);
            //DATOS DE LAS FIRMAS Y LOS TRABAJADORES



            $width_cell = array(20, 67.5, 67.5, 30);
            // Header starts /// 
            $pdf->Cell($width_cell[0], 10, utf8_decode('N° de personas'), 1, 0, 'C', false); // First header column 
            $pdf->Cell($width_cell[1], 10, 'NOMBRE Y APELLIDO', 1, 0, 'C', false); // Second header column
            $pdf->Cell($width_cell[2], 10, 'CARGO', 1, 0, 'C', false); // Third header column 
            $pdf->Cell($width_cell[3], 10, 'FIRMA', 1, 1, 'C', false); // Fourth header column

            $pdf->SetFont('Arial', '', 6);

            for ($indexRegistro =  $arrayCantidadPaginas[$index]; $indexRegistro <  $arrayCantidadPaginas[$index + 1]; $indexRegistro++) {

                //array_key_exists($key, $table)
                if (array_key_exists($indexRegistro, $evaluacion->listaEvaluacion)) {

                    // First row of data 
                    $pdf->Cell($width_cell[0], 10, $numeracion, 1, 0, 'C', false); // First column of row 1 
                    $pdf->Cell($width_cell[1], 10, $evaluacion->listaEvaluacion[$indexRegistro]->nombresApellidos, 1, 0, 'C', false); // Second column of row 1 
                    $pdf->Cell($width_cell[2], 10, utf8_decode($evaluacion->listaEvaluacion[$indexRegistro]->cargoTrabajador), 1, 0, 'C', false); // Third column of row 1 
                    $pdf->Cell($width_cell[3], 10, $pdf->Image('firmas/' . $evaluacion->listaEvaluacion[$indexRegistro]->firma, $pdf->GetX(), $pdf->GetY(), 20, 10), 1, 1, 'C', false); // Fourth column of row 1 



                } else {

                    // First row of data 
                    $pdf->Cell($width_cell[0], 10, '', 1, 0, 'C', false); // First column of row 1 
                    $pdf->Cell($width_cell[1], 10, '', 1, 0, 'C', false); // Second column of row 1 
                    $pdf->Cell($width_cell[2], 10, '', 1, 0, 'C', false); // Third column of row 1 
                    $pdf->Cell($width_cell[3], 10, '', 1, 1, 'C', false); // Fourth column of row 1 




                }

                $numeracion++;
            }


            //Observaciones
            $pdf->SetXY(10, 241.5);
            $pdf->SetFont('Helvetica', '', 8);
            $pdf->MultiCell(90, 5, utf8_decode('Observaciones:
        
        

        '), 1, 'J', false);


            $pdf->SetXY(11, 246);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(80, 3.5, utf8_decode($evaluacion->observacion), 0, 'J', false);


            //Preguntas acerca de la capacitación
            $pdf->SetXY(100, 241.5);
            $pdf->SetFont('Helvetica', '', 6);
            $pdf->MultiCell(47.5, 5, utf8_decode('(Llenar solo en capacitaciones) 
        
        
        
        '), 1, 'C', false);


            $pdf->SetXY(100, 246);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(47.5, 4, utf8_decode('Estado del curso:          Si          No
Finalizo? 
Continuará?'), 0, 'L', false);


            //Casillas para marcar SI
            $pdf->SetXY(126, 251);
            $pdf->Cell(5, 2, $evaluacion->finalizo == 1 ?  utf8_decode('X') : utf8_decode(''), 1);

            //Casillas para marcar SI
            $pdf->SetXY(135, 251);
            $pdf->Cell(5, 2, $evaluacion->finalizo == 0 ?  utf8_decode('X') : utf8_decode(''), 1);


            //Casillas para marcar SI
            $pdf->SetXY(126, 255);
            $pdf->Cell(5, 2, $evaluacion->continuara == 1 ?  utf8_decode('X') : utf8_decode(''), 1);

            //Casillas para marcar NO
            $pdf->SetXY(135, 255);
            $pdf->Cell(5, 2, $evaluacion->continuara == 0 ?  utf8_decode('X') : utf8_decode(''), 1);


            $pdf->SetXY(100, 260);
            $pdf->SetFont('Helvetica', '', 6);
            $pdf->Cell(5, 2, utf8_decode('Fecha de continuación:    ' . ($evaluacion->continuara == 1 ? $evaluacion->fechaContinuacion : '')), 0);



            //Firma del facilitador
            $pdf->SetXY(147.5, 241.5);
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->MultiCell(47.5, 5, utf8_decode('FIRMA FACILITADOR:
        
        
        
        '), 1, 'J', false);

            $pdf->Image(strlen($evaluacion->firmaFacilitador) > 0 ? 'firmas/' . $evaluacion->firmaFacilitador : 'firmas/blank.png', 150, 245, 40, 18);
        }




        $fecha = new DateTime();
        $fecha = $fecha->getTimestamp();

        $filename = "public/reports/asistencia" . $fecha . ".pdf";

        if (file_exists($filename)) {
            unlink($filename);
        }

        $pdf->Output($filename, 'F');
        if (file_exists($filename)) {
            return $filename;
        } else {
            return "fail documento";
        }
    }



    function crearArray($listaReportes)
    {

        $cantidad = $this->redondearDivision(count($listaReportes) / $this->filasPorHoja);

        $arrayCantidadHojas = [0];

        for ($index = 1; $index < $cantidad; $index++) {

            $arrayCantidadHojas[$index] = $arrayCantidadHojas[$index - 1] + $this->filasPorHoja;
        }

        //$arrayCantidadHojas[count($arrayCantidadHojas)] = count($listaReportes);

        $arrayCantidadHojas[count($arrayCantidadHojas)] = $this->filasPorHoja * (count($arrayCantidadHojas));

        return $arrayCantidadHojas;
    }


    function redondearDivision($resultado)
    {

        $resultadoFinal = 0;

        $resultadoRedondeado = round($resultado);

        if ($resultado > $resultadoRedondeado) {

            $resultadoFinal = $resultadoRedondeado + 1;
        } else {
            $resultadoFinal = $resultadoRedondeado;
        }

        return $resultadoFinal;
    }



    public function generateCertificate($curso)
    {


        $pdf = new FPDF();

        $pdf->AddPage('L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0);


        $pdf->Image('public/img/logo.png', 30, 30, 25);

        $pdf->SetXY(0, 30);
        $pdf->SetFont('Helvetica', 'B', 18);
        $pdf->MultiCell(300, 20, utf8_decode('CONSTANCIA DE CAPACITACION EN LA TAREA'), 0, 'C', false);
        $pdf->SetXY(0, 50);
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->MultiCell(300, 5, utf8_decode('Otorga la presente constancia al Sr(a): '), 0, 'C', false);
        $pdf->SetXY(0, 60);
        $pdf->SetFont('Helvetica', 'I', 16);
        $pdf->MultiCell(300, 10, utf8_decode($curso->nombresApellidos), 0, 'C', false);
        $pdf->SetXY(30, 70);
        $pdf->SetFont('Helvetica', 'B', 16);
        $pdf->MultiCell(250, 8, utf8_decode('SEPCON S.A.C'), 0, 'C', false);
        //$pdf->MultiCell(250, 8, utf8_decode('Por haber aprobado de forma satisfactoria el Curso Básico '.$curso->temaExamen), 0, 'C', false);
        
        $pdf->SetXY(30, 75);
        $pdf->SetFont('Helvetica', '', 11);
        $pdf->MultiCell(180, 8, utf8_decode('
Culminado su etapa de evaluación el ' . $curso->fechaExamen . '
Con resultado APROBADO,quedando apto para ocupar el puesto de'), 0, 'L', false);
    

$pdf->SetFont('Helvetica', 'B', 20);
$pdf->MultiCell(280, 8, utf8_decode($curso->cargoTrabajador),0, 'C', false);


        $pdf->SetXY(30, 100);
        $pdf->SetFont('Helvetica', 'B', 11);
        $pdf->MultiCell(180, 8, utf8_decode('
Según lo establecido:
DECRETO SUPREMO N° 024 -2016-EM'), 0, 'L', false);

        $pdf->MultiCell(180, 8, utf8_decode('                   '.$curso->temaExamen.' - '.$curso->horasCapacitadas.' hora(s)'), 0, 'L', false);


        $pdf->Image('firmas/'.$curso->firmaTrabajador, 30 , 145, 70, 30);
        $pdf->SetXY(30, 160);
        $pdf->SetFont('Helvetica', '', 10);
       // $pdf->Cell(50,8, utf8_decode('Firma del trabajador'), 0);
        $pdf -> Line(40, 170, 90, 170);
        $pdf->MultiCell(60, 8, utf8_decode('
        Firma del trabajador'), 0, 'C', false);

        
        $pdf->Image('firmas/'.$curso->firmaTrabajador, 100, 145, 70, 30);
        $pdf->SetXY(100, 160);
        $pdf->SetFont('Helvetica', '', 10);
        $pdf -> Line(110, 170, 160, 170);
        $pdf->MultiCell(60, 8, utf8_decode('
        ING Supervisor
        Responsable de la tarea'), 0, 'C', false);


        $pdf->Image('firmas/'.$curso->firmaTrabajador, 200 , 145, 70, 30);
        $pdf->SetXY(200, 160);
        $pdf->SetFont('Helvetica', '', 10);
        $pdf -> Line(210, 170, 270, 170);
        $pdf->MultiCell(80, 8, utf8_decode('
        Jefe de seguridad
        V°B° ING. Víctor Delgado Céspedes'), 0, 'C', false);


        //Marco del certificado
        //$pdf->SetXY(6.5, 5);
       // $pdf->Cell(285, 180, utf8_decode(''), 1);

        $fecha = new DateTime();
        $fecha = $fecha->getTimestamp();

        $filename = "public/reports/certificado".$fecha.".pdf";
        //$nombrePDF =  "certificado".$fecha.".pdf";

        if (file_exists($filename)) {
            unlink($filename);
        }

        $pdf->Output($filename, 'F');
        if (file_exists($filename)) {
            return $filename;
        } else {
            return "wrong";
        }
    }
}
