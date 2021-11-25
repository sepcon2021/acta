<?php

require_once 'public/PHPMailer/PHPMailerAutoload.php';
require_once 'public/generate-pdf/generatepdf.php';
require_once 'config/config.php';

class Email{


     /**
     * Enviar email con una notificación de que sucdio un TOP
     * @param string $mensaje El mensaje de lo que ocurrio en el top
     * @param string $sede El identificdor unico de la sede
     * @param string $nombre El nombre de la sede
     * @param string $urlPdf Url del PDF con el reporte del TOP
     * @return array Contiene estados de ok or error en función de la situación
     */
    public function enviarMailTop($mensaje, $sede, $nombre_sede,$urlPdf){

        $destino = "jcuri@sepcon.net";
        $contenido =  'Tarjeta Top - Potencial Alto';
        $mail = $this->settingEmail($destino);
        $mail = $this->selectUsersToSendEmail($mail,$sede);
        $mail = $this->customizeHeaderEmail($mail,$contenido);
        $mail->msgHTML(utf8_decode($this->contenidoEmail($mensaje,$nombre_sede)));
        $mail->SMTPDebug = 0;
        $mail->addAttachment($urlPdf);
        $mail->send();
        $mail->ClearAddresses();
    
    }

    public function settingEmail($destino){
        $origen = "ssma@sepcon.net";
        $remitente = "fichas@sepcon.net";

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = 'mail.sepcon.net';
        $mail->Port = 587;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => true,
                'verify_depth' => 3,
                'allow_self_signed' => true,
                'peer_name' => 'mail.sepcon.net',
            ),
        );
        $mail->SMTPAuth = true;
        $mail->Username = constant('CORREO');
        $mail->Password = constant('CONTRASEÑA_CORREO');

        $mail->setFrom($origen, $remitente);
        $mail->addAddress($destino, $destino);

        return $mail;
    }
 
    public function selectUsersToSendEmail($mail,$sede){

        if ($sede == "01") {

            $mail->addCC('mgarcia@sepcon.net', 'Tarjetas Top');
            $mail->addCC('hminaya@sepcon.net', 'Tarjetas Top');
            $mail->addCC('Svela@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jtaborga@sepcon.net', 'Tarjetas Top');
            $mail->addCC('Jopaniagua@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rchavez@sepcon.net', 'Tarjetas Top');
            $mail->addCC('gmontengro@sepcon.net', 'Tarjetas Top');
            $mail->addCC('asalvador@sepcon.net', 'Tarjetas Top');
            $mail->addCC('asistente_ssma_whcp21@sepcon.net', 'Tarjetas Top');
            $mail->addCC('hguardia@sepcon.net', 'Tarjetas Top');
            $mail->addCC('ctomasello@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rcarbonell@sepcon.net', 'Tarjetas Top');
            $mail->addCC('sreyes@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rarce@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rrhh_malvinas@sepcon.net', 'Tarjetas Top');
            $mail->addCC('lcatacora@sepcon.net', 'Tarjetas Top');
            $mail->addCC('kmontalvo@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rpeña@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jnovoa@sepcon.net', 'Tarjetas Top');

        } elseif ($sede == "03") {

            $mail->addCC('mgarcia@sepcon.net', 'Tarjetas Top');
            $mail->addCC('hminaya@sepcon.net', 'Tarjetas Top');
            $mail->addCC('Svela@sepcon.net', 'Tarjetas Top');
            $mail->addCC('pguzman@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jrobeiro@sepcon.net', 'Tarjetas Top');
            $mail->addCC('drios@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jtaborga@sepcon.net', 'Tarjetas Top');
            $mail->addCC('Jopaniagua@sepcon.net', 'Tarjetas Top');
            $mail->addCC('llujan@sepcon.net', 'Tarjetas Top');
            $mail->addCC('kmontalvo@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rpeña@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jnovoa@sepcon.net', 'Tarjetas Top');
            $mail->addCC('asalvador@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rchavez@sepcon.net', 'Tarjetas Top');
            $mail->addCC('gmontengro@sepcon.net', 'Tarjetas Top');

        } elseif ($sede == "04") {

            $mail->addCC('mgarcia@sepcon.net', 'Tarjetas Top');
            $mail->addCC('Svela@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jtaborga@sepcon.net', 'Tarjetas Top');
            $mail->addCC('Jopaniagua@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jcuri@sepcon.net', 'Tarjetas Top');
            $mail->addCC('carroyo@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rchavez@sepcon.net', 'Tarjetas Top');
            $mail->addCC('gmontengro@sepcon.net', 'Tarjetas Top');

        } elseif ($sede == "05") {

            $mail->addCC('mgarcia@sepcon.net', 'Tarjetas Top');
            $mail->addCC('hminaya@sepcon.net', 'Tarjetas Top');
            $mail->addCC('Svela@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jtaborga@sepcon.net', 'Tarjetas Top');
            $mail->addCC('Jopaniagua@sepcon.net', 'Tarjetas Top');
            $mail->addCC('mpilco@sepcon.net', 'Tarjeta Top');
            $mail->addCC('rchavez@sepcon.net', 'Tarjetas Top');
            $mail->addCC('gmontengro@sepcon.net', 'Tarjetas Top');
            $mail->addCC('kmontalvo@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rpeña@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jnovoa@sepcon.net', 'Tarjetas Top');
            $mail->addCC('asalvador@sepcon.net', 'Tarjetas Top');

        } elseif ($sede == "06") {

            $mail->addCC('mgarcia@sepcon.net', 'Tarjetas Top');
            $mail->addCC('hminaya@sepcon.net', 'Tarjetas Top');
            $mail->addCC('Svela@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jtaborga@sepcon.net', 'Tarjetas Top');
            $mail->addCC('Jopaniagua@sepcon.net', 'Tarjetas Top');
            $mail->addCC('warhuis@sepcon.net', 'Tarjetas Top');
            $mail->addCC('LFalcon@sepcon.net', 'Tarjetas Top');
            $mail->addCC('Vdelgado@sepcon.net', 'Tarjetas Top');
            $mail->addCC('Acalderon@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rpichilingue@sepcon.net', 'Tarjetas Top');
            $mail->addCC('kmontalvo@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rrhh_constancia@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rpeña@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jnovoa@sepcon.net', 'Tarjetas Top');
            $mail->addCC('asalvador@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rchavez@sepcon.net', 'Tarjetas Top');
            $mail->addCC('gmontengro@sepcon.net', 'Tarjetas Top');

        } elseif ($sede == "07") {

            $mail->addCC('mgarcia@sepcon.net', 'Tarjetas Top');
            $mail->addCC('hminaya@sepcon.net', 'Tarjetas Top');
            $mail->addCC('Svela@sepcon.net', 'Tarjetas Top');
            $mail->addCC('hguardia@sepcon.net', 'Tarjetas Top');
            $mail->addCC('ctomasello@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rcarbonell@sepcon.net', 'Tarjetas Top');
            $mail->addCC('asalvador@sepcon.net', 'Tarjetas Top');
            $mail->addCC('asistente_ssma_whcp21@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jtaborga@sepcon.net', 'Tarjetas Top');
            $mail->addCC('Jopaniagua@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jzapata@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rarce@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rpeña@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jnovoa@sepcon.net', 'Tarjetas Top');
            $mail->addCC('asalvador@sepcon.net', 'Tarjetas Top');
            $mail->addCC('kmontalvo@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rchavez@sepcon.net', 'Tarjetas Top');
            $mail->addCC('gmontengro@sepcon.net', 'Tarjetas Top');
            $mail->addCC('sreyes@sepcon.net', 'Tarjetas Top');

        } elseif ($sede == "08") {

            $mail->addCC('mgarcia@sepcon.net', 'Tarjetas Top');
            $mail->addCC('hminaya@sepcon.net', 'Tarjetas Top');
            $mail->addCC('Svela@sepcon.net', 'Tarjetas Top');
            $mail->addCC('hguardia@sepcon.net', 'Tarjetas Top');
            $mail->addCC('ctomasello@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rcarbonell@sepcon.net', 'Tarjetas Top');
            $mail->addCC('asalvador@sepcon.net', 'Tarjetas Top');
            $mail->addCC('asistente_ssma_whcp21@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jtaborga@sepcon.net', 'Tarjetas Top');
            $mail->addCC('Jopaniagua@sepcon.net', 'Tarjetas Top');
            $mail->addCC('sreyes@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rarce@sepcon.net', 'Tarjetas Top');
            $mail->addCC('lcatacora@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rchavez@sepcon.net', 'Tarjetas Top');
            $mail->addCC('gmontengro@sepcon.net', 'Tarjetas Top');
            $mail->addCC('kmontalvo@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rpeña@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jnovoa@sepcon.net', 'Tarjetas Top');
            $mail->addCC('hguardia@sepcon.net', 'Tarjetas Top');
            $mail->addCC('ctomasello@sepcon.net', 'Tarjetas Top');
            $mail->addCC('rcarbonell@sepcon.net', 'Tarjetas Top');
            $mail->addCC('asalvador@sepcon.net', 'Tarjetas Top');
            $mail->addCC('asistente_ssma_whcp21@sepcon.net', 'Tarjetas Top');
            $mail->addCC('jzapata@sepcon.net', 'Tarjetas Top');

        }

        return $mail;

    }

    public function contenidoEmail($mensaje,$nombre_sede){

        $message = "<html><body>";
        $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
        $message .= "<tr><td>";
        $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
        $message .= "<thead>
                <tr height='80'>
                <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:red; font-size:34px;' >Tarjeta TOP</th>
                </tr></thead>";
        $message .= "<tbody><tr>
                    <td colspan='4' style='padding:15px;'>
                        <p style='font-size:20px;'>Estimado(a):</p>
                        <hr />
                        <p style='font-size:25px;'>Se envia este mensaje de registro de Tarjeta TOP con potencial alto - $nombre_sede</p>
                        <p style='font-size:25px;'>Detalle de la observación preventiva :</p>
                        <p style='font-size:25px;'>$mensaje</p>
                        <img src='public/img/mail.jpg' style='height:auto; width:100%; max-width:100%;'/>
                        <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif; text-align: center; '>SSMMA - Registro Documentario</p>
                    </td>
                    </tr></tbody>";
        $message .= "</table>";
        $message .= "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";

        return $message;

    }




     /**
     * Enviar email con una notificación de que fue asignado a una acción
     * @param object $curso Es una instancia de la clase models/curso.php
     */
    public function enviarNotificacionAsignado($curso,$urlPdf){

        $contenido =  utf8_decode('Resultados del examen - '.$curso->temaExamen);

        $mail = $this->settingEmail($this->verificarCorreo($curso));
        $mail = $this->customizeHeaderEmail($mail,$contenido);
       
        $mail = $this->generarCertificado($curso,$mail,$urlPdf);
       
        $mail->msgHTML(utf8_decode($this->verficarNota($curso)));
        $mail->SMTPDebug = 0;
        $mail->send();
        $mail->ClearAddresses();
        
    }

    public function verificarCorreo($curso){

        $correo = $curso->correo;

        if(strlen($curso->correoCorporativo) > 0){

            $correo = $curso->correoCorporativo;
        }

        return $correo;
    }

    public function verficarNota($curso){
        
        $message = '';

        if($curso->notaExamen > $curso->notaAprobatoria){
            $message = $this->contenidoNotificacionAprobado($curso);
        }else{
            $message = $this->contenidoNotificacionDesAprobado($curso);

        }

        return $message;
    }


    public function contenidoNotificacionAprobado($curso){

        $message = 
        '<html>
            <body>
                <h3>Buenas '.$curso->nombresApellidos.'</h3>
                <p>Arobaste el examen - '.$curso->temaExamen.'</p>
                <p>nota : '.$curso->notaExamen.'</p>
                <p>Adjuntamos un certificado por finalizar el examen con éxito</p>

            </body>
        </html>';

        return $message;

    }

    public function contenidoNotificacionDesAprobado($curso){

        $message = 
        '<html>
            <body>
                <h3>Buenas '.$curso->nombresApellidos.'</h3>
                <p>Lo sentimos no aprobaste el examen - '.$curso->temaExamen.'</p>
                <p>nota : '.$curso->notaExamen.'</p>
                <p>Volver a dar el examen </p>
                <p>http://ssma.sepcon.net/form</p>

            </body>
        </html>';

        return $message;

    }


    public function customizeHeaderEmail($mail,$contenido){
        
        $mail->Subject = $contenido;

        return $mail;
    }



    public function generarCertificado($curso,$mail,$urlPdf){

        if($curso->notaExamen > $curso->notaAprobatoria){
            $mail->addAttachment($urlPdf);
        }

        return $mail;
    }



    /**
     * Enviar email con una notificación de que fue asignado a una acción
     * @param object $curso Es una instancia de la clase models/curso.php
     */
    public function enviarExistenciaTrabajador($dniTrabajador)
    {

        $contenido =  utf8_decode('Verificar trabajador ');

        $mail = $this->settingEmail('jcuri@sepcon.net');
        $mail = $this->customizeHeaderEmail($mail, $contenido);

        $mail->addCC('carroyo@sepcon.net', '');
        $mail->msgHTML(utf8_decode('Usuario no registrado en la base de datos RRHH DNI :'.$dniTrabajador));
        $mail->SMTPDebug = 0;
        $mail->send();
        $mail->ClearAddresses();
    }

}
?>