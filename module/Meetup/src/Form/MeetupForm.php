<?php

declare(strict_types=1);

namespace Meetup\Form;


use Meetup\Entity\Meetup;
use Doctrine\ORM\EntityManager;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\Date;
use Zend\Validator\StringLength;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class MeetupForm extends Form implements InputFilterProviderInterface
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct('meetup');

        $hydrator = new DoctrineHydrator($entityManager, '\Ed\Advertisers\Entity\AdVariant');
        $this->setHydrator($hydrator);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'title',
            'options' => [
                'label' => 'Title',
            ],
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'description',
            'options' => [
                'label' => 'Description',
            ],
        ]);

        $this->add([
            'type' => Element\DateTimeSelect::class,
            'name' => 'datedebut',
            'options' => [
                'label' => 'Date Debut',
            ],
        ]);

        $this->add([
            'type' => Element\DateTimeSelect::class,
            'name' => 'datefin',
            'options' => [
                'label' => 'Date Fin',
            ],
        ]);

        $this->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Submit',
            ],
        ]);

    }

    public function getInputFilterSpecification()
    {
        return [
            'title' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 2,
                            'max' => 4,
                        ],
                    ],
                ],
            ],
            'datedebut' => [
               /* 'validators' => [
                    [
                        'name' => Date::class,
                    ],
                ],*/
                'filters' => [
                    [
                        'name' => 'Zend\Filter\DatetimeFormatter',
                        'options' => [
                            'format' => 'Y-m-d H:i:s',
                        ],
                    ]
                ]
            ],
            'datefin' => [
              /*  'validators' => [
                    [
                        'name' => Date::class,
                    ],
                ],*/
                'filters' => [
                    [
                        'name' => 'Zend\Filter\DatetimeFormatter',
                        'options' => [
                            'format' => 'Y-m-d H:i:s',
                        ],
                    ]
                ]
            ],
        ];
    }
}
