<?php


namespace gq\player\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Assign score View Model",
 *     description="Assigne un score à la partie",
 * )
 *
 */
class AssignScore
{
    /**
     * @OA\Property(
     *     description="Score de la partie",
     *     title="Game score",
     * )
     *
     * @var int
     */
    public $score;
}