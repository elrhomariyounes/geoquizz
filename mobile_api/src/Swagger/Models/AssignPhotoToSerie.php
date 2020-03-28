<?php


namespace gq\mobile\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Assign Serie",
 *     description="Affectation d'une photo à une serie existante",
 * )
 *
 */
class AssignPhotoToSerie
{
    /**
     * @OA\Property(
     *     description="l'id de l'utilisateur",
     *     title="User UUID",
     * )
     *
     * @var string
     */
    public $userId;
    /**
     * @OA\Property(
     *     format="int32",
     *     description="serie à la quelle la photo sera affecté",
     *     title="Serie Id",
     * )
     *
     * @var int
     */
    public $serieId;
}