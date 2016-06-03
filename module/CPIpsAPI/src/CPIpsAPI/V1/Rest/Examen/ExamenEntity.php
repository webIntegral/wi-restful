<?php
namespace CPIpsAPI\V1\Rest\Examen;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use CPIpsAPI\V1\Rest\ExamenParametro\ExamenParametroCollection;

/**
 * @ORM\Entity(repositoryClass="CPIpsAPI\V1\Rest\Examen\ExamenCollection")
 * @ORM\Table(name="wcp_examenes")
 * @Gedmo\SoftDeleteable(fieldName="deleted", timeAware=false)
 */
class ExamenEntity
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
     * @var array @ORM\Column(type="array", nullable=true)
     */
    protected $examen;

    /**
     * Deletion datetime
     *
     * @var \DateTime @ORM\Column(type="datetime", nullable=true)
     */
    protected $deleted;

    /**
     * Creation datetime
     *
     * @var \DateTime @Gedmo\Timestampable(on="create")
     *      @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * Update datetime
     *
     * @var \DateTime @Gedmo\Timestampable(on="update")
     *      @ORM\Column(type="datetime")
     */
    protected $updated;

    /**
     *
     * @var CPIpsAPI\V1\Rest\Medico\MedicoEntity @ORM\ManyToOne(targetEntity="CPIpsAPI\V1\Rest\Medico\MedicoEntity", inversedBy="examenes", fetch="EAGER")
     */
    protected $medico;

    /**
     *
     * @var CPIpsAPI\V1\Rest\Afiliado\AfiliadoEntity @ORM\ManyToOne(targetEntity="CPIpsAPI\V1\Rest\Afiliado\AfiliadoEntity", inversedBy="examenes")
     */
    protected $afiliado;

    /**
     *
     * @var CPIpsAPI\V1\Rest\ExamenTipo\ExamenTipoEntity @ORM\ManyToOne(targetEntity="CPIpsAPI\V1\Rest\ExamenTipo\ExamenTipoEntity", inversedBy="examenes")
     */
    protected $examenTipo;

    /**
     * Flag to indicate that the test results are definitive and can't be modified
     *
     * @var boolean @ORM\Column(type="boolean", nullable=false)
     */
    protected $definitivo = false;

    /**
     * Temporal variable to handle data not related with the test it self.
     *
     * @var array @ORM\Column(type="array", nullable=true)
     */
    protected $tmp;

    /**
     * XML request string (for debug and error catch)
     *
     * @var string @ORM\Column(type="text", nullable=true)
     */
    protected $xmlRequest;

    /**
     * XML response string (for debug and error catch)
     *
     * @var string @ORM\Column(type="text", nullable=true)
     */
    protected $xmlResponse;

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
     * @return the $examen
     */
    public function getExamen()
    {
        return $this->examen;
    }

    /**
     *
     * @param string $examen            
     */
    public function setExamen($examen)
    {
        $this->examen = $examen;
    }

    /**
     *
     * @return the $deleted
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     *
     * @param DateTime $deleted            
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     *
     * @return the $created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     *
     * @return the $updated
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     *
     * @return the $medico
     */
    public function getMedico()
    {
        return $this->medico;
    }

    /**
     *
     * @param \CPIpsAPI\V1\Rest\Medico\MedicoEntity $medico            
     */
    public function setMedico($medico)
    {
        $this->medico = $medico;
    }

    /**
     *
     * @return the $afiliado
     */
    public function getAfiliado()
    {
        return $this->afiliado;
    }

    /**
     *
     * @param \CPIpsAPI\V1\Rest\Afiliado\AfiliadoEntity $afiliado            
     */
    public function setAfiliado($afiliado)
    {
        $this->afiliado = $afiliado;
    }

    /**
     *
     * @return the $examenTipo
     */
    public function getExamenTipo()
    {
        return $this->examenTipo;
    }

    /**
     *
     * @param \CPIpsAPI\V1\Rest\ExamenTipo\ExamenTipoEntity $examenTipo            
     */
    public function setExamenTipo($examenTipo)
    {
        $this->examenTipo = $examenTipo;
    }

    /**
     *
     * @return the $definitivo
     */
    public function getDefinitivo()
    {
        return $this->definitivo;
    }

    /**
     *
     * @param boolean $definitivo            
     */
    public function setDefinitivo($definitivo)
    {
        $this->definitivo = $definitivo;
    }

    /**
     *
     * @return the $tmp
     */
    public function getTmp()
    {
        return $this->tmp;
    }

    /**
     *
     * @param array $tmp            
     */
    public function setTmp($tmp)
    {
        $this->tmp = $tmp;
    }

    /**
     *
     * @return the $xmlRequest
     */
    public function getXmlRequest()
    {
        return $this->xmlRequest;
    }

    /**
     *
     * @param string $xmlRequest            
     */
    public function setXmlRequest($xmlRequest)
    {
        $this->xmlRequest = $xmlRequest;
    }

    /**
     *
     * @return the $xmlResponse
     */
    public function getXmlResponse()
    {
        return $this->xmlResponse;
    }

    /**
     *
     * @param string $xmlResponse            
     */
    public function setXmlResponse($xmlResponse)
    {
        $this->xmlResponse = $xmlResponse;
    }
    
    /**
     * Buidl Xml to send to remote server (Compensar)
     *
     * @param ExamenParametroCollection $parameters
     */
    public function getBuiltXml($parameters) {
    
        // Get examen
        $examen = $this->getExamen();
        // Get afiliado
        $afiliado = $this->getAfiliado();
        // Get tmp parameters
        $tmp = $this->getTmp();
    
        // Init xmlArray
        $xmlArray = array();
    
        // Iterate into each parameter
        foreach ($parameters as $parameter) {
    
            // Check if parameter is defined in examen
            if (isset($examen[$parameter->getAliasCampo()])) {
                // Check if value is not empty nor NULL
                if ('' != $examen[$parameter->getAliasCampo()] && null != $examen[$parameter->getAliasCampo()]) {
    
                    /**************/
                    /** VALIDATE **/
    
                    // Init alertaResultado flag
                    $alertaResultado = false;
    
                    switch ($parameter->getTipoValidacion()) {
                        // Validate in rango
                        case 'rango':
                            // test refMin
                            if ('' != $parameter->getRefMin() && null != $parameter->getRefMin()) {
                                if (floatval($examen[$parameter->getAliasCampo()]) < floatval($parameter->getRefMin())) {
                                    $alertaResultado = true;
                                }
                            }
    
                            // test refMax
                            if ('' != $parameter->getRefMax() && null != $parameter->getRefMax()) {
                                if (floatval($examen[$parameter->getAliasCampo()]) > floatval($parameter->getRefMax())) {
                                    $alertaResultado = true;
                                }
                            }
                            break;
    
                            // Validate menor que
                        case 'menor':
                            // test refMin
                            if ('' != $parameter->getRefMin() && null != $parameter->getRefMin()) {
                                if (floatval($examen[$parameter->getAliasCampo()]) > floatval($parameter->getRefMin())) {
                                    $alertaResultado = true;
                                }
                            }
                            break;
    
                            // Validate different than
                        case 'igual':
                            // test equal
                            if ('' != $parameter->getRefMin() && null != $parameter->getRefMin()) {
                                if ( $examen[$parameter->getAliasCampo()] != $parameter->getRefMin() ) {
                                    $alertaResultado = true;
                                }
                            }
                            break;
    
                            // none validation required
                        case 'ninguna':
                            break;
    
                            // default, in case of empty
                        default:
                            break;
                    }
    
    
    
                    /** VALIDATE **/
                    /**************/
    
                    // if cups doesn't exist create it
                    if (!isset($xmlArray[$parameter->getCups()])) {
    
                        // Create cups key
                        $xmlArray[$parameter->getCups()] = array(
                            array(
                                'ValorParametro' => $examen[$parameter->getAliasCampo()],
                                'NroParametro' => $parameter->getParametro(),
                                'AlertaResultado' => $alertaResultado
                            ),
                        );
    
                        // otherwise append parameter
                    } else {
    
                        // Append to existing cups
                        $xmlArray[$parameter->getCups()][] = array(
                            'ValorParametro' => $examen[$parameter->getAliasCampo()],
                            'NroParametro' => $parameter->getParametro(),
                            'AlertaResultado' => $alertaResultado
                        );
    
                    }
    
                } // if
            } // if
    
        } // foreach
    
        // Build Xml
        $examenXml = new \SimpleXMLElement('<ServicioLaboratorio></ServicioLaboratorio>');
    
        $examenXml->addChild('Fecha', date('Y-m-d\TH:m:s\.\0\0\0'));
        $examenXml->addChild('IdentificacionUsuario', $afiliado->getIdBeneficiario());
        $examenXml->addChild('TipoIdentificacionUsuario', $afiliado->getTidBeneficiario());
    
        // Add NUIP if necesary
        if ('7' == $afiliado->getTidBeneficiario()) {
            $examenXml->addChild('NuipUsuario', $afiliado->getNuip());
        }
    
        $examenXml->addChild('CodigoCausaExterna', $tmp['codigoCausaExterna']);
        $examenXml->addChild('CodigoEntidadResponsable', 'EPS008'); //~ // Codigo EPS Mevisalud    // TODO: Traerlo de una tabla de configuración
        $examenXml->addChild('ValorCostoEps', $tmp['valorCostoEps']);
        $examenXml->addChild('ValorCuotaModeradora', $tmp['valorCuotaModeradora']);
    
        // Build ServiciosCups
        $serviciosCups = $examenXml->addChild('ServiciosCUPS');
    
        foreach ($xmlArray as $key => $cups) {
            // Add ServicioAsociado
            $servicioAsociado = $serviciosCups->addChild('ServiciosAsociados');
    
            // Add CodigoServicio
            $servicioAsociado->addChild('CodigoServicio', $key);
    
            // iterate into $cups array
            foreach ($cups as $param) {
    
                // Add Parametros
                $parametrosServicio = $servicioAsociado->addChild('Parametros');
    
                // Add parametros values
                $parametrosServicio->addChild('ValorParametro', $param['ValorParametro']);
                $parametrosServicio->addChild('NroParametro', $param['NroParametro']);
                $parametrosServicio->addChild('AlertaResultado', ($param['AlertaResultado']) ? 'true' : 'false');
    
            } // foreach
    
        } // foreach
    
        // last parameters (after cups)
        $examenXml->addChild('CodigoClaseServicio', $tmp['codigoClaseServicio']);
        $examenXml->addChild('IdentificacionPrestador', '900631488');   //~ // Nit Mevisalud    // TODO: Traerlo de una tabla de configuración
        $examenXml->addChild('TipoIdentificacionPrestador', '1');   //~     // Nit              // TODO: Traerlo de una tabla de configuración
    
        return $examenXml->asXML();
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
