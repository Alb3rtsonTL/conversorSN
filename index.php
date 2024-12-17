<?php

/**
 * Conversor de Bases Numéricas
 *
 * Aplicación para convertir números entre diferentes sistemas numéricos.
 * Permite realizar conversiones entre bases como binario, octal, decimal y hexadecimal. 
 * También incluye funcionalidades avanzadas como validación automática, conversión simultánea 
 * y visualización responsiva de los resultados.
 *
 * @package     ConversorSN
 * @subpackage  Aplicación de Conversión
 * @category    Herramientas de Cálculo
 * @author      Alb3rtsonTL
 * @version     1.2
 */

// Información de la aplicación
const Site_LOGO = 'Logo.png';
const Site_NAME = 'Bases Conversor';
const Site_URL = 'http://localhost/conversorSN/';
const Site_DOMINIO = 'localhost';
const Site_VERSION = '1.2';
const Site_AUTHOR = 'Alb3rtsonTL';
const Site_AUTHOR_Web = 'https://github.com/Alb3rtsonTL';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Meta-etiquetas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Calculadora de bases o conversor de bases automático.">
    <meta name="keywords" content="">
    <link rel="shortcut icon" href="Logo.png" type="image/x-icon">

    <!-- Etiqueta de título -->
    <title><?php echo Site_NAME ?></title>

    <!-- Metadatos opcionales -->
    <meta name="author" content="<?php echo Site_AUTHOR ?>">
    <meta name="robots" content="index, follow">
    <meta name="og:title" content="<?php echo Site_NAME ?>">
    <meta name="og:description" content="Calculadora de bases o conversor de bases automático.">
    <meta name="og:image" content="Logo.png">

    <base href="<?php echo Site_URL ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
</head>

<body class="bg-light" style="background: linear-gradient(
      to right,
      rgba(0, 0, 0, 0.6),
      rgba(0, 0, 0, 0.6)
    ),
    url(./fondo-WhatIf.jpeg);">
    <div class="container mt-4">
        <div class="project-header mb-4">
            <img src="./Logo.png" alt="Logo del Proyecto" class="project-logo">
            <h1 class="project-title"><?php echo Site_NAME ?></h1>
        </div>
        <div class="row">
            <!-- Formulario de conversión -->
            <div class="col-md-12 mb-4" id="formularioConversión">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Conversor</h2>
                    </div>
                    <div class="card-body">
                        <form id="conversionForm">
                            <div class="mb-3">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero" placeholder="Ingrese el número" required>
                            </div>
                            <div class="mb-3">
                                <label for="base_origen" class="form-label">Base de Origen</label>
                                <select class="form-select" id="base_origen" name="base_origen" required>
                                    <option value="2">Binario (Base 2)</option>
                                    <option value="8">Octal (Base 8)</option>
                                    <option value="10">Decimal (Base 10)</option>
                                    <option value="16">Hexadecimal (Base 16)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="base_destino" class="form-label">Base de Destino</label>
                                <select class="form-select" id="base_destino" name="base_destino" required>
                                    <option value="2">Binario (Base 2)</option>
                                    <option value="8">Octal (Base 8)</option>
                                    <option value="10">Decimal (Base 10)</option>
                                    <option value="16">Hexadecimal (Base 16)</option>
                                </select>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="convert_all" name="convert_all">
                                <label class="form-check-label" for="convert_all">Ver en los 4 sistemas numéricos</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Resultados de la conversión -->
            <div class="col-md-6" id="resultados" style="display: none;">
                <div class="card shadow-lg">
                    <div class="card-header bg-success text-white text-center">
                        <h2>Resultados</h2>
                    </div>
                    <div class="card-body">
                        <p class="text-center fs-5">El número <strong id="numero_resultado"></strong> en base <strong id="base_origen_resultado"></strong> equivale a:</p>
                        <ul class="list-group" id="resultados_lista"></ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Footer -->
        <footer class="col-md-12 mt-2">
            <div>
                <span class="">Reservados todos los derechos. </span>
                <strong>
                    Copyright &copy; <?php echo date('Y'); ?>
                    <a href="<?php echo Site_AUTHOR_Web ?>"><?php echo Site_AUTHOR ?></a>.
                </strong>
            </div>
            <div class="right d-none d-sm-inline">
                <b>Version</b>
                <strong><?php echo Site_VERSION; ?></strong>
            </div>
        </footer>
    </div>

    <script>
        // Función para convertir cualquier número a decimal
        function convertirADecimal(numero, baseOrigen) {
            numero = numero.split('').reverse().join('').toUpperCase();
            let decimal = 0;
            let potencia = 0;

            for (let i = 0; i < numero.length; i++) {
                let caracter = numero[i];
                let valor = parseInt(caracter, baseOrigen);

                if (isNaN(valor)) {
                    valor = caracter.charCodeAt(0) - 65 + 10;
                }

                if (valor >= baseOrigen) {
                    alert(`Error: El valor ${valor} no es válido en base ${baseOrigen}.`);
                    return null;
                }

                decimal += valor * Math.pow(baseOrigen, potencia);
                potencia++;
            }

            return decimal;
        }

        // Función para convertir un número decimal a cualquier base
        function convertirDesdeDecimal(decimal, baseDestino) {
            if (decimal === 0) return "0";

            let resultado = "";
            while (decimal > 0) {
                let residuo = decimal % baseDestino;
                if (residuo < 10) {
                    resultado = String.fromCharCode(residuo + 48) + resultado;
                } else {
                    resultado = String.fromCharCode(residuo - 10 + 65) + resultado;
                }
                decimal = Math.floor(decimal / baseDestino);
            }

            return resultado;
        }

        // Función para actualizar los resultados en la página
        function actualizarResultados() {
            const numero = document.getElementById('numero').value;
            const baseOrigen = parseInt(document.getElementById('base_origen').value);
            const baseDestino = parseInt(document.getElementById('base_destino').value);
            const convertAll = document.getElementById('convert_all').checked;

            // Si el campo de número está vacío, no mostrar nada
            if (!numero) {
                document.getElementById('formularioConversión').classList.remove('col-md-12');
                document.getElementById('formularioConversión').classList.add('col-md-12');
                document.getElementById('resultados').style.display = 'none';
                return;
            }

            // Convertir el número ingresado a decimal
            const decimal = convertirADecimal(numero, baseOrigen);
            if (decimal === null) return;

            let resultadosHtml = '';
            if (convertAll) {
                const binario = convertirDesdeDecimal(decimal, 2);
                const octal = convertirDesdeDecimal(decimal, 8);
                const hexadecimal = convertirDesdeDecimal(decimal, 16);
                resultadosHtml = `
                    <li class="list-group-item"><strong>Binario (Base 2):</strong> ${binario}</li>
                    <hr><li class="list-group-item"><strong>Octal (Base 8):</strong> ${octal}</li>
                    <hr><li class="list-group-item"><strong>Decimal (Base 10):</strong> ${decimal}</li>
                    <hr><li class="list-group-item"><strong>Hexadecimal (Base 16):</strong> ${hexadecimal}</li>
                `;
            } else {
                const resultado = convertirDesdeDecimal(decimal, baseDestino);
                resultadosHtml = `<li class="list-group-item"><strong>Resultado:</strong> ${resultado}</li>`;
            }

            // Actualizar los resultados en la página
            document.getElementById('numero_resultado').textContent = numero;
            document.getElementById('base_origen_resultado').textContent = baseOrigen;
            document.getElementById('resultados_lista').innerHTML = resultadosHtml;

            // Mostrar el div de resultados
            document.getElementById('formularioConversión').classList.remove('col-md-12');
            document.getElementById('formularioConversión').classList.add('col-md-6');
            document.getElementById('resultados').style.display = 'block';
        }

        // Agregar el evento de "input" en el campo número para actualizar resultados al escribir
        document.getElementById('numero').addEventListener('input', actualizarResultados);

        // Agregar eventos para actualizar resultados cuando cambian las bases o el checkbox
        document.getElementById('base_origen').addEventListener('change', actualizarResultados);
        document.getElementById('base_destino').addEventListener('change', actualizarResultados);
        document.getElementById('convert_all').addEventListener('change', actualizarResultados);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>