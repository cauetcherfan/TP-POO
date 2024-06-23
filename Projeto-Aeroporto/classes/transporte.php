<?php

require_once('global.php');

class Transporte extends persist
{
    private string $veiculo;
    private array $rota;
    private array $latitude;
    private array $longitude;
    private array $sequenciaVisita;
    private int $distancia;
    private int $capacidadeVeiculo;
    protected static $local_filename ="transporte.txt";

    public function __construct(string $veiculo_, int $capacidadeVeiculo_)
    {
        $this->veiculo = $veiculo_;
        $this->capacidadeVeiculo = $capacidadeVeiculo_;
    }

    public function calculaDistancia($x1, $y1, $x2, $y2)
    {
        return 110.57 * sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));
    }

    public function calcularDistanciaTotal($tripulantes, $aeroporto)
    {
        $distanciaTotal = 0;
        $coordenadasAnteriores = $aeroporto;

        foreach ($tripulantes as $tripulante) {
            $distancia = $this->calculaDistancia(
                $coordenadasAnteriores['latitude'],
                $coordenadasAnteriores['longitude'],
                $tripulante['latitude'],
                $tripulante['longitude']
            );

            $distanciaTotal += $distancia;
            $coordenadasAnteriores = $tripulante;
        }

        $distanciaTotal += $this->calculaDistancia(
            $coordenadasAnteriores['latitude'],
            $coordenadasAnteriores['longitude'],
            $aeroporto['latitude'],
            $aeroporto['longitude']
        );

        return $distanciaTotal;
    }

    public function calcularRota()
    {
        $tripulantes = array(
            array('nome' => 'Tripulante 1', 'latitude' => -23.5505, 'longitude' => -46.6333),
            array('nome' => 'Tripulante 2', 'latitude' => -23.5674, 'longitude' => -46.6502),
            array('nome' => 'Tripulante 3', 'latitude' => -23.5439, 'longitude' => -46.6609),
        );

        $aeroporto = array('latitude' => -23.4356, 'longitude' => -46.4731);

        $distanciaTotal = $this->calcularDistanciaTotal($tripulantes, $aeroporto);

        $tempoTotal = $distanciaTotal / 18; // Velocidade média de 18 km/h
        $horarioEmbarque = strtotime('-90 minutes', strtotime('2023-06-06 12:00:00')); // Horário de decolagem da primeira viagem

        $this->sequenciaVisita = array();

        foreach ($tripulantes as $tripulante) {
            $tempoViagem = $this->calculaDistancia(
                $aeroporto['latitude'],
                $aeroporto['longitude'],
                $tripulante['latitude'],
                $tripulante['longitude']
            ) / 18;
          
          $horarioViagem = date('H:i', $horarioEmbarque - ($tempoTotal - $tempoViagem) * 3600);
            $this->sequenciaVisita[] = array(
                'nome' => $tripulante['nome'],
                'horario_embarque' => $horarioViagem
            );
        }
    }

      static public function getFilename()
        {
          return get_called_class()::$localFilename;
        }
    }


