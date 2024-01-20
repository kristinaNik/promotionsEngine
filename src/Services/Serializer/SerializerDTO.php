<?php

namespace App\Services\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerDTO implements SerializerInterface
{
    public function __construct(private SerializerInterface $serializer)
    {
        $this->serializer = new Serializer(
            //normalizers array
            [new ObjectNormalizer(nameConverter: new CamelCaseToSnakeCaseNameConverter())],
            //encoders array
            [new JsonEncoder()]
        );
    }

    public function serialize(mixed $data, string $format, array $context = []): string
    {
        return $this->serializer->serialize($data,$format,$context);
    }

    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed
    {
       return $this->serializer->deserialize($data, $type, $format, $context);
    }
}