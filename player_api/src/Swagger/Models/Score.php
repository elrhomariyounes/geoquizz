<?php


namespace gq\player\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Score",
 *     description="Score Model",
 * )
 *
 */
class Score
{
    /**
     * @OA\Property(
     *     description="Pseudo du joueur",
     *     title="Player Pseudo",
     * )
     *
     * @var string
     */
    public $player;
    /**
     * @OA\Property(
     *     description="Score de la partie",
     *     title="Game score",
     * )
     *
     * @var int
     */
    public $score;

    /**
     * @OA\Property(
     *     format="2",
     *     description="Serie id",
     *     title="Serie Id",
     * )
     *
     * @var int
     */
    public $serie_id;
}