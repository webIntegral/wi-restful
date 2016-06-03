<?php
namespace CPIpsAPI\V1\Rest\ExamenParametro;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="CPIpsAPI\V1\Rest\ExamenParametro\ExamenParametroCollection")
 * @ORM\Table(name="wcp_examenes_parametros")
 */
class ExamenParametroEntity
{

    /**
     *
     * @var int @ORM\Id
     *      @ORM\Column(type="integer")
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $cups;

    /**
     *
     * @var string @ORM\Column(type="integer", nullable=true)
     */
    protected $idAliasCups;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $aliasCups;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $aliasCampo;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $descr;

    /**
     *
     * @var string @ORM\Column(type="integer", nullable=true)
     */
    protected $parametro;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $sexo;

    /**
     *
     * @var string @ORM\Column(type="integer", nullable=true)
     */
    protected $edadInicial;

    /**
     *
     * @var string @ORM\Column(type="integer", nullable=true)
     */
    protected $edadFinal;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $unidadEdad;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $tipoValidacion;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $referencia;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $refMin;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $refMax;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $unidadMedida;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $descrReferencia;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $areaProcesamiento;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $equipoReactivo;

    /**
     *
     * @var string @ORM\Column(type="string", nullable=true)
     */
    protected $nitEntidad;

    /**
     *
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param int $id            
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @return the $cups
     */
    public function getCups()
    {
        return $this->cups;
    }

    /**
     *
     * @param string $cups            
     */
    public function setCups($cups)
    {
        $this->cups = $cups;
    }

    /**
     *
     * @return the $idAliasCups
     */
    public function getIdAliasCups()
    {
        return $this->idAliasCups;
    }

    /**
     *
     * @param string $idAliasCups            
     */
    public function setIdAliasCups($idAliasCups)
    {
        $this->idAliasCups = $idAliasCups;
    }

    /**
     *
     * @return the $aliasCups
     */
    public function getAliasCups()
    {
        return $this->aliasCups;
    }

    /**
     *
     * @param string $aliasCups            
     */
    public function setAliasCups($aliasCups)
    {
        $this->aliasCups = $aliasCups;
    }

    /**
     *
     * @return the $aliasCampo
     */
    public function getAliasCampo()
    {
        return $this->aliasCampo;
    }

    /**
     *
     * @param string $aliasCampo            
     */
    public function setAliasCampo($aliasCampo)
    {
        $this->aliasCampo = $aliasCampo;
    }

    /**
     *
     * @return the $descr
     */
    public function getDescr()
    {
        return $this->descr;
    }

    /**
     *
     * @param string $descr            
     */
    public function setDescr($descr)
    {
        $this->descr = $descr;
    }

    /**
     *
     * @return the $parametro
     */
    public function getParametro()
    {
        return $this->parametro;
    }

    /**
     *
     * @param string $parametro            
     */
    public function setParametro($parametro)
    {
        $this->parametro = $parametro;
    }

    /**
     *
     * @return the $sexo
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     *
     * @param string $sexo            
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     *
     * @return the $edadInicial
     */
    public function getEdadInicial()
    {
        return $this->edadInicial;
    }

    /**
     *
     * @param string $edadInicial            
     */
    public function setEdadInicial($edadInicial)
    {
        $this->edadInicial = $edadInicial;
    }

    /**
     *
     * @return the $edadFinal
     */
    public function getEdadFinal()
    {
        return $this->edadFinal;
    }

    /**
     *
     * @param string $edadFinal            
     */
    public function setEdadFinal($edadFinal)
    {
        $this->edadFinal = $edadFinal;
    }

    /**
     *
     * @return the $unidadEdad
     */
    public function getUnidadEdad()
    {
        return $this->unidadEdad;
    }

    /**
     *
     * @param string $unidadEdad            
     */
    public function setUnidadEdad($unidadEdad)
    {
        $this->unidadEdad = $unidadEdad;
    }

    /**
     *
     * @return the $tipoValidacion
     */
    public function getTipoValidacion()
    {
        return $this->tipoValidacion;
    }

    /**
     *
     * @param string $tipoValidacion            
     */
    public function setTipoValidacion($tipoValidacion)
    {
        $this->tipoValidacion = $tipoValidacion;
    }

    /**
     *
     * @return the $referencia
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     *
     * @param string $referencia            
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;
    }

    /**
     *
     * @return the $refMin
     */
    public function getRefMin()
    {
        return $this->refMin;
    }

    /**
     *
     * @param string $refMin            
     */
    public function setRefMin($refMin)
    {
        $this->refMin = $refMin;
    }

    /**
     *
     * @return the $refMax
     */
    public function getRefMax()
    {
        return $this->refMax;
    }

    /**
     *
     * @param string $refMax            
     */
    public function setRefMax($refMax)
    {
        $this->refMax = $refMax;
    }

    /**
     *
     * @return the $unidadMedida
     */
    public function getUnidadMedida()
    {
        return $this->unidadMedida;
    }

    /**
     *
     * @param string $unidadMedida            
     */
    public function setUnidadMedida($unidadMedida)
    {
        $this->unidadMedida = $unidadMedida;
    }

    /**
     *
     * @return the $descrReferencia
     */
    public function getDescrReferencia()
    {
        return $this->descrReferencia;
    }

    /**
     *
     * @param string $descrReferencia            
     */
    public function setDescrReferencia($descrReferencia)
    {
        $this->descrReferencia = $descrReferencia;
    }

    /**
     *
     * @return the $areaProcesamiento
     */
    public function getAreaProcesamiento()
    {
        return $this->areaProcesamiento;
    }

    /**
     *
     * @param string $areaProcesamiento            
     */
    public function setAreaProcesamiento($areaProcesamiento)
    {
        $this->areaProcesamiento = $areaProcesamiento;
    }

    /**
     *
     * @return the $equipoReactivo
     */
    public function getEquipoReactivo()
    {
        return $this->equipoReactivo;
    }

    /**
     *
     * @param string $equipoReactivo            
     */
    public function setEquipoReactivo($equipoReactivo)
    {
        $this->equipoReactivo = $equipoReactivo;
    }

    /**
     *
     * @return the $nitEntidad
     */
    public function getNitEntidad()
    {
        return $this->nitEntidad;
    }

    /**
     *
     * @param string $nitEntidad            
     */
    public function setNitEntidad($nitEntidad)
    {
        $this->nitEntidad = $nitEntidad;
    }

    /**
     *
     * @see Zend\\Stdlib\\Hydrator\\ArraySerializable::extract expects the provided object to implement getArrayCopy()
     * @return multitype
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}