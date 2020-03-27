<?php


namespace gq\backoffice\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Difficulty",
 *     description="Difficulté",
 * )
 *
 */
class Difficulty
{
    /**
     * @OA\Property(
     *     format="2",
     *     description="Serie id",
     *     title="Serie Id",
     * )
     *
     * @var int
     */
    public $id;
    /**
     * @OA\Property(
     *     description="Diffuclté",
     *     title="Difficulty description",
     * )
     *
     * @var string
     */
    public $description;
    /**
     * @OA\Property(
     *     description="Distance de calcul de point",
     *     title="Distance",
     * )
     *
     * @var int
     */
    public $distance;
}