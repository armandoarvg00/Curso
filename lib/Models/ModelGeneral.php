<?php
class ModelGeneral
{

    public function f_paginacion($arg_dataIn_a, &$arg_tabla, &$arg_msj)
    {
        $ls_li_open  = '';
        $ls_li_close = '';

        if (isset($arg_dataIn_a['pag_panel']) && $arg_dataIn_a['pag_panel'] == 1) {
            $ls_li_open  = '<li>';
            $ls_li_close = '</li>';
        }

        if ($arg_dataIn_a['n_pagina'] == '') {
            $arg_msj = 'El argumento n_pagina no puede ser nulo, favor de verificar.';
            return -1;
        }

        if (strlen($arg_dataIn_a['total']) == 0) {
            $arg_msj = 'El argumento total no puede ser nulo, favor de verificar.';
            return -1;
        }

        if ($arg_dataIn_a['reg_a_mostrar'] == '') {
            $arg_msj = 'El argumento reg_a_mostrar no puede ser nulo, favor de verificar.';
            return -1;
        }

        $PagAnt = $arg_dataIn_a['n_pagina'] - 1;
        $PagSig = $arg_dataIn_a['n_pagina'] + 1;
        $PagUlt = $arg_dataIn_a['total'] / $arg_dataIn_a['reg_a_mostrar'];
        $Res    = $arg_dataIn_a['total'] % $arg_dataIn_a['reg_a_mostrar'];
        if ($Res > 0) {
            $PagUlt = floor($PagUlt) + 1;
        }

        if ($PagUlt <= 10) {
            for ($li_index = 1; $li_index <= $PagUlt; $li_index++) {
                if ($arg_dataIn_a['n_pagina'] == $li_index) {
                    if (isset($arg_dataIn_a['pag_panel']) && $arg_dataIn_a['pag_panel'] == 2) {
                        $arg_tabla .= " <span class='page-numbers current'>" . $li_index . "</span> ";
                    } else {
                        $arg_tabla .= $ls_li_open . " <a href='javascript:void(0)' class='paginar select'>" . $li_index . "</a> " . $ls_li_close;
                    }
                } else {
                    if (isset($arg_dataIn_a['pag_panel']) && $arg_dataIn_a['pag_panel'] == 2) {
                        $arg_tabla .= " <a href='" . $arg_dataIn_a['link'] . "&n_pagina=" . $li_index . "' class='page-numbers'>" . $li_index . "</a> ";
                    } else {
                        $arg_tabla .= $ls_li_open . " <a href='" . $arg_dataIn_a['link'] . "&n_pagina=" . $li_index . "' class='paginar'>" . $li_index . "</a> " . $ls_li_close;
                    }
                }
            }
        } elseif ($PagUlt > 10) {
            if ($arg_dataIn_a['n_pagina'] == 1) {
                if (isset($arg_dataIn_a['pag_panel']) && $arg_dataIn_a['pag_panel'] == 2) {
                    $arg_tabla .= "<a href='javascript:void(0)' class='page-numbers current'>1</a> ";
                    $arg_tabla .= " <a href='javascript:void(0)' class='page-numbers current'>Anterior</a> ";
                } else {
                    $arg_tabla .= $ls_li_open . "<a href='javascript:void(0)' class='paginar select'>1</a> " . $ls_li_close;
                    $arg_tabla .= $ls_li_open . " <a href='javascript:void(0)' class='paginar select'>Anterior</a> " . $ls_li_close;
                }
            } else {
                if (isset($arg_dataIn_a['pag_panel']) && $arg_dataIn_a['pag_panel'] == 2) {
                    $arg_tabla .= "<a href='" . $arg_dataIn_a['link'] . "&n_pagina=1' class='page-numbers'>1</a> ";
                    $arg_tabla .= " <a href='" . $arg_dataIn_a['link'] . "&n_pagina=" . $PagAnt . "' class='page-numbers'>Anterior</a> ";
                } else {
                    $arg_tabla .= $ls_li_open . "<a href='" . $arg_dataIn_a['link'] . "&n_pagina=1' class='paginar'>1</a> ";
                    $arg_tabla .= $ls_li_open . " <a href='" . $arg_dataIn_a['link'] . "&n_pagina=" . $PagAnt . "' class='paginar'>Anterior</a> " . $ls_li_close;
                }
            }

            if ($arg_dataIn_a['n_pagina'] == $PagUlt) {
                if (isset($arg_dataIn_a['pag_panel']) && $arg_dataIn_a['pag_panel'] == 2) {
                    $arg_tabla .= $ls_li_open . " <a href='javascript:void(0)' class='page-numbers current'>Siguiente</a> ";
                    $arg_tabla .= $ls_li_open . "<a href='javascript:void(0)' class='page-numbers current' style='margin-right: 5px;'>" . $PagUlt . "</a> " . $ls_li_close;
                } else {
                    $arg_tabla .= $ls_li_open . " <a href='javascript:void(0)' class='paginar select'>Siguiente</a> ";
                    $arg_tabla .= $ls_li_open . "<a href='javascript:void(0)' class='paginar select' style='margin-right: 5px;'>" . $PagUlt . "</a> " . $ls_li_close;
                }
            } else {
                if (isset($arg_dataIn_a['pag_panel']) && $arg_dataIn_a['pag_panel'] == 2) {
                    $arg_tabla .= " <a href='" . $arg_dataIn_a['link'] . "&n_pagina=" . $PagSig . "' class='page-numbers'>Siguiente</a> ";
                    $arg_tabla .= " <a href='" . $arg_dataIn_a['link'] . "&n_pagina=" . $PagUlt . "' class='page-numbers' style='margin-right: 5px;'> " . $PagUlt . " </a>";
                } else {
                    $arg_tabla .= $ls_li_open . " <a href='" . $arg_dataIn_a['link'] . "&n_pagina=" . $PagSig . "' class='paginar'>Siguiente</a> " . $ls_li_close;
                    $arg_tabla .= $ls_li_open . " <a href='" . $arg_dataIn_a['link'] . "&n_pagina=" . $PagUlt . "' class='paginar' style='margin-right: 5px;'> " . $PagUlt . " </a>" . $ls_li_close;
                }
            }
        }
        return 1;
    }

    public function validaMailLogin($la_mail = '')
    {
        return $this->validaFormatoMail($la_mail);
    }

    public function validarFormularioLogin($la_dataIn = array(), &$arg_dataOut = array())
    {
        $la_dataClean    = $this->limpiarDatosForm($la_dataIn);
        $la_dataValidate = $this->validarDatosFrom($la_dataClean);

        return 1;
    }

    public function encriptaPassword($arg_pass)
    {
        $ls_base64     = base64_encode($arg_pass);
        $ls_encriptada = md5(sha1($ls_base64));
        return $ls_encriptada;
    }

    public function validaFormatoMail($ls_mail)
    {
        $sintaxis = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
        if (preg_match($sintaxis, $ls_mail)) {
            return true;
        } else {
            return false;
        }
    }

    public function limpiarDatosForm($la_dataIn = array())
    {
        foreach ($la_dataIn as $clave => $valor) {
            $la_dataIn[$clave] = strip_tags(trim($valor));
        }
        return $la_dataIn;
    }

    public function validarDatosFrom($la_dataIn = array())
    {
        $la_dataIn['return'] = 1;
        foreach ($la_dataIn as $clave => $valor) {
            if ($valor == '') {
                $la_dataIn['return'] = -1;
                return $la_dataIn;
            }

            $la_dataIn[$clave] = str_replace("'", "", htmlspecialchars($valor));
        }
        return $la_dataIn;
    }
}
